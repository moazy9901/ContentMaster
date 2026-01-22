<!-- Primary Navigation Menu -->
<nav x-data="{ open: false, profileOpen: false, lang: 'EN', darkMode: localStorage.theme === 'dark' }" 
     x-init="document.documentElement.classList.toggle('dark', darkMode);"
     class="bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-700">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left Side -->
            <div class="flex items-center gap-8">

                <!-- Logo -->
                <a href="{{ route('articles.index') }}" class="flex items-center gap-2">
                    <img src="{{ asset('logo.jpg') }}" alt="Logo" class="h-9 w-9 rounded">
                    <span class="font-bold text-lg">
                        <span class="text-blue-600 dark:text-blue-400">Content</span><span class="text-black dark:text-white">Master</span>
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex items-center justify-center space-x-8">
                    <x-nav-link :href="route('articles.index')" 
                                :active="request()->routeIs('articles.index')" 
                                class="text-gray-900 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400">
                        {{ __('site.articles') }}
                    </x-nav-link>
                    <x-nav-link :href="route('categories.index')" 
                                :active="request()->routeIs('categories.index')" 
                                class="text-gray-900 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400">
                        {{ __('site.categories') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex items-center gap-4">

    
                <!-- Language Toggle -->
                <div class="relative group ml-4">
                    <button class="flex items-center gap-2 text-gray-600 hover:text-indigo-600 font-medium transition">
                        🌍 {{ __('site.language') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                
                    <div
                        class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('language.en') }}"
                            class="block px-4 py-2 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            🇬🇧 {{ __('site.english') }}
                        </a>
                        <a href="{{ route('language.ar') }}"
                            class="block px-4 py-2 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                            🇪🇬 {{ __('site.arabic') }}
                        </a>
                    </div>
                </div>


                <!-- Profile / Auth Links -->
                @auth
                <div class="relative">
                    <button @click="profileOpen = !profileOpen" 
                            @keydown.escape.window="profileOpen = false" 
                            type="button" 
                            class="flex items-center gap-2 rounded-full border border-transparent bg-white dark:bg-slate-900 px-3 py-1.5 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-slate-800 transition">
                        <img class="h-9 w-9 rounded-full border border-gray-300 dark:border-slate-600 object-cover"
                            src="{{ Auth::user()?->image ? asset('storage/' . Auth::user()?->image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()?->name ?? 'Guest') . '&background=4f46e5&color=fff' }}" 
                            alt="{{ Auth::user()?->name ?? 'Guest' }}">
                        <span class="hidden sm:block">{{ auth()->user()?->name ?? 'Guest' }}</span>
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 transition-transform duration-200" 
                             :class="profileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="profileOpen" @click.away="profileOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                        class="absolute right-0 mt-2 w-52 origin-top-right rounded-xl bg-white dark:bg-slate-900 shadow-lg ring-1 ring-black/10 z-50">
                        <div class="py-2">
                            @php
    $dashboardRoute = match (auth()->user()->role) {
        'candidate' => 'candidate.dashboard',
        'employer' => 'employer.dashboard',
        'admin' => 'admin.dashboard',
        default => null,
    };
                            @endphp
                            <a href="{{ route('articles.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-800 transition">🏠 Home</a>
                            @if ($dashboardRoute)
                                <a href="{{ route($dashboardRoute) }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-800 transition">📊 Dashboard</a>
                            @endif
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-800 transition">👤 Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-slate-800 transition">🚪 Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition font-medium">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition font-medium">Register</a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="p-2 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-slate-700 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-white dark:bg-slate-900">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('articles.index')" :active="request()->routeIs('articles.index')" class="text-gray-900 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400">Home</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index.*')" class="text-gray-900 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400">Categories</x-responsive-nav-link>
        </div>

        @auth
        <div class="border-t border-gray-200 dark:border-slate-700 py-3 px-4">
            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}</div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-900 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-900 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400">Log Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
