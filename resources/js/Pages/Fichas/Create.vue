<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue';

const props = defineProps({
    racas: Array,
    classes: Array,
    tendencias: Array,
    divindades: Array,
    pericias: Array,
    talentos: Array,
    armas: Array,
    armaduras: Array,
    equipamentos: Array
});

const TOTAL_STEPS = 5;
const step = ref(1);

const stepLabels = [
    'Linhagem',
    'Vocação',
    'Ritual dos Atributos',
    'Treinamento',
    'Talentos & Dons'
];

const form = useForm({
    versao: '3.5',
    nome_personagem: '',
    nome_jogador: '',
    raca_id: null,
    classe_id: null,
    tendencia_id: props.tendencias?.[0]?.id ?? null,
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
    metodo_atributos: 'point_buy',
    pericias: {},
    talentos: [],
    armas: [],
    armaduras: [],
    equipamentos: []
});

const attributes = [
    { key: 'forca',        label: 'Força',        short: 'FOR', icon: 'fa-dumbbell' },
    { key: 'destreza',     label: 'Destreza',     short: 'DES', icon: 'fa-feather-pointed' },
    { key: 'constituicao', label: 'Constituição', short: 'CON', icon: 'fa-heart-pulse' },
    { key: 'inteligencia', label: 'Inteligência', short: 'INT', icon: 'fa-brain' },
    { key: 'sabedoria',    label: 'Sabedoria',    short: 'SAB', icon: 'fa-eye' },
    { key: 'carisma',      label: 'Carisma',      short: 'CAR', icon: 'fa-crown' }
];

const getMod = (val) => Math.floor(((val || 10) - 10) / 2);

const slugify = (str) => (str || '')
    .toLowerCase()
    .normalize('NFD').replace(/[̀-ͯ]/g, '')
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/(^-|-$)/g, '');

const selectedRaca    = computed(() => props.racas.find(r => r.id === form.raca_id) || null);
const selectedClasse  = computed(() => props.classes.find(c => c.id === form.classe_id) || null);

const racaIcones = {
    'anao':      'fa-hammer',
    'elfo':      'fa-leaf',
    'gnomo':     'fa-hat-wizard',
    'halfling':  'fa-shoe-prints',
    'humano':    'fa-user',
    'meio-elfo': 'fa-star-half-stroke',
    'meio-orc':  'fa-skull'
};
const classeIcones = {
    'barbaro':     'fa-axe-battle',
    'bardo':       'fa-guitar',
    'clerigo':     'fa-cross',
    'druida':      'fa-tree',
    'feiticeiro':  'fa-fire-flame-curved',
    'guerreiro':   'fa-shield-halved',
    'ladino':      'fa-mask',
    'mago':        'fa-wand-magic-sparkles',
    'monge':       'fa-hand-fist',
    'paladino':    'fa-sun',
    'patrulheiro': 'fa-bow-arrow'
};

const iconeFallback = (dict, nome, defaultIcon) => {
    const slug = slugify(nome);
    return dict[slug] || defaultIcon;
};

const racaImagem   = computed(() => selectedRaca.value   ? `/images/racas/${slugify(selectedRaca.value.nome)}.png`   : null);
const classeImagem = computed(() => selectedClasse.value ? `/images/classes/${slugify(selectedClasse.value.nome)}.png` : null);

const racasComAvatar3D = ['humano'];
const classesComAvatar3D = [];
const racaAvatar3DUrl = computed(() => {
    const slug = slugify(selectedRaca.value?.nome);
    return slug && racasComAvatar3D.includes(slug) ? `/avatars/${slug}/index.html` : null;
});
const classeAvatar3DUrl = computed(() => {
    const slug = slugify(selectedClasse.value?.nome);
    return slug && classesComAvatar3D.includes(slug) ? `/avatars/${slug}/index.html` : null;
});

const racaImagemOk   = ref(false);
const classeImagemOk = ref(false);
watch(racaImagem,   () => { racaImagemOk.value   = false; });
watch(classeImagem, () => { classeImagemOk.value = false; });

