<div class="flex items-center gap-4 pl-6 border-l border-slate-100 ml-4">
    <div class="hidden md:flex flex-col items-end">
        <span class="text-sm font-bold text-slate-800 tracking-tight">{{ Auth::user()->name }}</span>
        <span class="text-[10px] font-black text-indigo-500 bg-indigo-50 px-2 py-0.5 rounded-md uppercase tracking-tighter">Guru / Pengajar</span>
    </div>
    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-extrabold text-xl shadow-xl shadow-indigo-600/20">
        {{ substr(Auth::user()->name, 0, 1) }}
    </div>
</div>
