<x-layouts.murid>
    <x-slot name="title">Home</x-slot>

    <!-- Hero Section -->
    <div class="mb-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2 italic">
                    Halo, {{ Auth::user()->name }} 👋
                </h1>
                <p class="text-slate-500 font-medium text-lg">Lanjutkan perjalanan belajar kamu hari ini.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all active:scale-95 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                    Resume Activity
                </button>
                <button class="p-3 bg-white border border-slate-200 text-slate-400 rounded-2xl hover:text-slate-600 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Action Panel -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
        @php
            $quickActions = [
                ['label' => 'Start Learning', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253', 'color' => 'indigo', 'route' => 'murid.kelas.index'],
                ['label' => 'Explore Topic', 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z', 'color' => 'sky', 'route' => 'murid.kelas.index'],
                ['label' => 'Practice Mode', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', 'color' => 'emerald', 'route' => '#'],
                ['label' => 'Community', 'icon' => 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z', 'color' => 'rose', 'route' => 'murid.forum.index'],
            ];
        @endphp

        @foreach($quickActions as $action)
            <a href="{{ $action['route'] === '#' ? '#' : route($action['route']) }}" class="group bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-{{ $action['color'] }}-100/50 transition-all duration-300 flex flex-col items-center text-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-{{ $action['color'] }}-50 text-{{ $action['color'] }}-600 flex items-center justify-center mb-1 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="{{ $action['icon'] }}"></path></svg>
                </div>
                <span class="text-sm font-bold text-slate-800 tracking-tight">{{ $action['label'] }}</span>
            </a>
        @endforeach
    </div>

    <!-- Smart Content Area -->
    <div class="space-y-12">

        @if($globalMaterials->count() > 0)
            <!-- Global Materials Section (Materi Umum) -->
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight flex items-center gap-3 italic">
                        <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                        Materi Umum & Praktikum
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($globalMaterials as $material)
                        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col group hover:border-blue-200 hover:shadow-xl hover:shadow-blue-900/5 transition-all duration-300">
                            <div class="h-32 bg-slate-900 relative overflow-hidden shrink-0">
                                <div class="absolute inset-0 bg-gradient-to-tr from-blue-600/20 to-transparent"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                     <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-white/40 ring-1 ring-white/20">
                                         @if($material->language)
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                         @else
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253"></path></svg>
                                         @endif
                                     </div>
                                </div>
                                <div class="absolute bottom-3 left-6 flex gap-2">
                                     <span class="px-3 py-1 bg-black/50 backdrop-blur-md rounded-lg text-[9px] font-black text-white uppercase tracking-widest">{{ $material->language ?: 'Materi' }}</span>
                                </div>
                            </div>
                            <div class="p-6 flex flex-col flex-1">
                                <h3 class="text-lg font-black text-slate-900 mb-2 tracking-tight group-hover:text-blue-600 transition-colors uppercase italic">{{ $material->title }}</h3>
                                <div class="mt-auto flex items-center justify-between gap-4 pt-4 border-t border-slate-50">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                        <span class="text-[10px] font-bold text-slate-400">Tersedia</span>
                                    </div>
                                    <a href="{{ route('murid.materi.show', $material->id) }}" class="p-2 bg-slate-50 text-slate-400 hover:bg-blue-600 hover:text-white rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    </div>
</x-layouts.murid>
