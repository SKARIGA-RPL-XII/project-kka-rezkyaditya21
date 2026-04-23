<x-layouts.murid>
    <x-slot name="title">Community</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 mb-16">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter mb-4 italic uppercase">Community Hub</h1>
                <p class="text-slate-500 font-medium text-lg">Berinteraksi, berkolaborasi, dan pecahkan masalah bersama komunitas tech global.</p>
            </div>
            <a href="{{ route('murid.forum.create') }}" class="inline-flex items-center px-8 py-4 bg-indigo-600 text-white rounded-[1.5rem] font-black text-xs uppercase tracking-widest shadow-xl shadow-indigo-200 hover:bg-indigo-700 transition-all active:scale-95 shrink-0">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                New Thread
            </a>
        </div>

        <!-- Topics List -->
        <div class="space-y-6">
            @forelse($topics as $topic)
                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm hover:border-indigo-300 transition-all duration-300 group">
                    <a href="{{ route('murid.forum.show', $topic->id) }}" class="block">
                        <div class="flex items-start gap-6">
                            <!-- User Initial / Avatar -->
                            <div class="w-14 h-14 rounded-2xl flex-shrink-0 flex items-center justify-center font-black text-xl italic {{ $topic->user->role === 'admin' ? 'bg-indigo-600 text-white' : 'bg-slate-900 text-white' }} shadow-lg transition-transform group-hover:rotate-3">
                                {{ substr($topic->user->name, 0, 1) }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-full text-[9px] font-black text-indigo-600 uppercase tracking-widest">
                                        General Hub
                                    </span>
                                    <span class="text-slate-300 italic text-xs">&mdash;</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $topic->created_at->diffForHumans() }}</span>
                                </div>
                                
                                <h3 class="text-2xl font-black text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors tracking-tight leading-none italic uppercase">{{ $topic->title }}</h3>
                                <p class="text-slate-500 text-sm font-medium line-clamp-2 leading-relaxed">{{ Str::limit(strip_tags($topic->content), 150) }}</p>
                                
                                <div class="mt-8 flex items-center justify-between pt-6 border-t border-slate-50">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xs font-black text-slate-900 uppercase tracking-tight">{{ $topic->user->name }}</span>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest px-2 py-0.5 bg-slate-50 rounded border border-slate-100">
                                            {{ $topic->user->role === 'admin' ? 'Curator' : 'Builder' }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex items-center gap-5 text-slate-400">
                                        <div class="flex items-center gap-2 px-3 py-1.5 bg-slate-50 rounded-xl border border-slate-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                            <span class="text-[10px] font-black tracking-widest">{{ $topic->replies_count }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="text-center py-32 bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                    <div class="w-20 h-20 bg-slate-50 rounded-[2rem] flex items-center justify-center mx-auto mb-8 text-slate-200">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 italic uppercase mb-2">The Hub is Silent</h3>
                    <p class="text-slate-400 font-medium max-w-sm mx-auto">Be the pioneer. Start the first conversation in the community hub.</p>
                </div>
            @endforelse

            <div class="mt-12">
                {{ $topics->links() }}
            </div>
        </div>
    </div>
</x-layouts.murid>
