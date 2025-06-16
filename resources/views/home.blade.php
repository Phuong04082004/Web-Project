@extends("layout.layout")
@section("content")
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Sidebar -->
        @include("layout.sidebar")

        <!-- Main Content -->
        <div class="lg:col-span-6">
            <!-- Toast Notifications -->
            @include("shared.toast")

            <!-- Create Idea Form -->
            <div class="p-6">
                @include("shared.create_idea")
            </div>

            <!-- Ideas Feed -->
            <div class="space-y-6">
                @if(isset($tag))
                    <div class="mb-4">
                        <h2 class="text-center text-xl font-semibold text-gray-800">🔥🔥🔥 Posts with hashtag: #<strong>{{ $tag }}</strong> 🔥🔥🔥</h2>
                    </div>
                @endif
                @foreach ($ideas as $idea)
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        @include("shared.card_idea")
                    </div>
                @endforeach

                <!-- Pagination -->
                @if ($ideas->hasPages())
                    <div class="flex justify-center py-8">
                        <nav class="inline-flex items-center -space-x-px text-sm">
                            @if ($ideas->onFirstPage())
                                <span class="px-3 py-2 ml-0 leading-tight text-gray-400 bg-white border border-gray-300 rounded-l-lg">Previous</span>
                            @else
                                <a href="{{ $ideas->previousPageUrl() }}" class="px-3 py-2 ml-0 leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-900 rounded-l-lg">Previous</a>
                            @endif

                            @foreach ($ideas->getUrlRange(1, $ideas->lastPage()) as $page => $url)
                                @if ($page == $ideas->currentPage())
                                    <span class="px-3 py-2 leading-tight text-white bg-blue-500 border border-gray-300">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-3 py-2 leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-900">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($ideas->hasMorePages())
                                <a href="{{ $ideas->nextPageUrl() }}" class="px-3 py-2 leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-900 rounded-r-lg">Next</a>
                            @else
                                <span class="px-3 py-2 leading-tight text-gray-400 bg-white border border-gray-300 rounded-r-lg">Next</span>
                            @endif
                        </nav>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Sidebar -->
        <aside class="lg:col-span-3 space-y-6">
            <!-- Search -->
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Search</h3>
                @include("shared.search")
            </div>

            <!-- Who to Follow -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Who to follow</h3>
                @include("shared.follow_box")
            </div>

            <!-- Trending Topics -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Trending</h3>
                    <div class="space-y-3">
                        @forelse($topHashtags as $tag => $count)
                            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg cursor-pointer transition-colors duration-200">
                                <div>
                                    <a href="{{ url('/hashtag/' . $tag) }}" class="font-bold hover:underline">#{{ $tag }}</a>
                                    <p class="text-sm text-gray-500">{{ $count }} News 🔥</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Không có hashtag nào nổi bật.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </aside>
    </div>
@endsection
