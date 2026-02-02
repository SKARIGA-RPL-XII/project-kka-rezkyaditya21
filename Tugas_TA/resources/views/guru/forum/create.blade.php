<x-layouts.guru title="Buat Topik Diskusi">
    <div class="mb-12 flex items-center justify-between"
         style="animation: premiumFadeIn 0.8s cubic-bezier(0.23, 1, 0.32, 1) backwards;">
        <div>
            <h1 class="text-4xl font-black text-slate-800 tracking-tight">Mulai Diskusi Baru</h1>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mt-2">Bangun interaksi dan kolaborasi di dalam komunitas belajar</p>
        </div>
        <a href="{{ route('guru.forum.index') }}" class="px-6 py-3 border border-slate-200 text-slate-400 hover:text-indigo-600 hover:border-indigo-100 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all">
            Batal
        </a>
    </div>

    <div class="max-w-4xl mx-auto"
         style="animation: premiumFadeIn 0.8s cubic-bezier(0.23, 1, 0.32, 1) 0.2s backwards;">
        <div class="glass-card rounded-[3rem] shadow-2xl shadow-slate-200/40 overflow-hidden border border-white/20">
            <form action="{{ route('guru.forum.store') }}" method="POST" class="p-10 lg:p-12">
                @csrf
                <div class="space-y-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="classroom_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-1">Kaitkan ke Kelas (Opsional)</label>
                            <select name="classroom_id" id="classroom_id"
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all font-bold text-slate-800 appearance-none">
                                <option value="">-- Forum Publik --</option>
                                @foreach($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="title" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-1">Judul Topik Diskusi</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="w-full px-8 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all font-bold text-slate-800 placeholder:text-slate-300"
                                placeholder="Apa yang ingin Anda bicarakan?">
                        </div>
                    </div>

                    <div>
                        <label for="content" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-1">Isi Topik / Pertanyaan</label>
                        <textarea name="content" id="content" rows="10" required
                            class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-[2rem] focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all font-bold text-slate-800 placeholder:text-slate-300"
                            placeholder="Deskripsikan topik diskusi Anda secara detail agar mudah dipahami..."></textarea>
                    </div>

                    <div class="p-8 bg-indigo-50/50 rounded-[2.5rem] border border-indigo-100/30">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-black text-indigo-900 uppercase tracking-tight">Tips Diskusi Populer</h5>
                                <p class="text-[10px] font-bold text-indigo-600/70 uppercase tracking-widest mt-1 leading-relaxed">Gunakan judul yang spesifik dan lampirkan link pembelajaran yang relevan untuk memancing partisipasi murid.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 pt-10 border-t border-slate-50 flex justify-end">
                    <button type="submit" class="px-12 py-5 bg-indigo-600 hover:bg-slate-900 text-white font-black rounded-2xl shadow-xl shadow-indigo-600/20 transition-all active:scale-95 flex items-center">
                        Terbitkan Topik
                        <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.guru>
