<x-layouts.murid>
    <x-slot name="title">Buat Topik Baru</x-slot>

    <div class="max-w-3xl mx-auto">
        <a href="{{ route('murid.forum.index') }}" class="inline-flex items-center text-slate-400 hover:text-slate-600 font-bold mb-6 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Forum
        </a>

        <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-slate-100 shadow-xl shadow-slate-200/40">
            <h1 class="text-2xl font-black text-slate-800 tracking-tight mb-8">Mulai Diskusi Baru</h1>
            
            <form action="{{ route('murid.forum.store') }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Judul Diskusi</label>
                        <input type="text" name="title" required class="w-full rounded-xl border-slate-200 font-bold text-slate-800 placeholder:font-normal focus:border-indigo-500 focus:ring-indigo-500" placeholder="Apa yang ingin didiskusikan?">
                    </div>

                     <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Pilih Kelas (Opsional)</label>
                        <select name="classroom_id" class="w-full rounded-xl border-slate-200 text-slate-800 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Diskusi Umum --</option>
                            @foreach($classrooms as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-[10px] text-slate-400 font-bold mt-2">Pilih kelas jika diskusi berkaitan dengan materi spesifik.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Isi Diskusi</label>
                        <textarea name="content" rows="6" required class="w-full rounded-xl border-slate-200 text-slate-800 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Jelaskan pertanyaan atau topik diskusi Anda..."></textarea>
                    </div>

                    <div class="pt-6">
                         <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-600/20 transition-all active:scale-95 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Posting Diskusi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.murid>
