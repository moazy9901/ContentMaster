<x-guest-layout>
    <!-- Full-Width Book Layout -->
    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- Left Page - Article Hero Side -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
        
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center transform transition-transform duration-700 hover:scale-105"
                style="background-image: url('https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=1470&q=80');">
        
                <!-- Dark Overlay -->
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
        
                    <!-- Glass Card -->
                    <div class="space-y-5 backdrop-blur-md bg-white/10 p-10 rounded-3xl border border-white/20 shadow-2xl">
        
                        <h1 class="text-5xl font-extrabold leading-tight drop-shadow-lg">
                            Discover Stories That Matter
                        </h1>
        
                        <p class="text-xl text-gray-200 leading-relaxed">
                            A modern publishing platform for writers, creators, and thinkers.
                            Share your ideas and explore inspiring content from around the world.
                        </p>
        
                        <!-- Features -->
                        <div class="pt-6 space-y-4">
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-lg">Publish your own articles</span>
                            </div>
        
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                                </svg>
                                <span class="text-lg">Read trending topics daily</span>
                            </div>
        
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2a4 4 0 014-4h4" />
                                </svg>
                                <span class="text-lg">Grow your audience</span>
                            </div>
                        </div>
        
                    </div>
                </div>
            </div>
        </div>


        <!-- Right Page - Form Side -->
        <div
            class="flex w-full lg:w-1/2 justify-center items-center p-6 lg:p-12 bg-white dark:bg-gray-800 transition-colors duration-300">
            <div class="w-full max-w-md space-y-6">

                <!-- Mobile Logo -->
                <div class="lg:hidden text-center">
                    <x-application-logo class="w-16 h-16 mx-auto text-indigo-600" />
                </div>

                <!-- Header -->
                <div class="text-center space-y-2">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Create an Account</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Fill in your details below</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <!-- Profile Image -->
                    <div>
                        <x-input-label value="Profile Image" />
                        <input type="file" name="image" class="block w-full mt-2 text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:bg-indigo-50 file:text-indigo-700
                                      hover:file:bg-indigo-100
                                      transition-all">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" value="Full Name" />
                        <x-text-input id="name"
                            class="block mt-1.5 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                            type="text" name="name" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" value="Email Address" />
                        <x-text-input id="email"
                            class="block mt-1.5 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                            type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Role -->
                    <div>
                        <x-input-label for="role" value="Select Role" />
                        <select name="role" id="role"
                            class="block mt-1.5 w-full rounded-lg border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            <option value="">-- Choose Role --</option>
                            <option value="editor">Editor</option>
                            <option value="user">User</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password"
                            class="block mt-1.5 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                            type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" value="Confirm Password" />
                        <x-text-input id="password_confirmation"
                            class="block mt-1.5 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                            type="password" name="password_confirmation" required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="pt-2">
                        <x-primary-button
                            class="w-full justify-center py-3 text-base font-semibold rounded-lg bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition-all shadow-lg hover:shadow-xl">
                            Create Account
                        </x-primary-button>
                    </div>

                    <!-- Login -->
                    <div class="text-center pt-2">
                        <span class="text-sm text-gray-600">Already have an account?</span>
                        <a href="{{ route('login') }}"
                            class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold transition-colors">
                            Sign in
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>