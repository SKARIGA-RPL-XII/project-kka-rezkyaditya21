<x-layouts.guru>
    <x-slot name="title">Buat Tugas Baru</x-slot>

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('guru.tugas.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="classroom_id" class="block text-sm font-bold text-gray-700 mb-2">Pilih Kelas</label>
                    <select name="classroom_id" id="classroom_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Tugas</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="Contoh: Membuat Landing Page Sederhana">
                </div>

                <div>
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Instruksi Tugas</label>
                    <textarea name="description" id="description" rows="6"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="Tuliskan instruksi atau soal tugas di sini...">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="file" class="block text-sm font-bold text-gray-700 mb-2">Upload File Pendukung (Opsional)</label>
                    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-indigo-400 transition cursor-pointer bg-gray-50 flex flex-col items-center">
                        <input type="file" name="file" id="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <span class="text-sm text-gray-500">Klik atau seret file ke sini (Max 10MB)</span>
                        <p class="text-xs text-gray-400 mt-1">PDF, ZIP, DOCX, dll.</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 transition">
                    <label for="is_published" class="ml-2 block text-sm text-gray-700">Publikasikan tugas ke siswa</label>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end space-x-4">
                <a href="{{ route('guru.tugas.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Batal</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-md shadow-indigo-200 transition">Simpan Tugas</button>
            </div>
        </form>
    </div>
</x-layouts.guru>
