<script setup>
import { ref, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const mobileMenu = ref(false);
const { props } = usePage();

const sfx = {
    sounds: {
        hover: new Audio('/audio/hover.mp3'),
        page: new Audio('/audio/page.mp3'),
        sword: new Audio('/audio/sword.mp3'),
        magic: new Audio('/audio/magic.mp3'),
        explosion: new Audio('/audio/explosion.mp3')
    },
    play(sound) {
        if (this.sounds[sound]) {
            this.sounds[sound].currentTime = 0;
            this.sounds[sound].volume = sound === 'hover' ? 0.15 : 0.4;
            this.sounds[sound].play().catch(e => {});
        }
    }
};

onMounted(() => {
    Object.values(sfx.sounds).forEach(audio => audio.load());
});

const navItems = [
    { name: 'Salão dos Heróis', route: 'fichas.index', icon: 'fa-scroll-torah', color: 'text-blood-700', group: 'Essenciais' },
    { name: 'Classes', route: 'classes.index', icon: 'fa-khanda', color: 'text-blood-700', group: 'Criação' },
    { name: 'Raças', route: 'racas.index', icon: 'fa-users', color: 'text-blood-700', group: 'Criação' },
    { name: 'Perícias', route: 'pericias.index', icon: 'fa-book-journal-whills', color: 'text-blood-700', group: 'Criação' },
    { name: 'Talentos', route: 'talentos.index', icon: 'fa-scroll', color: 'text-blood-700', group: 'Criação' },
    { name: 'Divindades', route: 'divindades.index', icon: 'fa-sun', color: 'text-blood-700', group: 'Criação' },
    { name: 'Tendências', route: 'tendencias.index', icon: 'fa-compass', color: 'text-blood-700', group: 'Criação' },
    { name: 'Magias', route: 'magias.index', icon: 'fa-wand-sparkles', color: 'text-magic-600', group: 'Equipamento & Grimório' },
    { name: 'Armas', route: 'armas.index', icon: 'fa-sword', color: 'text-blood-700', group: 'Equipamento & Grimório' },
    { name: 'Armaduras', route: 'armaduras.index', icon: 'fa-shield-halved', color: 'text-blood-700', group: 'Equipamento & Grimório' },
    { name: 'Itens', route: 'equipamentos.index', icon: 'fa-sack-xmark', color: 'text-blood-700', group: 'Equipamento & Grimório' },
];

const groupedNav = navItems.reduce((acc, item) => {
    if (!acc[item.group]) acc[item.group] = [];
    acc[item.group].push(item);
    return acc;
}, {});

</script>

<template>
    <div class="flex flex-col md:flex-row min-h-screen bg-parchment-100 bg-parchment-pattern selection:bg-blood-700/20">
        <!-- Mobile Menu Toggle -->
        <div class="md:hidden glass-parchment p-4 sticky top-0 z-50 flex justify-between items-center shadow-lg border-b border-parchment-400">
            <Link href="/" class="text-xl font-cinzel font-bold text-parchment-900 flex items-center">
                <i class="fa-solid fa-dragon mr-2 text-blood-700"></i>
                Creator RPG
            </Link>
            <button @click="mobileMenu = !mobileMenu" class="text-parchment-900 text-2xl w-10 h-10 flex items-center justify-center rounded-full hover:bg-parchment-200 transition">
                <i class="fa-solid" :class="mobileMenu ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <aside class="w-full md:w-72 glass-parchment md:h-screen md:sticky md:top-0 z-40 overflow-y-auto border-r border-parchment-400 flex flex-col transition-all duration-300 shadow-2xl"
            :class="mobileMenu ? 'block' : 'hidden md:flex'">
            
            <div class="p-8 border-b border-parchment-300 hidden md:block bg-parchment-200/30">
                <Link href="/" class="text-2xl font-cinzel font-bold text-parchment-900 flex flex-col items-center hover:scale-105 transition-transform" @mouseenter="sfx.play('hover')" @click="sfx.play('page')">
                    <i class="fa-solid fa-dragon text-4xl text-blood-700 mb-2"></i>
                    <span class="tracking-widest">CREATOR RPG</span>
                </Link>
            </div>

            <nav class="flex-grow p-4 space-y-1 font-cinzel font-bold">
                <div v-for="(items, group) in groupedNav" :key="group" class="mb-6">
                    <p class="text-[9px] uppercase text-parchment-800 tracking-[0.2em] mb-3 px-3 flex items-center opacity-70">
                        <span class="flex-grow h-[1px] bg-parchment-400 mr-2"></span>
                        {{ group }}
                        <span class="flex-grow h-[1px] bg-parchment-400 ml-2"></span>
                    </p>
                    <Link v-for="item in items" :key="item.name" :href="route(item.route)" 
                        class="group flex items-center p-3 rounded-lg hover:bg-parchment-300/50 text-parchment-900 transition-all border-l-4 border-transparent hover:border-blood-700 mb-1" 
                        :class="{ 'bg-parchment-300/60 border-blood-700': $page.url.startsWith('/' + item.route.split('.')[0]) }"
                        @mouseenter="sfx.play('hover')" @click="sfx.play('page')">
                        <i :class="['fa-solid', item.icon, item.color, 'w-8 text-lg group-hover:scale-120 transition']"></i> 
                        <span class="text-sm tracking-wide">{{ item.name }}</span>
                    </Link>
                </div>
            </nav>

            <div class="p-6 border-t border-parchment-300 mt-auto bg-parchment-200/30">
                <p class="text-[10px] text-parchment-800 font-cinzel text-center tracking-widest opacity-60 uppercase">&copy; 2026 RPG Forger</p>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow flex flex-col min-h-screen overflow-x-hidden relative">
            <div class="flex-grow p-6 md:p-10 lg:p-16 max-w-7xl mx-auto w-full">
                <div v-if="$page.props.flash.success" class="bg-parchment-100 border-l-4 border-green-600 text-green-800 p-4 rounded shadow-md mb-8 font-lora animate-bounce">
                    <div class="flex items-center">
                        <i class="fa-solid fa-circle-check mr-3 text-xl"></i>
                        <div>
                            <strong class="font-bold">Vitória! </strong>
                            <span class="block sm:inline">{{ $page.props.flash.success }}</span>
                        </div>
                    </div>
                </div>

                <slot />
            </div>

            <footer class="py-10 border-t border-parchment-400/30 mt-auto">
                <div class="container mx-auto px-4 text-center text-parchment-800 font-cinzel text-[10px] tracking-[0.3em] opacity-40 uppercase">
                    <p>Forged in the fires of imagination. Creator RPG &copy; 2026</p>
                </div>
            </footer>
        </main>
    </div>
</template>

<style scoped>
.glass-parchment {
    background: rgba(253, 246, 227, 0.85);
    backdrop-filter: blur(4px);
}
.bg-parchment-pattern {
    background-image: url('https://www.transparenttextures.com/patterns/aged-paper.png');
}
</style>
