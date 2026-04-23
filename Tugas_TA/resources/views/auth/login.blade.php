<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduLearn Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .soft-gradient {
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.08), transparent),
                        radial-gradient(circle at bottom left, rgba(14, 165, 233, 0.08), transparent),
                        linear-gradient(to bottom right, #f8fafc, #f1f5f9);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .animate-subtle-float {
            animation: subtle-float 8s ease-in-out infinite;
        }
        @keyframes subtle-float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-10px, 15px); }
        }
    </style>
</head>
<body class="soft-gradient min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    <!-- Sophisticated Abstract Elements -->
    <div class="absolute top-[10%] left-[15%] w-96 h-96 bg-indigo-500/5 rounded-full blur-[100px] animate-subtle-float"></div>
    <div class="absolute bottom-[10%] right-[15%] w-80 h-80 bg-sky-500/5 rounded-full blur-[100px] animate-subtle-float" style="animation-delay: -4s"></div>

    <div class="max-w-md w-full relative z-10">
        <div class="glass-card rounded-[3rem] shadow-[0_20px_50px_rgba(79,70,229,0.08)] overflow-hidden">
            <div class="p-12 text-center">
                <!-- Brand Identity -->
                <div class="flex items-center justify-center gap-3 mb-10">
                    <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div class="text-left">
                        <span class="block text-xl font-extrabold text-slate-900 tracking-tight leading-none">EduLearn</span>
                        <span class="block text-[9px] text-indigo-500 font-black uppercase tracking-[0.3em] mt-0.5">Hub Platform</span>
                    </div>
                </div>

                <h1 class="text-2xl font-black text-slate-900 tracking-tight uppercase italic mb-2">Portal Entrance</h1>
                <p class="text-slate-400 text-sm font-medium tracking-wide">Silakan autentikasi untuk mengakses hub.</p>
            </div>
            
            <form action="{{ route('login') }}" method="POST" class="px-12 pb-12">
                @csrf
                
                @if($errors->any())
                    <div class="mb-8 p-4 bg-rose-50 border border-rose-100 text-rose-600 rounded-2xl text-[11px] font-bold flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="space-y-6">
                    <div>
                        <label for="email" class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">E-Mail Identity</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            class="w-full px-6 py-4 bg-white/50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 focus:bg-white outline-none transition-all font-semibold text-slate-700 placeholder:text-slate-300 placeholder:font-normal"
                            placeholder="username@domain.com">
                    </div>

                    <div>
                        <label for="password" class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Security Token</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-6 py-4 bg-white/50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 focus:bg-white outline-none transition-all font-semibold text-slate-700 placeholder:text-slate-300 placeholder:font-normal"
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center pt-2">
                        <label class="flex items-center text-xs font-bold text-slate-400 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-5 h-5 text-indigo-600 border-slate-200 rounded-lg focus:ring-offset-0 focus:ring-indigo-200 mr-3 transition-all">
                            <span class="group-hover:text-slate-600 transition-colors uppercase tracking-widest text-[10px]">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-black text-[10px] uppercase tracking-[0.3em] rounded-2xl hover:bg-slate-900 shadow-xl shadow-indigo-100 transition-all active:scale-[0.98] flex items-center justify-center group">
                        Enter Workspace
                        <svg class="w-4 h-4 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>

                <div class="mt-12 text-center border-t border-slate-50 pt-8">
                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.2em] mb-4">No membership yet?</p>
                    <a href="{{ route('register') }}" class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.1em] hover:text-slate-900 transition-colors">
                        Register New Identity
                    </a>
                </div>
            </form>
        </div>
        
        <div class="mt-10 flex items-center justify-center gap-5">
            <span class="h-px w-6 bg-slate-200"></span>
            <p class="text-slate-300 text-[10px] font-bold uppercase tracking-[0.4em] italic pr-1">TECH HUB 2.0</p>
            <span class="h-px w-6 bg-slate-200"></span>
        </div>
    </div>
</body>
</html>
