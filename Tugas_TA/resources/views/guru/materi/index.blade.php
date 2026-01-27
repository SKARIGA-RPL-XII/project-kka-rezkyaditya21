<x-layouts.guru>
    <x-slot name="title">Manajemen Materi</x-slot>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-gray-700">Daftar Materi Pembelajaran</h2>
        <a href="{{ route('guru.materi.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Materi
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs font-bold ring-1 ring-gray-200">
                    <th class="px-6 py-4">Judul Materi</th>
                    <th class="px-6 py-4">Kelas</th>
                    <th class="px-6 py-4">File</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($materials as $material)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-800">{{ $material->title }}</div>
                        <div class="text-xs text-gray-400">ID: #MAT-{{ $material->id }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-full ring-1 ring-blue-100 italic">{{ $material->classroom->name }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($material->file_path)
                            <a href="{{ Storage::url($material->file_path) }}" target="_blank" class="text-indigo-600 hover:underline text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Lihat File
                            </a>
                        @else
                            <span class="text-gray-400 text-sm">Tidak ada file</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($material->is_published)
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded">Publik</span>
                        @else
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('guru.materi.edit', $material) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('guru.materi.destroy', $material) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">Belum ada materi yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.guru>
