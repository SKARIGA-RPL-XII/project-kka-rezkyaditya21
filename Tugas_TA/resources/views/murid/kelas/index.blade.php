<x-layouts.murid>
    <x-slot name="title">Explore Library</x-slot>

    <div x-data="{ 
        videoModalOpen: false, 
        currentVideoUrl: '', 
        currentVideoTitle: '',
        currentEmbedUrl: '',
        openVideo(url, title) {
            this.currentVideoUrl = url;
            this.currentVideoTitle = title;
            // Extract YouTube video ID
            let videoId = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/ ]{11})/);
            if (videoId) {
                this.currentEmbedUrl = 'https://www.youtube.com/embed/' + videoId[1] + '?autoplay=1';
            }
            this.videoModalOpen = true;
        }
    }">

    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter mb-4 italic uppercase">Knowledge Base</h1>
        <p class="text-slate-500 font-medium text-lg max-w-2xl">Akses langsung ke seluruh materi pembelajaran, panduan teknis, dan tantangan koding yang tersedia.</p>
    </div>

    <!-- Filter/Search -->
    <div class="flex flex-wrap items-center gap-4 mb-10 pb-10 border-b border-slate-100">
        <a href="{{ route('murid.kelas.index') }}" 
           class="px-5 py-2.5 {{ !request('type') ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'bg-white border border-slate-200 text-slate-500 hover:border-indigo-300 hover:text-indigo-600' }} rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
           All Materials
        </a>
        
        <a href="{{ route('murid.kelas.index', ['type' => 'theory']) }}" 
           class="px-5 py-2.5 {{ request('type') == 'theory' ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'bg-white border border-slate-200 text-slate-500 hover:border-indigo-300 hover:text-indigo-600' }} rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
           Theory
        </a>
        
        <a href="{{ route('murid.kelas.index', ['type' => 'video']) }}" 
           class="px-5 py-2.5 {{ request('type') == 'video' ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'bg-white border border-slate-200 text-slate-500 hover:border-indigo-300 hover:text-indigo-600' }} rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
           Video
        </a>
        
        <a href="{{ route('murid.kelas.index', ['type' => 'practice']) }}" 
           class="px-5 py-2.5 {{ request('type') == 'practice' ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'bg-white border border-slate-200 text-slate-500 hover:border-indigo-300 hover:text-indigo-600' }} rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
           Practice
        </a>
    </div>

    @if($materials->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($materials as $material)
                <div class="group relative flex flex-col h-full">
                    <!-- Tech Hover Glow -->
                    <div class="absolute -inset-0.5 bg-gradient-to-tr from-indigo-500 to-emerald-400 rounded-[2.5rem] blur opacity-0 group-hover:opacity-20 transition duration-500 pointer-events-none"></div>
                    
                    
                    @if($material->video_url)
                        {{-- Video Card - Opens Modal --}}
                        <div onclick="openVideoModal('{{ $material->video_url }}', '{{ addslashes($material->title) }}')" 
                             class="relative flex-1 bg-white rounded-[2.2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group-hover:-translate-y-1 cursor-pointer">
                            
                            @php
                                // Extract YouTube video ID
                                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $material->video_url, $matches);
                                $videoId = $matches[1] ?? null;
                                $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg" : null;
                            @endphp
                            
                            {{-- Video Thumbnail --}}
                            @if($thumbnailUrl)
                                <div class="relative aspect-video bg-slate-900 overflow-hidden">
                                    <img src="{{ $thumbnailUrl }}" 
                                         alt="{{ $material->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    
                                    {{-- Play Button Overlay --}}
                                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                                        <div class="w-14 h-14 bg-rose-500 rounded-full flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform">
                                            <svg class="w-7 h-7 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <div class="absolute bottom-3 right-3 px-2 py-1 bg-rose-600 rounded text-white text-[10px] font-black uppercase tracking-widest">
                                        VIDEO
                                    </div>
                                </div>
                            @endif
                            
                            {{-- Video Info --}}
                            <div class="p-8 pb-0">
                                <h3 class="text-xl font-bold text-slate-900 leading-tight mb-2 group-hover:text-rose-500 transition-colors line-clamp-2">
                                    {{ $material->title }}
                                </h3>
                                <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                                    <span class="uppercase tracking-wider">Video Lesson</span>
                                    @if($material->language)
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                        <span class="px-2 py-0.5 bg-slate-100 rounded text-slate-500 uppercase tracking-wide">
                                            {{ $material->language }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="mt-auto p-8 pt-6">
                                <div class="w-full py-3 rounded-xl bg-slate-50 border border-slate-100 text-slate-400 font-bold text-xs uppercase tracking-widest text-center group-hover:bg-rose-500 group-hover:text-white transition-all duration-300 flex items-center justify-center gap-2">
                                    Watch Video
                                    <svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity translate-x-[-5px] group-hover:translate-x-0 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7"></path></svg>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Regular Material Card - Normal Link --}}
                        <a href="{{ route('murid.materi.show', $material->id) }}" class="relative flex-1 bg-white rounded-[2.2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group-hover:-translate-y-1">
                        
                        <!-- Card Header -->
                        <div class="p-8 pb-0">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white shadow-lg bg-indigo-600 shadow-indigo-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                @if($material->language)
                                    <span class="px-3 py-1 bg-slate-100 rounded-full text-[9px] font-black text-slate-500 uppercase tracking-widest border border-slate-200">
                                        {{ $material->language }}
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="text-xl font-bold text-slate-900 leading-tight mb-2 group-hover:text-indigo-600 transition-colors line-clamp-2">
                                {{ $material->title }}
                            </h3>
                            <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                                <span class="uppercase tracking-wider">Reading Material</span>
                                @if($material->has_compiler)
                                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                    <span class="text-emerald-500 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                        Practice
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="mt-auto p-8 pt-6">
                            <div class="w-full py-3 rounded-xl bg-slate-50 border border-slate-100 text-slate-400 font-bold text-xs uppercase tracking-widest text-center group-hover:bg-slate-900 group-hover:text-white transition-all duration-300 flex items-center justify-center gap-2">
                                Start Learning
                                <svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity translate-x-[-5px] group-hover:translate-x-0 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7"></path></svg>
                            </div>
                        </div>


                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @else
         <div class="text-center py-24 bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden relative">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-50/50 to-transparent"></div>
            <div class="relative z-10">
                <div class="w-20 h-20 bg-slate-100 rounded-[2rem] flex items-center justify-center mx-auto mb-6 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-2 italic uppercase">Library Empty</h3>
                <p class="text-slate-400 font-medium max-w-xs mx-auto">Masih belum ada materi global yang dipublikasikan.</p>
            </div>
        </div>
    @endif

    <!-- Request Tech -->
    <!-- Request Tech Compact -->
    <div class="mt-12 p-6 bg-black rounded-[1.5rem] border border-slate-800 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-4 shadow-xl group">
        <!-- Background Effects -->
        <div class="absolute top-0 right-0 w-48 h-48 bg-indigo-600/20 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2 group-hover:bg-indigo-600/30 transition-colors duration-700"></div>
        
        <div class="relative z-10 flex items-center gap-4 text-center md:text-left">
            <div class="hidden md:flex w-10 h-10 bg-indigo-600 rounded-xl items-center justify-center shrink-0 shadow-lg shadow-indigo-900/50 group-hover:scale-105 transition-transform">
                 <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <div>
                 <h3 class="text-base font-black text-white italic uppercase tracking-tight mb-0.5">Request a Topic</h3>
                 <p class="text-slate-400 text-xs font-medium max-w-sm">Tidak menemukan yang kamu cari? Ajukan topik baru.</p>
            </div>
        </div>
        
        <button class="relative z-10 px-6 py-3 bg-white text-indigo-950 rounded-lg font-black text-[10px] uppercase tracking-widest hover:bg-indigo-50 transition-all shadow-lg shadow-white/5 active:scale-95 shrink-0 w-full md:w-auto">
            Submit Request
        </button>
    </div>

    <!-- Floating Video Player Modal (Vanilla JS) -->
    <div id="videoModal" style="display: none;" class="fixed inset-0 z-[9999] flex items-center justify-center p-6 bg-black/90 backdrop-blur-md">
        <div class="relative w-full max-w-4xl">
            <!-- Close Button -->
            <button onclick="closeVideoModal()" class="absolute -top-12 right-0 text-white hover:text-rose-400 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Video Player -->
            <div class="bg-slate-900 rounded-2xl overflow-hidden shadow-2xl">
                <div class="relative w-full" style="padding-bottom: 56.25%;">
                    <iframe id="videoIframe" 
                            class="absolute inset-0 w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                </div>
                
                <!-- Video Title -->
                <div class="p-6 bg-slate-900 border-t border-slate-800">
                    <h3 id="videoTitle" class="text-xl font-bold text-white"></h3>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openVideoModal(url, title) {
            // Extract YouTube video ID
            const videoId = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/);
            
            if (videoId) {
                const embedUrl = 'https://www.youtube.com/embed/' + videoId[1] + '?autoplay=1';
                document.getElementById('videoIframe').src = embedUrl;
                document.getElementById('videoTitle').textContent = title;
                document.getElementById('videoModal').style.display = 'flex';
            }
        }

        function closeVideoModal() {
            document.getElementById('videoModal').style.display = 'none';
            document.getElementById('videoIframe').src = ''; // Stop video
        }

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeVideoModal();
            }
        });

        // Close on click outside
        document.getElementById('videoModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeVideoModal();
            }
        });
    </script>

    </div> <!-- Close Alpine x-data wrapper -->

</x-layouts.murid>
