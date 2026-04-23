<x-layouts.murid>
    <x-slot name="title">User Profile</x-slot>

    <div class="max-w-4xl mx-auto py-12 px-6">
        <div class="flex flex-col md:flex-row items-center gap-12 mb-16">
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-tr from-indigo-500 to-sky-400 rounded-full blur opacity-25 group-hover:opacity-60 transition duration-1000"></div>
                <div class="relative w-40 h-40 rounded-full bg-slate-100 flex items-center justify-center font-black text-5xl text-slate-400 border-4 border-white shadow-2xl italic group-hover:scale-105 transition-transform duration-500">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
            
            <div class="text-center md:text-left">
                <h1 class="text-5xl font-black text-slate-900 tracking-tighter italic uppercase leading-tight mb-2">{{ auth()->user()->name }}</h1>
                <p class="text-slate-500 font-bold text-lg mb-6">{{ auth()->user()->email }}</p>
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-4">
                    <span class="px-5 py-2 bg-indigo-600 text-white rounded-full text-[10px] font-black uppercase tracking-widest italic shadow-lg shadow-indigo-600/30">Lvl 1 Builder</span>
                    <span class="px-5 py-2 bg-slate-900 text-white rounded-full text-[10px] font-black uppercase tracking-widest italic">Rank #42</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-8 italic">Profile Controls</h3>
                <div class="space-y-6">
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100 group hover:border-indigo-500 transition-colors">
                        <span class="text-sm font-bold text-slate-600 italic uppercase">Account Settings</span>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100 group hover:border-indigo-500 transition-colors">
                        <span class="text-sm font-bold text-slate-600 italic uppercase">Security Buffer</span>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="flex items-center justify-between w-full p-6 bg-rose-50 hover:bg-rose-100 rounded-[2rem] border border-rose-100 transition-all text-rose-600 italic group">
                            <span class="text-sm font-black uppercase tracking-widest italic">Purge Session (Logout)</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-slate-900 rounded-[2.5rem] p-10 flex flex-col justify-between italic relative overflow-hidden group/card shadow-2xl">
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl opacity-0 group-hover/card:opacity-100 transition-opacity duration-1000"></div>
                
                <h3 class="text-sm font-black text-slate-500 uppercase tracking-widest mb-10 relative z-10">Data Intelligence</h3>
                <div class="space-y-8 relative z-10">
                    <div class="flex items-end justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Logic Solved</span>
                            <span class="text-3xl font-black text-white italic">14 Units</span>
                        </div>
                        <div class="w-12 h-1 bg-indigo-600 mb-2 rounded-full"></div>
                    </div>
                    <div class="flex items-end justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Weekly Streak</span>
                            <span class="text-3xl font-black text-white italic">4 Days</span>
                        </div>
                        <div class="w-8 h-1 bg-amber-500 mb-2 rounded-full"></div>
                    </div>
                </div>
                <div class="mt-12 p-6 bg-white/5 rounded-2xl border border-white/5 relative z-10">
                    <p class="text-[10px] font-medium text-slate-400 leading-relaxed uppercase tracking-widest">System analytics will become more detailed as your learning session progresses.</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.murid>
