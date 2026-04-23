<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Hub' }} - EduLearn Hub</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        
        .nav-item-active {
            color: #4f46e5;
            background: #f5f3ff;
        }

        .soft-gradient {
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.05), transparent),
                        radial-gradient(circle at bottom left, rgba(14, 165, 233, 0.05), transparent);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-blur: 8px;
        }
    </style>
</head>
<body class="h-full text-slate-900 antialiased overflow-hidden soft-gradient" x-data="{ sidebarOpen: true, mobileOpen: false }">
    
    <!-- Mobile Backdrop -->
    <div x-show="mobileOpen" x-cloak @click="mobileOpen = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-900/20 backdrop-blur-sm z-[60] lg:hidden"></div>

    <div class="flex h-screen overflow-hidden relative z-10">
        
        <!-- Modern Sidebar -->
        <aside :class="{ 'w-64': sidebarOpen, 'w-20': !sidebarOpen, 'translate-x-0': mobileOpen, '-translate-x-full': !mobileOpen }"
               class="fixed inset-y-0 left-0 z-[70] bg-white border-r border-slate-200 transition-all duration-300 lg:static lg:translate-x-0 flex flex-col">
            
            <!-- Tech Logo -->
            <div class="h-20 flex items-center px-6 shrink-0">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center shrink-0 shadow-lg shadow-indigo-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div x-show="sidebarOpen" x-transition class="flex flex-col">
                        <span class="text-base font-extrabold text-slate-900 tracking-tight">EduLearn</span>
                        <span class="text-[10px] text-indigo-500 font-bold uppercase tracking-widest">Hub Platform</span>
                    </div>
                </div>
            </div>

            <!-- Hub Navigation -->
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
                @php
                    $navItems = [
                        ['name' => 'Home', 'route' => 'murid.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['name' => 'Explore', 'route' => 'murid.kelas.index', 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
                        ['name' => 'Community', 'route' => 'murid.forum.index', 'icon' => 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z'],
                        ['name' => 'Profile', 'route' => 'murid.profile', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z']
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php 
                        $isExternal = str_contains($item['route'], '#');
                        $isActive = !$isExternal && request()->routeIs($item['route'].'*');
                    @endphp
                    <a href="{{ $isExternal ? '#' : route($item['route']) }}" 
                       class="flex items-center px-4 py-3 rounded-2xl transition-all duration-200 group {{ $isActive ? 'nav-item-active' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 shrink-0 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"></path>
                        </svg>
                        <span x-show="sidebarOpen" class="ml-3 font-semibold text-sm">
                            {{ $item['name'] }}
                        </span>
                        @if($isActive)
                            <div x-show="sidebarOpen" class="ml-auto w-1.5 h-1.5 rounded-full bg-indigo-600"></div>
                        @endif
                    </a>
                @endforeach
            </nav>

            <!-- Tech User Footer -->
            <div class="p-4 mt-auto">
                <div class="p-4 bg-slate-50 rounded-2xl flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center font-bold text-indigo-600 shrink-0 text-sm shadow-sm italic">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div x-show="sidebarOpen" class="flex flex-col overflow-hidden">
                        <span class="text-xs font-bold text-slate-900 truncate">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-slate-400 font-medium truncate uppercase tracking-tighter">Personal Account</span>
                    </div>
                </div>
            </div>

            <!-- Minimal Logout -->
            <div class="p-4 pt-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="flex items-center w-full px-4 py-3 rounded-xl text-slate-400 hover:text-rose-500 transition-colors group text-sm font-semibold">
                        <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span x-show="sidebarOpen">Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="flex-1 flex flex-col min-w-0">
            
            <!-- Minimal Navbar -->
            <header class="h-20 flex items-center justify-between px-8 z-50 shrink-0">
                <div class="flex items-center gap-6">
                    <button @click="sidebarOpen = !sidebarOpen" class="hidden lg:flex p-2 rounded-xl border border-slate-200 hover:bg-white transition-colors text-slate-500 shadow-sm">
                        <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': !sidebarOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>
                    </button>
                    <button @click="mobileOpen = true" class="lg:hidden p-2 rounded-xl bg-white border border-slate-200 text-slate-500 transition-colors shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="h-6 w-px bg-slate-200 mx-2 hidden lg:block"></div>
                    <nav class="hidden md:flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-slate-400">
                        <span>EduLearn</span>
                        <span>/</span>
                        <span class="text-slate-900">{{ $title ?? 'Home' }}</span>
                    </nav>
                </div>

                <!-- Right Side Profile Overlay -->
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-indigo-50 rounded-full border border-indigo-100 italic transition-all">
                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></div>
                        <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">Live Hub</span>
                    </div>
                    
                    <div class="w-10 h-10 rounded-2xl bg-white border border-slate-200 flex items-center justify-center p-1 shadow-sm cursor-pointer hover:border-indigo-300 transition-colors">
                        <div class="w-full h-full rounded-xl bg-slate-900 flex items-center justify-center text-white font-bold text-lg italic pr-0.5 pt-0.5">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-y-auto p-8 lg:p-12 no-scrollbar">
                <div class="max-w-6xl mx-auto">
                    
                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-transition class="mb-8 p-5 bg-white border border-emerald-100 rounded-2xl flex items-center text-emerald-800 shadow-sm">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center mr-4 shrink-0 shadow-inner">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div class="flex-1 text-sm font-semibold tracking-tight">
                                {{ session('success') }}
                            </div>
                            <button @click="show = false" class="ml-3 text-slate-300 hover:text-slate-900 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="animate-in fade-in slide-in-from-bottom-4 duration-700">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</body>
</html>
