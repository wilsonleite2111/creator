<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ talento: Object });

const escapeHtml = (str) => str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');

const formatar = (raw) => escapeHtml(raw ?? '')
    .replace(/\*\*(.+?)\*\*/g, '<strong class="font-cinzel text-parchment-900">$1</strong>')
    .replace(/\n/g, '<br>');

const descricaoFormatada = computed(() => formatar(props.talento.descricao || 'Sem descrição registrada.'));
const beneficioFormatado = computed(() => formatar(props.talento.beneficio || ''));
</script>

<template>
    <Head :title="'Talento: ' + talento.nome" />

    <AppLayout>
        <div class="max-w-4xl mx-auto">
            <div class="mb-6 flex justify-between items-center">
                <Link :href="route('talentos.index')" class="text-parchment-800 font-cinzel hover:text-blood-700 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Voltar aos Tomos
                </Link>
                <Link :href="route('talentos.edit', talento.id)" class="bg-blood-700 text-parchment-100 px-6 py-2 rounded font-cinzel shadow-md hover:bg-blood-800 transition">
                    <i class="fa-solid fa-pen-nib mr-2"></i> Editar Talento
                </Link>
            </div>

            <div class="glass-parchment rounded-xl shadow-2xl border border-parchment-400 overflow-hidden">
                <div class="p-8 bg-parchment-300/30 border-b border-parchment-400 flex justify-between items-start gap-6">
                    <div>
                        <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-blood-700 opacity-80 mb-1">Tomo de Talentos</p>
                        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest">{{ talento.nome }}</h1>
                        <p v-if="talento.versao" class="font-lora italic text-parchment-800 opacity-75 mt-1">Versão {{ talento.versao }}</p>
                    </div>
                    <span v-if="talento.tipo" class="bg-parchment-700 text-parchment-100 px-5 py-3 rounded-full font-cinzel shadow-inner text-center">
                        <span class="block text-[10px] uppercase opacity-70">Tipo</span>
                        <span class="block text-lg font-bold leading-none">{{ talento.tipo }}</span>
                    </span>
                </div>

                <div class="p-8 space-y-8">
                    <section v-if="talento.pre_requisitos">
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-list-check mr-2 text-blood-700"></i> Pré-requisitos
                        </h2>
                        <p class="font-lora text-parchment-800 leading-relaxed italic">{{ talento.pre_requisitos }}</p>
                    </section>

                    <section v-if="talento.beneficio">
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-star mr-2 text-blood-700"></i> Benefício
                        </h2>
                        <div class="bg-parchment-200/50 p-4 rounded-lg border border-parchment-300">
                            <div class="font-lora text-parchment-900 leading-relaxed" v-html="beneficioFormatado"></div>
                        </div>
                    </section>

                    <section>
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-scroll mr-2 text-blood-700"></i> Descrição Detalhada
                        </h2>
                        <div class="font-lora text-parchment-800 leading-relaxed space-y-2" v-html="descricaoFormatada"></div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
