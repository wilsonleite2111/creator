<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ magia: Object });

const nivelClasses = computed(() =>
    [...(props.magia.classes ?? [])].sort((a, b) => {
        const na = a.pivot?.nivel ?? 0;
        const nb = b.pivot?.nivel ?? 0;
        if (na !== nb) return na - nb;
        return a.nome.localeCompare(b.nome);
    })
);

const menorNivel = computed(() => {
    if (!nivelClasses.value.length) return null;
    return nivelClasses.value[0].pivot?.nivel ?? null;
});

const nomeCirculo = (n) => (n === 0 ? 'Truque / Oração' : `${n}º Círculo`);

const atributos = computed(() => [
    { label: 'Escola', valor: props.magia.escola, icone: 'fa-solid fa-hat-wizard' },
    { label: 'Componentes', valor: props.magia.componentes, icone: 'fa-solid fa-mortar-pestle' },
    { label: 'Tempo de Execução', valor: props.magia.tempo_execucao, icone: 'fa-solid fa-hourglass-half' },
    { label: 'Alcance', valor: props.magia.alcance, icone: 'fa-solid fa-arrows-left-right' },
    { label: 'Alvo/Área/Efeito', valor: props.magia.alvo_area_efeito, icone: 'fa-solid fa-crosshairs' },
    { label: 'Duração', valor: props.magia.duracao, icone: 'fa-solid fa-clock' },
    { label: 'Teste de Resistência', valor: props.magia.teste_resistencia, icone: 'fa-solid fa-shield-halved' },
    { label: 'Resistência à Magia', valor: props.magia.resistencia_magia, icone: 'fa-solid fa-bolt' },
]);
</script>

<template>
    <Head :title="'Magia: ' + magia.nome" />

    <AppLayout>
        <div class="max-w-4xl mx-auto">
            <div class="mb-6 flex justify-between items-center">
                <Link :href="route('magias.index')" class="text-parchment-800 font-cinzel hover:text-magic-700 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Voltar ao Grimório
                </Link>
                <Link :href="route('magias.edit', magia.id)" class="bg-magic-600 text-white px-6 py-2 rounded font-cinzel shadow-md hover:bg-magic-700 transition">
                    <i class="fa-solid fa-pen-nib mr-2"></i> Editar Magia
                </Link>
            </div>

            <div class="glass-parchment rounded-xl shadow-2xl border border-parchment-400 overflow-hidden">
                <div class="p-8 bg-parchment-300/30 border-b border-parchment-400 flex justify-between items-start gap-6">
                    <div>
                        <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-magic-700 opacity-80 mb-1">
                            <i class="fa-solid fa-wand-sparkles mr-1"></i> Pergaminho Arcano
                        </p>
                        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest">{{ magia.nome }}</h1>
                        <p class="font-lora italic text-parchment-800 opacity-75 mt-1">
                            <span v-if="magia.escola">{{ magia.escola }}</span>
                            <span v-if="magia.versao"> — Versão {{ magia.versao }}</span>
                        </p>
                    </div>
                    <span v-if="menorNivel !== null"
                        class="bg-magic-600 text-white px-5 py-3 rounded-full font-cinzel shadow-inner text-center">
                        <span class="block text-[10px] uppercase opacity-70">Círculo</span>
                        <span class="block text-2xl font-bold leading-none">{{ menorNivel }}</span>
                    </span>
                </div>

                <div class="p-8 space-y-8">
                    <section>
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-book-open mr-2 text-magic-600"></i> Atributos Arcanos
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div v-for="attr in atributos" :key="attr.label"
                                class="flex items-start space-x-3 bg-parchment-200/50 p-3 rounded-lg border border-parchment-300">
                                <i :class="attr.icone" class="text-magic-600 text-lg mt-1 w-5 text-center"></i>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-parchment-700">{{ attr.label }}</p>
                                    <p class="font-lora text-sm text-parchment-900 break-words">{{ attr.valor || '—' }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-scroll mr-2 text-magic-600"></i> Descrição
                        </h2>
                        <p class="font-lora text-parchment-800 leading-relaxed whitespace-pre-line">
                            {{ magia.descricao || 'Os segredos desta magia ainda não foram transcritos.' }}
                        </p>
                    </section>

                    <section v-if="nivelClasses.length">
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-users mr-2 text-magic-600"></i> Classes Conjuradoras
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div v-for="classe in nivelClasses" :key="classe.id"
                                class="flex items-center justify-between bg-parchment-200/50 p-3 rounded-lg border border-parchment-300">
                                <span class="font-cinzel font-bold text-parchment-900">{{ classe.nome }}</span>
                                <span class="text-xs font-cinzel font-bold bg-magic-600 text-white px-3 py-1 rounded-full shadow-inner">
                                    {{ nomeCirculo(classe.pivot?.nivel ?? 0) }}
                                </span>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
