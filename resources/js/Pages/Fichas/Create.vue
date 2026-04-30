<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    racas: Array,
    classes: Array,
    tendencias: Array,
    divindades: Array,
    pericias: Array,
    armas: Array,
    armaduras: Array,
    equipamentos: Array
});

const step = ref(1);
const form = useForm({
    versao: '3.5',
    nome_personagem: '',
    nome_jogador: '',
    raca_id: null,
    classe_id: null,
    tendencia_id: null,
    divindade: '',
    nivel: 1,
    ouro: 100,
    forca_base: 10,
    destreza_base: 10,
    constituicao_base: 10,
    inteligencia_base: 10,
    sabedoria_base: 10,
    carisma_base: 10,
    pv_max: 10,
    bab: 0,
    fortitude_base: 0,
    reflexos_base: 0,
    vontade_base: 0,
    xp_atual: 0,
    deslocamento: '9m',
    iniciativa_misc: 0,
    ca_natural: 0,
    ca_armadura: 0,
    ca_escudo: 0,
    ca_tamanho: 0,
    ca_deflexao: 0,
    ca_misc: 0,
    fortitude_misc: 0,
    fortitude_magia: 0,
    reflexos_misc: 0,
    reflexos_magia: 0,
    vontade_misc: 0,
    vontade_magia: 0,
    agarre_misc: 0,
    agarre_tamanho: 0,
    dinheiro_pc: 0,
    dinheiro_pp: 0,
    dinheiro_pl: 0,
    xp_proximo: 1000,
    pericias: {},
    armas: [],
    armaduras: [],
    equipamentos: []
});

const attributes = [
    { key: 'forca', label: 'Força' },
    { key: 'destreza', label: 'Destreza' },
    { key: 'constituicao', label: 'Constituição' },
    { key: 'inteligencia', label: 'Inteligência' },
    { key: 'sabedoria', label: 'Sabedoria' },
    { key: 'carisma', label: 'Carisma' }
];

const isRolling = ref(false);
const sfx = {
    play: (name) => {
        const audio = new Audio(`/audio/${name}.mp3`);
        audio.play().catch(e => console.log('Audio blocked or missing'));
    }
};

const getMod = (val) => Math.floor((val - 10) / 2);

const roll4d6DropLowest = () => {
    let rolls = Array.from({ length: 4 }, () => Math.floor(Math.random() * 6) + 1);
    rolls.sort((a, b) => b - a);
    return rolls.slice(0, 3).reduce((a, b) => a + b, 0);
};

const rollAllAttributes = () => {
    isRolling.value = true;
    sfx.play('hover'); // Som curtíssimo

    let iterations = 0;
    const maxIterations = 8; // Ultra rápido
    const interval = setInterval(() => {
        attributes.forEach(attr => {
            form[attr.key + '_base'] = Math.floor(Math.random() * 15) + 3;
        });
        iterations++;

        if (iterations >= maxIterations) {
            clearInterval(interval);
            attributes.forEach(attr => {
                form[attr.key + '_base'] = roll4d6DropLowest();
            });
            isRolling.value = false;
            sfx.play('hover'); // Finaliza com o mesmo som curto
        }
    }, 40); // 40ms entre os giros
};

const nextStep = () => { if (step.value < 4) step.value++; };
const prevStep = () => { if (step.value > 1) step.value--; };

const submit = () => {
    form.post(route('fichas.store'));
};

const selectedRaca = computed(() => props.racas.find(r => r.id === form.raca_id));
const selectedClasse = computed(() => props.classes.find(c => c.id === form.classe_id));
</script>

