<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ raca: Object });

const getModifierColor = (value) => {
    if (value > 0) return 'text-green-700';
    if (value < 0) return 'text-blood-700';
    return 'text-parchment-800 opacity-50';
};

const formatModifier = (value) => (value > 0 ? `+${value}` : value);

const atributos = computed(() => [
    { label: 'Força', short: 'FOR', valor: props.raca.mod_forca },
    { label: 'Destreza', short: 'DES', valor: props.raca.mod_destreza },
    { label: 'Constituição', short: 'CON', valor: props.raca.mod_constituicao },
    { label: 'Inteligência', short: 'INT', valor: props.raca.mod_inteligencia },
    { label: 'Sabedoria', short: 'SAB', valor: props.raca.mod_sabedoria },
    { label: 'Carisma', short: 'CAR', valor: props.raca.mod_carisma },
]);

const escapeHtml = (str) => str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');

const descricaoFormatada = computed(() => {
    const raw = props.raca.descricao || 'Raça documentada nos antigos pergaminhos imperiais.';
    return escapeHtml(raw)
        .replace(/\*\*(.+?)\*\*/g, '<strong class="font-cinzel text-parchment-900">$1</strong>')
        .replace(/\n/g, '<br>');
});
</script>

<template>
    <Head :title="'Raça: ' + raca.nome" />

    <AppLayout>
        <div class="max-w-4xl mx-auto">
            <div class="mb-6 flex justify-between items-center">
                <Link :href="route('racas.index')" class="text-parchment-800 font-cinzel hover:text-blood-700 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Voltar aos Pergaminhos
                </Link>
                <Link :href="route('racas.edit', raca.id)" class="bg-blood-700 text-parchment-100 px-6 py-2 rounded font-cinzel shadow-md hover:bg-blood-800 transition">
                    <i class="fa-solid fa-pen-nib mr-2"></i> Editar Raça
                </Link>
            </div>

            <div class="glass-parchment rounded-xl shadow-2xl border border-parchment-400 overflow-hidden">
                <div class="p-8 bg-parchment-300/30 border-b border-parchment-400 flex justify-between items-start gap-6">
                    <div>
                        <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-blood-700 opacity-80 mb-1">Pergaminho Racial</p>
                        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest">{{ raca.nome }}</h1>
                        <p v-if="raca.versao" class="font-lora italic text-parchment-800 opacity-75 mt-1">Versão {{ raca.versao }}</p>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <span v-if="raca.tamanho" class="text-[10px] font-cinzel font-bold border border-parchment-800 px-3 py-1 rounded uppercase tracking-widest opacity-70">
                            {{ raca.tamanho }}
                        </span>
                        <span v-if="raca.deslocamento !== null && raca.deslocamento !== undefined"
                            class="bg-blood-700 text-parchment-100 px-4 py-2 rounded-full font-cinzel shadow-inner text-center">
                            <span class="block text-[10px] uppercase opacity-70">Deslocamento</span>
                            <span class="block text-lg font-bold leading-none">{{ raca.deslocamento }}m</span>
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

                    <section>
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-dna mr-2 text-blood-700"></i> Modificadores de Atributo
                        </h2>
                        <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
                            <div v-for="attr in atributos" :key="attr.short"
                                class="text-center p-3 bg-parchment-200/50 rounded-lg border border-parchment-300">
                                <p class="text-[10px] font-cinzel font-bold opacity-60 uppercase tracking-widest">{{ attr.short }}</p>
                                <p :class="['text-2xl font-bold font-cinzel mt-1', getModifierColor(attr.valor)]">
                                    {{ formatModifier(attr.valor) }}
                                </p>
                                <p class="text-[9px] font-lora italic text-parchment-700 opacity-70 mt-1">{{ attr.label }}</p>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-3 border-b border-parchment-400/40 pb-2">
                            <i class="fa-solid fa-mountain-sun mr-2 text-blood-700"></i> Traços Físicos
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-4 bg-parchment-200/50 p-4 rounded-lg border border-parchment-300">
                                <i class="fa-solid fa-ruler-vertical text-2xl text-blood-700"></i>
                                <div>
                                    <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-parchment-700">Tamanho</p>
                                    <p class="font-cinzel font-bold text-lg text-parchment-900">{{ raca.tamanho || '—' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 bg-parchment-200/50 p-4 rounded-lg border border-parchment-300">
                                <i class="fa-solid fa-person-running text-2xl text-blood-700"></i>
                                <div>
                                    <p class="text-[10px] font-cinzel font-bold uppercase tracking-widest text-parchment-700">Deslocamento</p>
                                    <p class="font-cinzel font-bold text-lg text-parchment-900">
                                        {{ raca.deslocamento !== null && raca.deslocamento !== undefined ? raca.deslocamento + 'm' : '—' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
