<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    fichas: Array
});
</script>

<template>
    <Head title="Salão dos Heróis" />

    <AppLayout>
        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="text-left">
                <h1 class="text-5xl font-cinzel font-bold text-parchment-900 mb-2 uppercase tracking-tighter flex items-center">
                    <i class="fa-solid fa-shield-halved text-blood-700 mr-4"></i>
                    Salão dos Heróis
                </h1>
                <p class="font-lora italic text-parchment-800 opacity-75 text-lg">
                    "Onde as lendas são forjadas e registradas para a eternidade."
                </p>
            </div>
            
            <Link :href="route('fichas.create')" 
                class="bg-blood-700 hover:bg-blood-800 text-parchment-100 px-8 py-4 rounded-lg font-cinzel font-bold shadow-2xl transition-all hover:scale-105 active:scale-95 flex items-center group">
                <i class="fa-solid fa-feather-pointed mr-3 group-hover:rotate-12 transition-transform"></i>
                Forjar Novo Herói
            </Link>
        </div>

        <!-- Grid de Personagens -->
        <div v-if="fichas.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <div v-for="ficha in fichas" :key="ficha.id" 
                class="relative group">
                <!-- Moldura Decorativa -->
                <div class="absolute -inset-1 bg-gradient-to-r from-parchment-400 via-blood-700/20 to-parchment-400 rounded-xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                
                <div class="relative glass-parchment rounded-xl shadow-2xl overflow-hidden border border-parchment-400 flex flex-col h-full transition-transform hover:-translate-y-2">
                    <!-- Cabeçalho do Card -->
                    <div class="p-6 bg-parchment-300/40 border-b border-parchment-400">
                        <div class="flex justify-between items-start mb-2">
                            <h2 class="text-2xl font-cinzel font-bold text-parchment-900 truncate pr-4">
                                {{ ficha.nome_personagem }}
                            </h2>
                            <div class="bg-blood-700 text-parchment-100 w-10 h-10 rounded-full flex items-center justify-center font-cinzel font-bold shadow-lg border-2 border-parchment-300">
                                {{ ficha.nivel }}
                            </div>
                        </div>
                        <p class="text-xs font-cinzel font-bold text-parchment-800 opacity-60 uppercase tracking-widest">
                            {{ ficha.raca?.nome }} • {{ ficha.classe?.nome }}
                        </p>
                    </div>

                    <!-- Conteúdo Rápido -->
                    <div class="p-6 flex-grow space-y-4">
                        <div class="grid grid-cols-3 gap-2">
                            <div class="text-center p-2 bg-parchment-200/50 rounded border border-parchment-300">
                                <p class="text-[9px] font-cinzel font-bold opacity-50">PV</p>
                                <p class="text-sm font-bold text-blood-700">{{ ficha.pv_max }}</p>
                            </div>
                            <div class="text-center p-2 bg-parchment-200/50 rounded border border-parchment-300">
                                <p class="text-[9px] font-cinzel font-bold opacity-50">CA</p>
                                <p class="text-sm font-bold text-parchment-900">{{ 10 + ficha.ca_natural + ficha.ca_armadura }}</p>
                            </div>
                            <div class="text-center p-2 bg-parchment-200/50 rounded border border-parchment-300">
                                <p class="text-[9px] font-cinzel font-bold opacity-50">INIT</p>
                                <p class="text-sm font-bold text-magic-600">+{{ ficha.iniciativa_misc }}</p>
                            </div>
                        </div>

                        <div class="pt-4 flex justify-between items-center">
                            <Link :href="route('fichas.show', ficha.id)" 
                                class="bg-parchment-900 text-parchment-100 px-4 py-2 rounded font-cinzel text-xs font-bold hover:bg-black transition flex items-center group/btn">
                                Abrir Ficha
                                <i class="fa-solid fa-scroll ml-2 group-hover/btn:rotate-12 transition-transform"></i>
                            </Link>
                            
                            <div class="flex space-x-2">
                                <Link :href="route('fichas.edit', ficha.id)" class="p-2 text-parchment-800 hover:text-blood-700 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </Link>
                                <button class="p-2 text-parchment-800 hover:text-blood-900 transition">
                                    <i class="fa-solid fa-skull-crossbones"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estado Vazio -->
        <div v-else class="glass-parchment rounded-2xl p-20 text-center border-2 border-dashed border-parchment-400">
            <i class="fa-solid fa-ghost text-7xl text-parchment-400 mb-6 block"></i>
            <h3 class="text-2xl font-cinzel font-bold text-parchment-800 mb-2">O Salão está Silencioso</h3>
            <p class="font-lora italic text-parchment-700 mb-8 max-w-md mx-auto">
                Ainda não há heróis cujas façanhas mereçam ser registradas nestas crônicas. Comece a sua jornada agora.
            </p>
            <Link :href="route('fichas.create')" 
                class="inline-block bg-blood-700 text-parchment-100 px-10 py-4 rounded-lg font-cinzel font-bold shadow-xl hover:bg-blood-800 transition transform hover:scale-110">
                Iniciar Crônica
            </Link>
        </div>
    </AppLayout>
</template>
