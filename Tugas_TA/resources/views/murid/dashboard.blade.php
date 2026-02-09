<x-layouts.murid>
    <x-slot name="title">Ringkasan Belajar</x-slot>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <div class="group bg-white rounded-[2rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/40 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-start justify-between mb-6">
                <div class="w-14 h-14 rounded-2xl bg-sky-500 shadow-sky-200 flex items-center justify-center text-white shadow-lg relative overflow-hidden">
                     <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <svg class="w-7 h-7 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div class="text-right">
                    <span class="text-xs font-black text-slate-300 uppercase tracking-widest block mb-1">Terdaftar</span>
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 ml-auto animate-pulse"></div>
                </div>
            </div>
            <div>
                <h4 class="text-slate-400 font-bold text-sm uppercase tracking-wide mb-1">Kelas Saya</h4>
                <div class="flex items-baseline gap-2">
                    <span class="text-4xl font-extrabold text-slate-800 tracking-tight">{{ $stats['classrooms_count'] }}</span>
                    <span class="text-sm font-bold text-slate-400">Kelas</span>
                </div>
            </div>
        </div>

        <div class="group bg-white rounded-[2rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/40 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
             <div class="flex items-start justify-between mb-6">
                <div class="w-14 h-14 rounded-2xl bg-amber-500 shadow-amber-200 flex items-center justify-center text-white shadow-lg relative overflow-hidden">
                     <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <svg class="w-7 h-7 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="text-right">
                    <span class="text-xs font-black text-slate-300 uppercase tracking-widest block mb-1">Pending</span>
                </div>
            </div>
            <div>
                <h4 class="text-slate-400 font-bold text-sm uppercase tracking-wide mb-1">Tugas Belum Selesai</h4>
                <div class="flex items-baseline gap-2">
                    <span class="text-4xl font-extrabold text-slate-800 tracking-tight">{{ $stats['pending_assignments_count'] }}</span>
                    <span class="text-sm font-bold text-slate-400">Tugas</span>
                </div>
            </div>
        </div>
        
         <div class="group bg-white rounded-[2rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/40 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
             <div class="flex items-start justify-between mb-6">
                <div class="w-14 h-14 rounded-2xl bg-rose-500 shadow-rose-200 flex items-center justify-center text-white shadow-lg relative overflow-hidden">
                     <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <svg class="w-7 h-7 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                </div>
                <div class="text-right">
                    <span class="text-xs font-black text-slate-300 uppercase tracking-widest block mb-1">Diskusi</span>
                </div>
            </div>
            <div>
                <h4 class="text-slate-400 font-bold text-sm uppercase tracking-wide mb-1">Forum Diskusi</h4>
                 <div class="mt-2">
                    <a href="{{ route('murid.forum.index') }}" class="text-sm font-bold text-rose-500 hover:text-rose-600 flex items-center">
                        Lihat Diskusi
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="space-y-8">
        <h3 class="text-xl font-extrabold text-slate-800 flex items-center">
            <span class="w-2.5 h-8 bg-sky-500 rounded-full mr-4 shadow-lg shadow-sky-500/20"></span>
            Akses Cepat
        </h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Kelas Card -->
            <a href="{{ route('murid.kelas.index') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg shadow-slate-200/30 hover:bg-slate-900 transition-all duration-300 overflow-hidden relative">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-sky-50 rounded-full group-hover:bg-sky-500/10 transition-colors"></div>
                <div class="flex items-center gap-5 relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:bg-sky-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <div>
                        <span class="block text-lg font-black text-slate-800 group-hover:text-white transition-colors">Akses Kelas</span>
                        <span class="text-sm font-medium text-slate-400 group-hover:text-slate-300 transition-colors">Lihat materi & tugas</span>
                    </div>
                </div>
            </a>

            <!-- Forum Card -->
            <a href="{{ route('murid.forum.index') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg shadow-slate-200/30 hover:bg-slate-900 transition-all duration-300 overflow-hidden relative">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-rose-50 rounded-full group-hover:bg-rose-500/10 transition-colors"></div>
                <div class="flex items-center gap-5 relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <div>
                        <span class="block text-lg font-black text-slate-800 group-hover:text-white transition-colors">Forum Diskusi</span>
                        <span class="text-sm font-medium text-slate-400 group-hover:text-slate-300 transition-colors">Tanya jawab & diskusi</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-layouts.murid>
