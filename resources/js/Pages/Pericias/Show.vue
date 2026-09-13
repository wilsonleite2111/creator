<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ pericia: Object });

const habilidadeCompleta = computed(() => {
    const mapa = {
        FOR: 'Força',
        DES: 'Destreza',
        CON: 'Constituição',
        INT: 'Inteligência',
        SAB: 'Sabedoria',
        CAR: 'Carisma',
    };
    return mapa[props.pericia.habilidade_chave] ?? props.pericia.habilidade_chave ?? '—';
});

const escapeHtml = (str) => str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');

const descricaoFormatada = computed(() => {
    const raw = props.pericia.descricao || 'Sem descrição nos registros antigos.';
    return escapeHtml(raw)
        .replace(/\*\*(.+?)\*\*/g, '<strong class="font-cinzel text-parchment-900">$1</strong>')
        .replace(/\n/g, '<br>');
});
</script>

<template>
    <Head :title="'Perícia: ' + pericia.nome" />

    <AppLayout>
        <div class="max-w-4xl mx-auto">
            <div class="mb-6 flex justify-between items-center">
                <Link :href="route('pericias.index')" class="text-parchment-800 font-cinzel hover:text-blood-700 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Voltar ao Compêndio
                </Link>
                <Link :href="route('pericias.edit', pericia.id)" class="bg-blood-700 text-parchment-100 px-6 py-2 rounded font-cinzel shadow-md hover:bg-blood-800 transition">
                    <i class="fa-solid fa-pen-nib mr-2"></i> Editar Perícia
                </Link>
            </div>

            <div class="glass-parchment rounded-xl shadow-2xl border border-parchment-400 overflow-hidden">
                <div class="p-8 bg-parchment-300/30 border-b border-parchment-400 flex justify-between items-start gap-6">
                    <div>
                        <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-blood-700 opacity-80 mb-1">Compêndio de Perícias</p>
                        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest">{{ pericia.nome }}</h1>
                        <p v-if="pericia.versao" class="font-lora italic text-parchment-800 opacity-75 mt-1">Versão {{ pericia.versao }}</p>
                    </div>
                    <span v-if="pericia.habilidade_chave" class="bg-magic-600 text-parchment-100 px-5 py-3 rounded-full font-cinzel shadow-inner text-center">
                        <span class="block text-[10px] uppercase opacity-70">Habilidade</span>
                        <span class="block text-lg font-bold leading-none">{{ pericia.habilidade_chave }}</span>
                    </span>
                </div>

                <div class="p-8 space-y-8">
                    <section>
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-scroll mr-2 text-blood-700"></i> Descrição
                        </h2>
                        <div class="font-lora text-parchment-800 leading-relaxed space-y-2" v-html="descricaoFormatada"></div>
                    </section>

                    <section>
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-dna mr-2 text-blood-700"></i> Habilidade Chave
                        </h2>
                        <div class="bg-parchment-200/50 p-4 rounded-lg border border-parchment-300 flex items-center space-x-4">
                            <span class="bg-magic-600 text-parchment-100 px-4 py-2 rounded font-cinzel font-bold text-xl">
                                {{ pericia.habilidade_chave || '—' }}
                            </span>
                            <span class="font-lora text-parchment-900">{{ habilidadeCompleta }}</span>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
