<x-layouts.murid>
    <x-slot name="title">Catatan Belajar</x-slot>

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight italic uppercase">My Learning Notes</h1>
            <p class="text-slate-500 font-medium italic">Simpan pemikiran dan poin penting dari belajarmu.</p>
        </div>
        <a href="{{ route('murid.notes.create') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all active:scale-95 flex items-center gap-2 italic uppercase tracking-widest">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            Buat Catatan
        </a>
    </div>

    @if($notes->isEmpty())
        <div class="bg-white rounded-[2.5rem] p-12 border border-slate-100 shadow-sm text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-300">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <h3 class="text-xl font-black text-slate-900 mb-2 italic uppercase">Belum ada catatan</h3>
            <p class="text-slate-500 font-medium mb-8">Mulai menulis catatan belajarmu hari ini untuk mengingat materi lebih baik.</p>
            <a href="{{ route('murid.notes.create') }}" class="inline-flex items-center gap-2 text-indigo-600 font-black uppercase tracking-widest text-xs hover:gap-3 transition-all italic">
                Tulis catatan pertama <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($notes as $note)
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-900/5 transition-all duration-300 flex flex-col group p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[10px] font-black text-indigo-500 uppercase tracking-widest italic">{{ $note->created_at->diffForHumans() }}</span>
                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('murid.notes.edit', $note->id) }}" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('murid.notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Hapus catatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3 tracking-tight group-hover:text-indigo-600 transition-colors uppercase italic leading-tight">{{ $note->title }}</h3>
                    <p class="text-slate-500 text-sm font-medium line-clamp-4 italic mb-6">
                        {{ $note->content }}
                    </p>
                    <div class="mt-auto pt-4 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex -space-x-2">
                             <div class="w-6 h-6 rounded-lg bg-indigo-50 border border-indigo-100"></div>
                             <div class="w-6 h-6 rounded-lg bg-sky-50 border border-sky-100"></div>
                        </div>
                        <a href="{{ route('murid.notes.edit', $note->id) }}" class="text-[10px] font-black text-slate-400 hover:text-indigo-600 uppercase tracking-widest italic transition-colors">Lihat Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-layouts.murid>
