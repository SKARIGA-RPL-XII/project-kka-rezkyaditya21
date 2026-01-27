<x-layouts.guru>
    <x-slot name="title">Ringkasan Aktivitas</x-slot>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 mb-12">
        @php
            $statsData = [
                ['label' => 'Total Kelas', 'value' => $stats['classrooms_count'], 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => 'indigo', 'desc' => 'Kelas aktif saat ini'],
                ['label' => 'Materi Belajar', 'value' => $stats['materials_count'], 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253', 'color' => 'emerald', 'desc' => 'Total file diunggah'],
                ['label' => 'Tugas Aktif', 'value' => $stats['assignments_count'], 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'color' => 'amber', 'desc' => 'Menunggu pengerjaan'],
                ['label' => 'Data Murid', 'value' => $stats['students_count'], 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 01-9-3.833M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'color' => 'rose', 'desc' => 'Murid terdaftar']
            ];
            $colorClasses = [
                'indigo' => 'bg-indigo-600 shadow-indigo-200',
                'emerald' => 'bg-emerald-500 shadow-emerald-200',
                'amber' => 'bg-amber-500 shadow-amber-200',
                'rose' => 'bg-rose-500 shadow-rose-200',
            ];
        @endphp

        @foreach($statsData as $item)
            <div class="group bg-white rounded-[2rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/40 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-start justify-between mb-6">
                    <div class="w-14 h-14 rounded-2xl {{ $colorClasses[$item['color']] }} flex items-center justify-center text-white shadow-lg overflow-hidden relative">
                        <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <svg class="w-7 h-7 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="{{ $item['icon'] }}"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-black text-slate-300 uppercase tracking-widest block mb-1">Live Stats</span>
                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 ml-auto animate-pulse"></div>
                    </div>
                </div>
                <div>
                    <h4 class="text-slate-400 font-bold text-sm uppercase tracking-wide mb-1">{{ $item['label'] }}</h4>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-slate-800 tracking-tight">{{ $item['value'] }}</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-4 font-medium flex items-center">
                        <svg class="w-3.5 h-3.5 mr-1 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $item['desc'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Features & Info -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- Quick Actions -->
        <div class="lg:col-span-8 space-y-8">
            <h3 class="text-xl font-extrabold text-slate-800 flex items-center">
                <span class="w-2.5 h-8 bg-indigo-600 rounded-full mr-4 shadow-lg shadow-indigo-600/20"></span>
                Aksi Cepat Manajemen
            </h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Action Card 1 -->
                <a href="{{ route('guru.kelas.create') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg shadow-slate-200/30 hover:bg-slate-900 transition-all duration-300 overflow-hidden relative">
                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-indigo-50 rounded-full group-hover:bg-indigo-500/10 transition-colors"></div>
                    <div class="flex items-center gap-5 relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <div>
                            <span class="block text-lg font-black text-slate-800 group-hover:text-white transition-colors">Buat Kelas Baru</span>
                            <span class="text-sm font-medium text-slate-400 group-hover:text-slate-300 transition-colors">Tambah grup belajar baru</span>
                        </div>
                    </div>
                </a>

                <!-- Action Card 2 -->
                <a href="{{ route('guru.materi.create') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg shadow-slate-200/30 hover:bg-slate-900 transition-all duration-300 overflow-hidden relative">
                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-50 rounded-full group-hover:bg-emerald-500/10 transition-colors"></div>
                    <div class="flex items-center gap-5 relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <div>
                            <span class="block text-lg font-black text-slate-800 group-hover:text-white transition-colors">Upload Materi</span>
                            <span class="text-sm font-medium text-slate-400 group-hover:text-slate-300 transition-colors">Bagikan file pembelajaran</span>
                        </div>
                    </div>
                </a>

                <!-- Action Card 3 -->
                <a href="{{ route('guru.tugas.create') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg shadow-slate-200/30 hover:bg-slate-900 transition-all duration-300 overflow-hidden relative">
                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-amber-50 rounded-full group-hover:bg-amber-500/10 transition-colors"></div>
                    <div class="flex items-center gap-5 relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <div>
                            <span class="block text-lg font-black text-slate-800 group-hover:text-white transition-colors">Buat Penugasan</span>
                            <span class="text-sm font-medium text-slate-400 group-hover:text-slate-300 transition-colors">Evaluasi progres murid</span>
                        </div>
                    </div>
                </a>

                <!-- Action Card 4 -->
                <a href="{{ route('guru.murid.index') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg shadow-slate-200/30 hover:bg-slate-900 transition-all duration-300 overflow-hidden relative">
                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-rose-50 rounded-full group-hover:bg-rose-500/10 transition-colors"></div>
                    <div class="flex items-center gap-5 relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </div>
                        <div>
                            <span class="block text-lg font-black text-slate-800 group-hover:text-white transition-colors">Daftar Murid</span>
                            <span class="text-sm font-medium text-slate-400 group-hover:text-slate-300 transition-colors">Kelola data murid terdaftar</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Account Info & System Status -->
        <div class="lg:col-span-4 flex flex-col gap-6">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg shadow-slate-200/30 flex-1">
                <h3 class="text-lg font-black text-slate-800 mb-8 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Informasi Profil
                </h3>
                
                <div class="flex flex-col items-center mb-10 pb-10 border-b border-slate-50">
                    <div class="w-24 h-24 rounded-3xl bg-indigo-600 text-white flex items-center justify-center font-black text-4xl shadow-2xl shadow-indigo-600/30 mb-5 border-4 border-slate-50">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <p class="text-2xl font-extrabold text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="text-slate-400 font-bold text-sm">{{ Auth::user()->email }}</p>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center justify-between p-5 rounded-2xl bg-indigo-50/50 border border-indigo-100">
                        <span class="text-xs font-black text-indigo-400 uppercase tracking-widest">Identitas</span>
                        <span class="text-xs font-black text-indigo-700 bg-white px-3 py-1.5 rounded-lg shadow-sm">GURU / PENGAJAR</span>
                    </div>
                    <div class="flex items-center justify-between p-5 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Database</span>
                        <span class="text-xs font-bold text-slate-600">Supabase (PostgreSQL)</span>
                    </div>
                    <div class="flex items-center justify-between p-5 rounded-2xl bg-emerald-50 border border-emerald-100">
                        <span class="text-xs font-black text-emerald-400 uppercase tracking-widest">Status</span>
                        <span class="flex items-center text-xs font-black text-emerald-700">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                            AKTIF
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guru>
