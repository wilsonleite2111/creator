<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    classes: Array
});
</script>

<template>
    <Head title="Classes de Prestígio" />

    <AppLayout>
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 mb-2 uppercase tracking-widest">
                Classes de Prestígio
            </h1>
            <p class="font-lora italic text-parchment-800 opacity-75">
                "O caminho de cada herói é forjado por suas escolhas e treinamento."
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-for="classe in classes" :key="classe.id" 
                class="glass-parchment rounded-xl shadow-xl overflow-hidden group hover:scale-105 transition-all duration-300 border border-parchment-400">
                
                <div class="p-6 bg-parchment-300/30 border-b border-parchment-400 flex justify-between items-center">
                    <h2 class="text-xl font-cinzel font-bold text-parchment-900 uppercase tracking-wide group-hover:text-blood-700 transition">
                        {{ classe.nome }}
                    </h2>
                    <span class="bg-blood-700 text-parchment-100 px-3 py-1 rounded-full text-xs font-bold font-cinzel shadow-inner">
                        D{{ classe.dado_vida }}
                    </span>
                </div>

                <div class="p-6 space-y-4">
                    <p class="text-sm font-lora text-parchment-800 line-clamp-3 leading-relaxed italic">
                        {{ classe.descricao || 'Sem descrição disponível nos tomos antigos.' }}
                    </p>

                    <div class="grid grid-cols-2 gap-2 text-[10px] font-cinzel font-bold uppercase tracking-tighter">
                        <div class="flex items-center space-x-2 bg-parchment-200/50 p-2 rounded border border-parchment-300">
                            <i class="fa-solid fa-sword text-blood-700"></i>
                            <span>BBA: {{ classe.bba_progressao }}</span>
                        </div>
                        <div class="flex items-center space-x-2 bg-parchment-200/50 p-2 rounded border border-parchment-300">
                            <i class="fa-solid fa-brain text-magic-600"></i>
                            <span>Perícia: {{ classe.pontos_pericia }} + INT</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-parchment-400/30">
                        <Link :href="route('classes.show', classe.id)" 
                            class="text-xs font-cinzel font-bold text-blood-700 hover:text-blood-800 transition flex items-center group/link">
                            Estudar Classe
                            <i class="fa-solid fa-arrow-right ml-2 group-hover/link:translate-x-1 transition-transform"></i>
                        </Link>
                        <Link :href="route('classes.edit', classe.id)" class="text-parchment-800 opacity-40 hover:opacity-100 transition">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Botão de Criar Nova Classe -->
            <Link :href="route('classes.create')" 
                class="border-4 border-dashed border-parchment-400 rounded-xl flex flex-col items-center justify-center p-12 text-parchment-800 hover:bg-parchment-300/30 hover:border-blood-700 hover:text-blood-700 transition group min-h-[300px]">
                <i class="fa-solid fa-plus-circle text-5xl mb-4 group-hover:rotate-90 transition-transform duration-500"></i>
                <span class="font-cinzel font-bold uppercase tracking-widest">Registrar Nova Classe</span>
            </Link>
        </div>
    </AppLayout>
</template>
