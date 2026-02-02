<x-layouts.guru>
    <x-slot name="title">Pantau Pengumpulan: {{ $tuga->title }}</x-slot>

    <div class="mb-10 flex items-center justify-between"
         style="animation: premiumFadeIn 0.8s cubic-bezier(0.23, 1, 0.32, 1) backwards;">
        <div>
            <a href="{{ route('guru.tugas.index') }}" class="inline-flex items-center text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-700 transition-colors mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Tugas
            </a>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Monitor Pengumpulan</h2>
            <div class="flex items-center gap-3 mt-2">
                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase rounded-lg">
                    {{ $tuga->classroom->name }}
                </span>
                <span class="text-xs text-slate-300 font-bold">•</span>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $submissions->count() }} Murid Menunggu Penilaian</span>
            </div>
        </div>
    </div>

    <div class="glass-card rounded-[3rem] border border-white/20 shadow-2xl overflow-hidden animate-fade-in" style="animation-delay: 0.1s;">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 text-slate-400 uppercase text-[9px] font-black tracking-[0.25em] border-b border-slate-50">
                    <th class="px-10 py-8 text-center w-24">Posisi</th>
                    <th class="px-10 py-8">Identitas Murid</th>
                    <th class="px-10 py-8">Timestamp</th>
                    <th class="px-10 py-8 text-center">Akses File</th>
                    <th class="px-10 py-8 text-center">Skor Akhir</th>
                    <th class="px-10 py-8 text-right">Manajemen</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50/50">
                @forelse($submissions as $submission)
                <tr class="hover:bg-indigo-50/30 transition-all group">
                    <td class="px-10 py-8 text-center font-black text-slate-300 group-hover:text-indigo-600">#{{ $loop->iteration }}</td>
                    <td class="px-10 py-8">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg shadow-lg shadow-indigo-600/20 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                {{ substr($submission->student->name, 0, 1) }}
                            </div>
                            <div>
                                <h6 class="text-slate-800 font-black group-hover:text-indigo-600 transition-colors">{{ $submission->student->name }}</h6>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ $submission->student->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-10 py-8">
                        <span class="text-xs font-black text-slate-800 uppercase tracking-tighter">{{ $submission->created_at->translatedFormat('d M Y') }}</span>
                        <span class="block text-[10px] font-black text-rose-500 uppercase tracking-widest mt-1">{{ $submission->created_at->format('H:i') }} WIB</span>
                    </td>
                    <td class="px-10 py-8 text-center">
                        <a href="{{ Storage::url($submission->file_path) }}" target="_blank" class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all shadow-sm border border-emerald-100 hover:rotate-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </a>
                    </td>
                    <td class="px-10 py-8 text-center">
                        @if($submission->score)
                            <div class="inline-flex flex-col items-center">
                                <span class="px-5 py-2 bg-indigo-600 text-white text-xs font-black rounded-xl shadow-xl shadow-indigo-600/30 transform group-hover:scale-110 transition-transform">
                                    {{ $submission->score }}
                                </span>
                            </div>
                        @else
                            <span class="px-5 py-2 bg-slate-100 text-slate-400 text-[10px] font-black rounded-xl uppercase tracking-widest border border-slate-200">Pending</span>
                        @endif
                    </td>
                    <td class="px-10 py-8 text-right">
                        <button @click="$dispatch('open-grade-modal', { id: {{ $submission->id }}, name: '{{ $submission->student->name }}', score: '{{ $submission->score }}', feedback: '{{ $submission->feedback }}' })" 
                                class="px-6 py-3 bg-white border border-slate-200 text-slate-600 text-[10px] font-black rounded-xl hover:bg-indigo-600 hover:text-white hover:border-indigo-600 hover:shadow-lg transition-all uppercase tracking-widest active:scale-95">
                            Grade Action
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-10 py-32 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-24 h-24 rounded-[2.5rem] bg-slate-50 flex items-center justify-center mb-8 border border-white/50 shadow-inner">
                                <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <h4 class="text-2xl font-black text-slate-800 tracking-tight mb-2">Workspace Kosong</h4>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Belum ada murid yang mengunggah tugas untuk sesi ini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Premium Grade Modal (Alpine.js) -->
    <div x-data="{ open: false, submissionId: null, studentName: '', score: '', feedback: '' }"
         @open-grade-modal.window="open = true; submissionId = $event.detail.id; studentName = $event.detail.name; score = $event.detail.score; feedback = $event.detail.feedback"
         x-show="open" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-6">
        
        <div x-show="open" x-transition.opacity @click="open = false" class="absolute inset-0 bg-slate-900/80 backdrop-blur-md"></div>
        
        <div x-show="open" x-transition.scale.95 class="relative bg-white w-full max-w-xl rounded-[4rem] shadow-2xl overflow-hidden border border-white/20">
            <div class="p-12 lg:p-16">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight">Evaluasi Murid</h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Input parameter nilai & feedback akademik</p>
                    </div>
                    <button @click="open = false" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-slate-50 text-slate-400 hover:bg-rose-50 hover:text-rose-500 transition-all">&times;</button>
                </div>

                <div class="mb-12 p-8 bg-indigo-50/50 rounded-[2.5rem] border border-indigo-100/30">
                    <p class="text-[9px] font-black text-indigo-400 uppercase tracking-widest mb-2 italic">Identitas Terpilih</p>
                    <p class="text-xl font-black text-slate-800 uppercase tracking-tighter" x-text="studentName"></p>
                </div>

                <form :action="'/guru/submissions/' + submissionId + '/grade'" method="POST" class="space-y-10">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1">Nilai Akhir (0-100)</label>
                        <input type="number" name="score" required min="0" max="100" x-model="score"
                               class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-black text-slate-800 text-xl placeholder:text-slate-200"
                               placeholder="Input Skor">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1">Observasi & Catatan Guru</label>
                        <textarea name="feedback" rows="5" x-model="feedback"
                                  class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-[2rem] focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-800 placeholder:text-slate-300"
                                  placeholder="Berikan masukan konstruktif..."></textarea>
                    </div>

                    <button type="submit" class="w-full py-6 bg-indigo-600 hover:bg-slate-900 text-white font-black rounded-3xl shadow-2xl shadow-indigo-600/30 transition-all active:scale-95 uppercase tracking-widest text-xs">
                        Publish Final Score
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.guru>
