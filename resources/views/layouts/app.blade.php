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
<body class="font-lora min-h-screen flex flex-col" x-data="{
    playHover() { window.sfx.playHover(); },
    playSword() { window.sfx.playSword(); },
    playMagic() { window.sfx.playMagic(); },
    playPage() { window.sfx.playPage(); },
    playExplosion() { window.sfx.playExplosion(); }
}">

    <nav class="glass-parchment py-4 sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="/" class="text-2xl font-cinzel font-bold text-parchment-900 flex items-center hover:text-parchment-800 transition" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-dragon mr-2 text-blood-700"></i>
                    Creator RPG
                </a>
            </div>
            <div class="flex space-x-6 font-cinzel font-bold">
                <a href="{{ route('classes.index') }}" class="text-parchment-900 hover:text-blood-700 transition flex items-center" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-khanda mr-2"></i> Classes
                </a>
                <a href="{{ route('racas.index') }}" class="text-parchment-900 hover:text-blood-700 transition flex items-center" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-users mr-2"></i> Raças
                </a>
                <a href="{{ route('pericias.index') }}" class="text-parchment-900 hover:text-blood-700 transition flex items-center" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-book-journal-whills mr-2"></i> Perícias
                </a>
                <a href="{{ route('talentos.index') }}" class="text-parchment-900 hover:text-blood-700 transition flex items-center" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-scroll mr-2"></i> Talentos
                </a>
                <a href="{{ route('divindades.index') }}" class="text-parchment-900 hover:text-blood-700 transition flex items-center" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-sun mr-2"></i> Divindades
                </a>
                <a href="{{ route('tendencias.index') }}" class="text-parchment-900 hover:text-blood-700 transition flex items-center" @mouseenter="playHover()" @click="playPage()">
                    <i class="fa-solid fa-compass mr-2"></i> Tendências
                </a>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
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

    <footer class="glass-parchment py-6 mt-12">
        <div class="container mx-auto px-4 text-center text-parchment-800 font-cinzel">
            <p>&copy; {{ date('Y') }} Creator RPG - Forged in the fires of imagination.</p>
        </div>
    </footer>
</body>
</html>
