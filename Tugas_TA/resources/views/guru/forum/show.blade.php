<x-layouts.guru>
    <x-slot name="title">Detail Diskusi</x-slot>

    <div class="mb-8">
        <a href="{{ route('guru.forum.index') }}" class="inline-flex items-center text-sm font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Forum
        </a>
    </div>

    <!-- Topic Content -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden mb-8">
        <div class="p-8 lg:p-12">
            <div class="flex items-center gap-3 mb-6">
                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-lg">
                    {{ $topic->classroom ? $topic->classroom->name : 'Umum' }}
                </span>
                <span class="text-xs text-slate-400 font-bold">•</span>
                <span class="text-xs text-slate-400 font-bold">{{ $topic->created_at->translatedFormat('d F Y, H:i') }}</span>
            </div>

            <h3 class="text-3xl font-black text-slate-800 mb-6 leading-tight">{{ $topic->title }}</h3>
            
            <div class="flex items-center gap-4 mb-10 pb-8 border-b border-slate-50">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-xl shadow-lg shadow-indigo-600/20">
                    {{ substr($topic->user->name, 0, 1) }}
                </div>
                <div>
                    <h5 class="text-slate-800 font-black">{{ $topic->user->name }}</h5>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Penulis Topik</p>
                </div>
            </div>

            <div class="text-slate-600 text-lg leading-relaxed whitespace-pre-line font-medium">
                {{ $topic->content }}
            </div>
        </div>
    </div>

    <!-- Replies -->
    <div class="space-y-6">
        <h4 class="text-xl font-black text-slate-800 flex items-center px-4">
            <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            Komentar ({{ $topic->replies->count() }})
        </h4>

        @foreach($topic->replies as $reply)
            <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-md shadow-slate-200/20">
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-lg shrink-0">
                        {{ substr($reply->user->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-3">
                            <h6 class="text-slate-800 font-black text-sm">{{ $reply->user->name }}</h6>
                            <span class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-slate-600 font-medium leading-relaxed whitespace-pre-line">{{ $reply->content }}</p>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Reply Form -->
        <div class="bg-slate-900 rounded-[2.5rem] p-8 lg:p-10 shadow-2xl shadow-indigo-900/20 mt-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full -mr-32 -mt-32"></div>
            <div class="relative z-10">
                <h4 class="text-xl font-black text-white mb-6">Tambahkan Komentar</h4>
                <form action="{{ route('guru.forum.reply', $topic->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <textarea name="content" rows="4" required
                              class="w-full px-6 py-4 bg-white/5 border border-white/10 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-white placeholder:text-slate-500"
                              placeholder="Ketik pesan Anda di sini..."></textarea>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-8 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white font-black rounded-xl shadow-lg shadow-indigo-600/30 transition-all active:scale-95 flex items-center">
                            Kirim Komentar
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.guru>
