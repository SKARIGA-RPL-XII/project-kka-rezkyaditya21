<x-layouts.guru>
    <x-slot name="title">{{ $assignment->title }}</x-slot>

    <div class="mb-8">
        <a href="{{ route('guru.tugas.index') }}" class="inline-flex items-center text-gray-500 hover:text-indigo-600 mb-4 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Tugas
        </a>
        <div class="flex justify-between items-start">
            <div>
                 <h1 class="text-3xl font-bold text-gray-800">{{ $assignment->title }}</h1>
                 <p class="text-gray-500 mt-1">
                    Kelas: <span class="font-semibold text-indigo-600">{{ $assignment->classroom->name }}</span> 
                    &bull; 
                    Deadline: <span class="font-semibold text-amber-600">{{ $assignment->due_date ? \Carbon\Carbon::parse($assignment->due_date)->format('d M Y, H:i') : 'Tidak ada deadline' }}</span>
                </p>
                <div class="mt-4 prose text-gray-600">
                    {{ $assignment->description }}
                </div>
            </div>
            <div class="flex space-x-2">
                 <a href="{{ route('guru.tugas.edit', $assignment) }}" class="px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition font-semibold">
                    Edit Tugas
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
                <div class="ml-3"><p class="text-sm text-green-700">{{ session('success') }}</p></div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg shadow-gray-100 border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">Status Pengumpulan</h2>
            <div class="flex space-x-4 text-sm font-medium">
                <span class="flex items-center text-green-600"><span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> Terkumpul: {{ $submissions->count() }}</span>
                <span class="flex items-center text-gray-500"><span class="w-2 h-2 bg-gray-300 rounded-full mr-2"></span> Belum: {{ $students->count() - $submissions->count() }}</span>
            </div>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase font-bold tracking-wider">
                    <th class="px-6 py-4">Nama Murid</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Waktu Pengumpulan</th>
                    <th class="px-6 py-4 text-center">Nilai</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($students as $student)
                    @php
                        $submission = $submissions->get($student->id);
                        $hasSubmitted = $submission ? true : false;
                    @endphp
                    <tr class="hover:bg-gray-50/80 transition {{ $hasSubmitted ? 'bg-white' : 'bg-red-50/10' }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs mr-3">
                                    {{ substr($student->name, 0, 1) }}
                                </div>
                                <span class="font-semibold text-gray-700">{{ $student->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($hasSubmitted)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Terkumpul
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Belum
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $hasSubmitted ? $submission->created_at->format('d M Y, H:i') : '-' }}
                        </td>
                         <td class="px-6 py-4 text-center">
                            @if($hasSubmitted && $submission->score)
                                <span class="font-bold text-indigo-600">{{ $submission->score }}</span>
                            @elseif($hasSubmitted)
                                <span class="text-xs text-gray-400 italic">Belum dinilai</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                             @if($hasSubmitted)
                                <button onclick="openGradingModal('{{ $student->name }}', '{{ $submission->id }}', '{{ $submission->score }}', '{{ $submission->feedback }}', '{{ Storage::url($submission->file_path) }}', '{{ $submission->content }}')" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 underline">
                                    Periksa
                                </button>
                             @else
                                <span class="text-gray-300 text-sm">N/A</span>
                             @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Grading Modal -->
    <div id="gradingModal" class="fixed inset-0 overflow-y-auto hidden z-[100]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeGradingModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="gradingForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                            Periksa Tugas: <span id="modalStudentName" class="font-bold text-indigo-600"></span>
                        </h3>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jawaban Murid</label>
                            <div class="bg-gray-50 rounded-lg p-3 text-sm text-gray-800 border border-gray-200 mb-2">
                                <p id="modalContent" class="italic text-gray-500 mb-2"></p>
                                <a id="modalFileLink" href="#" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Lihat File Lampiran
                                </a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="score" class="block text-sm font-medium text-gray-700 mb-1">Nilai (0-100)</label>
                            <input type="number" name="score" id="modalScore" min="0" max="100" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Berikan nilai...">
                        </div>
                        
                        <div class="mb-4">
                            <label for="feedback" class="block text-sm font-medium text-gray-700 mb-1">Catatan Guru</label>
                            <textarea name="feedback" id="modalFeedback" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Tulis masukan untuk murid..."></textarea>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan Penilaian
                        </button>
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeGradingModal()">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openGradingModal(studentName, submissionId, score, feedback, fileUrl, content) {
            document.getElementById('modalStudentName').innerText = studentName;
            document.getElementById('modalScore').value = score || '';
            document.getElementById('modalFeedback').value = feedback || ''; // Handle potential 'null' string if passed directly
            document.getElementById('modalContent').innerText = content ? content : 'Tidak ada jawaban teks';
            
            const fileLink = document.getElementById('modalFileLink');
            if (fileUrl && fileUrl !== 'null' && fileUrl !== '{{ Storage::url("") }}') {
                fileLink.href = fileUrl;
                fileLink.classList.remove('hidden');
            } else {
                fileLink.classList.add('hidden');
            }

            // Set form action dynamically
            // Route: guru.tugas.grade (need to create this route)
            const form = document.getElementById('gradingForm');
            form.action = `/guru/tugas/submission/${submissionId}/grade`;

            document.getElementById('gradingModal').classList.remove('hidden');
        }

        function closeGradingModal() {
            document.getElementById('gradingModal').classList.add('hidden');
        }
    </script>
</x-layouts.guru>
