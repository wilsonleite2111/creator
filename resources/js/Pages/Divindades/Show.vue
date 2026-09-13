<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ divindade: Object });

const escapeHtml = (str) => str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');

const descricaoFormatada = computed(() => escapeHtml(props.divindade.descricao || 'Divindade sem crônicas registradas.')
    .replace(/\*\*(.+?)\*\*/g, '<strong class="font-cinzel text-parchment-900">$1</strong>')
    .replace(/\n/g, '<br>'));

const dominios = computed(() => {
    if (!props.divindade.dominios) return [];
    return props.divindade.dominios.split(',').map(d => d.trim()).filter(Boolean);
});
</script>

<template>
    <Head :title="'Divindade: ' + divindade.nome" />

    <AppLayout>
        <div class="max-w-4xl mx-auto">
            <div class="mb-6 flex justify-between items-center">
                <Link :href="route('divindades.index')" class="text-parchment-800 font-cinzel hover:text-blood-700 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Voltar ao Panteão
                </Link>
                <Link :href="route('divindades.edit', divindade.id)" class="bg-blood-700 text-parchment-100 px-6 py-2 rounded font-cinzel shadow-md hover:bg-blood-800 transition">
                    <i class="fa-solid fa-pen-nib mr-2"></i> Editar Divindade
                </Link>
            </div>

            <div class="glass-parchment rounded-xl shadow-2xl border border-parchment-400 overflow-hidden">
                <div class="p-8 bg-parchment-300/30 border-b border-parchment-400">
                    <div class="flex justify-between items-start gap-6">
                        <div>
                            <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-blood-700 opacity-80 mb-1">Panteão dos Céus</p>
                            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest">{{ divindade.nome }}</h1>
                            <p v-if="divindade.titulo" class="font-lora italic text-parchment-800 opacity-75 mt-1">{{ divindade.titulo }}</p>
                        </div>
                        <span v-if="divindade.tendencia" class="bg-magic-600/20 border border-magic-600/40 text-magic-700 px-4 py-2 rounded font-cinzel font-bold uppercase text-xs">
                            {{ divindade.tendencia }}
                        </span>
                    </div>
                </div>

                <div class="p-8 space-y-8">
                    <section>
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-scroll mr-2 text-blood-700"></i> Descrição
                        </h2>
                        <div class="font-lora text-parchment-800 leading-relaxed space-y-2" v-html="descricaoFormatada"></div>
                    </section>

                    <section v-if="dominios.length" class="pt-4 border-t border-parchment-400/30">
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3">
                            <i class="fa-solid fa-sun mr-2 text-magic-600"></i> Domínios Divinos
                        </h2>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="dominio in dominios" :key="dominio"
                                class="bg-magic-600/20 border border-magic-600/40 text-magic-700 px-3 py-1 rounded-full text-xs font-cinzel font-bold uppercase">
                                {{ dominio }}
                            </span>
                        </div>
                    </section>

                    <section v-if="divindade.arma_preferida" class="pt-4 border-t border-parchment-400/30">
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3">
                            <i class="fa-solid fa-khanda mr-2 text-blood-700"></i> Arma Preferida
                        </h2>
                        <div class="bg-parchment-200/50 p-4 rounded-lg border border-parchment-300 flex items-center space-x-4">
                            <i class="fa-solid fa-hand-fist text-blood-700 text-2xl"></i>
                            <span class="font-lora text-lg text-parchment-900">{{ divindade.arma_preferida }}</span>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
