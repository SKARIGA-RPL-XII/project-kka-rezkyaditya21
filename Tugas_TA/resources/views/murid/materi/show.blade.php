<x-layouts.murid>
    <x-slot name="title">{{ $material->title }}</x-slot>

    <div class="max-w-4xl mx-auto">
        <a href="{{ route('murid.kelas.show', $material->classroom_id) }}" class="inline-flex items-center text-slate-400 hover:text-slate-600 font-bold mb-6 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Kelas
        </a>

        <div class="bg-white rounded-[2.5rem] p-8 md:p-12 border border-slate-100 shadow-xl shadow-slate-200/40">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253"></path></svg>
                </div>
                <div>
                     <h1 class="text-3xl font-black text-slate-800 tracking-tight">{{ $material->title }}</h1>
                     <p class="text-slate-400 font-medium mt-1">Diposting: {{ $material->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div class="prose prose-slate max-w-none mb-10">
                <p class="text-lg text-slate-600 leading-relaxed">{{ $material->description }}</p>
                {!! $material->content !!}
            </div>

            @if($material->file_path)
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100">
                    <h3 class="font-bold text-slate-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                        Lampiran File
                    </h3>
                    
                    <div class="flex items-center justify-between bg-white p-4 rounded-2xl border border-slate-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-red-50 text-red-500 flex items-center justify-center font-bold text-xs uppercase">
                                PDF
                            </div>
                            <span class="font-semibold text-slate-700 text-sm truncate max-w-[200px] md:max-w-md">{{ basename($material->file_path) }}</span>
                        </div>
                        <a href="{{ Storage::url($material->file_path) }}" target="_blank" class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold text-sm transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Download
                        </a>
                    </div>
                    
                    <!-- Preview if PDF -->
                    @if(Str::endsWith($material->file_path, '.pdf'))
                        <div class="mt-6 aspect-[16/9] w-full rounded-2xl overflow-hidden shadow-lg">
                             <iframe src="{{ Storage::url($material->file_path) }}" class="w-full h-full" frameborder="0"></iframe>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-layouts.murid>
