<x-layouts.guru>
    <x-slot name="title">Tambah Murid ke Kelas</x-slot>

    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-4 bg-gray-50 border-b border-gray-100 italic text-sm text-gray-500">
            Pilih murid dan kelas untuk mendaftarkan murid tersebut ke kelas Anda.
        </div>
        <form action="{{ route('guru.murid.store') }}" method="POST" class="p-8">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="user_id" class="block text-sm font-bold text-gray-700 mb-2">Pilih Murid</label>
                    <select name="user_id" id="user_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        <option value="">-- Pilih Murid --</option>
                        @foreach($all_students as $student)
                            <option value="{{ $student->id }}" {{ old('user_id') == $student->id ? 'selected' : '' }}>{{ $student->name }} ({{ $student->email }})</option>
                        @endforeach
                    </select>
                </div>

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
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end space-x-4">
                <a href="{{ route('guru.murid.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Batal</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-md shadow-indigo-200 transition text-center flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    Daftarkan Murid
                </button>
            </div>
        </form>
    </div>
</x-layouts.guru>
