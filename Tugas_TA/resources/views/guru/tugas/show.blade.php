<x-layouts.guru>
    <x-slot name="title">Detail Tugas: {{ $tuga->title }}</x-slot>

    <div class="mb-6">
        <a href="{{ route('guru.tugas.index') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Tugas
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $tuga->title }}</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelas: <span class="font-medium text-indigo-600">{{ $tuga->classroom->name }}</span> | 
                    Dibuat pada: {{ $tuga->created_at->format('d M Y H:i') }}
                </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('guru.tugas.edit', $tuga) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Edit Tugas
                </a>
            </div>
        </div>

        <div class="p-6">
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-700 mb-3 text-indigo-100">Instruksi Tugas</h3>
                <div class="prose max-w-none text-gray-600">
                    {!! nl2br(e($tuga->description)) !!}
                </div>
            </div>

            @if($tuga->file_path)
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <h3 class="text-sm font-bold text-gray-700 mb-2">File Lampiran / Template</h3>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-indigo-400 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path></svg>
                        <span class="text-gray-600 font-medium">{{ basename($tuga->file_path) }}</span>
                    </div>
                    <a href="{{ Storage::url($tuga->file_path) }}" target="_blank" class="px-3 py-1 bg-white border border-gray-300 rounded text-sm text-gray-700 hover:bg-gray-50">
                        Buka / Download
                    </a>
                </div>
            </div>
            @endif

            <div class="mt-8 pt-6 border-t border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center">
                    <span class="text-sm text-gray-500 mr-3">Status Publikasi:</span>
                    @if($tuga->is_published)
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Publik</span>
                    @else
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">Draft</span>
                    @endif
                </div>
                <div class="flex items-center md:justify-end">
                    <span class="text-sm text-gray-500 mr-3">Pengumpulan:</span>
                    <span class="text-sm font-semibold text-gray-700">0 / {{ $tuga->classroom->students->count() }} Murid</span>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guru>
