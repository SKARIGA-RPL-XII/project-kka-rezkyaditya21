<x-layouts.murid>
    <x-slot name="title">Draw.io Pro Editor</x-slot>

    <!-- Interact.js for Drag and Drop -->
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

    <div x-data="drawioEditor()" class="h-[calc(100vh-8rem)] flex flex-col bg-[#121212] rounded-[2.5rem] overflow-hidden border border-white/5 shadow-2xl relative font-sans text-slate-300">
        
        <!-- Premium Draw.io Menu Bar -->
        <nav class="bg-[#2a2a2a] border-b border-white/5 flex items-center px-4 h-8 shrink-0 z-50 text-[11px] select-none">
            <div class="flex items-center gap-4 text-slate-400">
                <div class="hover:text-white cursor-pointer">File</div>
                <div class="hover:text-white cursor-pointer">Edit</div>
                <div class="hover:text-white cursor-pointer">View</div>
                <div class="hover:text-white cursor-pointer">Arrange</div>
                <div class="hover:text-white cursor-pointer">Help</div>
            </div>
            <div class="ml-auto text-slate-500 font-bold tracking-tighter">DRAW.IO PRO</div>
        </nav>

        <!-- Premium Draw.io Header -->
        <header class="bg-[#1e1e1e] border-b border-white/5 h-12 flex items-center justify-between px-4 shrink-0 z-40">
            <div class="flex items-center gap-4">
                <a href="{{ route('murid.materi.show', $material->id) }}" class="p-1.5 hover:bg-white/5 rounded text-slate-400 hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div class="h-4 w-px bg-white/10"></div>
                <h1 class="text-xs font-bold text-slate-400 tracking-tight">{{ $material->title }}</h1>
            </div>

            <div class="flex items-center gap-2">
                <div class="flex items-center bg-black/20 rounded px-1 py-1 border border-white/5">
                    <button @click="undo()" :disabled="historyIndex <= 0" class="p-1 px-3 hover:bg-white/10 rounded transition-colors text-slate-400 hover:text-white disabled:opacity-20 disabled:cursor-not-allowed text-[10px] font-black italic">UNDO</button>
                    <button @click="redo()" :disabled="historyIndex >= history.length - 1" class="p-1 px-3 hover:bg-white/10 rounded transition-colors text-slate-400 hover:text-white disabled:opacity-20 disabled:cursor-not-allowed text-[10px] font-black italic">REDO</button>
                </div>
                
                <div class="flex items-center gap-1 bg-black/20 rounded border border-white/5 px-1 py-1">
                    <button @click="zoomOut()" class="p-1 hover:bg-white/10 rounded text-slate-400 hover:text-white"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 12H4"></path></svg></button>
                    <span class="text-[10px] font-black min-w-[40px] text-center" x-text="Math.round(zoom * 100) + '%'"></span>
                    <button @click="zoomIn()" class="p-1 hover:bg-white/10 rounded text-slate-400 hover:text-white"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg></button>
                </div>

                <button @click="clearCanvas()" class="px-4 py-1.5 bg-rose-500/10 hover:bg-rose-500 text-rose-500 hover:text-white rounded text-[10px] font-black uppercase tracking-tighter transition-all border border-rose-500/20 active:scale-95">
                    CLEAR
                </button>
            </div>
        </header>

        <!-- Dynamic Context Toolbar -->
        <div class="bg-[#2a2a2a] border-b border-white/5 flex items-center px-4 h-10 gap-2 shrink-0 z-40 select-none">
            <button class="p-1.5 hover:bg-white/5 rounded text-slate-500 hover:text-rose-400 transition-colors" title="Delete" @click="deleteSelected()">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
            <div class="h-4 w-px bg-white/10 mx-1"></div>
            <div class="flex items-center gap-1">
                <template x-for="color in ['#6366f1', '#10b981', '#ffffff', '#f43f5e']">
                    <button @click="if(nodeSelected) { nodes.find(n=>n.id===nodeSelected).fill = color; pushHistory(); }" 
                            class="w-5 h-5 rounded border border-white/10 transition-transform active:scale-90"
                            :style="`background: ${color}; opacity: ${nodeSelected ? 1 : 0.3}`"></button>
                </template>
            </div>
        </div>

        <div class="flex-1 flex overflow-hidden">
            <!-- Sidebar (Symbols) -->
            <aside class="w-64 bg-[#1a1a1a] border-r border-white/10 flex flex-col z-30 shrink-0 select-none shadow-2xl">
                <div class="p-4 border-b border-white/5 bg-[#1e1e1e]">
                    <div class="relative">
                        <input type="text" placeholder="Search shapes..." class="w-full bg-black/40 border border-white/10 rounded px-8 py-1.5 text-[10px] font-bold text-slate-400 focus:outline-none focus:border-indigo-500 transition-all">
                        <svg class="absolute left-2.5 top-2 w-3.5 h-3.5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-4 no-scrollbar">
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4 group cursor-pointer">
                            <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">
                                 <svg class="w-3 h-3 text-indigo-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13H5v-2h14v2z"/></svg>
                                 General Shapes
                            </h3>
                            <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <template x-for="item in library">
                                <div class="bg-white/[0.03] border border-white/5 rounded flex flex-col items-center justify-center cursor-grab active:cursor-grabbing hover:bg-white/5 transition-all p-3 group aspect-square"
                                     draggable="true" 
                                     @dragstart="onDragStart($event, item)">
                                    <svg class="w-10 h-10 text-slate-400 group-hover:text-white transition-colors" viewBox="0 0 100 100">
                                        <g x-html="item.iconHtml"></g>
                                    </svg>
                                    <span class="text-[8px] font-black text-slate-600 group-hover:text-slate-400 mt-2 uppercase" x-text="item.label"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Major Workspace -->
            <main id="drawio-viewport" 
                  class="flex-1 relative bg-[#121212] overflow-hidden" 
                  :class="activeLine ? 'active-drawing' : ''"
                  @dragover.prevent 
                  @drop="onDrop($event)"
                  @mousedown="onCanvasBgDown($event)"
                  @mousemove="onCanvasMouseMove($event)"
                  @mouseup="onCanvasMouseUp($event)">
                
                <!-- Advanced Grid Logic -->
                <div class="absolute inset-0 pointer-events-none" 
                     :style="`transform: scale(${zoom}) translate(${pan.x}px, ${pan.y}px); transform-origin: top left;`">
                    <div class="absolute inset-0" 
                         style="background-image: 
                            linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), 
                            linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
                            background-size: 20px 20px; width: 10000px; height: 10000px;"></div>
                    <div class="absolute inset-0" 
                         style="background-image: 
                            linear-gradient(rgba(255,255,255,0.08) 1.5px, transparent 1.5px), 
                            linear-gradient(90deg, rgba(255,255,255,0.08) 1.5px, transparent 1.5px);
                            background-size: 100px 100px; width: 10000px; height: 10000px;"></div>
                </div>

                <!-- Connection Layer (SVG) -->
                <svg class="absolute inset-0 pointer-events-none z-50"
                     :style="`transform: scale(${zoom}) translate(${pan.x}px, ${pan.y}px); transform-origin: top left; width:10000px; height:10000px;`">
                    <defs>
                        <marker id="arrowhead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orientation="auto">
                            <polygon points="0 0, 10 3.5, 0 7" fill="#ffffff" />
                        </marker>
                    </defs>
                    
                    <!-- Rendered Lines -->
                    <template x-for="line in connections">
                        <path :d="line.path" 
                              stroke="#ffffff" 
                              stroke-width="1.8" 
                              fill="none" 
                              marker-end="url(#arrowhead)"
                              style="opacity: 0.9; stroke-linecap: round; stroke-linejoin: round;" />
                    </template>

                    <!-- Active Drawing Line -->
                    <path x-show="activeLine" 
                          :d="activeLinePath" 
                          stroke="#ffffff" 
                          stroke-width="1.8" 
                          stroke-dasharray="4,4"
                          fill="none" 
                          style="pointer-events: none;" />
                </svg>

                <!-- Symbols Container -->
                <div id="drawio-canvas" 
                     class="absolute inset-0 z-20"
                     :style="`transform: scale(${zoom}) translate(${pan.x}px, ${pan.y}px); transform-origin: top left;`"
                     @mouseup="onCanvasMouseUp($event)">
                    
                    <template x-for="(node, index) in nodes" :key="node.id">
                        <div :id="node.id"
                             class="absolute group cursor-move select-none"
                             :style="`left: ${node.x}px; top: ${node.y}px; width: ${node.width}px; height: ${node.height}px; transition: transform 0.05s ease-out;`"
                             @mousedown.stop="nodeSelected = node.id">
                            
                            <div class="relative flex items-center justify-center w-full h-full transition-all">
                                
                                <!-- Robust SVG Shape Background -->
                                <svg class="absolute inset-0 w-full h-full -z-10 transition-colors" 
                                     viewBox="0 0 100 100" preserveAspectRatio="none">
                                    <path :d="getShapePath(node.type)" 
                                          :stroke="nodeSelected === node.id ? '#818cf8' : (activeLine && activeLine.fromNode !== node.id ? 'rgba(99,102,241,0.6)' : 'rgba(255,255,255,0.4)')"
                                          :fill="nodeSelected === node.id ? 'rgba(99,102,241,0.1)' : (node.fill || '#1e1e1e')"
                                          stroke-width="3"
                                          :stroke-dasharray="activeLine && activeLine.fromNode !== node.id ? '5,3' : 'none'"
                                          style="transition: all 0.2s ease;" />
                                    <!-- Selection Glow -->
                                    <path x-show="nodeSelected === node.id"
                                          :d="getShapePath(node.type)" 
                                          stroke="#818cf8"
                                          stroke-width="12"
                                          fill="none"
                                          style="opacity: 0.15; filter: blur(4px);" />
                                </svg>
                                
                                <textarea x-model="node.text" 
                                          class="bg-transparent border-none text-center font-black text-[10px] text-white/90 outline-none resize-none w-[80%] h-auto overflow-hidden placeholder-white/10 uppercase tracking-[0.1em] no-scrollbar leading-tight relative z-10"
                                          :class="[node.type === 'diamond' ? 'scale-75' : '', activeLine ? 'pointer-events-none' : '']"
                                          rows="1"
                                          @change="pushHistory()"
                                          @input="rebuildConnections()"></textarea>

                                <!-- Premium Quick-Connect Arrows (Draw.io Style) -->
                                <div class="node-arrow t" :class="activeLine ? 'pointer-events-none opacity-0' : ''" @mousedown.stop.prevent="startLine(node.id, 'top')">
                                    <svg viewBox="0 0 24 24" class="w-full h-full"><path d="M12 4v16M5 11l7-7 7 7" stroke="currentColor" stroke-width="3" fill="none"/></svg>
                                </div>
                                <div class="node-arrow b" :class="activeLine ? 'pointer-events-none opacity-0' : ''" @mousedown.stop.prevent="startLine(node.id, 'bottom')">
                                    <svg viewBox="0 0 24 24" class="w-full h-full rotate-180"><path d="M12 4v16M5 11l7-7 7 7" stroke="currentColor" stroke-width="3" fill="none"/></svg>
                                </div>
                                <div class="node-arrow l" :class="activeLine ? 'pointer-events-none opacity-0' : ''" @mousedown.stop.prevent="startLine(node.id, 'left')">
                                    <svg viewBox="0 0 24 24" class="w-full h-full -rotate-90"><path d="M12 4v16M5 11l7-7 7 7" stroke="currentColor" stroke-width="3" fill="none"/></svg>
                                </div>
                                <div class="node-arrow r" :class="activeLine ? 'pointer-events-none opacity-0' : ''" @mousedown.stop.prevent="startLine(node.id, 'right')">
                                    <svg viewBox="0 0 24 24" class="w-full h-full rotate-90"><path d="M12 4v16M5 11l7-7 7 7" stroke="currentColor" stroke-width="3" fill="none"/></svg>
                                </div>

                                <!-- invisible larger hit targets for dropping connections -->
                                <div class="node-port t" :class="activeLine ? 'z-[100] pointer-events-auto' : 'z-5'" @mouseup.stop="onCanvasMouseUp($event)"></div>
                                <div class="node-port b" :class="activeLine ? 'z-[100] pointer-events-auto' : 'z-5'" @mouseup.stop="onCanvasMouseUp($event)"></div>
                                <div class="node-port l" :class="activeLine ? 'z-[100] pointer-events-auto' : 'z-5'" @mouseup.stop="onCanvasMouseUp($event)"></div>
                                <div class="node-port r" :class="activeLine ? 'z-[100] pointer-events-auto' : 'z-5'" @mouseup.stop="onCanvasMouseUp($event)"></div>

                                <!-- Resize Handles (Only when selected) -->
                                <template x-if="nodeSelected === node.id">
                                    <div class="absolute inset-0 pointer-events-none">
                                        <div class="resize-handle tl pointer-events-auto" @mousedown.stop="startResize(node.id, 'tl')"></div>
                                        <div class="resize-handle tr pointer-events-auto" @mousedown.stop="startResize(node.id, 'tr')"></div>
                                        <div class="resize-handle bl pointer-events-auto" @mousedown.stop="startResize(node.id, 'bl')"></div>
                                        <div class="resize-handle br pointer-events-auto" @mousedown.stop="startResize(node.id, 'br')"></div>
                                        <div class="resize-handle ml pointer-events-auto" @mousedown.stop="startResize(node.id, 'ml')"></div>
                                        <div class="resize-handle mr pointer-events-auto" @mousedown.stop="startResize(node.id, 'mr')"></div>
                                        <div class="resize-handle mt pointer-events-auto" @mousedown.stop="startResize(node.id, 'mt')"></div>
                                        <div class="resize-handle mb pointer-events-auto" @mousedown.stop="startResize(node.id, 'mb')"></div>
                                    </div>
                                </template>

                                <!-- Action Toolbar -->
                                <div class="absolute -top-10 left-1/2 -translate-x-1/2 flex items-center gap-1 bg-white/10 backdrop-blur-md p-1.5 rounded-xl border border-white/20 opacity-0 group-hover:opacity-100 transition-all scale-75 group-hover:scale-100 pointer-events-none group-hover:pointer-events-auto">
                                    <button @click.stop="deleteNode(node.id)" class="p-1.5 hover:bg-rose-500 rounded-lg transition-colors text-white/60 hover:text-white">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </main>

            <!-- Right Format Panel -->
            <aside class="w-64 bg-[#1a1a1a] border-l border-white/10 flex flex-col shrink-0 select-none z-30" x-show="nodeSelected">
                <div class="flex items-center justify-between p-4 border-b border-white/5 bg-[#222222]">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Format Panel</span>
                    <button class="text-slate-500 hover:text-white transition-colors" @click="nodeSelected = null">
                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-4 no-scrollbar">
                    <template x-if="getSelectedNode()">
                        <div class="space-y-6">
                            <!-- Style Tab -->
                            <div>
                                <h4 class="text-[9px] font-black text-indigo-500 uppercase tracking-widest mb-4">Style Properties</h4>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="p-3 bg-white/[0.03] border border-white/5 rounded-lg text-center cursor-pointer hover:bg-white/5 transition-all" @click="getSelectedNode().fill = '#818cf8'">
                                            <div class="w-full h-2 rounded bg-indigo-500 mb-1"></div>
                                            <span class="text-[8px] text-slate-500 font-bold uppercase">Ocean</span>
                                        </div>
                                        <div class="p-3 bg-white/[0.03] border border-white/5 rounded-lg text-center cursor-pointer hover:bg-white/5 transition-all" @click="getSelectedNode().fill = '#10b981'">
                                            <div class="w-full h-2 rounded bg-emerald-500 mb-1"></div>
                                            <span class="text-[8px] text-slate-500 font-bold uppercase">Forest</span>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-2">
                                        <label class="text-[9px] font-black text-slate-600 uppercase tracking-tighter">Fill Color</label>
                                        <div class="flex items-center gap-2">
                                            <input type="color" x-model="getSelectedNode().fill" class="w-full h-8 bg-transparent border-none cursor-pointer rounded overflow-hidden">
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-[9px] font-black text-slate-600 uppercase tracking-tighter">Line Opacity</label>
                                        <input type="range" min="0" max="1" step="0.1" class="w-full accent-indigo-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Text Tab -->
                            <div class="pt-6 border-t border-white/5">
                                <h4 class="text-[9px] font-black text-indigo-500 uppercase tracking-widest mb-4">Text Formatting</h4>
                                <div class="flex items-center gap-1 bg-black/40 p-1 rounded-lg">
                                    <button class="flex-1 p-1 hover:bg-white/10 rounded text-[10px] font-black">B</button>
                                    <button class="flex-1 p-1 hover:bg-white/10 rounded text-[10px] font-black italic">I</button>
                                    <button class="flex-1 p-1 hover:bg-white/10 rounded text-[10px] font-black underline">U</button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </aside>
        </div>
    </div>

    <script>
        function drawioEditor() {
            return {
                zoom: 1.0,
                pan: { x: 0, y: 0 },
                nodes: [],
                connections: [],
                history: [],
                historyIndex: -1,
                nodeSelected: null,
                resizingNode: null,
                resizingHandle: null,
                activeLine: null,
                activeLinePath: '',
                nextId: 1,
                library: [
                    { type: 'rect', label: 'Proses', w: 120, h: 60, iconHtml: '<rect x="5" y="5" width="90" height="90" fill="none" stroke="currentColor" stroke-width="6"/>' },
                    { type: 'rounded', label: 'Start/End', w: 120, h: 60, iconHtml: '<rect x="5" y="20" width="90" height="60" rx="30" fill="none" stroke="currentColor" stroke-width="6"/>' },
                    { type: 'diamond', label: 'Kondisi', w: 80, h: 80, iconHtml: '<path d="M50 5 L95 50 L50 95 L5 50 Z" fill="none" stroke="currentColor" stroke-width="6"/>' },
                    { type: 'io', label: 'Input/Output', w: 120, h: 60, iconHtml: '<path d="M20 5 L95 5 L80 95 L5 95 Z" fill="none" stroke="currentColor" stroke-width="6"/>' },
                    { type: 'cylinder', label: 'Database', w: 80, h: 100, iconHtml: '<path d="M10 25 Q50 5 90 25 L90 75 Q50 95 10 75 Z M10 25 Q50 45 90 25" fill="none" stroke="currentColor" stroke-width="6"/>' },
                    { type: 'actor', label: 'Actor', w: 100, h: 120, iconHtml: '<circle cx="50" cy="20" r="15" fill="none" stroke="currentColor" stroke-width="6"/><path d="M50 35 L50 75 M20 45 L80 45 M50 75 L25 95 M50 75 L75 95" fill="none" stroke="currentColor" stroke-width="6"/>' },
                ],
                
                getSelectedNode() {
                    return this.nodes.find(n => n.id === this.nodeSelected);
                },

                getShapePath(type) {
                    const paths = {
                        'rect': 'M 0 0 L 100 0 L 100 100 L 0 100 Z',
                        'rounded': 'M 25 0 L 75 0 C 90 0 100 10 100 50 C 100 90 90 100 75 100 L 25 100 C 10 100 0 90 0 50 C 0 10 10 0 25 0 Z',
                        'diamond': 'M 50 0 L 100 50 L 50 100 L 0 50 Z',
                        'io': 'M 20 0 L 100 0 L 80 100 L 0 100 Z',
                        'cylinder': 'M 0 20 Q 50 0 100 20 L 100 80 Q 50 100 0 80 Z M 0 20 Q 50 40 100 20',
                        'actor': 'M 50 35 L 50 75 M 20 45 L 80 45 M 50 75 L 25 95 M 50 75 L 75 95'
                    };
                    return paths[type] || paths['rect'];
                },

                startResize(id, handle) {
                    this.resizingNode = id;
                    this.resizingHandle = handle;
                },
                
                init() {
                    this.pushHistory();
                },

                pushHistory() {
                    const state = JSON.stringify({ nodes: this.nodes, connections: this.connections });
                    if (this.historyIndex < this.history.length - 1) {
                        this.history = this.history.slice(0, this.historyIndex + 1);
                    }
                    this.history.push(state);
                    this.historyIndex++;
                    if (this.history.length > 50) {
                        this.history.shift();
                        this.historyIndex--;
                    }
                },

                undo() {
                    if (this.historyIndex > 0) {
                        this.historyIndex--;
                        const state = JSON.parse(this.history[this.historyIndex]);
                        this.nodes = state.nodes;
                        this.connections = state.connections;
                        this.$nextTick(() => {
                            this.nodes.forEach(n => this.makeDraggable(n.id));
                            this.rebuildConnections();
                        });
                    }
                },

                redo() {
                    if (this.historyIndex < this.history.length - 1) {
                        this.historyIndex++;
                        const state = JSON.parse(this.history[this.historyIndex]);
                        this.nodes = state.nodes;
                        this.connections = state.connections;
                        this.$nextTick(() => {
                            this.nodes.forEach(n => this.makeDraggable(n.id));
                            this.rebuildConnections();
                        });
                    }
                },

                onDragStart(event, item) {
                    const rect = event.currentTarget.getBoundingClientRect();
                    const payload = {
                        type: item.type,
                        w: item.w,
                        h: item.h,
                        label: item.label,
                        dragOffsetX: event.clientX - rect.left,
                        dragOffsetY: event.clientY - rect.top
                    };
                    event.dataTransfer.setData('text/plain', JSON.stringify(payload));
                    event.dataTransfer.effectAllowed = 'copy';
                },

                onDrop(event) {
                    const canvas = document.getElementById('drawio-viewport');
                    const rect = canvas.getBoundingClientRect();
                    
                    let data;
                    try {
                        const rawData = event.dataTransfer.getData('text/plain');
                        data = JSON.parse(rawData);
                    } catch (e) { return; }

                    if (!data || !data.type) return;

                    const dragOffsetX = data.dragOffsetX || 0;
                    const dragOffsetY = data.dragOffsetY || 0;

                    const x = (event.clientX - rect.left) / this.zoom - this.pan.x - dragOffsetX; 
                    const y = (event.clientY - rect.top) / this.zoom - this.pan.y - dragOffsetY;

                    const newNode = {
                        id: `node-${this.nextId++}`,
                        type: data.type,
                        width: data.w || 120,
                        height: data.h || 60,
                        x: Math.round(x / 10) * 10,
                        y: Math.round(y / 10) * 10,
                        text: data.label.toUpperCase(),
                        fill: '#1e1e1e'
                    };

                    this.nodes.push(newNode);
                    this.pushHistory();
                    
                    this.$nextTick(() => {
                        this.makeDraggable(newNode.id);
                        this.rebuildConnections();
                    });
                },

                startLine(nodeId, port) {
                    this.activeLine = { fromNode: nodeId, fromPort: port };
                },

                onCanvasMouseMove(e) {
                    const viewport = document.getElementById('drawio-viewport').getBoundingClientRect();
                    const targetX = (e.clientX - viewport.left) / this.zoom - this.pan.x;
                    const targetY = (e.clientY - viewport.top) / this.zoom - this.pan.y;

                    if (this.resizingNode) {
                        const node = this.nodes.find(n => n.id === this.resizingNode);
                        if (node) {
                            const h = this.resizingHandle;
                            if (h.includes('r')) node.width = Math.max(40, targetX - node.x);
                            if (h.includes('b')) node.height = Math.max(40, targetY - node.y);
                            if (h.includes('l')) {
                                const newW = node.width + (node.x - targetX);
                                if (newW > 40) { node.width = newW; node.x = targetX; }
                            }
                            if (h.includes('t')) {
                                const newH = node.height + (node.y - targetY);
                                if (newH > 40) { node.height = newH; node.y = targetY; }
                            }
                            this.rebuildConnections();
                        }
                    } else if (this.activeLine) {
                        const start = this.getPortCoords(this.activeLine.fromNode, this.activeLine.fromPort);
                        this.activeLinePath = `M ${start.x} ${start.y} L ${targetX} ${targetY}`;
                    }
                },

                onCanvasMouseUp(e) {
                    if (this.resizingNode) {
                        this.resizingNode = null;
                        this.resizingHandle = null;
                        this.pushHistory();
                    }
                    if (this.activeLine) {
                        const viewport = document.getElementById('drawio-viewport').getBoundingClientRect();
                        const dropX = (e.clientX - viewport.left) / this.zoom - this.pan.x;
                        const dropY = (e.clientY - viewport.top) / this.zoom - this.pan.y;

                        let toNode = null;
                        // Manual Hit Detection: Check every node's bounding box in canvas space
                        // We iterate in reverse to hit the topmost node if they overlap
                        for (let i = this.nodes.length - 1; i >= 0; i--) {
                            const n = this.nodes[i];
                            const padding = 10; // Extra hit area for easier connecting
                            if (dropX >= (n.x - padding) && dropX <= (n.x + n.width + padding) &&
                                dropY >= (n.y - padding) && dropY <= (n.y + n.height + padding)) {
                                if (n.id !== this.activeLine.fromNode) {
                                    toNode = n;
                                    break;
                                }
                            }
                        }

                        if (toNode) {
                            // Find nearest port on the target node
                            const ports = ['top', 'bottom', 'left', 'right'];
                            let minDist = Infinity;
                            let toPort = 'top';
                            ports.forEach(p => {
                                const coords = this.getPortCoords(toNode.id, p);
                                const dist = Math.sqrt(Math.pow(dropX - coords.x, 2) + Math.pow(dropY - coords.y, 2));
                                if (dist < minDist) {
                                    minDist = dist;
                                    toPort = p;
                                }
                            });

                            // Avoid duplicate connections
                            const exists = this.connections.some(c => 
                                c.from === this.activeLine.fromNode && 
                                c.fromPort === this.activeLine.fromPort && 
                                c.to === toNode.id && 
                                c.toPort === toPort
                            );
                            
                            if (!exists) {
                                this.connections.push({
                                    from: this.activeLine.fromNode,
                                    fromPort: this.activeLine.fromPort,
                                    to: toNode.id,
                                    toPort: toPort
                                });
                                this.pushHistory();
                                this.rebuildConnections();
                            }
                        }
                        this.activeLine = null;
                    }
                },

                rebuildConnections() {
                    this.connections.forEach(conn => {
                        const start = this.getPortCoords(conn.from, conn.fromPort);
                        const end = this.getPortCoords(conn.to, conn.toPort);
                        
                        // Vertical/Horizontal Straight-Line Routing (Orthogonal)
                        // If they are somewhat aligned, make it a single L or 3 segment Z-shape
                        const midY = (start.y + end.y) / 2;
                        const midX = (start.x + end.x) / 2;

                        if (conn.fromPort === 'bottom' && conn.toPort === 'top') {
                            // Vertical Step
                            conn.path = `M ${start.x} ${start.y} L ${start.x} ${midY} L ${end.x} ${midY} L ${end.x} ${end.y}`;
                        } else if (conn.fromPort === 'right' && conn.toPort === 'left') {
                            // Horizontal Step
                            conn.path = `M ${start.x} ${start.y} L ${midX} ${start.y} L ${midX} ${end.y} L ${end.x} ${end.y}`;
                        } else {
                            // Default Fallback: Simple straight line with one corner
                            if (Math.abs(start.x - end.x) > Math.abs(start.y - end.y)) {
                                conn.path = `M ${start.x} ${start.y} L ${end.x} ${start.y} L ${end.x} ${end.y}`;
                            } else {
                                conn.path = `M ${start.x} ${start.y} L ${start.x} ${end.y} L ${end.x} ${end.y}`;
                            }
                        }
                    });
                },

                getPortCoords(nodeId, port) {
                    const node = this.nodes.find(n => n.id === nodeId);
                    if (!node) return { x: 0, y: 0 };
                    
                    const width = node.width || 120;
                    const height = node.height || 60;

                    let x = node.x + width / 2;
                    let y = node.y + height / 2;

                    if (port === 'top') { y = node.y; }
                    if (port === 'bottom') { y = node.y + height; }
                    if (port === 'left') { x = node.x; }
                    if (port === 'right') { x = node.x + width; }

                    return { x: Math.round(x), y: Math.round(y) };
                },

                makeDraggable(id) {
                    const el = document.getElementById(id);
                    interact(el).draggable({
                        listeners: {
                            move: (event) => {
                                const index = this.nodes.findIndex(n => n.id === id);
                                if (index === -1) return;
                                this.nodes[index].x += event.dx / this.zoom;
                                this.nodes[index].y += event.dy / this.zoom;
                                this.rebuildConnections();
                            },
                            end: (event) => {
                                const index = this.nodes.findIndex(n => n.id === id);
                                if (index === -1) return;
                                this.nodes[index].x = Math.round(this.nodes[index].x / 20) * 20;
                                this.nodes[index].y = Math.round(this.nodes[index].y / 20) * 20;
                                this.rebuildConnections();
                            }
                        }
                    });
                },

                onCanvasBgDown(e) { this.nodeSelected = null; },
                zoomIn() { this.zoom = Math.min(2.0, this.zoom + 0.1); this.rebuildConnections(); },
                zoomOut() { this.zoom = Math.max(0.5, this.zoom - 0.1); this.rebuildConnections(); },
                clearCanvas() { if(confirm('Bersihkan seluruh diagram?')) { this.nodes = []; this.connections = []; this.pushHistory(); } },
                deleteNode(id) {
                    this.nodes = this.nodes.filter(n => n.id !== id);
                    this.connections = this.connections.filter(c => c.from !== id && c.to !== id);
                    this.pushHistory();
                    this.rebuildConnections();
                },
                deleteSelected() {
                    if (this.nodeSelected) {
                        this.deleteNode(this.nodeSelected);
                        this.nodeSelected = null;
                    }
                }
            }
        }
    </script>

    <style>
        .no-scrollbar::-webkit-scrollbar { width: 0; }
        
        .node-port {
            position: absolute;
            width: 32px;
            height: 32px;
            background: transparent;
            z-index: 5;
            cursor: crosshair;
            border-radius: 4px;
            transition: background 0.2s ease;
        }

        .node-port.t { top: -16px; left: 50%; transform: translateX(-50%); width: 80%; }
        .node-port.b { bottom: -16px; left: 50%; transform: translateX(-50%); width: 80%; }
        .node-port.l { left: -16px; top: 50%; transform: translateY(-50%); height: 80%; }
        .node-port.r { right: -16px; top: 50%; transform: translateY(-50%); height: 80%; }

        /* Highlight ports when activeLine is active */
        .active-drawing .node-port { 
             background: rgba(99, 102, 241, 0.2);
             border: 2px solid rgba(99, 102, 241, 0.6);
             box-shadow: 0 0 10px rgba(99, 102, 241, 0.3);
        }

        /* Smart Drop Feedback */
        .active-drawing div[id^="node-"]:hover svg path:first-child {
            stroke: #818cf8 !important;
            stroke-width: 4 !important;
        }

        /* Quick Connect Arrows */
        .node-arrow {
            position: absolute;
            width: 20px;
            height: 20px;
            color: #818cf8;
            opacity: 0;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            z-index: 15;
            padding: 4px;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 4px;
        }

        .group:hover .node-arrow { opacity: 0.6; }
        .node-arrow:hover { opacity: 1 !important; transform: scale(1.2) !important; color: white; background: #818cf8; }

        .node-arrow.t { top: -30px; left: 50%; transform: translateX(-50%); }
        .node-arrow.b { bottom: -30px; left: 50%; transform: translateX(-50%); }
        .node-arrow.l { left: -30px; top: 50%; transform: translateY(-50%); }
        .node-arrow.r { right: -30px; top: 50%; transform: translateY(-50%); }

        textarea { transform-origin: center; }

        .drawio-viewport {
            touch-action: none;
            user-select: none;
        }

        /* Resize Handles */
        .resize-handle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: #ffffff;
            border: 1.5px solid #818cf8;
            border-radius: 1px;
            z-index: 25;
            transition: all 0.1s ease;
        }
        .resize-handle:hover {
            background: #818cf8;
            transform: scale(1.4);
        }

        .resize-handle.tl { top: -4px; left: -4px; cursor: nwse-resize; }
        .resize-handle.tr { top: -4px; right: -4px; cursor: nesw-resize; }
        .resize-handle.bl { bottom: -4px; left: -4px; cursor: nesw-resize; }
        .resize-handle.br { bottom: -4px; right: -4px; cursor: nwse-resize; }
        .resize-handle.mt { top: -4px; left: 50%; transform: translateX(-50%); cursor: ns-resize; }
        .resize-handle.mb { bottom: -4px; left: 50%; transform: translateX(-50%); cursor: ns-resize; }
        .resize-handle.ml { left: -4px; top: 50%; transform: translateY(-50%); cursor: ew-resize; }
        .resize-handle.mr { right: -4px; top: 50%; transform: translateY(-50%); cursor: ew-resize; }

        [x-cloak] { display: none !important; }
    </style>
</x-layouts.murid>
