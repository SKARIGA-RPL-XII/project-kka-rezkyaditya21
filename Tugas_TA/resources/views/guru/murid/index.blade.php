    <x-layouts.guru>
    <x-slot name="title">Kelola Murid</x-slot>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-gray-700">Daftar Murid Terdaftar</h2>
        <a href="{{ route('guru.murid.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Tambah Murid ke Kelas
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs font-bold ring-1 ring-gray-200">
                    <th class="px-6 py-4">Nama Murid</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Kelas yang Diikuti</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($students as $student)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold mr-3">
                                {{ substr($student->name, 0, 1) }}
                            </div>
                            <span class="font-semibold text-gray-800">{{ $student->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $student->email }}</td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach($student->enrolledClassrooms->where('teacher_id', Auth::id()) as $classroom)
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded border border-gray-200 flex items-center">
                                    {{ $classroom->name }}
                                    <form action="{{ route('guru.murid.destroy', $student->id) }}" method="POST" class="ml-2 inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                                        <button type="submit" class="text-red-400 hover:text-red-600" title="Keluarkan dari kelas">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </form>
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">Belum ada murid yang terdaftar di kelas Anda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.guru>
