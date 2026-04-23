<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EduLearn Hub</title>
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
<body class="soft-gradient min-h-screen flex items-center justify-center p-6 py-12 relative overflow-hidden">
    <!-- Sophisticated Abstract Elements -->
    <div class="absolute top-[10%] right-[15%] w-96 h-96 bg-indigo-500/5 rounded-full blur-[100px] animate-subtle-float"></div>
    <div class="absolute bottom-[10%] left-[15%] w-80 h-80 bg-sky-500/5 rounded-full blur-[100px] animate-subtle-float" style="animation-delay: -4s"></div>

    <div class="max-w-md w-full relative z-10 scale-up-center">
        <div class="glass-card rounded-[3rem] shadow-[0_20px_50px_rgba(79,70,229,0.08)] overflow-hidden">
            <div class="p-12 text-center">
                <!-- Brand Identity -->
                <div class="flex items-center justify-center gap-3 mb-10">
                    <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200 -rotate-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                    <div class="text-left">
                        <span class="block text-xl font-extrabold text-slate-900 tracking-tight leading-none">EduLearn</span>
                        <span class="block text-[9px] text-indigo-500 font-black uppercase tracking-[0.3em] mt-0.5">Hub Platform</span>
                    </div>
                </div>

                <h1 class="text-2xl font-black text-slate-900 tracking-tight uppercase italic mb-2">New Account</h1>
                <p class="text-slate-400 text-sm font-medium tracking-wide">Mulai perjalanan belajarmu hari ini.</p>
            </div>
            
            <form action="{{ route('register') }}" method="POST" class="px-12 pb-12">
                @csrf
                
                @if($errors->any())
                    <div class="mb-8 p-4 bg-rose-50 border border-rose-100 text-rose-600 rounded-2xl text-[11px] font-bold">
                        <ul class="space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="flex items-center gap-2">
                                    <div class="w-1 h-1 bg-rose-400 rounded-full"></div>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Full Name</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="w-full px-6 py-4 bg-white/50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 focus:bg-white outline-none transition-all font-semibold text-slate-700 placeholder:text-slate-300 placeholder:font-normal"
                            placeholder="John Doe">
                    </div>

                    <div>
                        <label for="email" class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Email Identity</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            class="w-full px-6 py-4 bg-white/50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 focus:bg-white outline-none transition-all font-semibold text-slate-700 placeholder:text-slate-300 placeholder:font-normal"
                            placeholder="name@domain.com">
                    </div>

                    <div>
                        <label for="password" class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Security Token</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-6 py-4 bg-white/50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 focus:bg-white outline-none transition-all font-semibold text-slate-700 placeholder:text-slate-300 placeholder:font-normal"
                            placeholder="Minimal 8 karakter">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Confirm Token</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-6 py-4 bg-white/50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 focus:bg-white outline-none transition-all font-semibold text-slate-700 placeholder:text-slate-300 placeholder:font-normal"
                            placeholder="Ulangi password">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-black text-[10px] uppercase tracking-[0.3em] rounded-2xl hover:bg-slate-900 shadow-xl shadow-indigo-100 transition-all active:scale-[0.98] flex items-center justify-center group">
                            Create Workspace
                            <svg class="w-4 h-4 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </div>

                <div class="mt-12 text-center border-t border-slate-50 pt-8">
                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.2em] mb-4">Already have access?</p>
                    <a href="{{ route('login') }}" class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.1em] hover:text-slate-900 transition-colors">
                        Sign In Instead
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
