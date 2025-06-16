<nav class="bg-white shadow-lg border-b sticky top-0 z-50 backdrop-blur-md bg-white/95">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-2 text-2xl font-bold text-gray-800 hover:text-primary-600 transition-colors duration-200">
                    <span class="fa-solid fa-radio text-primary-500"></span>
                    <span class="bg-gradient-to-r from-primary-600 to-purple-600 bg-clip-text text-transparent">InSocial</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    <!-- Avatar + Name Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 px-3 py-2 hover:bg-gray-100 rounded-lg transition-all duration-200">
                            <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                            <span class="font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transform -translate-y-2 group-hover:visible invisible transition-all duration-200 z-50">
                            <a href="{{ route('profile.show', auth()->user()) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Not logged in -->
                    <a href="/login" class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-200 font-medium">
                        Login
                    </a>
                    <a href="/register" class="px-4 py-2 bg-primary-500 text-white hover:bg-primary-600 rounded-lg transition-all duration-200 font-medium shadow-md hover:shadow-lg">
                        Register
                    </a>
                @endauth
            </div>


            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-2">
                    @auth
                        <div class="flex items-center space-x-3 px-4">
                            <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                        </div>
                        <a href="/profile" class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-200 font-medium">
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-left px-4 py-2 text-gray-700 hover:bg-primary-50 rounded-lg transition-all duration-200 font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="/login" class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-200 font-medium">
                            Login
                        </a>
                        <a href="/register" class="px-4 py-2 bg-primary-500 text-white hover:bg-primary-600 rounded-lg transition-all duration-200 font-medium">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-2">
                <a href="/login" class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-200 font-medium">
                    Login
                </a>
                <a href="/register" class="px-4 py-2 bg-primary-500 text-white hover:bg-primary-600 rounded-lg transition-all duration-200 font-medium">
                    Register
                </a>
                <a href="/profile" class="px-4 py-2 text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-200 font-medium">
                    Profile
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>
