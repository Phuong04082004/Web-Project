<?php

namespace App\Http\Controllers;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $ideas = $user->ideas()
            ->withCount(['likes', 'comments'])
            ->latest()
            ->paginate(9);

        return view('profile', [
            'user' => $user,
            'ideas' => $ideas,
            'follo'
        ]);
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->name = $validated['name'];
        $user->bio = $validated['bio'] ?? null;
        $user->save();

        return redirect()->route('profile')->with('success', 'Cập nhật hồ sơ thành công.');
    }
}
