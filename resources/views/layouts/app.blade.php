<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creator RPG - @yield('title', 'Classes')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lora:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS (CDN for rapid prototyping as requested) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'cinzel': ['Cinzel', 'serif'],
                        'lora': ['Lora', 'serif'],
                    },
                    colors: {
                        parchment: {
                            100: '#fdf6e3',
                            200: '#f4e8c1',
                            300: '#e8d5a5',
                            400: '#d1b882',
                            800: '#5a4624',
                            900: '#3d2b14',
                        },
                        magic: {
                            500: '#8b5cf6', // purple magic
                            600: '#7c3aed',
                        },
                        blood: {
                            600: '#dc2626',
                            700: '#b91c1c',
                        }
                    },
                    backgroundImage: {
                        'parchment-pattern': "url('https://www.transparenttextures.com/patterns/aged-paper.png')",
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            background-color: #f4e8c1;
            background-image: url('https://www.transparenttextures.com/patterns/aged-paper.png');
            color: #3d2b14;
        }
        
        .glass-parchment {
            background: rgba(253, 246, 227, 0.85);
            box-shadow: 0 4px 6px -1px rgba(90, 70, 36, 0.2), 0 2px 4px -1px rgba(90, 70, 36, 0.1);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(209, 184, 130, 0.5);
        }

        .btn-medieval {
            transition: all 0.2s ease-in-out;
            position: relative;
            overflow: hidden;
        }
        
        .btn-medieval:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px -2px rgba(90, 70, 36, 0.3);
        }
    </style>
    <script>
        // Gerenciador de efeitos sonoros com arquivos reais
        window.sfx = {
            sounds: {
                hover: new Audio('/audio/hover.mp3'),
                page: new Audio('/audio/page.mp3'),
                sword: new Audio('/audio/sword.mp3'),
                magic: new Audio('/audio/magic.mp3'),
                explosion: new Audio('/audio/explosion.mp3')
            },
            playHover() {
                this.sounds.hover.currentTime = 0;
                this.sounds.hover.volume = 0.15;
                this.sounds.hover.play().catch(e => {});
            },
            playPage() {
                this.sounds.page.currentTime = 0;
                this.sounds.page.volume = 0.4;
                this.sounds.page.play().catch(e => {});
            },
            playSword() {
                this.sounds.sword.currentTime = 0;
                this.sounds.sword.volume = 0.5;
                this.sounds.sword.play().catch(e => {});
            },
            playMagic() {
                this.sounds.magic.currentTime = 0;
                this.sounds.magic.volume = 0.5;
                this.sounds.magic.play().catch(e => {});
            },
            playExplosion() {
                this.sounds.explosion.currentTime = 0;
                this.sounds.explosion.volume = 0.5;
                this.sounds.explosion.play().catch(e => {});
            }
        };
        
        // Pré-carregar os sons assim que a página carregar
        document.addEventListener('DOMContentLoaded', () => {
            Object.values(window.sfx.sounds).forEach(audio => {
                audio.load();
            });
        });
    </script>
