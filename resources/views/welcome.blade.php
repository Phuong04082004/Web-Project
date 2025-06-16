<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ideas - Where Great Minds Meet</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">
<!-- Navigation -->
<nav class="bg-white/80 backdrop-blur-md shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="bg-gradient-to-r from-primary-500 to-purple-600 p-2 rounded-lg">
                    <i class="fas fa-brain text-white text-xl"></i>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-purple-600 bg-clip-text text-transparent">
                        Ideas
                    </span>
            </div>
            <div class="hidden md:flex space-x-4">
                <a href="/login" class="px-4 py-2 text-gray-700 hover:text-primary-600 font-medium transition-colors duration-200">
                    Login
                </a>
                <a href="/register" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Get Started
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="container mx-auto px-6 py-20">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
        <!-- Left Content -->
        <div class="space-y-8">
            <div class="space-y-4">
                <div class="inline-block">
                        <span class="bg-primary-100 text-primary-800 px-4 py-2 rounded-full text-sm font-medium">
                            🚀 Welcome to the future of idea sharing
                        </span>
                </div>
                <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                    Where
                    <span class="bg-gradient-to-r from-primary-600 to-purple-600 bg-clip-text text-transparent">
                            Great Minds
                        </span>
                    Meet
                </h1>
                <p class="text-xl text-gray-600 leading-relaxed">
                    Share your thoughts, discover brilliant ideas, and connect with creative minds from around the world. Join our community of innovators and thought leaders.
                </p>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/register" class="group px-8 py-4 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition-all duration-200 shadow-xl hover:shadow-2xl font-semibold text-center">
                        <span class="flex items-center justify-center">
                            Start Sharing Ideas
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                        </span>
                </a>
                <a href="/login" class="px-8 py-4 border-2 border-primary-600 text-primary-600 rounded-xl hover:bg-primary-50 transition-all duration-200 font-semibold text-center">
                    Sign In
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-6 pt-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-gray-900">10K+</div>
                    <div class="text-sm text-gray-600">Active Users</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-gray-900">50K+</div>
                    <div class="text-sm text-gray-600">Ideas Shared</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-gray-900">100+</div>
                    <div class="text-sm text-gray-600">Countries</div>
                </div>
            </div>
        </div>

        <!-- Right Content - Floating Cards -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-primary-400 to-purple-500 rounded-full opacity-20 blur-3xl"></div>

            <!-- Floating Idea Cards -->
            <div class="relative space-y-4">
                <div class="bg-white rounded-2xl p-6 shadow-xl animate-float border border-gray-100">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-lightbulb text-white"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Sarah Chen</div>
                            <div class="text-sm text-gray-500">Tech Innovator</div>
                        </div>
                    </div>
                    <p class="text-gray-700">
                        "What if we could use AI to predict and prevent traffic jams before they happen? 🚗💭"
                    </p>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <i class="fas fa-heart text-red-500 mr-1"></i>
                                    127
                                </span>
                            <span class="flex items-center">
                                    <i class="fas fa-comment text-blue-500 mr-1"></i>
                                    23
                                </span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-xl animate-float border border-gray-100 ml-8" style="animation-delay: -2s;">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-leaf text-white"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Alex Rivera</div>
                            <div class="text-sm text-gray-500">Environmental Scientist</div>
                        </div>
                    </div>
                    <p class="text-gray-700">
                        "Imagine vertical farms in every neighborhood - fresh food with zero transport emissions! 🌱"
                    </p>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <i class="fas fa-heart text-red-500 mr-1"></i>
                                    89
                                </span>
                            <span class="flex items-center">
                                    <i class="fas fa-comment text-blue-500 mr-1"></i>
                                    15
                                </span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-xl animate-float border border-gray-100" style="animation-delay: -4s;">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-palette text-white"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Maya Patel</div>
                            <div class="text-sm text-gray-500">UX Designer</div>
                        </div>
                    </div>
                    <p class="text-gray-700">
                        "Voice interfaces for the visually impaired could revolutionize web accessibility! 🎙️✨"
                    </p>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <i class="fas fa-heart text-red-500 mr-1"></i>
                                    156
                                </span>
                            <span class="flex items-center">
                                    <i class="fas fa-comment text-blue-500 mr-1"></i>
                                    31
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="bg-white py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Why Choose Ideas?
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Our platform is designed to foster creativity, collaboration, and innovation
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center group">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-200">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Connect & Collaborate</h3>
                <p class="text-gray-600">
                    Meet like-minded individuals and collaborate on groundbreaking projects
                </p>
            </div>

            <div class="text-center group">
                <div class="bg-gradient-to-r from-green-500 to-teal-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-200">
                    <i class="fas fa-rocket text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Launch Your Ideas</h3>
                <p class="text-gray-600">
                    Get feedback, find supporters, and turn your concepts into reality
                </p>
            </div>

            <div class="text-center group">
                <div class="bg-gradient-to-r from-purple-500 to-pink-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-200">
                    <i class="fas fa-trophy text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Get Recognized</h3>
                <p class="text-gray-600">
                    Build your reputation and showcase your innovative thinking
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-2 mb-4 md:mb-0">
                <div class="bg-gradient-to-r from-primary-500 to-purple-600 p-2 rounded-lg">
                    <i class="fas fa-brain text-white"></i>
                </div>
                <span class="text-xl font-bold">Ideas</span>
            </div>
            <div class="flex space-x-6">
                <a href="/term" class="text-gray-400 hover:text-white transition-colors duration-200">Terms</a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Privacy</a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Support</a>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2025 Ideas. All rights reserved. Made with ❤️ for innovators worldwide.</p>
        </div>
    </div>
</footer>
</body>
</html>
