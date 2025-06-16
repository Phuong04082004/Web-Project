@extends('layout.layout')

@section('content')
    <script>
        function toggleFollow(userId) {
            fetch(`/users/${userId}/toggle-follow`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    const followButton = document.getElementById('followButton');
                    if (data.following) {
                        followButton.textContent = 'Following';
                        followButton.classList.remove('bg-blue-600', 'text-white');
                        followButton.classList.add('bg-gray-200', 'text-gray-800');
                    } else {
                        followButton.textContent = 'Follow';
                        followButton.classList.remove('bg-gray-200', 'text-gray-800');
                        followButton.classList.add('bg-blue-600', 'text-white');
                    }

                    const followersCount = document.querySelector('[data-followers-count]');
                    if (followersCount) {
                        followersCount.textContent = data.followersCount;
                    }
                });
        }
    </script>
    <div class="min-h-screen bg-gray-100">
        <!-- Header Profile -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center py-8 gap-8">
                    <!-- Avatar -->
                    <div class="relative group">
                        <img
                            src="{{ $user->avatar_url }}"
                            alt="{{ $user->name }}"
                            class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover"
                        >
                        @auth
                            @if(auth()->id() === $user->id)
                                <div class="absolute inset-0 rounded-full bg-black/30 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                                    <button class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-full text-sm font-medium">
                                        Change Avatar
                                    </button>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <!-- Thông tin người dùng -->
                    <div class="flex-1">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                                <p class="text-gray-600">{{ '@'.$user->nickname }}</p>
                                <p class="text-xl text-gray-900">{{ $user->bio ?? 'No bio yet' }}</p>
                            </div>

                            @auth
                                @if(auth()->id() !== $user->id)
                                    <button
                                        onclick="toggleFollow({{ $user->id }})"
                                        class="px-6 py-2 rounded-full font-medium text-sm {{ auth()->user()->isFollowing($user) ? 'bg-gray-200 text-gray-800' : 'bg-blue-600 text-white' }}"
                                        id="followButton"
                                    >
                                        {{ auth()->user()->isFollowing($user) ? 'Following' : 'Follow' }}
                                    </button>

                                @else
                                    <a
                                        href="{{ route('profile.edit') }}"
                                        class="px-6 py-2 bg-gray-300 text-gray-800 rounded-full font-medium text-sm hover:bg-gray-300"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2m4-4h4m-4 0v4m0-4H8m8 0v4m0-4h-4m8 8h-4m4 0v4m0-4H8m8 0v4m0-4H8" />
                                        <span>Edit Profile</span>
                                    </a>
                                @endif
                            @endauth
                        </div>

                        <!-- Thống kê -->
                        <div class="flex gap-6 mt-6 text-sm">
                            <div class="flex items-center gap-1">
                                <span class="font-semibold" data-followers-count>{{ $user->followers->count() }}</span>
                                <span class="text-gray-600">News</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="font-semibold">{{ $user->followers->count() }}</span>
                                <span class="text-gray-600">Followers</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="font-semibold">{{ $user->following->count() }}</span>
                                <span class="text-gray-600">Following</span>
                            </div>
                        </div>

                        <!-- Bio -->
                        @if($user->bio)
                            <p class="mt-4 text-gray-700">{{ $user->bio }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Nội dung chính -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Tab điều hướng -->
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <a
                        href="#"
                        class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                    >
                        News
                    </a>
                    <a
                        href="#"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                    >
                        Liked
                    </a>
                    <a
                        href="#"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                    >
                        Comments
                    </a>
                </nav>
            </div>

            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($ideas as $idea)
                    <div onclick="window.location.href='{{ route('ideas.show', ['id' => $idea->id]) }}'" class="cursor-pointer bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <img
                                    src="{{ $idea->user->avatar_url }}"
                                    alt="{{ $idea->user->name }}"
                                    class="w-10 h-10 rounded-full"
                                >
                                <div>
                                    <h3 class="font-medium">{{ $idea->user->name }}</h3>
                                    <p class="text-xs text-gray-500">{{ $idea->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <a href="{{ route('ideas.show', $idea) }}" class="block">
                                <p class="text-gray-600 line-clamp-3">{{ $idea->content }}</p>
                            </a>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <button class="text-gray-500 hover:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                    <span class="text-sm text-gray-500">{{ $idea->likes_count }}</span>
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $idea->comments->count() }} comments
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No news yet</h3>
                        <p class="mt-1 text-gray-500">Khi {{ $user->name }} post news, you will see it here.</p>
                    </div>
                @endforelse
            </div>

            <!-- Phân trang -->
            @if($ideas->hasPages())
                <div class="mt-8">
                    {{ $ideas->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