</head>
<body class="font-lora min-h-screen bg-parchment-pattern" x-data="{ 
    mobileMenu: false,
    playHover() { window.sfx.playHover(); },
    playSword() { window.sfx.playSword(); },
    playMagic() { window.sfx.playMagic(); },
    playPage() { window.sfx.playPage(); },
    playExplosion() { window.sfx.playExplosion(); }
}">

    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Botão Mobile -->
        <div class="md:hidden glass-parchment p-4 sticky top-0 z-50 flex justify-between items-center shadow-md">
            <a href="/" class="text-xl font-cinzel font-bold text-parchment-900 flex items-center">
                <i class="fa-solid fa-dragon mr-2 text-blood-700"></i>
                Creator RPG
            </a>
            <button @click="mobileMenu = !mobileMenu" class="text-parchment-900 text-2xl">
                <i class="fa-solid" :class="mobileMenu ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <aside class="w-full md:w-64 lg:w-72 glass-parchment md:h-screen md:sticky md:top-0 z-40 overflow-y-auto border-r border-parchment-400 flex flex-col transition-all duration-300"
            :class="mobileMenu ? 'block' : 'hidden md:flex'">
            
            <div class="p-6 border-b border-parchment-300 hidden md:block">
                <a href="/" class="text-2xl font-cinzel font-bold text-parchment-900 flex items-center hover:text-parchment-800 transition" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-dragon mr-2 text-blood-700"></i>
                    Creator RPG
                </a>
            </div>

            <nav class="flex-grow p-4 space-y-2 font-cinzel font-bold overflow-y-auto">
                <p class="text-[10px] uppercase text-parchment-700 tracking-widest mb-2 px-2 border-b border-parchment-300 pb-1 mt-4">Essenciais</p>
                
                <a href="{{ route('fichas.index') }}" class="group flex items-center p-3 rounded-lg hover:bg-parchment-300 text-parchment-900 transition-all border-l-4 border-transparent hover:border-blood-700" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-scroll-torah w-8 text-blood-700 group-hover:scale-110 transition"></i> 
                    <span>Salão dos Heróis</span>
                </a>

                <p class="text-[10px] uppercase text-parchment-700 tracking-widest mb-2 px-2 border-b border-parchment-300 pb-1 mt-6">Criação</p>

                <a href="{{ route('classes.index') }}" class="group flex items-center p-3 rounded-lg hover:bg-parchment-300 text-parchment-900 transition-all border-l-4 border-transparent hover:border-blood-700" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-khanda w-8 text-blood-700 group-hover:scale-110 transition"></i> 
                    <span>Classes</span>
                </a>
                <a href="{{ route('racas.index') }}" class="group flex items-center p-3 rounded-lg hover:bg-parchment-300 text-parchment-900 transition-all border-l-4 border-transparent hover:border-blood-700" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-users w-8 text-blood-700 group-hover:scale-110 transition"></i> 
                    <span>Raças</span>
                </a>
                <a href="{{ route('pericias.index') }}" class="group flex items-center p-3 rounded-lg hover:bg-parchment-300 text-parchment-900 transition-all border-l-4 border-transparent hover:border-blood-700" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-book-journal-whills w-8 text-blood-700 group-hover:scale-110 transition"></i> 
                    <span>Perícias</span>
                </a>
                <a href="{{ route('talentos.index') }}" class="group flex items-center p-3 rounded-lg hover:bg-parchment-300 text-parchment-900 transition-all border-l-4 border-transparent hover:border-blood-700" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-scroll w-8 text-blood-700 group-hover:scale-110 transition"></i> 
                    <span>Talentos</span>
                </a>
                <a href="{{ route('divindades.index') }}" class="group flex items-center p-3 rounded-lg hover:bg-parchment-300 text-parchment-900 transition-all border-l-4 border-transparent hover:border-blood-700" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-sun w-8 text-blood-700 group-hover:scale-110 transition"></i> 
                    <span>Divindades</span>
                </a>
                <a href="{{ route('tendencias.index') }}" class="group flex items-center p-3 rounded-lg hover:bg-parchment-300 text-parchment-900 transition-all border-l-4 border-transparent hover:border-blood-700" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-compass w-8 text-blood-700 group-hover:scale-110 transition"></i> 
                    <span>Tendências</span>
                </a>

                <p class="text-[10px] uppercase text-parchment-700 tracking-widest mb-2 px-2 border-b border-parchment-300 pb-1 mt-6">Equipamento & Grimório</p>

                <a href="{{ route('magias.index') }}" class="group flex items-center p-3 rounded-lg hover:bg-parchment-300 text-parchment-900 transition-all border-l-4 border-transparent hover:border-magic-600" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-wand-sparkles w-8 text-magic-600 group-hover:scale-110 transition"></i> 
                    <span>Magias</span>
                </a>
                <a href="{{ route('armas.index') }}" class="group flex items-center p-3 rounded-lg hover:bg-parchment-300 text-parchment-900 transition-all border-l-4 border-transparent hover:border-blood-700" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-sword w-8 text-blood-700 group-hover:scale-110 transition"></i> 
                    <span>Armas</span>
                </a>
                <a href="{{ route('armaduras.index') }}" class="group flex items-center p-3 rounded-lg hover:bg-parchment-300 text-parchment-900 transition-all border-l-4 border-transparent hover:border-blood-700" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-shield-halved w-8 text-blood-700 group-hover:scale-110 transition"></i> 
                    <span>Armaduras</span>
                </a>
                <a href="{{ route('equipamentos.index') }}" class="group flex items-center p-3 rounded-lg hover:bg-parchment-300 text-parchment-900 transition-all border-l-4 border-transparent hover:border-blood-700" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-sack-xmark w-8 text-blood-700 group-hover:scale-110 transition"></i> 
                    <span>Itens</span>
                </a>
            </nav>

            <div class="p-4 border-t border-parchment-300 mt-auto">
                <p class="text-xs text-parchment-800 font-cinzel text-center">&copy; {{ date('Y') }} RPG Forger</p>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-grow flex flex-col min-h-screen overflow-x-hidden">
            <main class="flex-grow p-4 md:p-8 lg:p-12">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 font-lora" role="alert" x-data="{ show: true }" x-show="show" x-transition.opacity>
                        <strong class="font-bold">Vitória!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="glass-parchment py-6 border-t border-parchment-400">
                <div class="container mx-auto px-4 text-center text-parchment-800 font-cinzel text-xs">
                    <p>Forged in the fires of imagination. Creator RPG &copy; {{ date('Y') }}</p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