const modRaciais = computed(() => {
    if (!selectedRaca.value) return [];
    const r = selectedRaca.value;
    const mapa = [
        ['FOR', r.mod_forca],        ['DES', r.mod_destreza],   ['CON', r.mod_constituicao],
        ['INT', r.mod_inteligencia], ['SAB', r.mod_sabedoria],  ['CAR', r.mod_carisma]
    ];
    return mapa.filter(([, v]) => Number(v) !== 0).map(([k, v]) => `${k} ${v > 0 ? '+' : ''}${v}`);
});

const isHumano = computed(() => slugify(selectedRaca.value?.nome) === 'humano');

// ---------- Atributos: 3 métodos ----------
const roll = (sides) => Math.floor(Math.random() * sides) + 1;
const roll4d6DropLowest = () => {
    const r = [roll(6), roll(6), roll(6), roll(6)].sort((a, b) => b - a);
    return r[0] + r[1] + r[2];
};
const roll3d6 = () => roll(6) + roll(6) + roll(6);

const poolRolagens = ref([]);      // valores rolados (aguardando distribuição)
const atribsAtribuidos = ref({});  // { forca: idx_do_pool, ... }
const rolando = ref(false);

const rolarPool = () => {
    rolando.value = true;
    const gerador = form.metodo_atributos === 'four_d6' ? roll4d6DropLowest : roll3d6;
    const qtd = form.metodo_atributos === 'four_d6' ? 6 : 12;
    let n = 0;
    poolRolagens.value = Array(qtd).fill(0);
    atribsAtribuidos.value = {};
    attributes.forEach(a => { form[a.key + '_base'] = 10; });
    const t = setInterval(() => {
        poolRolagens.value = poolRolagens.value.map(() => gerador());
        n++;
        if (n >= 6) {
            clearInterval(t);
            rolando.value = false;
        }
    }, 60);
};

const atribuirValor = (attrKey, poolIdx) => {
    const anterior = Object.entries(atribsAtribuidos.value).find(([, i]) => i === poolIdx);
    if (anterior) delete atribsAtribuidos.value[anterior[0]];
    const anteriorDoAttr = atribsAtribuidos.value[attrKey];
    atribsAtribuidos.value[attrKey] = poolIdx;
    form[attrKey + '_base'] = poolRolagens.value[poolIdx];
    if (anteriorDoAttr === undefined) return;
};

const limparAtribuicao = (attrKey) => {
    delete atribsAtribuidos.value[attrKey];
    form[attrKey + '_base'] = 10;
};

const poolLivre = computed(() => poolRolagens.value.map((v, i) => ({ v, i, usado: Object.values(atribsAtribuidos.value).includes(i) })));

// Point Buy 25 pts (custo D&D 3.5)
const POINT_BUY_TOTAL = 25;
const custoPointBuy = { 8: 0, 9: 1, 10: 2, 11: 3, 12: 4, 13: 5, 14: 6, 15: 8, 16: 10, 17: 13, 18: 16 };

const pontosGastos = computed(() => {
    if (form.metodo_atributos !== 'point_buy') return 0;
    return attributes.reduce((sum, a) => sum + (custoPointBuy[form[a.key + '_base']] ?? 0), 0);
});
const pontosRestantes = computed(() => POINT_BUY_TOTAL - pontosGastos.value);

const incAtributo = (key) => {
    const atual = form[key + '_base'];
    if (atual >= 18) return;
    const proximo = atual + 1;
    const custoExtra = (custoPointBuy[proximo] ?? 99) - (custoPointBuy[atual] ?? 0);
    if (custoExtra > pontosRestantes.value) return;
    form[key + '_base'] = proximo;
};
const decAtributo = (key) => {
    const atual = form[key + '_base'];
    if (atual <= 8) return;
    form[key + '_base'] = atual - 1;
};

watch(() => form.metodo_atributos, (novo) => {
    poolRolagens.value = [];
    atribsAtribuidos.value = {};
    const base = novo === 'point_buy' ? 8 : 10;
    attributes.forEach(a => { form[a.key + '_base'] = base; });
});

