<x-layouts.murid>
    <x-slot name="title">Cinema: {{ $material->title }}</x-slot>

    <!-- CodeMirror for Performance -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/theme/dracula.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/php/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/clike/clike.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/css/css.min.js"></script>

    <div x-data="videoHub()" class="max-w-7xl mx-auto py-6 px-4">
        <!-- Breadcrumb & Title -->
        <div class="mb-8">
            <a href="{{ route('murid.materi.show', $material->id) }}" class="inline-flex items-center text-slate-400 hover:text-indigo-600 font-bold mb-4 transition-all group text-[10px] uppercase tracking-widest">
                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Theory
            </a>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase leading-none">{{ $material->title }}</h1>
                    <p class="text-slate-400 font-bold text-xs mt-3 uppercase tracking-widest italic flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-rose-600 animate-pulse"></span>
                        Cinematic Session Active
                    </p>
                </div>
            </div>
        </div>

        @php
            $embedUrl = null;
            if ($material->video_url) {
                if (str_contains($material->video_url, 'youtube.com') || str_contains($material->video_url, 'youtu.be')) {
                    $videoId = null;
                    if (preg_match('/(?:v=|\/embed\/|\/1\/|\/v\/|https:\/\/youtu\.be\/)([^"&?\/\s]{11})/', $material->video_url, $match)) {
                        $videoId = $match[1];
                    }
                    if ($videoId) $embedUrl = "https://www.youtube.com/embed/" . $videoId . "?autoplay=0&rel=0&modestbranding=1";
                } elseif (str_contains($material->video_url, 'vimeo.com')) {
                    if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $material->video_url, $match)) {
                        $embedUrl = "https://player.vimeo.com/video/" . $match[1];
                    }
                }
            }
        @endphp

        <!-- Video Player Section -->
        <div class="relative group mb-12">
            <div class="absolute -inset-1 bg-gradient-to-tr from-indigo-500/20 to-sky-400/20 rounded-[3rem] blur transition duration-1000"></div>
            <div class="relative aspect-video bg-black rounded-[2.5rem] overflow-hidden shadow-2xl border border-slate-900">
                @if($embedUrl)
                    <iframe src="{{ $embedUrl }}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-700">
                        <svg class="w-16 h-16 mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        <h3 class="text-sm font-black uppercase tracking-widest opacity-40 italic">Transmitter Offline</h3>
                    </div>
                @endif
            </div>
        </div>

        @if($material->has_compiler)
        <!-- Practice Space Under Video -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Code Editor Column -->
            <div class="lg:col-span-2 flex flex-col bg-[#282a36] rounded-[2rem] overflow-hidden shadow-2xl border border-white/5">
                <div class="h-12 bg-black/20 border-b border-white/5 flex items-center justify-between px-8">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Live Code Experiment</span>
                    </div>
                    <button @click="resetCode()" class="text-slate-500 hover:text-rose-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </button>
                </div>
                <div class="h-[400px] overflow-hidden">
                    <textarea id="video-editor" class="hidden"></textarea>
                </div>
                <div class="h-14 bg-black/20 flex items-center justify-end px-6 border-t border-white/5">
                    <button @click="runCode()" :disabled="isRunning" class="px-8 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-black text-[9px] uppercase tracking-widest italic rounded-xl transition-all disabled:opacity-50">
                        <span x-text="isRunning ? 'Running...' : 'Run Code'"></span>
                    </button>
                </div>
            </div>

            <!-- Console Output Column -->
            <div class="bg-[#0f172a] rounded-[2rem] p-8 border border-white/5 flex flex-col shadow-2xl">
                <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-widest italic mb-6">Console Output</h3>
                <div class="flex-1 font-mono text-[13px] leading-relaxed overflow-y-auto no-scrollbar"
                     :class="output ? 'text-emerald-400' : 'text-slate-600 italic'"
                     x-text="output || 'Output will appear here after execution...'"></div>
            </div>
        </div>
        @endif

        <!-- Lesson Insights -->
        <div class="bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="max-w-2xl">
                <h2 class="text-xs font-black text-indigo-600 uppercase tracking-[0.2em] italic mb-4">Strategic Insights</h2>
                <p class="text-slate-600 font-bold text-lg leading-relaxed">Selesaikan video ini dan cobalah latihan koding di atas untuk memperkuat pemahaman Anda. Praktik langsung adalah kunci penguasaan teknis.</p>
            </div>
            <a href="{{ route('murid.kelas.index') }}" class="px-10 py-5 bg-slate-900 text-white rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] italic hover:scale-105 transition-all shadow-xl shadow-slate-200 shrink-0">
                Finish Lesson
            </a>
        </div>
    </div>

    <script>
        function videoHub() {
            return {
                isRunning: false,
                output: '',
                lang: '{{ $material->language ?? "python" }}',
                sample: {!! json_encode($material->sample_code ?? "") !!},
                editor: null,

                init() {
                    @if($material->has_compiler)
                    setTimeout(() => this.initEditor(), 100);
                    @endif
                },

                initEditor() {
                    const modeMap = {
                        'html': 'htmlmixed',
                        'javascript': 'javascript',
                        'python': 'python',
                        'php': 'php',
                        'java': 'text/x-java',
                        'cpp': 'text/x-c++src',
                        'csharp': 'text/x-csharp',
                        'css': 'css'
                    };
                    const mode = modeMap[this.lang] || 'text/plain';
                    
                    this.editor = CodeMirror.fromTextArea(document.getElementById('video-editor'), {
                        value: this.sample,
                        mode: mode,
                        theme: 'dracula',
                        lineNumbers: true,
                        autoCloseBrackets: true,
                        matchBrackets: true,
                        tabSize: 4,
                        indentUnit: 4,
                        lineWrapping: true
                    });
                    this.editor.setSize("100%", "100%");
                },

                resetCode() {
                    if (confirm('Reset koding ke awal?')) {
                        this.editor.setValue(this.sample);
                        this.output = '';
                    }
                },

                async runCode() {
                    this.isRunning = true;
                    this.output = 'Executing...';
                    try {
                        const response = await fetch("{{ route('murid.compiler.run') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                code: this.editor.getValue(),
                                language: this.lang
                            })
                        });
                        const result = await response.json();
                        this.output = result.output;
                    } catch (error) {
                        this.output = 'Error: Link failed.';
                    } finally {
                        this.isRunning = false;
                    }
                }
            }
        }
    </script>

    <style>
        .CodeMirror {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 14px;
            background: transparent !important;
            height: 100% !important;
            padding: 20px 0;
        }
        .CodeMirror-gutters {
            background: transparent !important;
            border-right: 1px solid rgba(255,255,255,0.05) !important;
        }
        .no-scrollbar::-webkit-scrollbar { width: 0px; display: none; }
    </style>
</x-layouts.murid>
