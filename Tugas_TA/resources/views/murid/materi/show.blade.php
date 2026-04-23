<x-layouts.murid>
    <x-slot name="title">{{ $material->title }}</x-slot>

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

    <div x-data="materialHub()" class="h-[calc(100vh-8rem)] flex flex-col bg-white rounded-[2.5rem] overflow-hidden border border-slate-200 shadow-xl">
        
        <!-- Header Bar -->
        <nav class="h-16 bg-slate-900 flex items-center justify-between px-8 shrink-0">
            <div class="flex items-center gap-6">
                <a href="{{ route('murid.kelas.index') }}" class="p-2 text-slate-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div class="h-6 w-px bg-white/10"></div>
                <h1 class="text-sm font-black text-white uppercase tracking-widest italic truncate max-w-md">{{ $material->title }}</h1>
            </div>

            <div class="flex items-center gap-4">
                @if($material->video_url)
                <a href="{{ route('murid.materi.video', $material->id) }}" class="px-4 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"/></svg>
                    Watch Lesson
                </a>
                @endif
                <div class="h-6 w-px bg-white/10"></div>
                <div class="flex items-center gap-2 px-3 py-1 bg-white/5 rounded-full border border-white/10 opacity-50">
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Learning Active</span>
                </div>
            </div>
        </nav>

        <!-- Body: Two Columns Hub -->
        <div class="flex-1 flex overflow-hidden">
            
            <!-- Left Side: Content / Theory -->
            <div :class="!hasCompiler ? 'w-full px-20' : 'w-1/2'" class="flex flex-col bg-white overflow-y-auto custom-scrollbar border-r border-slate-100 transition-all duration-500">
                <div class="p-12 md:p-16">
                    <div class="mb-10">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="px-3 py-1 rounded-lg bg-indigo-50 text-indigo-600 text-[9px] font-black uppercase tracking-widest border border-indigo-100 italic">Material Node</span>
                            <span class="text-[10px] font-bold text-slate-400 italic">• Hub v4.0</span>
                        </div>
                        <h2 class="text-4xl font-black text-slate-900 tracking-tighter italic uppercase leading-tight mb-6">{{ $material->title }}</h2>
                        <div class="h-1.5 w-20 bg-indigo-600 rounded-full"></div>
                    </div>

                    <div class="prose prose-indigo max-w-none 
                        prose-headings:text-slate-900 prose-headings:font-black prose-headings:tracking-tight prose-headings:uppercase prose-headings:italic
                        prose-p:text-slate-600 prose-p:text-lg prose-p:leading-[1.8] prose-p:font-medium
                        prose-strong:text-slate-900 prose-strong:font-black
                        prose-code:bg-slate-50 prose-code:text-indigo-600 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded-md prose-code:font-bold
                        prose-li:text-slate-600 prose-li:font-medium
                        ">
                        {!! $material->content !!}
                    </div>

                    <!-- Navigation Footer in Content -->
                    <div class="mt-20 pt-10 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex flex-col gap-1">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Current Module</span>
                            <span class="text-sm font-bold text-slate-900">{{ $material->title }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            @if($material->has_flowchart)
                             <a href="{{ route('murid.materi.flowchart', $material->id) }}" class="px-8 py-4 bg-white border border-slate-200 text-slate-800 rounded-[1.5rem] font-black text-xs uppercase tracking-widest italic shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all active:scale-95 flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path></svg>
                                Latihan Flowchart
                             </a>
                            @endif
                             <a href="{{ route('murid.kelas.index') }}" class="px-10 py-4 bg-slate-900 text-white rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] italic shadow-xl shadow-slate-200 hover:scale-105 transition-all active:scale-95">
                                I Finished This
                             </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Integrated Compiler (CodeMirror) -->
            <div x-show="hasCompiler" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" class="w-1/2 flex flex-col bg-[#282a36] relative overflow-hidden">
                <div class="h-12 bg-black/20 border-b border-white/5 flex items-center justify-between px-8 shrink-0">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></div>
                            <span class="text-[9px] font-black text-indigo-400 uppercase tracking-[0.2em] italic">Interactive Practice</span>
                        </div>
                        <div class="h-4 w-px bg-white/10"></div>
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest" x-text="lang.toUpperCase()"></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <button @click="resetCode()" class="p-1.5 text-slate-500 hover:text-rose-400 transition-colors" title="Reset Code">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- CodeMirror Editor -->
                <div class="flex-1 overflow-hidden relative">
                    <textarea id="hub-editor" class="hidden"></textarea>
                </div>

                <!-- Action Bar & Mini Console -->
                <div class="h-44 bg-black/40 border-t border-white/5 flex flex-col shadow-2xl">
                    <div class="flex-1 p-8 overflow-y-auto font-mono text-[13px] leading-relaxed custom-scrollbar-dark no-scrollbar whitespace-pre-wrap transition-all duration-300"
                         :class="output ? 'text-emerald-400' : 'text-slate-600 italic'"
                         x-text="output || 'Ready to execute... Klik RUN untuk mencoba koding di atas.'"></div>
                    
                    <div class="h-14 bg-black/20 flex items-center justify-between px-8 shrink-0">
                        <div class="text-[9px] font-black text-slate-600 uppercase tracking-widest animate-pulse" x-show="isRunning">Executing...</div>
                        <div class="flex-1" x-show="!isRunning"></div>
                        <button @click="runCode()" :disabled="isRunning" class="px-8 py-2 bg-emerald-500 hover:bg-emerald-400 text-white font-black text-[9px] uppercase tracking-[0.2em] italic rounded-xl shadow-lg shadow-emerald-500/10 transition-all flex items-center gap-2 active:scale-95 disabled:opacity-50">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"/></svg>
                            Run Code
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function materialHub() {
            return {
                hasCompiler: {{ $material->has_compiler ? 'true' : 'false' }},
                lang: '{{ $material->language ?? "python" }}',
                sample: {!! json_encode($material->sample_code ?? "") !!},
                editor: null,
                output: '',
                isRunning: false,

                init() {
                    if (this.hasCompiler) {
                        setTimeout(() => this.initEditor(), 100);
                    }
                },

                initEditor() {
                    const mode = this.getMode(this.lang);
                    this.editor = CodeMirror.fromTextArea(document.getElementById('hub-editor'), {
                        value: this.sample,
                        mode: mode,
                        theme: 'dracula',
                        lineNumbers: true,
                        autoCloseBrackets: true,
                        matchBrackets: true,
                        tabSize: 4,
                        indentUnit: 4,
                        lineWrapping: true,
                        scrollbarStyle: 'native'
                    });
                    this.editor.setSize("100%", "100%");
                },

                getMode(lang) {
                    const map = {
                        'html': 'htmlmixed',
                        'javascript': 'javascript',
                        'python': 'python',
                        'php': 'php',
                        'java': 'text/x-java',
                        'cpp': 'text/x-c++src',
                        'csharp': 'text/x-csharp',
                        'css': 'css'
                    };
                    return map[lang] || 'text/plain';
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
                    const code = this.editor.getValue();

                    try {
                        const response = await fetch("{{ route('murid.compiler.run') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                code: code,
                                language: this.lang
                            })
                        });

                        const result = await response.json();
                        this.output = result.output;
                    } catch (error) {
                        this.output = 'System Error: Connection failed.';
                    } finally {
                        this.isRunning = false;
                    }
                }
            }
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        
        .custom-scrollbar-dark::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar-dark::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); }
        .custom-scrollbar-dark::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }

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
            padding: 0 10px;
        }
        .prose pre { background-color: #f8fafc; border: 1px solid #e2e8f0; color: #1e293b; border-radius: 1.5rem; padding: 2rem; }
    </style>
</x-layouts.murid>
