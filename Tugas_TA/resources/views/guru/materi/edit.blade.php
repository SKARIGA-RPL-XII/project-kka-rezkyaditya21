<x-layouts.guru>
    <x-slot name="title">Edit Materi: {{ $materi->title }}</x-slot>

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('guru.materi.update', $materi) }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label for="classroom_id" class="block text-sm font-bold text-gray-700 mb-2">Pilih Kelas</label>
                    <select name="classroom_id" id="classroom_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ old('classroom_id', $materi->classroom_id) == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Materi</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $materi->title) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

                <div>
                    <label for="content" class="block text-sm font-bold text-gray-700 mb-2">Konten Materi (Teks)</label>
                    <textarea name="content" id="content" rows="6"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">{{ old('content', $materi->content) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">File Saat Ini</label>
                    @if($materi->file_path)
                        <div class="flex items-center p-3 bg-indigo-50 border border-indigo-100 rounded-lg mb-2">
                            <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <span class="text-xs text-indigo-700">{{ basename($materi->file_path) }}</span>
                        </div>
                    @else
                        <p class="text-xs text-gray-400 italic mb-2">Belum ada file yang diupload.</p>
                    @endif
                    
                    <label for="file" class="block text-sm font-bold text-gray-700 mb-2">Ganti File (Opsional)</label>
                    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-indigo-400 transition cursor-pointer bg-gray-50 flex flex-col items-center">
                        <input type="file" name="file" id="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <span class="text-sm text-gray-500">Klik atau seret file baru ke sini</span>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $materi->is_published) ? 'checked' : '' }}
                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 transition">
                    <label for="is_published" class="ml-2 block text-sm text-gray-700">Publikasikan materi</label>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end space-x-4">
                <a href="{{ route('guru.materi.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Batal</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-md shadow-indigo-200 transition">Update Materi</button>
            </div>
        </form>
    </div>
</x-layouts.guru>