// ---------- Perícias: orçamento ----------
const modInt = computed(() => getMod(form.inteligencia_base));
const pontosPericiaMax = computed(() => {
    const base = Number(selectedClasse.value?.pontos_pericia ?? 2);
    const total = Math.max(1, base + modInt.value) * 4;
    return total + (isHumano.value ? 4 : 0);
});
const pontosPericiaGastos = computed(() =>
    Object.values(form.pericias).reduce((s, v) => s + (Number(v) || 0), 0)
);
const pontosPericiaRestantes = computed(() => pontosPericiaMax.value - pontosPericiaGastos.value);

const setPericia = (id, val) => {
    const n = Math.max(0, Math.floor(Number(val) || 0));
    if (n === 0) delete form.pericias[id];
    else form.pericias[id] = n;
};

// ---------- Talentos ----------
const slotsTalento = computed(() => 1 + (isHumano.value ? 1 : 0));
const talentosDisponiveis = computed(() => slotsTalento.value - form.talentos.length);
const talentosPorTipo = computed(() => {
    const grupos = {};
    (props.talentos || []).forEach(t => {
        (grupos[t.tipo] = grupos[t.tipo] || []).push(t);
    });
    return grupos;
});

const toggleTalento = (id) => {
    const idx = form.talentos.indexOf(id);
    if (idx >= 0) form.talentos.splice(idx, 1);
    else if (talentosDisponiveis.value > 0) form.talentos.push(id);
};

// ---------- Navegação ----------
const podeAvancar = computed(() => {
    if (step.value === 1) return !!form.raca_id;
    if (step.value === 2) return !!form.classe_id;
    if (step.value === 3) {
        if (form.metodo_atributos === 'point_buy') return pontosRestantes.value === 0;
        return poolRolagens.value.length > 0 && attributes.every(a => atribsAtribuidos.value[a.key] !== undefined);
    }
    if (step.value === 4) return pontosPericiaRestantes.value >= 0;
    if (step.value === 5) return form.talentos.length === slotsTalento.value;
    return true;
});

const nextStep = () => { if (step.value < TOTAL_STEPS && podeAvancar.value) step.value++; };
const prevStep = () => { if (step.value > 1) step.value--; };

const submit = () => form.post(route('fichas.store'));
</script>

