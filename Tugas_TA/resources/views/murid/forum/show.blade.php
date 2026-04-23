<x-layouts.murid>
    <x-slot name="title">{{ $topic->title }}</x-slot>

    <div class="max-w-4xl mx-auto">
        <a href="{{ route('murid.forum.index') }}" class="inline-flex items-center text-slate-400 hover:text-indigo-600 font-bold mb-8 transition-all group text-xs uppercase tracking-widest">
            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Community
        </a>

        <!-- Topic Card -->
        <div class="bg-white rounded-[3rem] p-10 md:p-16 border border-slate-100 shadow-2xl shadow-slate-200/50 mb-16 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 opacity-50"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-6 mb-10">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0 font-black text-2xl italic {{ $topic->user->role === 'admin' ? 'bg-indigo-600 text-white' : 'bg-slate-900 text-white' }} shadow-xl">
                        {{ substr($topic->user->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-xs font-black {{ $topic->user->role === 'admin' ? 'text-indigo-600' : 'text-slate-900' }} uppercase tracking-widest italic">{{ $topic->user->name }}</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest px-2 py-0.5 bg-slate-50 rounded border border-slate-100 italic">
                                {{ $topic->user->role === 'admin' ? 'Curator' : 'Builder' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            <span>{{ $topic->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic uppercase leading-tight mb-8">{{ $topic->title }}</h1>
                
                <div class="prose prose-slate max-w-none text-slate-600 font-medium text-lg leading-[1.8]">
                    {!! nl2br(e($topic->content)) !!}
                </div>
            </div>
        </div>

        <!-- Replies Section -->
        <div class="space-y-10">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-4 italic italic">
                    <span class="w-8 h-px bg-slate-100"></span>
                    {{ $topic->replies->count() }} Insightful Replies
                </h3>
            </div>

            @foreach($topic->replies as $reply)
                 <div class="group relative bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm flex gap-8 transition-all duration-300 {{ $reply->user->role === 'admin' ? 'border-indigo-100 bg-indigo-50/10' : '' }}">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 font-black text-lg italic {{ $reply->user->role === 'admin' ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-400' }} shadow-sm">
                        {{ substr($reply->user->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-4">
                             <div class="flex items-center gap-3">
                                <span class="text-xs font-black {{ $reply->user->role === 'admin' ? 'text-indigo-600' : 'text-slate-900' }} uppercase tracking-widest italic">{{ $reply->user->name }}</span>
                                @if($reply->user->role === 'admin')
                                    <span class="text-[8px] font-black text-white bg-indigo-600 px-2 py-0.5 rounded italic uppercase tracking-widest">Curator</span>
                                @endif
                             </div>
                             <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-slate-600 font-medium text-base leading-relaxed">
                            {!! nl2br(e($reply->content)) !!}
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Reply Form -->
            <div class="mt-16 bg-slate-900 rounded-[3rem] p-10 md:p-12 shadow-2xl shadow-indigo-200 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-600/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 group-hover:scale-110 transition-transform duration-1000"></div>
                
                <div class="relative z-10">
                    <h4 class="text-2xl font-black text-white italic uppercase tracking-tighter mb-8">Share your perspective</h4>
                    <form action="{{ route('murid.forum.reply', $topic->id) }}" method="POST" class="space-y-6">
                        @csrf
                        <textarea name="content" rows="4" required class="w-full rounded-3xl bg-white/5 border-white/10 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all text-lg font-medium p-6" placeholder="Beri balasan yang membangun..."></textarea>
                        <div class="flex justify-end">
                            <button type="submit" class="px-10 py-4 bg-white text-slate-900 hover:bg-indigo-50 font-black text-xs uppercase tracking-[0.2em] rounded-2xl shadow-xl transition-all active:scale-95">
                                Send Intelligence &rarr;
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.murid>
