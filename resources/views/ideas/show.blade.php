@extends("layout.layout")
@section("content")
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Sidebar -->
        @include("layout.sidebar")

        <!-- Main Feed -->
        <div class="lg:col-span-6">
            @include("shared.toast")
            <hr class="my-4" />
            <div class="mt-3 space-y-6">
                <!-- Idea Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    @include("shared.card_idea")
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <aside class="lg:col-span-3 space-y-6">
            <!-- Search Box -->
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                <h5 class="text-lg font-bold text-gray-800 mb-4">Search</h5>
                @include("shared.search")
            </div>

            <!-- Who to Follow -->
            <div class="bg-white rounded-xl shadow-md border border-gray-100">
                <div class="p-6">
                    <h5 class="text-lg font-bold text-gray-800 mb-4">Who to follow</h5>
                    @include("shared.follow_box")
                </div>
            </div>
        </aside>
    </div>
@endsection
