<x-layouts.murid>
    <x-slot name="title">{{ $classroom->name }}</x-slot>

    <!-- Header info -->
    <div class="mb-10 bg-white rounded-[2rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/40 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-sky-400/20 to-indigo-500/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
        
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                   <div class="flex items-center gap-3 mb-2">
                        <span class="px-3 py-1 rounded-lg bg-sky-50 text-sky-600 text-xs font-black uppercase tracking-wider">Ruang Kelas</span>
                        <span class="text-slate-300">|</span>
                        <div class="flex items-center gap-2 text-slate-500">
                             <div class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold">
                                {{ substr($classroom->teacher->name ?? 'G', 0, 1) }}
                            </div>
                            <span class="text-sm font-bold">{{ $classroom->teacher->name ?? 'Guru' }}</span>
                        </div>
                   </div>
                   <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">{{ $classroom->name }}</h1>
                   <p class="text-slate-500 max-w-2xl text-lg">{{ $classroom->description }}</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
                <!-- Materials Section -->
                <div>
                    <h3 class="text-xl font-extrabold text-slate-800 flex items-center mb-6">
                        <span class="w-2.5 h-8 bg-emerald-500 rounded-full mr-4 shadow-lg shadow-emerald-500/20"></span>
                        Materi Pembelajaran
                    </h3>
                    
                    <div class="space-y-4">
                        @forelse($classroom->materials as $material)
                            <a href="{{ route('murid.materi.show', $material->id) }}" class="flex items-start gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-200 hover:bg-white hover:border-emerald-200 hover:shadow-lg hover:shadow-emerald-500/10 transition-all duration-300 group">
                                <div class="w-12 h-12 rounded-xl bg-white text-emerald-500 flex items-center justify-center shadow-sm border border-slate-100 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-slate-800 group-hover:text-emerald-700 transition-colors">{{ $material->title }}</h4>
                                    <p class="text-sm text-slate-400 line-clamp-1 mt-1">{{ $material->description }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-8 text-slate-400 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                                Belum ada materi
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Assignments Section -->
                <div>
                     <h3 class="text-xl font-extrabold text-slate-800 flex items-center mb-6">
                        <span class="w-2.5 h-8 bg-amber-500 rounded-full mr-4 shadow-lg shadow-amber-500/20"></span>
                        Tugas & Evaluasi
                    </h3>

                    <div class="space-y-4">
                        @forelse($classroom->assignments as $assignment)
                            <a href="{{ route('murid.tugas.show', $assignment->id) }}" class="flex items-start gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-200 hover:bg-white hover:border-amber-200 hover:shadow-lg hover:shadow-amber-500/10 transition-all duration-300 group">
                                <div class="w-12 h-12 rounded-xl bg-white text-amber-500 flex items-center justify-center shadow-sm border border-slate-100 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-slate-800 group-hover:text-amber-700 transition-colors">{{ $assignment->title }}</h4>
                                    <div class="flex items-center gap-4 mt-2 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                        <span>Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                             <div class="text-center py-8 text-slate-400 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                                Belum ada tugas
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.murid>
