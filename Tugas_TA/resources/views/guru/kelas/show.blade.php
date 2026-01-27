<x-layouts.guru>
    <x-slot name="title">Kelas: {{ $kela->name }}</x-slot>

    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $kela->name }}</h2>
            <p class="text-gray-500">{{ $kela->description }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('guru.kelas.edit', $kela) }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Edit Kelas</a>
            <a href="{{ route('guru.materi.create', ['classroom_id' => $kela->id]) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Tambah Materi</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar: Info & Students -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-700 mb-4 pb-2 border-b">Info Kelas</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status:</span>
                        @if($kela->is_published)
                            <span class="text-green-600 font-bold">Publik</span>
                        @else
                            <span class="text-yellow-600 font-bold">Draft</span>
                        @endif
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Dibuat:</span>
                        <span class="text-gray-800 font-medium">{{ $kela->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-700 mb-4 pb-2 border-b">Murid Terdaftar ({{ $kela->students->count() }})</h3>
                <div class="space-y-3">
                    @forelse($kela->students as $student)
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold mr-3">
                                    {{ substr($student->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ $student->name }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 italic">Belum ada murid di kelas ini.</p>
                    @endforelse
                </div>
                <div class="mt-4 pt-4 border-t border-gray-50">
                    <a href="{{ route('guru.murid.create', ['classroom_id' => $kela->id]) }}" class="text-sm text-indigo-600 font-bold hover:underline">+ Daftarkan Murid</a>
                </div>
            </div>
        </div>

        <!-- Main Content: Materi & Tugas -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Materi Section -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-800 text-lg">Materi Pembelajaran</h3>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <tbody class="divide-y divide-gray-100">
                            @forelse($kela->materials as $material)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-800">{{ $material->title }}</div>
                                        <div class="text-xs text-gray-400">{{ $material->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('guru.materi.edit', $material) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-10 text-center text-gray-400 italic">Belum ada materi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Tugas Section -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-800 text-lg">Daftar Tugas</h3>
                    <a href="{{ route('guru.tugas.create', ['classroom_id' => $kela->id]) }}" class="text-sm text-indigo-600 font-bold hover:underline">Tambah Tugas</a>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <tbody class="divide-y divide-gray-100">
                            @forelse($kela->assignments as $assignment)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-800">{{ $assignment->title }}</div>
                                        <div class="text-xs text-gray-400">Dibuat: {{ $assignment->created_at->format('d/m/Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('guru.tugas.edit', $assignment) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-10 text-center text-gray-400 italic">Belum ada tugas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-layouts.guru>