<template>
    <Head title="Forjar Herói" />

    <AppLayout>
        <div class="max-w-6xl mx-auto">
            <div class="mb-10 text-center">
                <h1 class="text-4xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest mb-4">A Forja de Almas</h1>

                <div class="flex items-center justify-center flex-wrap gap-2">
                    <div v-for="i in TOTAL_STEPS" :key="i" class="flex items-center">
                        <div :class="['w-10 h-10 rounded-full flex items-center justify-center font-cinzel font-bold transition-all duration-500 border-2 shadow-lg',
                            step >= i ? 'bg-blood-700 text-parchment-100 border-parchment-300' : 'bg-parchment-300 text-parchment-600 border-parchment-400']">
                            {{ i }}
                        </div>
                        <div v-if="i < TOTAL_STEPS" :class="['w-10 h-1 transition-all duration-500 mx-1', step > i ? 'bg-blood-700' : 'bg-parchment-400']"></div>
                    </div>
                </div>
                <p class="mt-4 font-cinzel font-bold text-parchment-800 text-sm uppercase tracking-widest">
                    Passo {{ step }} — {{ stepLabels[step-1] }}
                </p>
            </div>

            <form @submit.prevent="submit" class="glass-parchment p-8 md:p-12 rounded-2xl shadow-2xl border border-parchment-400 relative overflow-hidden">

                <!-- ============ PASSO 1: RAÇA ============ -->
                <div v-if="step === 1" class="space-y-8">
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 mb-2 uppercase text-sm">Raça</label>
                        <select v-model="form.raca_id"
                            class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-3 font-lora focus:border-blood-700 outline-none transition shadow-inner">
                            <option :value="null">Selecione uma Raça...</option>
                            <option v-for="r in racas" :key="r.id" :value="r.id">{{ r.nome }}</option>
                        </select>
                    </div>

                    <!-- Painel do Avatar da Raça -->
                    <div class="min-h-[520px] bg-parchment-200/40 border-2 border-parchment-400 rounded-2xl p-8 flex flex-col md:flex-row gap-8 items-center transition-all duration-500"
                         :class="{ 'border-blood-700/60 shadow-2xl': selectedRaca }">
                        <div class="w-full md:w-3/5 flex items-center justify-center">
                            <div class="relative w-full aspect-square max-w-xl rounded-2xl bg-gradient-to-br from-parchment-300 to-parchment-500 border-4 border-parchment-600 shadow-inner overflow-hidden">
                                <template v-if="selectedRaca">
                                    <iframe v-if="racaAvatar3DUrl"
                                            :src="racaAvatar3DUrl"
                                            class="absolute inset-0 w-full h-full border-0"
                                            :title="'Avatar de ' + selectedRaca.nome"
                                            loading="lazy"></iframe>
                                    <template v-else>
                                        <img v-show="racaImagemOk"
                                             :src="racaImagem" :alt="selectedRaca.nome"
                                             @load="racaImagemOk = true" @error="racaImagemOk = false"
                                             class="absolute inset-0 w-full h-full object-cover">
                                        <div v-if="!racaImagemOk" class="absolute inset-0 flex items-center justify-center">
                                            <i :class="['fa-solid text-[10rem] text-blood-700/70 drop-shadow-lg', iconeFallback(racaIcones, selectedRaca.nome, 'fa-user-shield')]"></i>
                                        </div>
                                    </template>
                                </template>
                                <div v-else class="absolute inset-0 flex items-center justify-center text-center px-6">
                                    <div>
                                        <i class="fa-solid fa-people-group text-8xl text-parchment-600/40 mb-4"></i>
                                        <p class="font-cinzel text-parchment-700/60 italic">Escolha uma linhagem</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:w-2/5 space-y-4">
                            <template v-if="selectedRaca">
                                <h3 class="text-3xl font-cinzel font-bold text-blood-800 uppercase tracking-wider">{{ selectedRaca.nome }}</h3>
                                <p class="font-lora italic text-parchment-800">{{ selectedRaca.descricao }}</p>

                                <div class="grid grid-cols-2 gap-3 pt-2">
                                    <div class="bg-parchment-100 rounded-lg p-3 border border-parchment-400">
                                        <p class="text-[10px] font-cinzel uppercase opacity-60">Tamanho</p>
                                        <p class="font-bold font-cinzel">{{ selectedRaca.tamanho }}</p>
                                    </div>
                                    <div class="bg-parchment-100 rounded-lg p-3 border border-parchment-400">
                                        <p class="text-[10px] font-cinzel uppercase opacity-60">Deslocamento</p>
                                        <p class="font-bold font-cinzel">{{ selectedRaca.deslocamento }}</p>
                                    </div>
                                </div>

                                <div v-if="modRaciais.length" class="pt-2">
                                    <p class="text-[10px] font-cinzel uppercase opacity-60 mb-2">Modificadores Raciais</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span v-for="m in modRaciais" :key="m"
                                            class="px-3 py-1 rounded-full bg-blood-700 text-parchment-100 font-cinzel font-bold text-xs shadow">{{ m }}</span>
                                    </div>
                                </div>
                            </template>
                            <div v-else class="text-center text-parchment-700/60 italic font-lora">
                                O herói ainda não escolheu sua linhagem. Cada raça carrega dons e limitações que moldarão seu destino.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============ PASSO 2: CLASSE ============ -->
                <div v-if="step === 2" class="space-y-8">
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 mb-2 uppercase text-sm">Classe</label>
                        <select v-model="form.classe_id"
                            class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-3 font-lora focus:border-blood-700 outline-none transition shadow-inner">
                            <option :value="null">Selecione uma Classe...</option>
                            <option v-for="c in classes" :key="c.id" :value="c.id">{{ c.nome }}</option>
                        </select>
                    </div>

                    <!-- Painel do Avatar da Classe -->
                    <div class="min-h-[520px] bg-parchment-200/40 border-2 border-parchment-400 rounded-2xl p-8 flex flex-col md:flex-row gap-8 items-center transition-all duration-500"
                         :class="{ 'border-blood-700/60 shadow-2xl': selectedClasse }">
                        <div class="w-full md:w-3/5 flex items-center justify-center">
                            <div class="relative w-full aspect-square max-w-xl rounded-2xl bg-gradient-to-br from-parchment-300 to-parchment-500 border-4 border-parchment-600 shadow-inner overflow-hidden">
                                <template v-if="selectedClasse">
                                    <iframe v-if="classeAvatar3DUrl"
                                            :src="classeAvatar3DUrl"
                                            class="absolute inset-0 w-full h-full border-0"
                                            :title="'Avatar de ' + selectedClasse.nome"
                                            loading="lazy"></iframe>
                                    <template v-else>
                                        <img v-show="classeImagemOk"
                                             :src="classeImagem" :alt="selectedClasse.nome"
                                             @load="classeImagemOk = true" @error="classeImagemOk = false"
                                             class="absolute inset-0 w-full h-full object-cover">
                                        <div v-if="!classeImagemOk" class="absolute inset-0 flex items-center justify-center">
                                            <i :class="['fa-solid text-[10rem] text-blood-700/70 drop-shadow-lg', iconeFallback(classeIcones, selectedClasse.nome, 'fa-shield')]"></i>
                                        </div>
                                    </template>
                                </template>
                                <div v-else class="absolute inset-0 flex items-center justify-center text-center px-6">
                                    <div>
                                        <i class="fa-solid fa-khanda text-8xl text-parchment-600/40 mb-4"></i>
                                        <p class="font-cinzel text-parchment-700/60 italic">Escolha uma vocação</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:w-2/5 space-y-4">
                            <template v-if="selectedClasse">
                                <h3 class="text-3xl font-cinzel font-bold text-blood-800 uppercase tracking-wider">{{ selectedClasse.nome }}</h3>
                                <p class="font-lora italic text-parchment-800">{{ selectedClasse.descricao }}</p>

                                <div class="grid grid-cols-2 gap-3 pt-2">
                                    <div class="bg-parchment-100 rounded-lg p-3 border border-parchment-400">
                                        <p class="text-[10px] font-cinzel uppercase opacity-60">Dado de Vida</p>
                                        <p class="font-bold font-cinzel">d{{ selectedClasse.dado_vida }}</p>
                                    </div>
                                    <div class="bg-parchment-100 rounded-lg p-3 border border-parchment-400">
                                        <p class="text-[10px] font-cinzel uppercase opacity-60">Pts. Perícia (nv 1)</p>
                                        <p class="font-bold font-cinzel">({{ selectedClasse.pontos_pericia }}+INT) × 4</p>
                                    </div>
                                    <div class="bg-parchment-100 rounded-lg p-3 border border-parchment-400">
                                        <p class="text-[10px] font-cinzel uppercase opacity-60">Progressão de BBA</p>
                                        <p class="font-bold font-cinzel capitalize">{{ selectedClasse.bba_progressao }}</p>
                                    </div>
                                    <div class="bg-parchment-100 rounded-lg p-3 border border-parchment-400">
                                        <p class="text-[10px] font-cinzel uppercase opacity-60">Resistências Boas</p>
                                        <p class="font-bold font-cinzel text-xs">
                                            <span v-if="selectedClasse.resistencia_fortitude">FORT </span>
                                            <span v-if="selectedClasse.resistencia_reflexos">REF </span>
                                            <span v-if="selectedClasse.resistencia_vontade">VONT</span>
                                        </p>
                                    </div>
                                </div>
                            </template>
                            <div v-else class="text-center text-parchment-700/60 italic font-lora">
                                Cada vocação define o caminho da glória — do estudioso da magia ao mestre da lâmina.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============ PASSO 3: ATRIBUTOS ============ -->
                <div v-if="step === 3" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <button type="button" @click="form.metodo_atributos = 'four_d6'"
                            :class="['p-4 rounded-xl border-2 transition text-left', form.metodo_atributos === 'four_d6' ? 'border-blood-700 bg-blood-700/10 shadow-lg' : 'border-parchment-400 hover:border-parchment-600']">
                            <p class="font-cinzel font-bold uppercase text-sm text-parchment-900"><i class="fa-solid fa-dice-d6 mr-2"></i> 6 × 4d6</p>
                            <p class="text-xs font-lora opacity-70 mt-1">Rola 4d6, descarta o menor. Distribua os 6 valores.</p>
                        </button>
                        <button type="button" @click="form.metodo_atributos = 'twelve_d6'"
                            :class="['p-4 rounded-xl border-2 transition text-left', form.metodo_atributos === 'twelve_d6' ? 'border-blood-700 bg-blood-700/10 shadow-lg' : 'border-parchment-400 hover:border-parchment-600']">
                            <p class="font-cinzel font-bold uppercase text-sm text-parchment-900"><i class="fa-solid fa-dice-d20 mr-2"></i> 12 × 3d6</p>
                            <p class="text-xs font-lora opacity-70 mt-1">Rola 12 valores; escolhe 6 e descarta os outros.</p>
                        </button>
                        <button type="button" @click="form.metodo_atributos = 'point_buy'"
                            :class="['p-4 rounded-xl border-2 transition text-left', form.metodo_atributos === 'point_buy' ? 'border-blood-700 bg-blood-700/10 shadow-lg' : 'border-parchment-400 hover:border-parchment-600']">
                            <p class="font-cinzel font-bold uppercase text-sm text-parchment-900"><i class="fa-solid fa-scale-balanced mr-2"></i> Compra de Pontos (25)</p>
                            <p class="text-xs font-lora opacity-70 mt-1">Distribua 25 pontos entre atributos (8–18).</p>
                        </button>
                    </div>

                    <!-- Rolagens: pool -->
                    <div v-if="form.metodo_atributos !== 'point_buy'" class="space-y-6">
                        <div class="text-center">
                            <button type="button" @click="rolarPool" :disabled="rolando"
                                class="px-10 py-4 bg-black text-white rounded-full font-cinzel font-bold shadow-2xl hover:bg-blood-900 transition border-2 border-blood-700 disabled:opacity-50">
                                <i class="fa-solid" :class="rolando ? 'fa-sync fa-spin' : 'fa-dice-d20'"></i>
                                {{ poolRolagens.length ? 'Rolar Novamente' : 'Realizar Ritual' }}
                            </button>
                        </div>

                        <div v-if="poolRolagens.length" class="bg-parchment-200/40 rounded-xl p-6 border-2 border-parchment-400">
                            <p class="font-cinzel font-bold uppercase text-sm mb-4 text-parchment-800">Valores Rolados — clique para atribuir</p>
                            <div class="flex flex-wrap gap-3">
                                <button v-for="p in poolLivre" :key="p.i" type="button"
                                    :disabled="p.usado"
                                    :class="['w-14 h-14 rounded-lg font-cinzel font-bold text-xl border-2 transition',
                                            p.usado ? 'bg-parchment-300 border-parchment-400 opacity-30 line-through' : 'bg-parchment-100 border-blood-700 hover:bg-blood-700 hover:text-white shadow']">
                                    {{ p.v }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Grade de Atributos -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div v-for="attr in attributes" :key="attr.key"
                            class="p-5 rounded-2xl border-2 border-parchment-400 bg-parchment-100 shadow flex flex-col items-center">
                            <p class="font-cinzel font-bold text-parchment-900 uppercase text-xs tracking-widest mb-2">
                                <i class="fa-solid mr-1" :class="attr.icon"></i> {{ attr.label }}
                            </p>

                            <!-- Point Buy: +/- -->
                            <div v-if="form.metodo_atributos === 'point_buy'" class="flex items-center gap-3">
                                <button type="button" @click="decAtributo(attr.key)"
                                    class="w-8 h-8 rounded-full bg-parchment-300 hover:bg-blood-700 hover:text-white font-bold">−</button>
                                <span class="text-4xl font-cinzel font-bold w-14 text-center">{{ form[attr.key + '_base'] }}</span>
                                <button type="button" @click="incAtributo(attr.key)"
                                    class="w-8 h-8 rounded-full bg-parchment-300 hover:bg-blood-700 hover:text-white font-bold">+</button>
                            </div>

                            <!-- Rolagens: select do pool -->
                            <div v-else>
                                <div v-if="atribsAtribuidos[attr.key] === undefined" class="text-parchment-600 italic text-xs mb-2">Não atribuído</div>
                                <div v-else class="text-4xl font-cinzel font-bold mb-2">{{ form[attr.key + '_base'] }}</div>
                                <select :value="atribsAtribuidos[attr.key] ?? ''"
                                    @change="e => e.target.value === '' ? limparAtribuicao(attr.key) : atribuirValor(attr.key, Number(e.target.value))"
                                    :disabled="!poolRolagens.length"
                                    class="text-xs bg-parchment-100 border border-parchment-400 rounded p-1">
                                    <option value="">— escolher —</option>
                                    <option v-for="p in poolLivre" :key="p.i" :value="p.i" :disabled="p.usado && atribsAtribuidos[attr.key] !== p.i">
                                        {{ p.v }}
                                    </option>
                                </select>
                            </div>

                            <p class="mt-3 text-xs font-cinzel opacity-60 uppercase">Mod</p>
                            <span :class="['text-xl font-bold font-cinzel', getMod(form[attr.key + '_base']) >= 0 ? 'text-green-700' : 'text-blood-700']">
                                {{ getMod(form[attr.key + '_base']) >= 0 ? '+' : '' }}{{ getMod(form[attr.key + '_base']) }}
                            </span>
                        </div>
                    </div>

                    <div v-if="form.metodo_atributos === 'point_buy'"
                         class="text-center p-4 rounded-lg font-cinzel font-bold text-sm"
                         :class="pontosRestantes === 0 ? 'bg-green-100 text-green-800' : pontosRestantes < 0 ? 'bg-blood-700 text-white' : 'bg-parchment-200 text-parchment-900'">
                        Pontos restantes: {{ pontosRestantes }} / {{ POINT_BUY_TOTAL }}
                    </div>
                </div>

                <!-- ============ PASSO 4: PERÍCIAS ============ -->
                <div v-if="step === 4" class="space-y-6">
                    <div v-if="!selectedClasse" class="p-6 bg-blood-700/10 border border-blood-700 rounded-lg font-lora italic text-center">
                        Escolha uma classe no passo 2 para calcular seus pontos de perícia.
                    </div>

                    <div v-else class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                        <div class="p-4 rounded-lg bg-parchment-200 border border-parchment-400">
                            <p class="text-[10px] uppercase font-cinzel opacity-60">Total (nível 1)</p>
                            <p class="text-2xl font-cinzel font-bold">{{ pontosPericiaMax }}</p>
                        </div>
                        <div class="p-4 rounded-lg bg-parchment-200 border border-parchment-400">
                            <p class="text-[10px] uppercase font-cinzel opacity-60">Gastos</p>
                            <p class="text-2xl font-cinzel font-bold">{{ pontosPericiaGastos }}</p>
                        </div>
                        <div :class="['p-4 rounded-lg border font-cinzel font-bold',
                            pontosPericiaRestantes < 0 ? 'bg-blood-700 text-white border-blood-800' : 'bg-parchment-200 border-parchment-400']">
                            <p class="text-[10px] uppercase opacity-60">Restantes</p>
                            <p class="text-2xl">{{ pontosPericiaRestantes }}</p>
                        </div>
                    </div>

                    <div class="max-h-[500px] overflow-y-auto pr-2 grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div v-for="p in pericias" :key="p.id"
                            class="flex items-center justify-between p-3 bg-parchment-200/50 rounded-lg border border-parchment-300">
                            <div>
                                <p class="font-lora text-sm font-bold">{{ p.nome }}</p>
                                <p class="text-[10px] uppercase opacity-50 font-cinzel">{{ p.habilidade_chave }}</p>
                            </div>
                            <input type="number" min="0"
                                :value="form.pericias[p.id] ?? 0"
                                @input="e => setPericia(p.id, e.target.value)"
                                class="w-16 bg-parchment-100 border border-parchment-400 rounded p-1 text-center font-bold">
                        </div>
                    </div>
                </div>

                <!-- ============ PASSO 5: TALENTOS ============ -->
                <div v-if="step === 5" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                        <div class="p-4 rounded-lg bg-parchment-200 border border-parchment-400">
                            <p class="text-[10px] uppercase font-cinzel opacity-60">Slots</p>
                            <p class="text-2xl font-cinzel font-bold">{{ slotsTalento }}</p>
                        </div>
                        <div class="p-4 rounded-lg bg-parchment-200 border border-parchment-400">
                            <p class="text-[10px] uppercase font-cinzel opacity-60">Escolhidos</p>
                            <p class="text-2xl font-cinzel font-bold">{{ form.talentos.length }}</p>
                        </div>
                        <div :class="['p-4 rounded-lg border font-cinzel font-bold',
                            talentosDisponiveis === 0 ? 'bg-green-100 text-green-800 border-green-400' : 'bg-parchment-200 border-parchment-400']">
                            <p class="text-[10px] uppercase opacity-60">Restantes</p>
                            <p class="text-2xl">{{ talentosDisponiveis }}</p>
                        </div>
                    </div>

                    <div class="max-h-[550px] overflow-y-auto pr-2 space-y-6">
                        <div v-for="(lista, tipo) in talentosPorTipo" :key="tipo">
                            <h4 class="font-cinzel font-bold uppercase text-sm text-blood-800 mb-2 border-b border-parchment-400 pb-1">{{ tipo }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <button v-for="t in lista" :key="t.id" type="button"
                                    @click="toggleTalento(t.id)"
                                    :disabled="!form.talentos.includes(t.id) && talentosDisponiveis === 0"
                                    :class="['text-left p-3 rounded-lg border-2 transition',
                                            form.talentos.includes(t.id) ? 'border-blood-700 bg-blood-700/10 shadow' : 'border-parchment-300 hover:border-parchment-600 disabled:opacity-40 disabled:hover:border-parchment-300']">
                                    <p class="font-cinzel font-bold text-sm">{{ t.nome }}</p>
                                    <p v-if="t.pre_requisitos" class="text-[10px] italic opacity-60">Pré: {{ t.pre_requisitos }}</p>
                                    <p class="text-xs font-lora mt-1">{{ t.beneficio }}</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navegação -->
                <div class="mt-12 flex justify-between items-center pt-8 border-t border-parchment-400">
                    <button type="button" @click="prevStep" v-if="step > 1"
                        class="px-8 py-3 rounded-lg font-cinzel font-bold text-parchment-800 hover:bg-parchment-300 transition">
                        <i class="fa-solid fa-chevron-left mr-2"></i> Voltar
                    </button>
                    <div v-else></div>

                    <button type="button" @click="nextStep" v-if="step < TOTAL_STEPS"
                        :disabled="!podeAvancar"
                        class="px-10 py-3 bg-blood-700 text-white rounded-lg font-cinzel font-bold shadow-lg hover:bg-blood-800 transition transform hover:scale-105 active:scale-95 border-b-4 border-blood-900 disabled:opacity-40 disabled:hover:scale-100">
                        PRÓXIMO PASSO <i class="fa-solid fa-chevron-right ml-2"></i>
                    </button>

                    <button type="submit" v-if="step === TOTAL_STEPS"
                        :disabled="form.processing || !podeAvancar"
                        class="px-12 py-4 bg-blood-700 text-parchment-100 rounded-lg font-cinzel font-bold shadow-2xl hover:bg-blood-800 transition transform hover:scale-105 active:scale-95 disabled:opacity-40">
                        <i class="fa-solid fa-fire mr-2"></i> {{ form.processing ? 'Forjando...' : 'Registrar Herói' }}
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
