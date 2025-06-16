<div class="bg-white shadow-xl rounded-lg p-6">
    <div class="mb-4 border-b pb-2">
        <h2 class="text-2xl font-bold tracking-tight text-gray-800">🔍 Search</h2>
    </div>
    <form method="GET" action="{{ url('/') }}" class="space-y-4">
        <div class="flex items-center gap-2">
            <input
                type="text"
                id="search"
                name="search"
                placeholder="Type something badass..."
                class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black focus:border-black transition"
            />
        </div>
        <button
            type="submit"
            class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-black rounded-md hover:bg-gray-800 transition-all"
        >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z">
                </path>
            </svg>
            Search
        </button>
    </form>
</div>
