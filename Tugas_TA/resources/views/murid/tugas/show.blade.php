<x-layouts.murid>
    <x-slot name="title">{{ $assignment->title }}</x-slot>

    <div class="max-w-4xl mx-auto">
        <a href="{{ route('murid.kelas.show', $assignment->classroom_id) }}" class="inline-flex items-center text-slate-400 hover:text-slate-600 font-bold mb-6 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Kelas
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Assignment Details -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/40">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <div>
                             <h1 class="text-2xl font-black text-slate-800 tracking-tight">{{ $assignment->title }}</h1>
                             <div class="flex items-center gap-3 mt-1 text-sm font-semibold text-slate-400">
                                 <span>Tenggat: <span class="text-amber-600">{{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y, H:i') }}</span></span>
                             </div>
                        </div>
                    </div>

                    <div class="prose prose-slate max-w-none text-slate-600">
                        <p>{{ $assignment->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Right: Submission Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-[2.5rem] p-6 border border-slate-100 shadow-xl shadow-slate-200/40 sticky top-6">
                    <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center">
                         <span class="w-1.5 h-6 bg-indigo-600 rounded-full mr-3"></span>
                         Pengumpulan Tugas
                    </h3>

                    @if($submission)
                        <!-- Already Submitted State -->
                        <div class="bg-emerald-50 rounded-2xl p-6 text-center border border-emerald-100 mb-6">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-emerald-500 mx-auto mb-3 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h4 class="font-bold text-emerald-800 mb-1">Sudah Dikumpulkan</h4>
                            <p class="text-xs text-emerald-600 font-semibold">{{ $submission->created_at->format('d M Y, H:i') }}</p>
                            
                            @if($submission->grade)
                                <div class="mt-4 pt-4 border-t border-emerald-100">
                                    <span class="block text-xs font-bold text-emerald-600 uppercase tracking-widest mb-1">Nilai Anda</span>
                                    <span class="text-3xl font-black text-emerald-700">{{ $submission->grade }}</span>
                                </div>
                            @endif
                        </div>
                        
                        @if($submission->file_path)
                             <div class="flex items-center justify-between bg-slate-50 p-3 rounded-xl border border-slate-200 mb-4">
                                <span class="text-xs font-bold text-slate-500 truncate mr-2">File Anda</span>
                                <a href="{{ Storage::url($submission->file_path) }}" target="_blank" class="text-xs font-bold text-indigo-600 hover:text-indigo-700">Lihat</a>
                            </div>
                        @else
                            <div class="p-4 bg-slate-50 rounded-xl text-sm text-slate-600 italic border border-slate-100">
                                "{{ $submission->content }}"
                            </div>
                        @endif

                    @else
                        <!-- Submission Form -->
                        <form action="{{ route('murid.tugas.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Jawaban Text (Opsional)</label>
                                <textarea name="content" rows="4" class="w-full rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Tulis jawaban..."></textarea>
                            </div>

                            <div class="mb-6">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Upload File</label>
                                <input type="file" name="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>

                            <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-600/20 transition-all active:scale-95 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                Kumpulkan Tugas
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.murid>
