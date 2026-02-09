<x-layouts.murid>
    <x-slot name="title">Kelas Saya</x-slot>

    <div class="mb-10">
        <h3 class="text-xl font-extrabold text-slate-800 flex items-center mb-6">
            <span class="w-2.5 h-8 bg-sky-500 rounded-full mr-4 shadow-lg shadow-sky-500/20"></span>
            Daftar Kelas Terdaftar
        </h3>

        @if($classes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($classes as $class)
                    <a href="{{ route('murid.kelas.show', $class->id) }}" class="group bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                        <div class="h-40 bg-gradient-to-br from-sky-400 to-indigo-600 relative p-6 flex flex-col justify-end">
                             <div class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <h4 class="text-white font-black text-2xl tracking-tight leading-tight mb-1">{{ $class->name }}</h4>
                            <p class="text-white/80 font-medium text-sm">{{ $class->description ?? 'Tidak ada deskripsi' }}</p>
                        </div>
                        <div class="p-8 flex-1 flex flex-col">
                           <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Guru Pengajar</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center text-[10px] font-bold">
                                        {{ substr($class->teacher->name ?? 'G', 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-700">{{ $class->teacher->name ?? 'Guru' }}</span>
                                </div>
                           </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
             <div class="text-center py-20 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Kelas</h3>
                <p class="text-slate-400">Anda belum terdaftar di kelas manapun saat ini.</p>
            </div>
        @endif
    </div>
</x-layouts.murid>
