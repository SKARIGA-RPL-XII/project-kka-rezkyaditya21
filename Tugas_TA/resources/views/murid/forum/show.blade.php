<x-layouts.murid>
    <x-slot name="title">{{ $topic->title }}</x-slot>

    <div class="max-w-4xl mx-auto">
        <a href="{{ route('murid.forum.index') }}" class="inline-flex items-center text-slate-400 hover:text-slate-600 font-bold mb-6 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Forum
        </a>

        <!-- Topic Card -->
        <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-slate-100 shadow-xl shadow-slate-200/40 mb-10">
            <div class="flex items-start gap-4 mb-6">
                 <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 font-bold text-xl border-2 {{ $topic->user->role === 'guru' ? 'bg-indigo-50 border-indigo-100 text-indigo-600' : 'bg-slate-50 border-slate-100 text-slate-500' }}">
                    {{ substr($topic->user->name, 0, 1) }}
                </div>
                <div>
                     <h1 class="text-2xl font-black text-slate-800 tracking-tight leading-tight mb-2">{{ $topic->title }}</h1>
                     <div class="flex items-center gap-4 text-xs font-bold text-slate-400">
                        <span class="{{ $topic->user->role === 'guru' ? 'text-indigo-600' : 'text-slate-600' }}">{{ $topic->user->name }}</span>
                        <span>&bull;</span>
                        <span>{{ $topic->created_at->diffForHumans() }}</span>
                        @if($topic->classroom)
                             <span>&bull;</span>
                            <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-500 uppercase tracking-wider">{{ $topic->classroom->name }}</span>
                        @endif
                     </div>
                </div>
            </div>

            <div class="prose prose-slate max-w-none text-slate-700">
                {!! nl2br(e($topic->content)) !!}
            </div>
        </div>

        <!-- Replies Section -->
        <div class="space-y-6">
            <h3 class="text-lg font-black text-slate-800 flex items-center">
                 <span class="w-1.5 h-6 bg-slate-300 rounded-full mr-3"></span>
                 {{ $topic->replies->count() }} Balasan
            </h3>

            @foreach($topic->replies as $reply)
                 <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex gap-4 {{ $reply->user->role === 'guru' ? 'ring-2 ring-indigo-50' : '' }}">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 font-bold text-sm border {{ $reply->user->role === 'guru' ? 'bg-indigo-50 border-indigo-100 text-indigo-600' : 'bg-slate-50 border-slate-100 text-slate-500' }}">
                        {{ substr($reply->user->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                             <span class="text-sm font-bold {{ $reply->user->role === 'guru' ? 'text-indigo-600' : 'text-slate-700' }}">{{ $reply->user->name }}</span>
                             <span class="text-xs font-bold text-slate-300">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-slate-600 text-sm leading-relaxed">
                            {!! nl2br(e($reply->content)) !!}
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Reply Form -->
            <div class="bg-slate-50 rounded-[2rem] p-6 border border-slate-200 mt-8">
                <h4 class="font-bold text-slate-700 mb-4">Tulis Balasan</h4>
                <form action="{{ route('murid.forum.reply', $topic->id) }}" method="POST">
                    @csrf
                    <textarea name="content" rows="3" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 mb-4" placeholder="Tulis komentar anda..."></textarea>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-600/20 transition-all active:scale-95">
                            Kirim Balasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.murid>
