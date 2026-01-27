<x-layouts.guru>
    <x-slot name="title">Edit Kelas: {{ $kela->name }}</x-slot>

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('guru.kelas.update', $kela) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Kelas</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $kela->name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="Contoh: Pemrograman Web - XI RPL 1">
                </div>

                <div>
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Kelas</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="Berikan penjelasan singkat tentang kelas ini...">{{ old('description', $kela->description) }}</textarea>
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $kela->is_published) ? 'checked' : '' }}
                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 transition">
                    <label for="is_published" class="ml-2 block text-sm text-gray-700">Publikasikan kelas agar dapat diakses murid</label>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end space-x-4">
                <a href="{{ route('guru.kelas.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Batal</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-md shadow-indigo-200 transition">Perbarui Kelas</button>
            </div>
        </form>
    </div>
</x-layouts.guru>
