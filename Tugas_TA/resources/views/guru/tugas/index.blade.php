<x-layouts.guru>
    <x-slot name="title">Manajemen Tugas</x-slot>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-gray-700">Daftar Tugas Murid</h2>
        <a href="{{ route('guru.tugas.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Buat Tugas Baru
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs font-bold ring-1 ring-gray-200">
                    <th class="px-6 py-4">Judul Tugas</th>
                    <th class="px-6 py-4">Kelas</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Deadline / Dibuat</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($assignments as $assignment)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $assignment->title }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 bg-purple-50 text-purple-700 text-xs font-medium rounded-full ring-1 ring-purple-100">{{ $assignment->classroom->name }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($assignment->is_published)
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded">Publik</span>
                        @else
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $assignment->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('guru.tugas.show', $assignment) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Lihat Progress">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                             <a href="{{ route('guru.tugas.edit', $assignment) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('guru.tugas.destroy', $assignment) }}" method="POST" onsubmit="return confirm('Hapus tugas ini?')">
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
                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">Belum ada tugas yang dibuat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.guru>
