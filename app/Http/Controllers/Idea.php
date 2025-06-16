<?php

namespace App\Http\Controllers;

use App\Models\Idea as ModelsIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Idea extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query('search');

        $ideas = ModelsIdea::with(['user', 'comments.user', 'media'])
            ->when($search, fn($q) => $q->where('content', 'like', '%' . $search . '%'))
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $allContents = ModelsIdea::pluck('content');

        $hashtagCounts = [];
        foreach ($allContents as $content) {
            preg_match_all('/#([\p{L}0-9_]+)/u', $content, $matches);
            foreach ($matches[1] as $tag) {
                $tag = Str::lower($tag);
                $hashtagCounts[$tag] = ($hashtagCounts[$tag] ?? 0) + 1;
            }
        }

        arsort($hashtagCounts);
        $topHashtags = array_slice($hashtagCounts, 0, 10, true);

        return view('home', compact('ideas', 'search', 'topHashtags'));
    }


    public function createIdea(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:2|max:255',
            'media.*' => 'file|mimes:jpeg,jpg,png,gif,mp4|max:10240' // mỗi file tối đa 10MB
        ]);

        // Lưu Idea mới
        $idea = new ModelsIdea();
        $idea->content = $validated['content'];
        $idea->likes = 0;
        $idea->user_id = Auth::id();
        $idea->save();

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('media', 'public');
                $type = str_starts_with($file->getMimeType(), 'video/') ? 'video' : 'image';

                $idea->media()->create([
                    'file_path' => $path,
                    'type' => $type
                ]);
            }
        }

        return redirect("/")->with("success", "Your news has been saved successfully!");
    }

    public function delete($id)
    {
        $idea = ModelsIdea::find($id);

        if (!$idea) {
            return redirect("/")->with("fail", "The idea does not exist or has already been deleted!");
        }
        if ($idea->user_id !== Auth::id()) {
            return redirect("/")->with("fail", "You are not authorized to delete this idea!");
        }
        $idea->comments()->delete();
        $idea->likes()->delete();

        $idea->delete();

        return redirect("/")->with("success", "The idea has been deleted successfully!");
    }

    public function show($id)
    {
        return view("ideas.show", ["idea" => ModelsIdea::find($id)]);
    }

    public function edit($id)
    {
        $idea = ModelsIdea::find($id);
        $edit = true;
        return view("ideas.show", ["idea" => $idea, "edit" => $edit]);
    }

    public function update(Request $request, $id)
    {
        $idea = ModelsIdea::with('media')->findOrFail($id);

        // Validate request
        $request->validate([
            'content' => 'required|string|min:2|max:255',
            'existing_media_ids' => 'sometimes|array',
            'existing_media_ids.*' => 'exists:media,id',
            'deleted_media_ids' => 'sometimes|array',
            'deleted_media_ids.*' => 'exists:media,id',
            'media_replace' => 'sometimes|array',
            'media_replace.*' => 'in:0,1',
            'media' => 'sometimes|array',
            'media.*' => 'file|mimes:jpeg,png,gif,mp4|max:10240',
            'new_media' => 'sometimes|array',
            'new_media.*' => 'file|mimes:jpeg,png,gif,mp4|max:10240',
        ]);

        // Kiểm tra quyền sở hữu
        if ($idea->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this idea!');
        }

        // Update content
        $idea->content = $request->input('content');
        $idea->save();

        // Xử lý media bị xóa
        $deletedMediaIds = $request->input('deleted_media_ids', []);
        if (!empty($deletedMediaIds)) {
            $mediaToDelete = $idea->media()->whereIn('id', $deletedMediaIds)->get();
            foreach ($mediaToDelete as $media) {
                Storage::disk('public')->delete($media->file_path);
                $media->delete();
            }
        }

        // Xử lý media bị thay thế
        $mediaReplaces = $request->input('media_replace', []);
        foreach ($mediaReplaces as $mediaId => $replaceFlag) {
            if ($replaceFlag && $request->hasFile("media.{$mediaId}")) {
                $media = $idea->media()->find($mediaId);
                if ($media) {
                    // Xóa file cũ
                    Storage::disk('public')->delete($media->file_path);

                    // Lưu file mới
                    $file = $request->file("media.{$mediaId}");
                    $path = $file->store('media', 'public');

                    // Cập nhật media
                    $media->file_path = $path;
                    $media->type = str_starts_with($file->getMimeType(), 'video/') ? 'video' : 'image';
                    $media->save();
                }
            }
        }

        // Xử lý media mới
        if ($request->hasFile('new_media')) {
            // Kiểm tra tổng số media
            $currentMediaCount = $idea->media->count() - count($deletedMediaIds);
            $newMediaCount = count($request->file('new_media'));

            if ($currentMediaCount + $newMediaCount > 5) {
                return redirect()->back()->withErrors(['media' => 'Maximum 5 media files allowed.']);
            }

            foreach ($request->file('new_media') as $file) {
                $path = $file->store('media', 'public');
                $idea->media()->create([
                    'file_path' => $path,
                    'type' => str_starts_with($file->getMimeType(), 'video/') ? 'video' : 'image'
                ]);
            }
        }

        return redirect()->route('ideas.show', $idea)->with('success', 'Idea updated successfully!');
    }

    public function hashtag($tag)
    {
        $tag = strtolower($tag);

        $ideas = ModelsIdea::with(['user', 'comments.user', 'media'])
            ->where('content', 'like', "%#{$tag}%")
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $search = null;

        // Reuse topHashtags logic if needed
        $allContents = ModelsIdea::pluck('content');
        $hashtagCounts = [];

        foreach ($allContents as $content) {
            preg_match_all('/#([\p{L}0-9_]+)/u', $content, $matches);
            foreach ($matches[1] as $t) {
                $t = Str::lower($t);
                $hashtagCounts[$t] = ($hashtagCounts[$t] ?? 0) + 1;
            }
        }

        arsort($hashtagCounts);
        $topHashtags = array_slice($hashtagCounts, 0, 10, true);

        return view('home', compact('ideas', 'tag', 'topHashtags', 'search'));
    }
}
