<x-layouts.guru title="Forum Diskusi">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12"
         style="animation: premiumFadeIn 0.8s cubic-bezier(0.23, 1, 0.32, 1) backwards;">
        <div>
            <h1 class="text-4xl font-black text-slate-800 tracking-tight">Forum Komunitas</h1>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mt-2">Ruang diskusi dan kolaborasi antar guru dan murid</p>
        </div>
        <a href="{{ route('guru.forum.create') }}" 
           class="px-8 py-4 bg-indigo-600 hover:bg-slate-900 text-white font-black rounded-2xl shadow-xl shadow-indigo-600/30 transition-all active:scale-95 flex items-center group">
            <svg class="w-6 h-6 mr-3 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Buat Topik Baru
        </a>
    </div>

    <div class="space-y-8">
        @forelse($topics as $index => $topic)
        <div class="glass-card rounded-[3rem] overflow-hidden hover-lift group border border-white/20"
             style="animation: premiumFadeIn 0.8s cubic-bezier(0.23, 1, 0.32, 1) {{ 0.2 + ($index * 0.1) }}s backwards;">
            <div class="p-10 lg:p-12 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/5 rounded-full -mr-32 -mt-32 blur-3xl group-hover:bg-indigo-500/10 transition-colors"></div>
                
                <div class="flex flex-col lg:flex-row gap-10 relative z-10">
                    <!-- Author Sidebar -->
                    <div class="lg:w-48 shrink-0 flex flex-row lg:flex-col items-center lg:items-center justify-between lg:justify-start gap-4 lg:border-r lg:border-slate-100 lg:pr-10">
                        <div class="w-20 h-20 rounded-3xl bg-slate-900 border-4 border-white shadow-2xl flex items-center justify-center text-white font-black text-2xl group-hover:rotate-6 transition-transform overflow-hidden">
                            @if($topic->user->avatar)
                                <img src="{{ Storage::url($topic->user->avatar) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($topic->user->name, 0, 1) }}
                            @endif
                        </div>
                        <div class="text-center lg:mt-4">
                            <p class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $topic->user->name }}</p>
                            <p class="text-[9px] font-black text-indigo-500 uppercase tracking-widest mt-1">Author</p>
                        </div>
                    </div>

                    <!-- Topic Content -->
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-6">
                            <span class="px-4 py-1.5 bg-slate-50 text-slate-400 text-[10px] font-black uppercase tracking-widest rounded-xl border border-slate-100 italic">
                                {{ $topic->created_at->diffForHumans() }}
                            </span>
                            @if($topic->classroom)
                                <span class="px-4 py-1.5 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-xl border border-indigo-100/50">
                                    Kelas: {{ $topic->classroom->name }}
                                </span>
                            @else
                                <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-xl border border-emerald-100/50">
                                    Public Forum
                                </span>
                            @endif
                        </div>

                        <h3 class="text-3xl font-black text-slate-800 mb-6 group-hover:text-indigo-600 transition-colors tracking-tight leading-tight uppercase">{{ $topic->title }}</h3>
                        <p class="text-slate-500 font-medium leading-relaxed mb-10 line-clamp-3 text-lg">{{ $topic->content }}</p>

                        <div class="flex flex-wrap items-center justify-between gap-6 pt-10 border-t border-slate-50">
                            <div class="flex items-center gap-8">
                                <div class="flex items-center gap-3 text-slate-400">
                                    <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    </div>
                                    <span class="text-xs font-black uppercase tracking-widest">{{ $topic->replies_count }} Diskusi</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3">
                                <a href="{{ route('guru.forum.show', $topic->id) }}" class="px-8 py-3 bg-white text-indigo-600 font-black text-[11px] uppercase tracking-[0.2em] rounded-xl border border-indigo-100 hover:bg-indigo-600 hover:text-white transition-all shadow-sm flex items-center">
                                    Lihat Diskusi
                                    <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                                
                                @if(Auth::id() === $topic->user_id)
                                <form action="{{ route('guru.forum.destroy', $topic->id) }}" method="POST" onsubmit="return confirm('Hapus topik ini?')">
                                    @csrf @method('DELETE')
                                    <button class="p-3 text-slate-300 hover:text-rose-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="glass-card py-32 px-10 rounded-[4rem] text-center border-dashed border-slate-200 border-2">
            <div class="w-24 h-24 bg-slate-50 rounded-3xl flex items-center justify-center text-slate-300 mx-auto mb-6">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 uppercase tracking-[0.2em]">Belum Ada Diskusi</h3>
            <p class="text-slate-400 font-bold uppercase tracking-widest mt-4 text-xs">Jadilah yang pertama untuk memulai percakapan di forum ini.</p>
        </div>
        @endforelse
    </div>
    
    <div class="mt-12">
        {{ $topics->links() }}
    </div>
</x-layouts.guru>
