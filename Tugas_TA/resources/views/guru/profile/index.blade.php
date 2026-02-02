<x-layouts.guru>
    <x-slot name="title">Pengaturan Profil Saya</x-slot>

    <div class="max-w-6xl mx-auto pb-20" style="animation: premiumFadeIn 0.8s cubic-bezier(0.23, 1, 0.32, 1) backwards;">
        <!-- Profile Header Core -->
        <div class="glass-card rounded-[4rem] overflow-hidden border border-white/20 shadow-2xl mb-12">
            <!-- Dynamic Cover -->
            <div class="h-60 bg-gradient-to-br from-indigo-900 via-slate-900 to-indigo-800 relative overflow-hidden">
                <div class="absolute inset-0 opacity-20" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
                <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
            </div>
            
            <div class="px-12 pb-12 relative">
                <div class="flex flex-col md:flex-row items-center md:items-end gap-10 -mt-24 relative z-10">
                    <!-- High-Contrast Avatar -->
                    <div class="relative group">
                        <div class="w-44 h-44 rounded-[3rem] p-1.5 bg-white shadow-2xl ring-8 ring-white/10 overflow-hidden transform group-hover:rotate-3 transition-all duration-500">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" class="w-full h-full object-cover rounded-[2.5rem]" alt="Avatar">
                            @else
                                <div class="w-full h-full rounded-[2.5rem] bg-gradient-to-br from-indigo-600 to-blue-500 flex items-center justify-center text-white font-black text-6xl shadow-inner">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <label for="avatar-upload" class="absolute -bottom-2 -right-2 w-12 h-12 bg-indigo-600 text-white rounded-2xl shadow-xl flex items-center justify-center cursor-pointer hover:bg-slate-900 hover:scale-110 transition-all border-4 border-white group">
                            <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </label>
                    </div>

                    <!-- Enhanced Identity Info -->
                    <div class="flex-1 text-center md:text-left">
                        <div class="flex flex-col md:flex-row md:items-center gap-4 mb-3">
                            <h2 class="text-4xl font-black text-slate-800 tracking-tighter">{{ $user->name }}</h2>
                            <div class="flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-50 border border-emerald-100/50">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em]">Verified Teacher</span>
                            </div>
                        </div>
                        <p class="text-slate-400 font-bold uppercase tracking-[0.25em] text-xs flex items-center justify-center md:justify-start gap-2">
                             System Educator Account
                        </p>
                    </div>

                    <!-- Statistics Pills -->
                    <div class="flex gap-6 pb-2">
                         <div class="text-center px-8 border-r border-slate-100">
                            <span class="block text-3xl font-black text-slate-800 tracking-tighter">{{ $user->classrooms->count() }}</span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Active Classes</span>
                         </div>
                         <div class="text-center px-8">
                            <span class="block text-3xl font-black text-slate-800 tracking-tighter">{{ \App\Models\Material::whereHas('classroom', fn($q) => $q->where('teacher_id', $user->id))->count() }}</span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Published Materials</span>
                         </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Sidebar Navigation/Stats -->
            <div class="lg:col-span-1 space-y-8">
                <div class="glass-card p-10 rounded-[3rem] border border-white/20 shadow-xl overflow-hidden relative">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl"></div>
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.25rem] mb-8 ml-1">Account Summary</h3>
                    
                    <div class="space-y-6">
                        <div class="p-6 bg-slate-50/50 rounded-2xl border border-slate-100/50">
                            <span class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 italic">Access Identity</span>
                            <span class="text-sm font-black text-slate-800 break-all">{{ $user->email }}</span>
                        </div>
                        
                        <div class="p-6 bg-indigo-50/50 rounded-2xl border border-indigo-100/30">
                            <span class="block text-[9px] font-black text-indigo-400 uppercase tracking-widest mb-2 italic">Current Role</span>
                            <span class="text-xs font-black text-indigo-600 uppercase tracking-widest flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                Authenticated Guru
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-indigo-600 p-10 rounded-[3rem] text-white shadow-2xl shadow-indigo-600/30 relative overflow-hidden group">
                    <div class="absolute -right-12 -top-12 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700"></div>
                    <svg class="w-10 h-10 text-indigo-200 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h4 class="text-xl font-black mb-4 tracking-tight">Need Support?</h4>
                    <p class="text-xs text-indigo-100 font-bold uppercase tracking-widest leading-relaxed mb-6 opacity-80">Contact platform administrator for account escalated issues.</p>
                    <a href="mailto:admin@edulearn.pro" class="w-full text-center px-6 py-4 bg-white text-indigo-600 font-black rounded-2xl text-[11px] uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all inline-block shadow-lg">Contact Admin</a>
                </div>
            </div>

            <!-- Enhanced Main Form Area -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Profile Settings -->
                <form action="{{ route('guru.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <input type="file" id="avatar-upload" name="avatar" class="hidden" onchange="this.form.submit()">

                    <div class="glass-card rounded-[3.5rem] border border-white/20 shadow-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.1s;">
                        <div class="px-12 py-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
                            <div>
                                <h3 class="font-black text-slate-800 uppercase tracking-tight">Informasi Personal</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Perbarui identitas publik Anda</p>
                            </div>
                            <svg class="w-6 h-6 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>

                        <div class="p-12 space-y-10">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1 block">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                           class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-800">
                                </div>

                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1 block">Email Akun</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                           class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-800">
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1 block">Biografi & Pengalaman Mengajar</label>
                                <textarea name="bio" rows="5" 
                                          class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-[2rem] focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-800 placeholder:text-slate-300"
                                          placeholder="Ceritakan tentang diri Anda untuk profil publik...">{{ old('bio', $user->bio) }}</textarea>
                            </div>
                        </div>

                        <div class="px-12 py-10 bg-slate-50/50 border-t border-slate-50 flex justify-end">
                            <button type="submit" class="bg-indigo-600 hover:bg-slate-900 text-white font-black text-[11px] uppercase tracking-[0.2em] px-12 py-5 rounded-2xl transition-all shadow-xl shadow-indigo-600/20 active:scale-95">
                                Save Profile Changes
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Password Settings -->
                <form action="{{ route('guru.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="glass-card rounded-[3.5rem] border border-white/20 shadow-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.2s;">
                        <div class="px-12 py-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
                            <div>
                                <h3 class="font-black text-slate-800 uppercase tracking-tight">Keamanan & Password</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Kelola data rahasia akun Anda</p>
                            </div>
                            <svg class="w-6 h-6 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>

                        <div class="p-12 space-y-10">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1 block">Password Saat Ini</label>
                                <input type="password" name="current_password" required
                                       class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 transition-all font-bold text-slate-800">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1 block">Password Baru</label>
                                    <input type="password" name="password" required
                                           class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-800">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1 block">Ulangi Password</label>
                                    <input type="password" name="password_confirmation" required
                                           class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-800">
                                </div>
                            </div>
                        </div>

                        <div class="px-12 py-10 bg-slate-50/50 border-t border-slate-50 flex justify-end">
                            <button type="submit" class="bg-slate-900 hover:bg-black text-white font-black text-[11px] uppercase tracking-[0.2em] px-12 py-5 rounded-2xl transition-all shadow-xl active:scale-95 flex items-center">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Update Security Info
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.guru>
