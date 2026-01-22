<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .transition-base {
            transition: all .15s ease-in-out;
        }

        .sidebar.collapsed {
            width: 5rem;
        }

        .sidebar .sidebar-label {
            display: inline;
            font-weight: 600;
        }

        .sidebar.collapsed .sidebar-label {
            display: none;
        }

        .sidebar.collapsed .logo-text {
            display: none;
        }

        .sidebar .nav-icon {
            width: 1.5rem;
            height: 1.5rem;
        }

        .sidebar.collapsed .nav-icon {
            width: 3rem;
            height: 1rem;
        }

        .sidebar.collapsed .sidebar-footer {
            display: none;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(8px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        @keyframes scale-in {
            from {
                opacity: 0;
                transform: scale(.98)
            }

            to {
                opacity: 1;
                transform: scale(1)
            }
        }

        .animate-fade-in {
            animation: fade-in .28s ease-out both;
        }

        .animate-scale-in {
            animation: scale-in .18s ease-out both;
        }

        @media (min-width: 768px) {
            .main-with-sidebar-expanded {
                margin-left: 16rem;
            }

            .main-with-sidebar-collapsed {
                margin-left: 5rem;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50 text-gray-900">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="sidebar fixed min-h-screen inset-y-0 left-0 z-40 w-64 md:translate-x-0 bg-white border-r border-gray-200 flex flex-col transition-transform duration-150 ease-in-out shadow-lg rounded-r-xl overflow-hidden">
        
            <!-- Logo / Header -->
            <div class="h-16 px-4 md:px-6 flex items-center justify-between border-b border-gray-200">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 min-w-0">
                    <img src="{{ asset('admin.avif') }}" alt="Logo" class="h-8 w-auto rounded">
                    <span class="logo-text text-xl font-extrabold truncate text-indigo-600">Admin Panel</span>
                </a>
                <button id="sidebar-close" class="md:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100 transition-base">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        
            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md transition-base {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-100 font-semibold text-indigo-700' : 'hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="nav-icon w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l7-7 7 7M5 10v10h14V10" />
                    </svg>
                    <span class="sidebar-label">Dashboard</span>
                </a>
        
                <a href="{{ route('articles.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md transition-base {{ request()->routeIs('articles.*') ? 'bg-indigo-100 font-semibold text-indigo-700' : 'hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="nav-icon w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2z" />
                    </svg>
                    <span class="sidebar-label">Articles</span>
                </a>
        
                <a href="{{ route('categories.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md transition-base {{ request()->routeIs('categories.*') ? 'bg-indigo-100 font-semibold text-indigo-700' : 'hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="nav-icon w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 4.5h6v6h-6v-6zM13.5 4.5h6v6h-6v-6zM4.5 13.5h6v6h-6v-6zM13.5 13.5h6v6h-6v-6z" />
                    </svg>
                    <span class="sidebar-label">Categories</span>
                </a>
        
                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 w-full text-left px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition-base">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="nav-icon w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6A2.25 2.25 0 0 0 15.75 18.75V15" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H9.75M15.75 9L18 12l-2.25 3" />
                        </svg>
                        <span class="sidebar-label">Logout</span>
                    </button>
                </form>
            </nav>
        
            <!-- Sidebar Footer -->
            
            <div class="sidebar-footer px-4 py-3 border-t border-gray-200 bg-gray-50 text-xs">
    @if(auth()->check())
        <div class="flex items-center gap-3 mb-3">
            <!-- User Avatar -->
            <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-semibold text-sm shadow-sm">
                {{ strtoupper(mb_substr(auth()->user()->name ?: 'A', 0, 1)) }}
            </div>
            
            <!-- User Info -->
            <div class="truncate">
                <p class="text-gray-800 font-medium truncate">{{ auth()->user()->name }}</p>
                <span class="text-gray-500 text-xs bg-gray-100 px-2 py-0.5 rounded-full">
                    {{ auth()->user()->role }}
                </span>
            </div>
        </div>
    @endif

    <!-- Footer Text -->
    <div class="text-gray-400 text-[11px] mt-2 text-center">
        &copy; 2026 {{ config('app.name') }}
    </div>
</div>

        </aside>


        <div id="sidebar-backdrop" class="hidden fixed inset-0 z-30 bg-black/30 md:hidden"></div>

        <!-- Main content -->
        <div id="admin-main" class="flex-1 flex flex-col min-w-0 main-with-sidebar-expanded">
            <header
                class="sticky top-0 z-30 h-16 bg-white border-b border-gray-200 px-4 md:px-6 flex items-center justify-between shadow-sm animate-scale-in">
                <span class="text-xl font-extrabold text-indigo-600">@yield('title')</span>
                <div class="flex items-center gap-3">@yield('page-actions')</div>
            </header>

            <main class="p-4 md:p-6 max-w-7xl mx-auto w-full animate-fade-in">
                <div
                    class="bg-white border border-gray-200 shadow-sm rounded-lg p-4 md:p-6 transition-all duration-200 hover:shadow-md">
                    @yield('content')
                </div>
            </main>
        </div>

    </div>

    <script>
        // Sidebar toggle
        (function () {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('admin-main');
            const openBtn = document.getElementById('sidebar-open');
            const closeBtn = document.getElementById('sidebar-close');
            const backdrop = document.getElementById('sidebar-backdrop');
            const mq = window.matchMedia('(min-width: 768px)');

            const applyCollapsed = () => {
                if (!mq.matches) return;
                const collapsed = localStorage.getItem('sidebar-collapsed') === '1';
                sidebar.classList.toggle('collapsed', collapsed);
                main.classList.toggle('main-with-sidebar-collapsed', collapsed);
                main.classList.toggle('main-with-sidebar-expanded', !collapsed);
            };

            const toggle = () => {
                if (mq.matches) {
                    const collapsed = sidebar.classList.toggle('collapsed');
                    localStorage.setItem('sidebar-collapsed', collapsed ? '1' : '0');
                    main.classList.toggle('main-with-sidebar-collapsed', collapsed);
                    main.classList.toggle('main-with-sidebar-expanded', !collapsed);
                } else {
                    sidebar.classList.toggle('-translate-x-full');
                    backdrop.classList.toggle('hidden');
                }
            };

            openBtn && openBtn.addEventListener('click', toggle);
            closeBtn && closeBtn.addEventListener('click', toggle);
            backdrop && backdrop.addEventListener('click', toggle);
            window.addEventListener('resize', applyCollapsed);
            applyCollapsed();
        })();
    </script>
</body>

</html>