<x-layouts.murid>
    <x-slot name="title">Forum Diskusi</x-slot>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Diskusi Kelas</h1>
            <p class="text-slate-500 font-medium">Ruang tanya jawab dan kolaborasi siswa</p>
        </div>
        <a href="{{ route('murid.forum.create') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold shadow-lg shadow-indigo-600/20 transition-all active:scale-95 flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Topik Baru
        </a>
    </div>

    <!-- Topics List -->
    <div class="space-y-4">
        @forelse($topics as $topic)
            <a href="{{ route('murid.forum.show', $topic->id) }}" class="block bg-white p-6 rounded-[2rem] border border-slate-100 shadow-lg shadow-slate-200/20 hover:shadow-xl hover:border-indigo-100 hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-start gap-5">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 font-bold text-lg border-2 {{ $topic->user->role === 'guru' ? 'bg-indigo-50 border-indigo-100 text-indigo-600' : 'bg-slate-50 border-slate-100 text-slate-500' }}">
                        {{ substr($topic->user->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-1">
                            @if($topic->classroom)
                                <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-wider">{{ $topic->classroom->name }}</span>
                            @else
                                <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-wider">UMUM</span>
                            @endif
                            <span class="text-xs font-bold text-slate-400">&bull;</span>
                            <span class="text-xs font-bold text-slate-400">{{ $topic->created_at->diffForHumans() }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2 truncate group-hover:text-indigo-600 transition-colors">{{ $topic->title }}</h3>
                        <p class="text-slate-500 text-sm line-clamp-2">{{ Str::limit(strip_tags($topic->content), 150) }}</p>
                        
                        <div class="mt-4 flex items-center gap-6 border-t border-slate-50 pt-4">
                            <div class="flex items-center text-slate-400 text-xs font-bold">
                                <span class="{{ $topic->user->role === 'guru' ? 'text-indigo-600' : 'text-slate-600' }} mr-1">{{ $topic->user->name }}</span>
                                <span class="uppercase text-[10px] px-1.5 py-0.5 rounded bg-slate-100 ml-1">{{ $topic->user->role }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-slate-400 text-xs font-bold ml-auto">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                {{ $topic->replies_count }} Balasan
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center py-20 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Diskusi</h3>
                <p class="text-slate-400">Jadilah yang pertama memulai diskusi!</p>
            </div>
        @endforelse

        <div class="mt-6">
            {{ $topics->links() }}
        </div>
    </div>
</x-layouts.murid>
