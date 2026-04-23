<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCode - Modern Learning Experience</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); }
        .text-gradient { background: linear-gradient(to right, #6366f1, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="bg-[#0b0f19] text-slate-300 selection:bg-indigo-500/30">
    <!-- Background Decor -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-rose-600/10 rounded-full blur-[120px]"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-50 px-6 py-8 md:px-12">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-600/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                </div>
                <span class="text-2xl font-black text-white tracking-tighter">EduCode</span>
            </div>
            
            <div class="flex items-center gap-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-white text-slate-900 rounded-2xl font-black text-sm transition-all hover:scale-105 active:scale-95 shadow-xl">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-bold text-slate-400 hover:text-white transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-black text-sm transition-all hover:bg-indigo-500 hover:shadow-lg hover:shadow-indigo-600/20 active:scale-95">Daftar Sekarang</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative z-10 pt-20 md:pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass border border-white/5 mb-8 animate-fade-in">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-400">Pembelajaran Berbasis Full Compiler</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-white tracking-tighter leading-[0.9] mb-8">
                Belajar Coding <br> <span class="text-gradient">Lebih Nyata.</span>
            </h1>
            
            <p class="max-w-2xl mx-auto text-slate-400 text-lg md:text-xl font-medium leading-relaxed mb-12">
                Platform edukasi modern tempat Anda belajar teori dan langsung praktek dengan compiler interaktif di setiap modul pembelajarannya.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-12 py-5 bg-indigo-600 text-white rounded-[2rem] font-black text-lg transition-all hover:bg-indigo-500 hover:shadow-2xl hover:shadow-indigo-600/30 active:scale-95">
                        Mulai Belajar
                    </a>
                    <a href="#features" class="w-full sm:w-auto px-12 py-5 glass border border-white/10 text-white rounded-[2rem] font-black text-lg transition-all hover:bg-white/5 hover:border-white/20 active:scale-95">
                        Lihat Fitur
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-12 py-5 bg-white text-slate-900 rounded-[2rem] font-black text-lg transition-all hover:scale-105 active:scale-95 shadow-2xl">
                        Akses Portal Saya
                    </a>
                @endguest
            </div>

            <!-- Dashboard Preview -->
            <div class="mt-24 relative max-w-5xl mx-auto group">
                <div class="absolute inset-0 bg-indigo-600/20 blur-[100px] rounded-full group-hover:bg-indigo-600/30 transition-all"></div>
                <div class="relative glass border border-white/10 rounded-[3rem] p-4 shadow-2xl overflow-hidden shadow-indigo-900/40 translate-y-12 animate-float">
                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Code Preview" class="rounded-[2rem] opacity-50 grayscale group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
                    <div class="absolute inset-0 flex items-center justify-center">
                         <div class="px-8 py-4 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 text-white font-black text-sm uppercase tracking-widest flex items-center gap-3">
                            <svg class="w-6 h-6 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"></path></svg>
                            Interaktif Compiler Terpasang
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section id="features" class="relative z-10 pt-48 pb-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="glass p-10 rounded-[3rem] border border-white/5 hover:border-indigo-500/30 transition-all">
                    <div class="w-16 h-16 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-500 mb-8">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-4">Real-time Compiler</h3>
                    <p class="text-slate-400 font-medium leading-relaxed">Praktekkan kode HTML, CSS, JS, dan PHP Anda secara langsung tanpa perlu aplikasi tambahan.</p>
                </div>

                <div class="glass p-10 rounded-[3rem] border border-white/5 hover:border-rose-500/30 transition-all">
                    <div class="w-16 h-16 bg-rose-500/10 rounded-2xl flex items-center justify-center text-rose-500 mb-8">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9l-.707.707M12 18v1m4.243-4.243l.707.707M12 7a5 5 0 110 10 5 5 0 010-10z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-4">Tantangan Coding</h3>
                    <p class="text-slate-400 font-medium leading-relaxed">Selesaikan misi coding yang menantang dan dapatkan hasil verifikasi otomatis untuk progres Anda.</p>
                </div>

                <div class="glass p-10 rounded-[3rem] border border-white/5 hover:border-emerald-500/30 transition-all">
                    <div class="w-16 h-16 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-500 mb-8">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-4">Forum Diskusi</h3>
                    <p class="text-slate-400 font-medium leading-relaxed">Diskusi dengan sesama murid dan admin jika Anda menemui kendala saat masa pembelajaran.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="relative z-10 py-12 border-t border-white/5 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
            <span class="text-slate-500 font-bold text-sm tracking-widest uppercase">© 2026 EduCode Platform. All rights reserved.</span>
            <div class="flex gap-8 text-slate-500 font-black text-xs uppercase tracking-widest">
                <a href="#" class="hover:text-white transition-colors">Privacy</a>
                <a href="#" class="hover:text-white transition-colors">Terms</a>
                <a href="#" class="hover:text-white transition-colors">Contact</a>
            </div>
        </div>
    </footer>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(48px); }
            50% { transform: translateY(24px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-fade-in { animation: fadeIn 1s ease-out forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>
