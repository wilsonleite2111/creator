<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ classe: Object });

const rotuloProgressao = (valor) => {
    if (!valor) return '—';
    const mapa = { boa: 'Boa', media: 'Média', ruim: 'Ruim' };
    return mapa[valor.toLowerCase()] ?? valor;
};

const rotuloResistencia = (valor) => {
    if (!valor) return '—';
    const mapa = { boa: 'Boa', ruim: 'Ruim' };
    return mapa[valor.toLowerCase()] ?? valor;
};

const iconeProgressao = (valor) => {
    switch ((valor ?? '').toLowerCase()) {
        case 'boa': return 'fa-solid fa-arrow-trend-up text-blood-700';
        case 'media': return 'fa-solid fa-equals text-parchment-800';
        case 'ruim': return 'fa-solid fa-arrow-trend-down text-parchment-600';
        default: return 'fa-solid fa-minus text-parchment-500';
    }
};

const resistencias = computed(() => [
    { nome: 'Fortitude', valor: props.classe.resistencia_fortitude, icone: 'fa-solid fa-shield-heart' },
    { nome: 'Reflexos', valor: props.classe.resistencia_reflexos, icone: 'fa-solid fa-person-running' },
    { nome: 'Vontade', valor: props.classe.resistencia_vontade, icone: 'fa-solid fa-brain' },
]);

const escapeHtml = (str) => str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');

const descricaoFormatada = computed(() => {
    const raw = props.classe.descricao || 'Sem descrição disponível nos tomos antigos.';
    return escapeHtml(raw)
        .replace(/\*\*(.+?)\*\*/g, '<strong class="font-cinzel text-parchment-900">$1</strong>')
        .replace(/\n/g, '<br>');
});
</script>

<template>
    <Head :title="'Classe: ' + classe.nome" />

    <AppLayout>
        <div class="max-w-4xl mx-auto">
            <div class="mb-6 flex justify-between items-center">
                <Link :href="route('classes.index')" class="text-parchment-800 font-cinzel hover:text-blood-700 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Voltar aos Tomos
                </Link>
                <Link :href="route('classes.edit', classe.id)" class="bg-blood-700 text-parchment-100 px-6 py-2 rounded font-cinzel shadow-md hover:bg-blood-800 transition">
                    <i class="fa-solid fa-pen-nib mr-2"></i> Editar Classe
                </Link>
            </div>

            <div class="glass-parchment rounded-xl shadow-2xl border border-parchment-400 overflow-hidden">
                <div class="p-8 bg-parchment-300/30 border-b border-parchment-400 flex justify-between items-start gap-6">
                    <div>
                        <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-blood-700 opacity-80 mb-1">Tomo da Classe</p>
                        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest">{{ classe.nome }}</h1>
                        <p v-if="classe.versao" class="font-lora italic text-parchment-800 opacity-75 mt-1">Versão {{ classe.versao }}</p>
                    </div>
                    <span class="bg-blood-700 text-parchment-100 px-5 py-3 rounded-full font-cinzel shadow-inner text-center">
                        <span class="block text-[10px] uppercase opacity-70">Dado de Vida</span>
                        <span class="block text-2xl font-bold leading-none">d{{ classe.dado_vida ?? '?' }}</span>
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
                            <i class="fa-solid fa-swords mr-2 text-blood-700"></i> Combate
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-4 bg-parchment-200/50 p-4 rounded-lg border border-parchment-300">
                                <i :class="iconeProgressao(classe.bba_progressao)" class="text-2xl"></i>
                                <div>
                                    <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-parchment-700">Bônus Base de Ataque</p>
                                    <p class="font-cinzel font-bold text-lg text-parchment-900">{{ rotuloProgressao(classe.bba_progressao) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 bg-parchment-200/50 p-4 rounded-lg border border-parchment-300">
                                <i class="fa-solid fa-brain text-magic-600 text-2xl"></i>
                                <div>
                                    <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-parchment-700">Pontos de Perícia</p>
                                    <p class="font-cinzel font-bold text-lg text-parchment-900">
                                        {{ classe.pontos_pericia ?? '—' }} + Mod. INT
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-shield-halved mr-2 text-blood-700"></i> Resistências
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div v-for="res in resistencias" :key="res.nome"
                                class="bg-parchment-200/50 p-4 rounded-lg border border-parchment-300 text-center">
                                <i :class="res.icone" class="text-2xl text-blood-700 mb-2"></i>
                                <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-parchment-700">{{ res.nome }}</p>
                                <p class="font-cinzel font-bold text-xl text-parchment-900 mt-1">{{ rotuloResistencia(res.valor) }}</p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
