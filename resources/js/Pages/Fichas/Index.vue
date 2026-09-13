<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';

defineProps({
    fichas: Array
});

const CHAVE_RASCUNHO = 'forja-de-almas:rascunho';
const rascunho = ref(null);

const carregarRascunho = () => {
    if (typeof window === 'undefined') return;
    try {
        const raw = window.localStorage.getItem(CHAVE_RASCUNHO);
        if (!raw) { rascunho.value = null; return; }
        const snapshot = JSON.parse(raw);
        if (!snapshot?.form) { rascunho.value = null; return; }
        rascunho.value = snapshot;
    } catch (e) {
        rascunho.value = null;
    }
};

onMounted(carregarRascunho);

const dataRascunho = computed(() => {
    if (!rascunho.value?.timestamp) return '';
    try {
        return new Date(rascunho.value.timestamp).toLocaleString('pt-BR', {
            day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit'
        });
    } catch { return ''; }
});

const passoRascunho = computed(() => Number(rascunho.value?.step || 1));

const forjarNovoHeroi = () => {
    if (rascunho.value) {
        if (!confirm('Você tem um rascunho salvo. Iniciar um novo herói vai descartá-lo. Continuar?')) return;
        if (typeof window !== 'undefined') window.localStorage.removeItem(CHAVE_RASCUNHO);
    }
    router.visit(route('fichas.create') + '?fresh=1');
};

const continuarRascunho = () => {
    router.visit(route('fichas.create'));
};

const descartarRascunho = () => {
    if (!confirm('Descartar o rascunho salvo? Todos os dados preenchidos serão perdidos.')) return;
    if (typeof window !== 'undefined') window.localStorage.removeItem(CHAVE_RASCUNHO);
    rascunho.value = null;
};
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

            <button type="button" @click="forjarNovoHeroi"
                class="bg-blood-700 hover:bg-blood-800 text-parchment-100 px-8 py-4 rounded-lg font-cinzel font-bold shadow-2xl transition-all hover:scale-105 active:scale-95 flex items-center group">
                <i class="fa-solid fa-feather-pointed mr-3 group-hover:rotate-12 transition-transform"></i>
                Forjar Novo Herói
            </button>
        </div>

        <!-- Grid: rascunho + fichas -->
        <div v-if="fichas.length > 0 || rascunho" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            <!-- Card do Rascunho -->
            <div v-if="rascunho" class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-yellow-400 via-yellow-600/40 to-yellow-400 rounded-xl blur opacity-40 group-hover:opacity-90 transition duration-1000 group-hover:duration-200"></div>

                <div class="relative glass-parchment rounded-xl shadow-2xl overflow-hidden border-2 border-yellow-600/60 flex flex-col h-full transition-transform hover:-translate-y-2 cursor-pointer"
                    @click="continuarRascunho">
                    <div class="p-6 bg-yellow-600/10 border-b border-yellow-600/40">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-scroll text-yellow-700 text-2xl"></i>
                                <h2 class="text-2xl font-cinzel font-bold text-parchment-900">
                                    Rascunho
                                </h2>
                            </div>
                            <div class="bg-yellow-700 text-parchment-100 w-10 h-10 rounded-full flex items-center justify-center font-cinzel font-bold shadow-lg border-2 border-parchment-300">
                                {{ passoRascunho }}
                            </div>
                        </div>
                        <p class="text-xs font-cinzel font-bold text-parchment-800 opacity-70 uppercase tracking-widest">
                            Preenchimento em andamento
                        </p>
                    </div>

                    <div class="p-6 flex-grow space-y-3">
                        <p class="text-xs font-lora italic text-parchment-700">
                            <i class="fa-solid fa-clock mr-1"></i>
                            Última alteração: {{ dataRascunho || 'agora há pouco' }}
                        </p>
                        <p class="text-xs font-lora italic text-parchment-700">
                            <i class="fa-solid fa-list-ol mr-1"></i>
                            Parou no passo {{ passoRascunho }} de 8
                        </p>

                        <div class="pt-4 flex justify-between items-center border-t border-parchment-400/30">
                            <button type="button" @click.stop="continuarRascunho"
                                class="bg-yellow-700 hover:bg-yellow-800 text-parchment-100 px-4 py-2 rounded font-cinzel text-xs font-bold transition flex items-center group/btn">
                                Continuar Forjando
                                <i class="fa-solid fa-arrow-right ml-2 group-hover/btn:translate-x-1 transition-transform"></i>
                            </button>
                            <button type="button" @click.stop="descartarRascunho"
                                class="p-2 text-parchment-800 hover:text-blood-700 transition" title="Descartar rascunho">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cards de Fichas Registradas -->
            <div v-for="ficha in fichas" :key="ficha.id" class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-parchment-400 via-blood-700/20 to-parchment-400 rounded-xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>

                <div class="relative glass-parchment rounded-xl shadow-2xl overflow-hidden border border-parchment-400 flex flex-col h-full transition-transform hover:-translate-y-2">
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

        <!-- Estado Vazio (só quando não há fichas nem rascunho) -->
        <div v-else class="glass-parchment rounded-2xl p-20 text-center border-2 border-dashed border-parchment-400">
            <i class="fa-solid fa-ghost text-7xl text-parchment-400 mb-6 block"></i>
            <h3 class="text-2xl font-cinzel font-bold text-parchment-800 mb-2">O Salão está Silencioso</h3>
            <p class="font-lora italic text-parchment-700 mb-8 max-w-md mx-auto">
                Ainda não há heróis cujas façanhas mereçam ser registradas nestas crônicas. Comece a sua jornada agora.
            </p>
            <button type="button" @click="forjarNovoHeroi"
                class="inline-block bg-blood-700 text-parchment-100 px-10 py-4 rounded-lg font-cinzel font-bold shadow-xl hover:bg-blood-800 transition transform hover:scale-110">
                Iniciar Crônica
            </button>
        </div>
    </AppLayout>
</template>
