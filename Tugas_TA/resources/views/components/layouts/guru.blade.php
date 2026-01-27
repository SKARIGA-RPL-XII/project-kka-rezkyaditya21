<!DOCTYPE html>
<html lang="id" class="h-full bg-[#f8fafc]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Guru' }} - EduLearn Professional</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        
        /* Modern Scrollbar */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }

        /* Sidebar active state glass effect */
        .nav-item-active {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.1) 0%, rgba(99, 102, 241, 0) 100%);
            border-left: 4px solid #6366f1;
            color: #fff !important;
        }
    </style>
</head>
<body class="h-full text-slate-900 antialiased overflow-hidden" x-data="{ sidebarOpen: true, mobileOpen: false }">
    
    <!-- Mobile Backdrop -->
    <div x-show="mobileOpen" x-cloak @click="mobileOpen = false" 
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[60] lg:hidden"></div>

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside :class="{ 'w-64': sidebarOpen, 'w-20': !sidebarOpen, 'translate-x-0': mobileOpen, '-translate-x-full': !mobileOpen }"
               class="fixed inset-y-0 left-0 z-[70] bg-slate-900 text-slate-100 transition-all duration-300 ease-in-out lg:static lg:translate-x-0 flex flex-col border-r border-slate-800 shadow-2xl">
            
            <!-- Logo Section -->
            <div class="h-20 flex items-center px-6 shrink-0 border-b border-slate-800/50">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-600/20 shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253"></path></svg>
                    </div>
                    <span x-show="sidebarOpen" x-transition class="text-xl font-extrabold text-white tracking-tight">EduLearn<span class="text-indigo-500">Pro</span></span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2 no-scrollbar">
                @php
                    $navItems = [
                        ['name' => 'Dashboard', 'route' => 'guru.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['name' => 'Manajemen Kelas', 'route' => 'guru.kelas.index', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                        ['name' => 'Materi Belajar', 'route' => 'guru.materi.index', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253'],
                        ['name' => 'Tugas Murid', 'route' => 'guru.tugas.index', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                        ['name' => 'Data Murid', 'route' => 'guru.murid.index', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 01-9-3.833M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z']
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="flex items-center px-4 py-3.5 rounded-xl transition-all duration-200 group {{ request()->routeIs($item['route'].'*') ? 'bg-indigo-600 text-white border-l-4 border-indigo-500' : 'hover:bg-white/10 text-slate-300 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 transition-transform duration-300 {{ request()->routeIs($item['route'].'*') ? 'text-white' : 'group-hover:scale-110' }}" 
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"></path>
                        </svg>
                        <span x-show="sidebarOpen" class="ml-4 font-semibold text-sm tracking-wide" x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0 translate-x-1" x-transition:enter-end="opacity-100 translate-x-0">
                            {{ $item['name'] }}
                        </span>
                    </a>
                @endforeach
            </nav>

            <!-- Logout Section -->
            <div class="p-4 border-t border-slate-800/50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="flex items-center w-full px-4 py-3.5 rounded-xl text-slate-400 hover:bg-rose-500/10 hover:text-rose-400 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span x-show="sidebarOpen" class="ml-4 font-bold text-sm">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 bg-[#f8fafc]">
            
            <!-- Navbar -->
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-8 z-50 shrink-0">
                <div class="flex items-center gap-6">
                    <button @click="sidebarOpen = !sidebarOpen" class="hidden lg:flex p-2.5 rounded-xl bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200 transition-all active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"></path></svg>
                    </button>
                    <button @click="mobileOpen = true" class="lg:hidden p-2.5 rounded-xl bg-slate-50 text-slate-500 hover:bg-slate-100 border border-slate-200 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">{{ $title ?? 'Ringkasan' }}</h2>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mt-0.5">EduLearn Management System</p>
                    </div>
                </div>

                <!-- User Profile -->
                <div class="flex items-center gap-4 pl-6 border-l border-slate-100">
                    <div class="hidden md:flex flex-col items-end">
                        <span class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] font-black text-indigo-500 bg-indigo-50 px-2 py-0.5 rounded-md uppercase tracking-tighter">Guru / Pengajar</span>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-extrabold text-xl shadow-xl shadow-indigo-600/20">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto no-scrollbar">
                <div class="max-w-[1600px] mx-auto p-6 lg:p-10">
                    
                    <!-- Alert Notifications -->
                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-transition class="mb-8 p-5 bg-emerald-50 border border-emerald-100 rounded-3xl flex items-center shadow-lg shadow-emerald-500/5">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-600 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                            <p class="font-bold text-emerald-800">{{ session('success') }}</p>
                            <button @click="show = false" class="ml-auto text-emerald-400 hover:text-emerald-600 font-black text-xl px-2">&times;</button>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Additional UI Polishing -->
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</body>
</html>