<template>
    <Head title="Forjar Herói" />

    <AppLayout>
        <div class="max-w-5xl mx-auto">
            <!-- Header do Wizard -->
            <div class="mb-10 text-center">
                <h1 class="text-4xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest mb-4">A Forja de Almas</h1>
                
                <!-- Progress Stepper -->
                <div class="flex items-center justify-center space-x-4">
                    <div v-for="i in 4" :key="i" class="flex items-center">
                        <div :class="['w-10 h-10 rounded-full flex items-center justify-center font-cinzel font-bold transition-all duration-500 border-2 shadow-lg', 
                            step >= i ? 'bg-blood-700 text-parchment-100 border-parchment-300' : 'bg-parchment-300 text-parchment-600 border-parchment-400']">
                            {{ i }}
                        </div>
                        <div v-if="i < 4" :class="['w-16 h-1 transition-all duration-500 mx-2', step > i ? 'bg-blood-700' : 'bg-parchment-400']"></div>
                    </div>
                </div>
                <p class="mt-4 font-cinzel font-bold text-parchment-800 text-sm uppercase tracking-widest">
                    {{ ['Origens & Linhagem', 'Atributos & Vitalidade', 'Habilidades & Treinamento', 'Equipamento & Destino'][step-1] }}
                </p>
            </div>

            <form @submit.prevent="submit" class="glass-parchment p-8 md:p-12 rounded-2xl shadow-2xl border border-parchment-400 relative overflow-hidden">
                <!-- Background Decorativo -->
                <i class="fa-solid fa-feather absolute -right-10 -bottom-10 text-[20rem] opacity-5 -rotate-12 pointer-events-none"></i>

                <!-- Passo 1: Origens -->
                <div v-if="step === 1" class="space-y-8 animate-in fade-in slide-in-from-right duration-500">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 mb-2 uppercase text-sm">Nome do Herói</label>
                            <input v-model="form.nome_personagem" type="text" class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-3 font-lora focus:border-blood-700 outline-none transition shadow-inner" placeholder="Ex: Valerius, o Audaz">
                        </div>
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 mb-2 uppercase text-sm">Nome do Jogador</label>
                            <input v-model="form.nome_jogador" type="text" class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-3 font-lora focus:border-blood-700 outline-none transition shadow-inner">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 mb-2 uppercase text-sm">Raça</label>
                            <select v-model="form.raca_id" class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-3 font-lora focus:border-blood-700 outline-none transition shadow-inner">
                                <option :value="null">Selecione uma Raça...</option>
                                <option v-for="raca in racas" :key="raca.id" :value="raca.id">{{ raca.nome }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 mb-2 uppercase text-sm">Classe</label>
                            <select v-model="form.classe_id" class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-3 font-lora focus:border-blood-700 outline-none transition shadow-inner">
                                <option :value="null">Selecione uma Classe...</option>
                                <option v-for="classe in classes" :key="classe.id" :value="classe.id">{{ classe.nome }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 mb-2 uppercase text-sm">Tendência</label>
                            <select v-model="form.tendencia_id" class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-3 font-lora focus:border-blood-700 outline-none transition shadow-inner">
                                <option :value="null">Selecione uma Tendência...</option>
                                <option v-for="t in tendencias" :key="t.id" :value="t.id">{{ t.nome }}</option>
                            </select>
                        </div>
                    </div>

                    <div v-if="selectedRaca || selectedClasse" class="bg-parchment-200/50 p-6 rounded-xl border border-parchment-400 italic font-lora text-sm space-y-2">
                        <p v-if="selectedRaca"><strong class="font-cinzel text-blood-700">Traços de {{ selectedRaca.nome }}:</strong> {{ selectedRaca.descricao }}</p>
                        <p v-if="selectedClasse"><strong class="font-cinzel text-blood-700">Treinamento de {{ selectedClasse.nome }}:</strong> {{ selectedClasse.descricao }}</p>
                    </div>
                </div>

                <!-- Passo 2: Atributos -->
                <div v-if="step === 2" class="space-y-10 animate-in fade-in slide-in-from-right duration-500">
                    <div class="text-center mb-6">
                        <button type="button" @click="rollAllAttributes" :disabled="isRolling"
                            class="relative px-12 py-5 bg-[#1a1a1a] text-white rounded-full font-cinzel font-bold shadow-2xl hover:bg-black transition group overflow-hidden border-2 border-blood-700">
                            <span v-if="!isRolling" class="relative z-10 flex items-center">
                                <i class="fa-solid fa-dice-d20 mr-3 text-2xl text-blood-700 animate-pulse"></i>
                                REALIZAR RITUAL DE ATRIBUTOS
                            </span>
                            <span v-else class="relative z-10 flex items-center">
                                <i class="fa-solid fa-sync fa-spin mr-3"></i>
                                SORTEANDO...
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blood-700/0 via-blood-700/40 to-blood-700/0 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </button>
                        <p class="mt-4 text-xs font-lora italic text-parchment-800 opacity-60">Método Sagrado: 4d6 (descarta o menor)</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                        <div v-for="attr in attributes" :key="attr.key" 
                            class="relative flex flex-col items-center p-6 rounded-2xl border-2 transition-all duration-500"
                            :class="isRolling ? 'bg-blood-700/5 border-blood-700 shadow-inner' : 'bg-parchment-300/30 border-parchment-400 shadow-xl'">
                            
                            <label class="font-cinzel font-bold text-parchment-900 uppercase text-sm mb-4 tracking-widest">{{ attr.label }}</label>
                            
                            <div class="relative w-24 h-24 flex items-center justify-center">
                                <!-- Animação de Brilho Arcano -->
                                <div v-if="isRolling" class="absolute inset-0 bg-blood-700/20 rounded-full animate-ping"></div>
                                
                                <div class="text-5xl font-cinzel font-bold text-parchment-900 z-10 drop-shadow-md"
                                     :class="{ 'animate-pulse scale-110 text-blood-700': isRolling }">
                                    {{ form[attr.key + '_base'] }}
                                </div>
                            </div>

                            <div class="mt-4 flex flex-col items-center">
                                <span class="text-xs font-cinzel font-bold uppercase opacity-60">Modificador</span>
                                <span :class="['text-xl font-bold font-cinzel', getMod(form[attr.key + '_base']) >= 0 ? 'text-green-700' : 'text-blood-700']">
                                    {{ getMod(form[attr.key + '_base']) > 0 ? '+' : '' }}{{ getMod(form[attr.key + '_base']) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-10 border-t border-parchment-400/30">
                        <!-- PV e Ouro permanecem -->
                        <div class="glass-parchment p-6 rounded-xl border border-parchment-400">
                            <label class="block font-cinzel font-bold text-parchment-900 mb-4 uppercase text-sm flex items-center">
                                <i class="fa-solid fa-heart text-blood-700 mr-2"></i> Vitalidade Inicial (PV)
                            </label>
                            <input v-model="form.pv_max" type="number" class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-4 font-bold text-2xl text-center focus:border-blood-700 outline-none shadow-inner">
                        </div>
                        <div class="glass-parchment p-6 rounded-xl border border-parchment-400">
                            <label class="block font-cinzel font-bold text-parchment-900 mb-4 uppercase text-sm flex items-center">
                                <i class="fa-solid fa-coins text-yellow-600 mr-2"></i> Riqueza de Herança
                            </label>
                            <input v-model="form.ouro" type="number" class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-4 font-bold text-2xl text-center focus:border-blood-700 outline-none shadow-inner">
                        </div>
                    </div>
                </div>

                <!-- Passo 3: Perícias (Simplificado para o exemplo) -->
                <div v-if="step === 3" class="space-y-6 animate-in fade-in slide-in-from-right duration-500 h-[500px] overflow-y-auto pr-4 scrollbar-parchment">
                    <h3 class="font-cinzel font-bold text-xl text-parchment-900 border-b border-parchment-400 pb-2">Treinamento de Perícias</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-for="p in pericias" :key="p.id" class="flex items-center justify-between p-3 bg-parchment-200/50 rounded-lg border border-parchment-300">
                            <span class="font-lora text-sm font-bold">{{ p.nome }} <span class="text-[10px] opacity-50 uppercase">({{ p.atributo_chave }})</span></span>
                            <input v-model="form.pericias[p.id]" type="number" min="0" class="w-16 bg-parchment-100 border border-parchment-400 rounded p-1 text-center font-bold">
                        </div>
                    </div>
                </div>

                <!-- Passo 4: Finalização -->
                <div v-if="step === 4" class="text-center space-y-8 animate-in fade-in slide-in-from-right duration-500 py-12">
                    <i class="fa-solid fa-scroll-old text-8xl text-blood-700/20"></i>
                    <div>
                        <h2 class="text-3xl font-cinzel font-bold text-parchment-900">O Herói está Pronto</h2>
                        <p class="font-lora italic text-parchment-800 mt-2">Revise as informações antes de registrar nas crônicas.</p>
                    </div>
                    
                    <div class="max-w-md mx-auto bg-parchment-200/50 p-6 rounded-xl border-2 border-parchment-400 text-left font-lora">
                        <p><strong>Nome:</strong> {{ form.nome_personagem }}</p>
                        <p><strong>Linhagem:</strong> {{ selectedRaca?.nome }} {{ selectedClasse?.nome }}</p>
                        <p><strong>Nível:</strong> {{ form.nivel }}</p>
                    </div>

                    <p class="text-xs text-blood-700 font-bold uppercase tracking-widest animate-pulse">Este ato é permanente e mudará o destino deste mundo.</p>
                </div>

                <!-- Navegação -->
                <div class="mt-12 flex justify-between items-center pt-8 border-t border-parchment-400">
                    <button type="button" @click="prevStep" v-if="step > 1" 
                        class="px-8 py-3 rounded-lg font-cinzel font-bold text-parchment-800 hover:bg-parchment-300 transition">
                        Voltar
                    </button>
                    <div v-else></div>

                    <button type="button" @click="nextStep" v-if="step < 4" 
                        class="px-10 py-3 bg-blood-700 text-white rounded-lg font-cinzel font-bold shadow-lg hover:bg-blood-800 transition transform hover:scale-105 active:scale-95 border-b-4 border-blood-900">
                        PRÓXIMO PASSO
                    </button>
                    
                    <button type="submit" v-if="step === 4" 
                        :disabled="form.processing"
                        class="px-12 py-4 bg-blood-700 text-parchment-100 rounded-lg font-cinzel font-bold shadow-2xl hover:bg-blood-800 transition transform hover:scale-105 active:scale-95">
                        <i class="fa-solid fa-fire mr-2"></i> {{ form.processing ? 'Forjando...' : 'Registrar Herói' }}
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<style scoped>
.scrollbar-parchment::-webkit-scrollbar { width: 8px; }
.scrollbar-parchment::-webkit-scrollbar-track { background: var(--parchment-200); }
.scrollbar-parchment::-webkit-scrollbar-thumb { background: var(--parchment-400); border-radius: 4px; }
.scrollbar-parchment::-webkit-scrollbar-thumb:hover { background: var(--parchment-800); }
</style>
