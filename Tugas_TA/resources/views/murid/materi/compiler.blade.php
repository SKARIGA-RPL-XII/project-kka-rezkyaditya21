<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn Pro Compiler - {{ $material->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0d1117; color: #c9d1d9; }
        .jetbrains { font-family: 'JetBrains Mono', monospace; }
        .monaco-editor { padding-top: 5px; }
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: #0d1117; }
        ::-webkit-scrollbar-thumb { background: #30363d; border-radius: 5px; }
        ::-webkit-scrollbar-thumb:hover { background: #484f58; }
        .sidebar-item:hover { background-color: #21262d; }
        .sidebar-active { background-color: #21262d; border-left: 2px solid #58a6ff; }
        .status-bar { background-color: #0d1117; border-top: 1px solid #30363d; height: 25px; }
    </style>
</head>
<body class="h-screen flex flex-col overflow-hidden">

    <!-- Activity Bar (Far Left) -->
    <div class="flex flex-1 overflow-hidden">
        <aside class="w-12 bg-[#0d1117] border-r border-[#30363d] flex flex-col items-center py-4 gap-6 shrink-0 z-50">
            <div class="text-slate-500 hover:text-white cursor-pointer transition-colors p-1 border-l-2 border-white">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20 18H4V8h16m0-2H4c-1.11 0-2 .89-2 2v10c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2m-9 3H5v2h6m8-2h-6v2h6m-8 2H5v2h6m8-2h-6v2h6Z"/></svg>
            </div>
            <div class="text-slate-500 hover:text-white cursor-pointer transition-colors p-1 border-l-2 border-transparent">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
            </div>
            <div class="text-slate-500 hover:text-white cursor-pointer transition-colors p-1 border-l-2 border-transparent">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 10 10 10 10 0 0 0 10-10A10 10 0 0 0 12 2m0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8m-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
            </div>
            <div class="mt-auto mb-4 text-slate-600 hover:text-white cursor-pointer">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 15.5A3.5 3.5 0 0 1 8.5 12 3.5 3.5 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5 3.5 3.5 0 0 1-3.5 3.5m7.43-2.53c.04-.32.07-.64.07-.97 0-.33-.03-.66-.07-1l2.11-1.63c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.31-.61-.22l-2.49 1c-.52-.39-1.06-.73-1.69-.98l-.37-2.65c-.04-.24-.25-.42-.5-.42h-4c-.25 0-.46.18-.5.42l-.37 2.65c-.63.25-1.17.59-1.69.98l-2.49-1c-.22-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L5.57 11c-.04.34-.07.67-.07 1 0 .33.03.65.07.97l-2.11 1.66c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.31.61.22l2.49-1c.52.39 1.06.73 1.69.98l.37 2.65c.04.24.25.42.5.42h4c.25 0 .46-.18.5-.42l.37-2.65c.63-.25 1.17-.59 1.69-.98l2.49 1c.22.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.66Z"/></svg>
            </div>
        </aside>

        <!-- Sidebar Simulation -->
        <aside class="w-60 bg-[#0d1117] border-r border-[#30363d] flex flex-col shrink-0 text-xs hidden lg:flex">
            <div class="h-10 flex items-center px-4 uppercase font-black tracking-widest text-[#8b949e]">Explorer</div>
            <div class="flex-1 overflow-y-auto pt-2">
                <div class="px-4 py-1 flex items-center gap-2 font-bold text-[#c9d1d9] group cursor-pointer">
                    <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
                    <span>APP-LEARNING</span>
                </div>
                <div class="pl-8 flex flex-col gap-0.5 mt-1">
                    <div class="sidebar-active px-4 py-1.5 flex items-center gap-2 cursor-pointer transition-colors group">
                        <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                        <span class="text-[#f0f6fc]">Main.{{ $material->language == 'html' ? 'html' : ($material->language ?: 'txt') }}</span>
                    </div>
                    <div class="sidebar-item px-4 py-1.5 flex items-center gap-2 cursor-pointer transition-colors text-slate-500">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                        <span>config.json</span>
                    </div>
                    <div class="sidebar-item px-4 py-1.5 flex items-center gap-2 cursor-pointer transition-colors text-slate-500">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                        <span>README.md</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- IDE Main -->
        <div class="flex-1 flex flex-col min-w-0 bg-[#0d1117]">
            <!-- Tab Bar -->
            <div class="h-9 bg-[#0d1117] border-b border-[#30363d] flex items-center px-2">
                <div class="h-full px-4 bg-[#161b22] border-t-2 border-[#f78166] flex items-center gap-2 text-[11px] font-medium border-x border-[#30363d]">
                    <svg class="w-3.5 h-3.5 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                    <span>Main.{{ $material->language }}</span>
                    <button class="ml-2 text-slate-500 hover:text-white">&times;</button>
                </div>
                <div class="flex-1"></div>
                <!-- Control Buttons -->
                <div class="flex items-center gap-2 px-4">
                    <button id="runBtn" class="bg-[#238636] hover:bg-[#2ea043] text-white px-4 py-1 rounded-md text-[11px] font-bold flex items-center gap-1.5 transition-all shadow-lg active:scale-95">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4.5 2.691a.75.75 0 01.385-.655l12.75 7.5a.75.75 0 010 1.31l-12.75 7.5a.75.75 0 01-1.135-.655V2.691z"/></svg>
                        JALANKAN
                    </button>
                    <button onclick="window.close()" class="text-slate-500 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>

            <!-- VS Code Body -->
            <div class="flex-1 flex flex-col lg:flex-row overflow-hidden">
                <!-- Code Panel -->
                <div class="flex-1 flex flex-col border-r border-[#30363d] relative">
                    <textarea id="codemirror-editor" class="hidden"></textarea>
                </div>

                <!-- Preview/Terminal Panel -->
                <div class="lg:w-1/2 flex flex-col bg-[#010409]">
                    <div class="h-9 bg-[#161b22] border-b border-[#30363d] flex items-center px-4 gap-4 overflow-x-auto shrink-0">
                        <button class="text-[11px] font-black text-[#c9d1d9] border-b-2 border-[#f78166] h-full px-2 uppercase tracking-widest">Output Terminal</button>
                        <button class="text-[11px] font-bold text-slate-500 hover:text-white h-full px-2 uppercase tracking-widest">Console</button>
                        <div class="flex-1"></div>
                        <button id="clearBtn" class="text-[10px] text-slate-500 hover:text-rose-400 font-bold uppercase tracking-widest">Clear</button>
                    </div>

                    <div class="flex-1 overflow-hidden relative group">
                        @if(in_array($material->language, ['html', 'css', 'javascript_web']))
                            <iframe id="web-preview" class="w-full h-full bg-white"></iframe>
                        @else
                            <div id="terminal" class="w-full h-full p-6 jetbrains text-[14px] overflow-y-auto leading-relaxed text-[#d1d5db] selection:bg-[#264f78]">
                                <div class="text-[#8b949e] italic mb-4"> EduLearn Piston Engine v3.0 // Ready...</div>
                                <div id="terminal-content"></div>
                            </div>
                        @endif

                        <!-- Floating Notification -->
                        <div id="status-toast" class="absolute top-4 right-4 translate-x-32 opacity-0 transition-all duration-300 bg-[#238636] text-white px-4 py-2 rounded-lg text-xs font-bold shadow-2xl flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Berhasil dijalankan
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Bar -->
            <div class="status-bar flex items-center justify-between px-3 text-[11px] text-[#8b949e] shrink-0">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1.5 hover:text-white cursor-pointer px-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                        <span>0 Errors</span>
                    </div>
                    <div class="flex items-center gap-1.5 hover:text-white cursor-pointer px-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M11 15h2v2h-2zm0-8h2v6h-2zm1-5C6.47 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.53 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                        <span>0 Warnings</span>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span id="line-info">Ln 1, Col 1</span>
                    <span>Spaces: 4</span>
                    <span>UTF-8</span>
                    <span class="bg-[#238636]/20 text-[#3fb950] px-2 font-bold">{{ strtoupper($material->language ?: 'plaintext') }}</span>
                    <svg class="w-3.5 h-3.5 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Light-weight CodeMirror Editor -->
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

    <script>
        let editor;
        const runBtn = document.getElementById('runBtn');
        const clearBtn = document.getElementById('clearBtn');
        const terminalContent = document.getElementById('terminal-content');
        const webPreview = document.getElementById('web-preview');
        const toast = document.getElementById('status-toast');
        
        const lang = '{{ $material->language }}';
        const sampleCode = {!! json_encode($material->sample_code) !!};

        function getCodeMirrorMode(lang) {
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
        }

        function showToast(success = true, msg = "Berhasil dijalankan") {
            toast.innerText = msg;
            toast.style.backgroundColor = success ? '#238636' : '#da3633';
            toast.classList.remove('translate-x-32', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-x-32', 'opacity-0');
            }, 2000);
        }

        // Initialize CodeMirror
        editor = CodeMirror.fromTextArea(document.getElementById('codemirror-editor'), {
            value: sampleCode,
            mode: getCodeMirrorMode(lang),
            theme: 'dracula',
            lineNumbers: true,
            autoCloseBrackets: true,
            matchBrackets: true,
            tabSize: 4,
            indentUnit: 4,
            lineWrapping: true,
            scrollbarStyle: 'native'
        });
        editor.setSize("100%", "100%");

        editor.on('cursorActivity', (instance) => {
            const pos = instance.getCursor();
            document.getElementById('line-info').innerText = `Ln ${pos.line + 1}, Col ${pos.ch + 1}`;
        });

        runBtn.addEventListener('click', async () => {
            const code = editor.getValue();
            runBtn.disabled = true;
            runBtn.innerHTML = '<span class="animate-pulse">MENJALANKAN...</span>';

            if (['html', 'css', 'javascript_web'].includes(lang)) {
                if (webPreview) webPreview.srcdoc = code;
                setTimeout(() => {
                    runBtn.disabled = false;
                    runBtn.innerHTML = 'JALANKAN';
                    showToast();
                }, 400);
            } else {
                try {
                    const response = await fetch('{{ route('compiler.run') }}', {
                        method: 'POST',
                        headers: { 
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ code, language: lang })
                    });
                    const data = await response.json();
                    
                    if (terminalContent) {
                        const div = document.createElement('div');
                        div.className = 'mt-2 border-l-2 border-indigo-500 pl-4 py-1 animate-in fade-in slide-in-from-left-2 duration-300';
                        div.innerHTML = `<div class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Execution @ ${new Date().toLocaleTimeString()}</div>
                                         <pre class="selection:bg-indigo-900">${data.output || 'Tidak ada output.'}</pre>`;
                        terminalContent.prepend(div);
                    }
                    showToast();
                } catch (e) {
                    showToast(false, "Kesalahan Eksekusi");
                } finally {
                    runBtn.disabled = false;
                    runBtn.innerHTML = 'JALANKAN';
                }
            }
        });

        clearBtn.addEventListener('click', () => {
            if (terminalContent) terminalContent.innerHTML = '';
            if (webPreview) webPreview.srcdoc = '';
        });

        // Shortcut Ctrl+Enter
        window.addEventListener('keydown', (e) => {
            if (e.ctrlKey && e.key === 'Enter') {
                runBtn.click();
            }
        });
    </script>

    <style>
        .CodeMirror {
            font-family: 'JetBrains Mono', monospace;
            font-size: 14px;
            background: transparent !important;
            height: 100% !important;
        }
        .CodeMirror-gutters {
            background: transparent !important;
            border-right: 1px solid rgba(255,255,255,0.05) !important;
        }
    </style>
</body>
</html>
