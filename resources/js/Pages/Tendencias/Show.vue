<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ tendencia: Object });

const escapeHtml = (str) => str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');

const descricaoFormatada = computed(() => escapeHtml(props.tendencia.descricao || 'Tendência sem crônica registrada.')
    .replace(/\*\*(.+?)\*\*/g, '<strong class="font-cinzel text-parchment-900">$1</strong>')
    .replace(/\n/g, '<br>'));
</script>

<template>
    <Head :title="'Tendência: ' + tendencia.nome" />

    <AppLayout>
        <div class="max-w-4xl mx-auto">
            <div class="mb-6 flex justify-between items-center">
                <Link :href="route('tendencias.index')" class="text-parchment-800 font-cinzel hover:text-blood-700 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Voltar às Tendências
                </Link>
                <Link :href="route('tendencias.edit', tendencia.id)" class="bg-blood-700 text-parchment-100 px-6 py-2 rounded font-cinzel shadow-md hover:bg-blood-800 transition">
                    <i class="fa-solid fa-pen-nib mr-2"></i> Editar Tendência
                </Link>
            </div>

            <div class="glass-parchment rounded-xl shadow-2xl border border-parchment-400 overflow-hidden">
                <div class="p-8 bg-parchment-300/30 border-b border-parchment-400 flex justify-between items-start gap-6">
                    <div>
                        <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-blood-700 opacity-80 mb-1">Bússola Moral</p>
                        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest">{{ tendencia.nome }}</h1>
                        <p v-if="tendencia.apelido" class="font-lora italic text-parchment-800 opacity-75 mt-1">{{ tendencia.apelido }}</p>
                    </div>
                    <span class="bg-blood-700 text-parchment-100 w-20 h-20 flex items-center justify-center rounded-full font-cinzel font-bold text-2xl shadow-inner">
                        {{ tendencia.iniciais }}
                    </span>
                </div>

                <div class="p-8">
                    <section>
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-scroll mr-2 text-blood-700"></i> Descrição
                        </h2>
                        <div class="font-lora text-parchment-800 leading-relaxed space-y-2" v-html="descricaoFormatada"></div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
