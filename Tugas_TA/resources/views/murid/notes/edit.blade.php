<x-layouts.murid>
    <x-slot name="title">Edit Catatan</x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="mb-12">
            <a href="{{ route('murid.notes.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-indigo-600 font-black uppercase tracking-widest text-[10px] mb-4 transition-all italic group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path></svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic uppercase leading-none">Edit Catatan</h1>
            <p class="text-slate-500 font-bold text-lg mt-2 italic">Perbarui pengetahuan yang telah kamu simpan.</p>
        </div>

        <form action="{{ route('murid.notes.update', $note->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm space-y-6">
                <div>
                    <label for="title" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 italic">Judul Catatan</label>
                    <input type="text" name="title" id="title" required value="{{ old('title', $note->title) }}"
                           class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all italic">
                    @error('title') <p class="mt-2 text-xs text-rose-500 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="content" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 italic">Isi Catatan</label>
                    <textarea name="content" id="content" rows="10" required
                              class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-900 font-medium placeholder:text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all italic">{{ old('content', $note->content) }}</textarea>
                    @error('content') <p class="mt-2 text-xs text-rose-500 font-bold italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="flex-1 px-8 py-5 bg-indigo-600 text-white rounded-[2rem] font-black text-sm shadow-xl shadow-indigo-600/30 hover:bg-indigo-700 transition-all active:scale-[0.98] uppercase tracking-widest italic">
                    Perbarui Catatan
                </button>
                <a href="{{ route('murid.notes.index') }}" class="px-8 py-5 bg-white border border-slate-200 text-slate-400 rounded-[2rem] font-black text-sm hover:text-slate-900 transition-all uppercase tracking-widest italic">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.murid>
