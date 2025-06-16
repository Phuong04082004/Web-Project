@extends("layout.layout")

@section("content")
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 mb-8">
            <div class="px-8 py-12 text-center">
                <div class="flex justify-center mb-6">
                    <div class="bg-primary-100 p-4 rounded-full">
                        <i class="fas fa-file-contract text-3xl text-primary-600"></i>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Terms of Service</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Please read these terms carefully before using our platform. By accessing Ideas, you agree to be bound by these terms.
                </p>
                <div class="mt-6 flex justify-center">
                <span class="bg-primary-100 text-primary-800 px-4 py-2 rounded-full text-sm font-medium">
                    Last updated: January 2025
                </span>
                </div>
            </div>
        </div>

        <!-- Terms Content -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100">
            <div class="p-8">
                <div class="prose max-w-none">
                    <!-- Section 1 -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-primary-100 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3">1</span>
                            Acceptance of Terms
                        </h2>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <p class="text-gray-700 leading-relaxed">
                                By accessing and using Ideas ("the Service"), you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.
                            </p>
                        </div>
                    </div>

                    <!-- Section 2 -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-primary-100 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3">2</span>
                            User Accounts
                        </h2>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <p class="text-gray-700 leading-relaxed mb-4">
                                When you create an account with us, you must provide information that is accurate, complete, and current at all times. You are responsible for safeguarding the password and for all activities that occur under your account.
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 space-y-2">
                                <li>You must be at least 13 years old to use this service</li>
                                <li>You are responsible for maintaining the security of your account</li>
                                <li>You must not share your account credentials with others</li>
                                <li>You must notify us immediately of any unauthorized use</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Section 3 -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-primary-100 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3">3</span>
                            Content and Conduct
                        </h2>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <p class="text-gray-700 leading-relaxed mb-4">
                                You are solely responsible for any content you post, upload, or share through the Service. By posting content, you grant us the right to use, modify, and display such content.
                            </p>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="bg-white rounded-lg p-4 border border-gray-200">
                                    <h4 class="font-semibold text-gray-900 mb-2 flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        Allowed
                                    </h4>
                                    <ul class="text-sm text-gray-700 space-y-1">
                                        <li>• Original ideas and thoughts</li>
                                        <li>• Constructive discussions</li>
                                        <li>• Educational content</li>
                                        <li>• Creative works</li>
                                    </ul>
                                </div>
                                <div class="bg-white rounded-lg p-4 border border-gray-200">
                                    <h4 class="font-semibold text-gray-900 mb-2 flex items-center">
                                        <i class="fas fa-times text-red-500 mr-2"></i>
                                        Prohibited
                                    </h4>
                                    <ul class="text-sm text-gray-700 space-y-1">
                                        <li>• Hate speech or harassment</li>
                                        <li>• Spam or misleading content</li>
                                        <li>• Copyrighted material</li>
                                        <li>• Illegal activities</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4 -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-primary-100 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3">4</span>
                            Privacy and Data
                        </h2>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <p class="text-gray-700 leading-relaxed mb-4">
                                Your privacy is important to us. We collect and use your information in accordance with our Privacy Policy, which is incorporated into these Terms by reference.
                            </p>
                            <div class="bg-primary-50 border border-primary-200 rounded-lg p-4">
                                <p class="text-primary-800 font-medium flex items-center">
                                    <i class="fas fa-shield-alt mr-2"></i>
                                    We are committed to protecting your personal information and will never sell your data to third parties.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5 -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-primary-100 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3">5</span>
                            Termination
                        </h2>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <p class="text-gray-700 leading-relaxed">
                                We may terminate or suspend your account and bar access to the Service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever, including but not limited to a breach of the Terms.
                            </p>
                        </div>
                    </div>

                    <!-- Section 6 -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-primary-100 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3">6</span>
                            Changes to Terms
                        </h2>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <p class="text-gray-700 leading-relaxed">
                                We reserve the right to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days notice prior to any new terms taking effect.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="border-t border-gray-200 px-8 py-6 bg-gray-50 rounded-b-2xl">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-gray-600 mb-4 md:mb-0">
                        <p>If you have any questions about these Terms, please contact us at:</p>
                        <a href="mailto:support@ideas.com" class="text-primary-600 hover:text-primary-500 font-medium">
                            support@ideas.com
                        </a>
                    </div>
                    <div class="flex space-x-4">
                        <a href="/" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition-colors duration-200 font-medium">
                            Back to Home
                        </a>
                        <a href="/login" class="border border-primary-600 text-primary-600 px-6 py-2 rounded-lg hover:bg-primary-50 transition-colors duration-200 font-medium">
                            Sign In
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
