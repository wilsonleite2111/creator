<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    racas: Array
});

const getModifierColor = (value) => {
    if (value > 0) return 'text-green-700';
    if (value < 0) return 'text-blood-700';
    return 'text-parchment-800 opacity-50';
};

const formatModifier = (value) => {
    return value > 0 ? `+${value}` : value;
};
</script>

<template>
    <Head title="Povos e Raças" />

    <AppLayout>
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 mb-2 uppercase tracking-widest">
                Povos e Raças
            </h1>
            <p class="font-lora italic text-parchment-800 opacity-75">
                "Desde as profundezas das montanhas até o topo das florestas, cada raça carrega sua própria herança."
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-for="raca in racas" :key="raca.id" 
                class="glass-parchment rounded-xl shadow-xl overflow-hidden group hover:-translate-y-2 transition-all duration-300 border border-parchment-400">
                
                <div class="p-6 bg-parchment-300/30 border-b border-parchment-400 flex justify-between items-center">
                    <h2 class="text-xl font-cinzel font-bold text-parchment-900 uppercase tracking-wide group-hover:text-blood-700 transition">
                        {{ raca.nome }}
                    </h2>
                    <span class="text-[10px] font-cinzel font-bold border border-parchment-800 px-2 py-0.5 rounded uppercase opacity-60">
                        {{ raca.tamanho }}
                    </span>
                </div>

                <div class="p-6">
                    <!-- Modificadores de Habilidade -->
                    <div class="grid grid-cols-3 gap-3 mb-6">
                        <div class="text-center p-2 bg-parchment-200/50 rounded border border-parchment-300">
                            <p class="text-[9px] font-cinzel font-bold opacity-60 uppercase">FOR</p>
                            <p :class="['text-sm font-bold font-cinzel', getModifierColor(raca.mod_forca)]">
                                {{ formatModifier(raca.mod_forca) }}
                            </p>
                        </div>
                        <div class="text-center p-2 bg-parchment-200/50 rounded border border-parchment-300">
                            <p class="text-[9px] font-cinzel font-bold opacity-60 uppercase">DES</p>
                            <p :class="['text-sm font-bold font-cinzel', getModifierColor(raca.mod_destreza)]">
                                {{ formatModifier(raca.mod_destreza) }}
                            </p>
                        </div>
                        <div class="text-center p-2 bg-parchment-200/50 rounded border border-parchment-300">
                            <p class="text-[9px] font-cinzel font-bold opacity-60 uppercase">CON</p>
                            <p :class="['text-sm font-bold font-cinzel', getModifierColor(raca.mod_constituicao)]">
                                {{ formatModifier(raca.mod_constituicao) }}
                            </p>
                        </div>
                        <div class="text-center p-2 bg-parchment-200/50 rounded border border-parchment-300">
                            <p class="text-[9px] font-cinzel font-bold opacity-60 uppercase">INT</p>
                            <p :class="['text-sm font-bold font-cinzel', getModifierColor(raca.mod_inteligencia)]">
                                {{ formatModifier(raca.mod_inteligencia) }}
                            </p>
                        </div>
                        <div class="text-center p-2 bg-parchment-200/50 rounded border border-parchment-300">
                            <p class="text-[9px] font-cinzel font-bold opacity-60 uppercase">SAB</p>
                            <p :class="['text-sm font-bold font-cinzel', getModifierColor(raca.mod_sabedoria)]">
                                {{ formatModifier(raca.mod_sabedoria) }}
                            </p>
                        </div>
                        <div class="text-center p-2 bg-parchment-200/50 rounded border border-parchment-300">
                            <p class="text-[9px] font-cinzel font-bold opacity-60 uppercase">CAR</p>
                            <p :class="['text-sm font-bold font-cinzel', getModifierColor(raca.mod_carisma)]">
                                {{ formatModifier(raca.mod_carisma) }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center text-xs font-lora italic text-parchment-800 opacity-80">
                            <i class="fa-solid fa-person-running mr-2 text-blood-700"></i>
                            Deslocamento: {{ raca.deslocamento }}m
                        </div>
                        
                        <p class="text-xs font-lora text-parchment-800 line-clamp-3 leading-relaxed">
                            {{ raca.descricao || 'Raça documentada nos antigos pergaminhos imperiais.' }}
                        </p>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-parchment-400/30 mt-4">
                        <Link :href="route('racas.show', raca.id)" 
                            class="text-xs font-cinzel font-bold text-blood-700 hover:text-blood-800 transition flex items-center group/link">
                            Detalhes Raciais
                            <i class="fa-solid fa-scroll ml-2 group-hover/link:translate-x-1 transition-transform"></i>
                        </Link>
                        <Link :href="route('racas.edit', raca.id)" class="text-parchment-800 opacity-40 hover:opacity-100 transition">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Botão de Criar Nova Raça -->
            <Link :href="route('racas.create')" 
                class="border-4 border-dashed border-parchment-400 rounded-xl flex flex-col items-center justify-center p-12 text-parchment-800 hover:bg-parchment-300/30 hover:border-blood-700 hover:text-blood-700 transition group min-h-[350px]">
                <i class="fa-solid fa-dna text-5xl mb-4 group-hover:scale-125 transition-transform duration-500"></i>
                <span class="font-cinzel font-bold uppercase tracking-widest text-center">Catalogar Nova Raça</span>
            </Link>
        </div>
    </AppLayout>
</template>
