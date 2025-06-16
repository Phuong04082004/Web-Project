<!-- Comment Form -->
<form action="{{ url('/idea/' . $idea->id . '/comment') }}" method="POST" class="space-y-4 mb-6">
    @csrf
    <!-- Comment Input -->
    <div>
        <textarea
            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            name="content"
            rows="2"
            placeholder="Write a comment..."
            required
        ></textarea>
    </div>

    <div>
        <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium"
        >
            Post Comment
        </button>
    </div>
</form>

<hr class="border-t border-gray-200 mb-4" />

<!-- Comments List -->
<div class="space-y-4">
    @if ($idea->comments->isEmpty())
        <p class="text-sm text-gray-500 italic">No comments yet.</p>
    @else
        @foreach ($idea->comments as $comment)
            <div class="flex items-start space-x-3">
                <img
                    class="w-9 h-9 rounded-full"
                    src="{{ $comment->user->avatar_url ?? 'https://api.dicebear.com/6.x/fun-emoji/svg?seed=User' }}"
                    alt="{{ $comment->user->name ?? 'User' }} Avatar"
                />
                <div class="bg-gray-100 p-4 rounded-xl w-full">
                    <div class="flex justify-between items-center">
                        <h6 class="text-sm font-semibold text-gray-800">
                            {{ $comment->user->name ?? 'Anonymous' }}
                        </h6>
                        <span class="text-xs text-gray-500">
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <p class="mt-2 text-sm text-gray-700">
                        {{ $comment->content }}
                    </p>
                </div>
            </div>
        @endforeach
    @endif
</div>
