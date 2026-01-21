<x-guest-layout>
    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- Left Page - Article Hero -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">

            <div class="absolute inset-0 bg-cover bg-center transform transition-transform duration-700 hover:scale-105"
                style="background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1470&q=80');">
                <div class="absolute inset-0 bg-gradient-to-br from-gray-900/80 via-indigo-900/50 to-transparent"></div>
            </div>

            <!-- Editorial Content -->
            <div class="relative z-10 flex flex-col justify-center items-center w-full p-12 text-white">
                <div class="max-w-lg space-y-8">

                    <!-- Blog Logo -->
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-xl bg-indigo-600 flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 20l9-5-9-5-9 5 9 5zM12 12l9-5-9-5-9 5 9 5z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold tracking-wide">ArticleHub</h2>
                            <p class="text-sm text-gray-300">Read. Write. Inspire.</p>
                        </div>
                    </div>

                    <!-- Hero Card -->
                    <div class="space-y-5 backdrop-blur-md bg-white/10 p-10 rounded-3xl border border-white/20 shadow-2xl">
                        <h1 class="text-5xl font-extrabold leading-tight drop-shadow-lg">
                            Welcome Back
                        </h1>

                        <p class="text-xl text-gray-200 leading-relaxed">
                            Continue your journey and explore new inspiring stories every day.
                        </p>

                        <div class="pt-6 space-y-4">
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-lg">Access your saved articles</span>
                            </div>

                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3" />
                                </svg>
                                <span class="text-lg">Continue writing</span>
                            </div>

                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2a4 4 0 014-4h4" />
                                </svg>
                                <span class="text-lg">Manage your publications</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Page - Login Form -->
        <div class="flex w-full lg:w-1/2 justify-center items-center p-6 lg:p-12 bg-white">
            <div class="w-full max-w-md space-y-6">

                <!-- Header -->
                <div class="text-center space-y-2">
                    <h2 class="text-3xl font-bold text-gray-900">Sign in to your account</h2>
                    <p class="text-sm text-gray-600">Welcome back to ArticleHub</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" value="Email Address" />
                        <x-text-input id="email"
                                      class="block mt-1.5 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                      type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password"
                                      class="block mt-1.5 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                      type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox"
                                   class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                   name="remember">
                            <span class="text-sm text-gray-600">Remember me</span>
                        </label>

                        <a href="{{ route('password.request') }}"
                           class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Submit -->
                    <div class="pt-2">
                        <x-primary-button
                            class="w-full justify-center py-3 text-base font-semibold rounded-lg bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition-all shadow-lg hover:shadow-xl">
                            Sign In
                        </x-primary-button>
                    </div>

                    <!-- Register -->
                    <div class="text-center pt-2">
                        <span class="text-sm text-gray-600">Don’t have an account?</span>
                        <a href="{{ route('register') }}"
                           class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold transition-colors">
                            Create account
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
