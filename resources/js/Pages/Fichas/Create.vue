<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed, watch, nextTick } from 'vue';

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

const TOTAL_STEPS = 7;
const step = ref(1);

const stepLabels = [
    'Identidade',
    'Linhagem',
    'Vocação',
    'Ritual dos Atributos',
    'Perícias',
    'Talentos & Dons',
    'Arsenal & Provisões'
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
    armas: {},         // { id: quantidade }
    armaduras: [],     // [id, id, ...] — armaduras não têm quantidade no pivot
    equipamentos: {},  // { id: quantidade }
});

const attributes = [
    { key: 'forca',        label: 'Força',        short: 'FOR', icon: 'fa-dumbbell',       modKey: 'mod_forca' },
    { key: 'destreza',     label: 'Destreza',     short: 'DES', icon: 'fa-feather-pointed', modKey: 'mod_destreza' },
    { key: 'constituicao', label: 'Constituição', short: 'CON', icon: 'fa-heart-pulse',    modKey: 'mod_constituicao' },
    { key: 'inteligencia', label: 'Inteligência', short: 'INT', icon: 'fa-brain',          modKey: 'mod_inteligencia' },
    { key: 'sabedoria',    label: 'Sabedoria',    short: 'SAB', icon: 'fa-eye',            modKey: 'mod_sabedoria' },
    { key: 'carisma',      label: 'Carisma',      short: 'CAR', icon: 'fa-crown',          modKey: 'mod_carisma' }
];

const getMod = (val) => Math.floor(((val || 10) - 10) / 2);

// Valor bruto do atributo (rolado ou comprado), ANTES do modificador racial.
const atributosRaw = ref(Object.fromEntries(attributes.map(a => [a.key, 10])));

// Modificador racial por atributo, extraído da raça selecionada.
const modRacialPor = computed(() => {
    const r = selectedRaca.value;
    const obj = {};
    attributes.forEach(a => { obj[a.key] = r ? (Number(r[a.modKey]) || 0) : 0; });
    return obj;
});

// Valor final do atributo = bruto + modificador racial.
const atributoFinal = (key) => (atributosRaw.value[key] ?? 10) + (modRacialPor.value[key] ?? 0);

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

const escapeHtml = (str) => (str ?? '')
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');

const formatarDescricao = (raw) => escapeHtml(raw)
    .replace(/\*\*(.+?)\*\*/g, '<strong class="font-cinzel text-parchment-900 not-italic">$1</strong>')
    .replace(/\n/g, '<br>');

const racaDescricaoFormatada = computed(() => selectedRaca.value ? formatarDescricao(selectedRaca.value.descricao) : '');
const classeDescricaoFormatada = computed(() => selectedClasse.value ? formatarDescricao(selectedClasse.value.descricao) : '');

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
    attributes.forEach(a => { atributosRaw.value[a.key] = 10; });
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
    atributosRaw.value[attrKey] = poolRolagens.value[poolIdx];
    if (anteriorDoAttr === undefined) return;
};

const limparAtribuicao = (attrKey) => {
    delete atribsAtribuidos.value[attrKey];
    atributosRaw.value[attrKey] = 10;
};

const poolLivre = computed(() => poolRolagens.value.map((v, i) => ({ v, i, usado: Object.values(atribsAtribuidos.value).includes(i) })));

// Point Buy 25 pts (custo D&D 3.5)
const POINT_BUY_TOTAL = 25;
const custoPointBuy = { 8: 0, 9: 1, 10: 2, 11: 3, 12: 4, 13: 5, 14: 6, 15: 8, 16: 10, 17: 13, 18: 16 };

const pontosGastos = computed(() => {
    if (form.metodo_atributos !== 'point_buy') return 0;
    return attributes.reduce((sum, a) => sum + (custoPointBuy[atributosRaw.value[a.key]] ?? 0), 0);
});
const pontosRestantes = computed(() => POINT_BUY_TOTAL - pontosGastos.value);

const incAtributo = (key) => {
    const atual = atributosRaw.value[key];
    if (atual >= 18) return;
    const proximo = atual + 1;
    const custoExtra = (custoPointBuy[proximo] ?? 99) - (custoPointBuy[atual] ?? 0);
    if (custoExtra > pontosRestantes.value) return;
    atributosRaw.value[key] = proximo;
};
const decAtributo = (key) => {
    const atual = atributosRaw.value[key];
    if (atual <= 8) return;
    atributosRaw.value[key] = atual - 1;
};

watch(() => form.metodo_atributos, (novo) => {
    poolRolagens.value = [];
    atribsAtribuidos.value = {};
    const base = novo === 'point_buy' ? 8 : 10;
    attributes.forEach(a => { atributosRaw.value[a.key] = base; });
});

// Sincroniza form.forca_base etc. com o total (raw + racial) sempre que qualquer um mudar.
watch([atributosRaw, modRacialPor], () => {
    attributes.forEach(a => {
        form[a.key + '_base'] = atributoFinal(a.key);
    });
}, { deep: true, immediate: true });

// ---------- Perícias: orçamento e regras de classe (PHB 3.5) ----------
const modInt = computed(() => getMod(form.inteligencia_base));
const pontosPericiaMax = computed(() => {
    const base = Number(selectedClasse.value?.pontos_pericia ?? 2);
    const total = Math.max(1, base + modInt.value) * 4;
    return total + (isHumano.value ? 4 : 0);
});

// Perícias de classe por classe (PHB 3.5). Perícias FORA dessa lista são "fora da classe": custam 2 pts por graduação e o teto de graduações é metade.
const periciasClassePor = {
    'barbaro':     ['Adestrar Animais', 'Cavalgar', 'Escalar', 'Intimidar', 'Natação', 'Ofícios', 'Ouvir', 'Saltar', 'Sobrevivência'],
    'bardo':       ['Avaliação', 'Equilíbrio', 'Blefar', 'Escalar', 'Concentração', 'Ofícios', 'Decifrar Escrita', 'Diplomacia', 'Disfarce', 'Arte da Fuga', 'Obter Informação', 'Esconder-se', 'Saltar', 'Conhecimento (Arcano)', 'Conhecimento (Arquitetura e Engenharia)', 'Conhecimento (Dungeon)', 'Conhecimento (Geografia)', 'Conhecimento (História)', 'Conhecimento (Local)', 'Conhecimento (Natureza)', 'Conhecimento (Nobreza e Realeza)', 'Conhecimento (Os Planos)', 'Conhecimento (Religião)', 'Ouvir', 'Furtividade', 'Atuação', 'Profissão', 'Sentir Motivação', 'Prestidigitação', 'Identificar Magia', 'Natação', 'Acrobacia', 'Usar Instrumento Mágico'],
    'clerigo':     ['Concentração', 'Ofícios', 'Diplomacia', 'Cura', 'Conhecimento (Arcano)', 'Conhecimento (História)', 'Conhecimento (Religião)', 'Conhecimento (Os Planos)', 'Profissão', 'Identificar Magia'],
    'druida':      ['Concentração', 'Ofícios', 'Diplomacia', 'Adestrar Animais', 'Cura', 'Conhecimento (Natureza)', 'Ouvir', 'Profissão', 'Cavalgar', 'Identificar Magia', 'Observar', 'Sobrevivência', 'Natação'],
    'feiticeiro':  ['Blefar', 'Concentração', 'Ofícios', 'Conhecimento (Arcano)', 'Profissão', 'Identificar Magia'],
    'guerreiro':   ['Escalar', 'Ofícios', 'Adestrar Animais', 'Intimidar', 'Saltar', 'Cavalgar', 'Natação'],
    'ladino':      ['Avaliação', 'Equilíbrio', 'Blefar', 'Escalar', 'Ofícios', 'Decifrar Escrita', 'Diplomacia', 'Operar Mecanismo', 'Disfarce', 'Arte da Fuga', 'Falsificação', 'Obter Informação', 'Esconder-se', 'Intimidar', 'Saltar', 'Conhecimento (Local)', 'Ouvir', 'Furtividade', 'Abrir Fechaduras', 'Atuação', 'Profissão', 'Procurar', 'Sentir Motivação', 'Prestidigitação', 'Observar', 'Natação', 'Acrobacia', 'Usar Instrumento Mágico', 'Usar Cordas'],
    'mago':        ['Concentração', 'Ofícios', 'Decifrar Escrita', 'Conhecimento (Arcano)', 'Conhecimento (Arquitetura e Engenharia)', 'Conhecimento (Dungeon)', 'Conhecimento (Geografia)', 'Conhecimento (História)', 'Conhecimento (Local)', 'Conhecimento (Natureza)', 'Conhecimento (Nobreza e Realeza)', 'Conhecimento (Os Planos)', 'Conhecimento (Religião)', 'Profissão', 'Identificar Magia'],
    'monge':       ['Equilíbrio', 'Escalar', 'Concentração', 'Ofícios', 'Diplomacia', 'Arte da Fuga', 'Esconder-se', 'Saltar', 'Conhecimento (Arcano)', 'Conhecimento (Religião)', 'Ouvir', 'Furtividade', 'Atuação', 'Profissão', 'Sentir Motivação', 'Observar', 'Natação', 'Acrobacia'],
    'paladino':    ['Concentração', 'Ofícios', 'Diplomacia', 'Adestrar Animais', 'Cura', 'Conhecimento (Nobreza e Realeza)', 'Conhecimento (Religião)', 'Profissão', 'Cavalgar', 'Sentir Motivação'],
    'patrulheiro': ['Escalar', 'Concentração', 'Ofícios', 'Adestrar Animais', 'Cura', 'Esconder-se', 'Saltar', 'Conhecimento (Dungeon)', 'Conhecimento (Geografia)', 'Conhecimento (Natureza)', 'Ouvir', 'Furtividade', 'Profissão', 'Cavalgar', 'Procurar', 'Observar', 'Sobrevivência', 'Natação', 'Usar Cordas'],
};

// Perícias trained-only que exigem ao menos uma graduação na classe: ao ler estritamente, o PHB 3.5 não proíbe fora-da-classe, mas para desincentivar aplicaremos exclusividade em algumas.
// Convenção: uma perícia é "exclusiva" quando aparece em apenas UMA lista de classe.
const periciasExclusivas = computed(() => {
    const contagem = {};
    Object.values(periciasClassePor).forEach(lista => lista.forEach(nome => { contagem[nome] = (contagem[nome] || 0) + 1; }));
    const exclusivas = {};
    Object.entries(periciasClassePor).forEach(([classe, lista]) => {
        lista.forEach(nome => { if (contagem[nome] === 1) exclusivas[nome] = classe; });
    });
    return exclusivas;
});

const classeSlug = computed(() => slugify(selectedClasse.value?.nome));

const ehPericiaDeClasse = (pericia) => {
    const slug = classeSlug.value;
    if (!slug) return false;
    const lista = periciasClassePor[slug];
    return Array.isArray(lista) && lista.includes(pericia.nome);
};

const ehPericiaProibida = (pericia) => {
    const dono = periciasExclusivas.value[pericia.nome];
    return !!dono && dono !== classeSlug.value;
};

const custoDaPericia = (pericia) => ehPericiaDeClasse(pericia) ? 1 : 2;

const nivelPersonagem = computed(() => Number(form.nivel || 1));

const maxGraduacoesDaPericia = (pericia) => {
    if (ehPericiaProibida(pericia)) return 0;
    const teto = nivelPersonagem.value + 3;
    return ehPericiaDeClasse(pericia) ? teto : Math.floor(teto / 2);
};

const graduacoesDaPericia = (pericia) => Number(form.pericias[pericia.id] || 0);

const pontosGastosDaPericia = (pericia) => graduacoesDaPericia(pericia) * custoDaPericia(pericia);

const pontosPericiaGastos = computed(() =>
    (props.pericias || []).reduce((soma, p) => soma + pontosGastosDaPericia(p), 0)
);
const pontosPericiaRestantes = computed(() => pontosPericiaMax.value - pontosPericiaGastos.value);

// Bônus raciais por perícia (PHB 3.5). Alguns são condicionais no PHB (ex.: anão em pedra/metal); aqui aplicamos o valor cheio como aproximação da ficha.
const bonusRacialPorPericia = {
    'anao':      { 'Avaliação': 2, 'Ofícios': 2, 'Procurar': 2 },
    'elfo':      { 'Ouvir': 2, 'Observar': 2, 'Procurar': 2 },
    'gnomo':     { 'Ouvir': 2, 'Ofícios': 2 },
    'halfling':  { 'Escalar': 2, 'Saltar': 2, 'Furtividade': 2, 'Ouvir': 2 },
    'meio-elfo': { 'Ouvir': 1, 'Observar': 1, 'Procurar': 1, 'Diplomacia': 2, 'Obter Informação': 2 },
};

const racaSlug = computed(() => slugify(selectedRaca.value?.nome));

const bonusRacialDaPericia = (pericia) => {
    const slug = racaSlug.value;
    if (!slug) return 0;
    const mapa = bonusRacialPorPericia[slug];
    return (mapa && mapa[pericia.nome]) ?? 0;
};

const habilidadeParaChave = {
    'FOR': 'forca',
    'DES': 'destreza',
    'CON': 'constituicao',
    'INT': 'inteligencia',
    'SAB': 'sabedoria',
    'CAR': 'carisma',
};

const modDaHabilidade = (pericia) => {
    const chave = habilidadeParaChave[pericia.habilidade_chave];
    if (!chave) return 0;
    return getMod(form[chave + '_base']);
};

const totalDaPericia = (pericia) => graduacoesDaPericia(pericia) + modDaHabilidade(pericia) + bonusRacialDaPericia(pericia);

const setPericia = (id, val) => {
    const pericia = (props.pericias || []).find(p => p.id === id);
    if (!pericia) return;
    if (ehPericiaProibida(pericia)) {
        delete form.pericias[id];
        return;
    }
    const teto = maxGraduacoesDaPericia(pericia);
    const nSolicitado = Math.max(0, Math.min(teto, Math.floor(Number(val) || 0)));

    // Impede exceder o orçamento total considerando o custo dessa perícia.
    const atual = graduacoesDaPericia(pericia);
    const custo = custoDaPericia(pericia);
    const delta = nSolicitado - atual;
    if (delta > 0 && delta * custo > pontosPericiaRestantes.value) {
        // Limita ao máximo permitido pelo saldo.
        const cabe = Math.floor(pontosPericiaRestantes.value / custo);
        const permitido = atual + Math.max(0, cabe);
        if (permitido === 0) delete form.pericias[id];
        else form.pericias[id] = permitido;
        return;
    }

    if (nSolicitado === 0) delete form.pericias[id];
    else form.pericias[id] = nSolicitado;
};

// Wrapper para o input do passo 5: aplica setPericia e força o DOM a exibir o valor real.
// Sem isso, se o setPericia bloquear a mudança (ex.: orçamento zerado), o número digitado
// permanece no input mesmo sem estado reactivo mudando.
const atualizarInputPericia = (id, event) => {
    setPericia(id, event.target.value);
    nextTick(() => {
        if (event.target) event.target.value = form.pericias[id] ?? 0;
    });
};

// Ao mudar de classe, zera todas as graduações. O orçamento total, a lista de perícias de
// classe e as perícias proibidas são radicalmente diferentes de uma classe para outra, então
// o usuário precisa redistribuir do zero em vez de arrastar graduações potencialmente inválidas.
watch(classeSlug, () => {
    Object.keys(form.pericias).forEach(id => delete form.pericias[id]);
});

// ---------- Talentos: slots e pré-requisitos ----------
const slotsTalento = computed(() => 1 + (isHumano.value ? 1 : 0));
const talentosDisponiveis = computed(() => slotsTalento.value - form.talentos.length);
const talentosPorTipo = computed(() => {
    const grupos = {};
    (props.talentos || []).forEach(t => {
        (grupos[t.tipo] = grupos[t.tipo] || []).push(t);
    });
    return grupos;
});

// Bônus Base de Ataque na classe atual (PHB 3.5): boa = nível, média = 3/4 nível, ruim = 1/2 nível (arredondado para baixo).
const bbaDaClasse = computed(() => {
    const c = selectedClasse.value;
    if (!c) return 0;
    const prog = String(c.bba_progressao || '').toLowerCase();
    const nv = nivelPersonagem.value;
    if (prog === 'boa') return nv;
    if (prog === 'media') return Math.floor(nv * 3 / 4);
    return Math.floor(nv / 2);
});

// Nível de conjurador: full casters = nível de personagem; paladino/patrulheiro entram no 4°; demais = 0.
const nivelDeConjurador = computed(() => {
    const slug = classeSlug.value;
    const nv = nivelPersonagem.value;
    if (['clerigo', 'druida', 'feiticeiro', 'mago', 'bardo'].includes(slug)) return nv;
    if (['paladino', 'patrulheiro'].includes(slug)) return nv >= 4 ? nv - 3 : 0;
    return 0;
});

const talentosPorNome = computed(() => {
    const map = {};
    (props.talentos || []).forEach(t => { map[t.nome] = t; });
    return map;
});

const nomesTalentosSelecionados = computed(() =>
    form.talentos.map(id => (props.talentos || []).find(t => t.id === id)?.nome).filter(Boolean)
);

const nomeAtributoParaChave = {
    'Força': 'forca',
    'Destreza': 'destreza',
    'Constituição': 'constituicao',
    'Inteligência': 'inteligencia',
    'Sabedoria': 'sabedoria',
    'Carisma': 'carisma',
};

const NOMES_CLASSES = ['Bárbaro', 'Bardo', 'Clérigo', 'Druida', 'Feiticeiro', 'Guerreiro', 'Ladino', 'Mago', 'Monge', 'Paladino', 'Patrulheiro'];

// Avalia um requisito atômico (sem "ou"). Retorna { ok, texto } para uso na UI.
const checarRequisitoAtomico = (req) => {
    const t = String(req).trim();
    if (!t) return { ok: true, texto: t };

    // Atributo mínimo: "Força 13"
    for (const [nome, chave] of Object.entries(nomeAtributoParaChave)) {
        const m = t.match(new RegExp(`^${nome}\\s+(\\d+)$`, 'i'));
        if (m) {
            const alvo = Number(m[1]);
            const atual = Number(form[chave + '_base'] || 0);
            return { ok: atual >= alvo, texto: `${nome} ${alvo} (você: ${atual})` };
        }
    }

    // BBA: "BBA +N"
    const mBBA = t.match(/^BBA\s*\+?(\d+)$/i);
    if (mBBA) {
        const alvo = Number(mBBA[1]);
        return { ok: bbaDaClasse.value >= alvo, texto: `BBA +${alvo} (você: +${bbaDaClasse.value})` };
    }

    // Nível de conjurador
    const mConj = t.match(/^N[íi]vel de conjurador\s+(\d+)$/i);
    if (mConj) {
        const alvo = Number(mConj[1]);
        return { ok: nivelDeConjurador.value >= alvo, texto: `Nível de conjurador ${alvo} (você: ${nivelDeConjurador.value})` };
    }

    // Expulsar mortos-vivos: só Clérigo (todos os níveis) ou Paladino a partir do 4°
    if (/^Capacidade de expulsar mortos-vivos$/i.test(t)) {
        const slug = classeSlug.value;
        const ok = slug === 'clerigo' || (slug === 'paladino' && nivelPersonagem.value >= 4);
        return { ok, texto: t };
    }

    // Proficiência com a arma: assumida como satisfeita (guerreiros/etc já cobrem armas marciais/simples).
    if (/^Profici[êe]ncia com a arma$/i.test(t)) return { ok: true, texto: t };

    // Classe + nível: "Guerreiro 8", "Monge 1"
    for (const nomeClasse of NOMES_CLASSES) {
        const m = t.match(new RegExp(`^${nomeClasse}\\s+(\\d+)$`, 'i'));
        if (m) {
            const alvo = Number(m[1]);
            const slug = slugify(nomeClasse);
            const ok = classeSlug.value === slug && nivelPersonagem.value >= alvo;
            return { ok, texto: `${nomeClasse} ${alvo}` };
        }
    }

    // Talento por nome
    if (talentosPorNome.value[t]) {
        return { ok: nomesTalentosSelecionados.value.includes(t), texto: `Talento: ${t}` };
    }

    // Requisito não reconhecido: exibe como aviso e não bloqueia.
    return { ok: true, texto: `${t} (não verificado)` };
};

// Avalia a string completa de pré-requisitos (separada por vírgulas, com possibilidade de "ou").
const avaliarPreRequisitos = (talento) => {
    const bruto = talento.pre_requisitos;
    if (!bruto) return { ok: true, itens: [] };
    const partes = String(bruto).split(',').map(s => s.trim()).filter(Boolean);
    const itens = partes.map(parte => {
        if (/\bou\b/i.test(parte)) {
            const alternativas = parte.split(/\bou\b/i).map(s => s.trim()).filter(Boolean);
            const avaliadas = alternativas.map(alt => checarRequisitoAtomico(alt));
            return {
                ok: avaliadas.some(a => a.ok),
                texto: avaliadas.map(a => a.texto).join(' OU '),
            };
        }
        return checarRequisitoAtomico(parte);
    });
    return { ok: itens.every(i => i.ok), itens };
};

const preReqsPorTalento = computed(() => {
    const map = {};
    (props.talentos || []).forEach(t => { map[t.id] = avaliarPreRequisitos(t); });
    return map;
});

const talentoAtendePreRequisitos = (talento) => preReqsPorTalento.value[talento.id]?.ok ?? true;

const toggleTalento = (id) => {
    const talento = (props.talentos || []).find(t => t.id === id);
    if (!talento) return;
    const idx = form.talentos.indexOf(id);
    if (idx >= 0) {
        form.talentos.splice(idx, 1);
        // Deselecionar em cadeia: se este talento era pré-requisito de outros selecionados, remove-os.
        revalidarTalentosSelecionados();
        return;
    }
    if (talentosDisponiveis.value <= 0) return;
    if (!talentoAtendePreRequisitos(talento)) return;
    form.talentos.push(id);
};

// Remove da seleção quaisquer talentos cujos pré-requisitos deixaram de ser atendidos.
const revalidarTalentosSelecionados = () => {
    let mudou = true;
    while (mudou) {
        mudou = false;
        for (const id of [...form.talentos]) {
            const t = (props.talentos || []).find(x => x.id === id);
            if (!t) continue;
            if (!talentoAtendePreRequisitos(t)) {
                form.talentos.splice(form.talentos.indexOf(id), 1);
                mudou = true;
                break;
            }
        }
    }
};

// Ao mudar de classe ou atributos base, revalida a seleção.
watch([classeSlug, () => ({
    forca: form.forca_base,
    destreza: form.destreza_base,
    constituicao: form.constituicao_base,
    inteligencia: form.inteligencia_base,
    sabedoria: form.sabedoria_base,
    carisma: form.carisma_base,
})], () => revalidarTalentosSelecionados(), { deep: true });

// ---------- Arsenal: ouro inicial, capacidade de carga e cálculo de compras ----------

// Peças de ouro iniciais no 1° nível por classe (média dos dados PHB 3.5).
const ouroInicialPorClasse = {
    'barbaro':     100,   // 4d4 × 10
    'bardo':       100,   // 4d4 × 10
    'clerigo':     125,   // 5d4 × 10
    'druida':      50,    // 2d4 × 10
    'feiticeiro':  75,    // 3d4 × 10
    'guerreiro':   150,   // 6d4 × 10
    'ladino':      125,   // 5d4 × 10
    'mago':        75,    // 3d4 × 10
    'monge':       12.5,  // 5d4 (monges começam sem × 10 — voto de pobreza)
    'paladino':    150,   // 6d4 × 10
    'patrulheiro': 150,   // 6d4 × 10
};

const ouroInicial = computed(() => ouroInicialPorClasse[classeSlug.value] ?? 0);

// Capacidade de carga máxima (pesada, em kg) — PHB 3.5 Table 9-1 convertida da tabela em libras (lb/2).
const cargaPesadaPorForca = {
    1: 5,   2: 10,  3: 15,  4: 20,  5: 25,  6: 30,  7: 35,  8: 40,  9: 45,
    10: 50, 11: 58, 12: 65, 13: 75, 14: 88, 15: 100, 16: 115, 17: 130, 18: 150,
    19: 175, 20: 200, 21: 230, 22: 260, 23: 300, 24: 350, 25: 400,
    26: 460, 27: 520, 28: 600, 29: 700, 30: 800,
};

const forcaFinal = computed(() => Math.min(30, Math.max(1, Number(form.forca_base || 10))));
const cargaPesadaMax = computed(() => cargaPesadaPorForca[forcaFinal.value] ?? 50);
const cargaMediaMax = computed(() => Math.round((cargaPesadaMax.value * 2 / 3) * 10) / 10);
const cargaLeveMax  = computed(() => Math.round((cargaPesadaMax.value / 3) * 10) / 10);

// Converte string tipo "10 PO", "5 PP", "3 PC", "1.500 PO" para peças de ouro (float). "-" ou vazio = 0.
const parsePreco = (str) => {
    if (!str) return 0;
    const s = String(str).trim();
    if (s === '-' || s === '—') return 0;
    const m = s.match(/^([\d.,]+)\s*(PO|PP|PC)$/i);
    if (!m) return 0;
    const valor = Number(m[1].replace(/\./g, '').replace(',', '.'));
    if (!Number.isFinite(valor)) return 0;
    const moeda = m[2].toUpperCase();
    if (moeda === 'PO') return valor;
    if (moeda === 'PP') return valor / 10;
    if (moeda === 'PC') return valor / 100;
    return 0;
};

// Somas dinâmicas. Aceita tanto array de IDs (armaduras) quanto mapa { id: qty } (armas, equipamentos).
const somarPor = (lista, selecao, fn) => {
    if (!lista) return 0;
    let total = 0;
    if (Array.isArray(selecao)) {
        for (const id of selecao) {
            const item = lista.find(x => x.id === id);
            if (item) total += fn(item);
        }
    } else if (selecao && typeof selecao === 'object') {
        for (const [id, qty] of Object.entries(selecao)) {
            if (!qty) continue;
            const item = lista.find(x => x.id === Number(id));
            if (item) total += fn(item) * Number(qty);
        }
    }
    return total;
};

const pesoArmas        = computed(() => somarPor(props.armas,        form.armas,        i => Number(i.peso || 0)));
const pesoArmaduras    = computed(() => somarPor(props.armaduras,    form.armaduras,    i => Number(i.peso || 0)));
const pesoEquipamentos = computed(() => somarPor(props.equipamentos, form.equipamentos, i => Number(i.peso || 0)));

const pesoTotal = computed(() => Math.round((pesoArmas.value + pesoArmaduras.value + pesoEquipamentos.value) * 100) / 100);

const ouroGasto = computed(() =>
    Math.round((
        somarPor(props.armas,        form.armas,        i => parsePreco(i.preco)) +
        somarPor(props.armaduras,    form.armaduras,    i => parsePreco(i.preco)) +
        somarPor(props.equipamentos, form.equipamentos, i => parsePreco(i.preco))
    ) * 100) / 100
);

const ouroRestante = computed(() => Math.round((ouroInicial.value - ouroGasto.value) * 100) / 100);

const nivelCarga = computed(() => {
    const p = pesoTotal.value;
    if (p > cargaPesadaMax.value) return { label: 'Excedida', cor: 'bg-blood-700 text-parchment-100' };
    if (p > cargaMediaMax.value)  return { label: 'Pesada',   cor: 'bg-orange-700 text-parchment-100' };
    if (p > cargaLeveMax.value)   return { label: 'Média',    cor: 'bg-yellow-600 text-parchment-100' };
    return { label: 'Leve', cor: 'bg-green-700 text-parchment-100' };
});

const armasPorCategoria = computed(() => {
    const grupos = {};
    (props.armas || []).forEach(a => {
        const chave = `${a.categoria || 'Outras'} — ${a.uso || 'Corpo-a-corpo'}`;
        (grupos[chave] = grupos[chave] || []).push(a);
    });
    return grupos;
});

const armadurasPorTipo = computed(() => {
    const grupos = {};
    (props.armaduras || []).forEach(a => {
        const chave = a.tipo || 'Outras';
        (grupos[chave] = grupos[chave] || []).push(a);
    });
    return grupos;
});

const toggleItem = (arr, id) => {
    const idx = arr.indexOf(id);
    if (idx >= 0) arr.splice(idx, 1);
    else arr.push(id);
};

// Setters de quantidade para mapas { id: qty } (armas, equipamentos).
const setQtd = (mapa, id, qty) => {
    const n = Math.max(0, Math.floor(Number(qty) || 0));
    if (n === 0) delete mapa[id];
    else mapa[id] = n;
};
const incQtd = (mapa, id) => setQtd(mapa, id, (mapa[id] || 0) + 1);
const decQtd = (mapa, id) => setQtd(mapa, id, (mapa[id] || 0) - 1);

// Aba ativa do passo 7.
const abaArsenal = ref('armaduras');

// ---------- Navegação ----------
const podeAvancar = computed(() => {
    if (step.value === 1) return !!form.nome_personagem?.trim() && !!form.nome_jogador?.trim() && !!form.tendencia_id;
    if (step.value === 2) return !!form.raca_id;
    if (step.value === 3) return !!form.classe_id;
    if (step.value === 4) {
        if (form.metodo_atributos === 'point_buy') return pontosRestantes.value === 0;
        return poolRolagens.value.length > 0 && attributes.every(a => atribsAtribuidos.value[a.key] !== undefined);
    }
    if (step.value === 5) return pontosPericiaRestantes.value >= 0;
    if (step.value === 6) return form.talentos.length === slotsTalento.value;
    if (step.value === 7) return ouroRestante.value >= 0 && pesoTotal.value <= cargaPesadaMax.value;
    return true;
});

const scrollTopo = () => {
    if (typeof window !== 'undefined') {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
};
const nextStep = () => {
    if (step.value < TOTAL_STEPS && podeAvancar.value) {
        step.value++;
        scrollTopo();
    }
};
const prevStep = () => {
    if (step.value > 1) {
        step.value--;
        scrollTopo();
    }
};

// Auto-computa campos derivados antes de submeter: PV, BBA, resistências-base, ouro final e CA/deslocamento da armadura equipada.
const submit = () => {
    const c = selectedClasse.value;
    if (c) {
        const conMod = getMod(form.constituicao_base);
        // No 1° nível, PV = dado de vida máximo + mod CON (mínimo 1).
        form.pv_max = Math.max(1, Number(c.dado_vida || 4) + conMod);
        form.bab = bbaDaClasse.value;
        form.fortitude_base = c.resistencia_fortitude === 'boa' ? 2 : 0;
        form.reflexos_base = c.resistencia_reflexos === 'boa' ? 2 : 0;
        form.vontade_base = c.resistencia_vontade === 'boa' ? 2 : 0;
    }
    // Ouro restante após compras vira o dinheiro em pl (peças de ouro) e frações em pp (prata).
    const restante = Math.max(0, ouroRestante.value);
    form.ouro = restante;
    form.dinheiro_pl = Math.floor(restante);
    form.dinheiro_pp = Math.floor((restante - Math.floor(restante)) * 10 + 0.001);
    form.dinheiro_pc = 0;
    form.post(route('fichas.store'));
};
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

                <!-- ============ PASSO 1: IDENTIDADE ============ -->
                <div v-if="step === 1" class="space-y-6">
                    <div class="text-center max-w-2xl mx-auto mb-4">
                        <p class="font-lora italic text-parchment-800">
                            Antes da forja começar, dê nome e propósito à sua alma. O nome do herói ecoará em canções de taverna; a tendência guiará suas escolhas ao longo da jornada.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 mb-2 uppercase text-sm">Nome do Personagem *</label>
                            <input v-model="form.nome_personagem" type="text" maxlength="100"
                                placeholder="Ex.: Aragorn, Thorin, Elara..."
                                class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-3 font-lora focus:border-blood-700 outline-none transition shadow-inner">
                            <p v-if="form.errors.nome_personagem" class="text-blood-700 text-xs mt-1">{{ form.errors.nome_personagem }}</p>
                        </div>
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 mb-2 uppercase text-sm">Nome do Jogador *</label>
                            <input v-model="form.nome_jogador" type="text" maxlength="100"
                                placeholder="Seu nome"
                                class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-3 font-lora focus:border-blood-700 outline-none transition shadow-inner">
                            <p v-if="form.errors.nome_jogador" class="text-blood-700 text-xs mt-1">{{ form.errors.nome_jogador }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 mb-2 uppercase text-sm">Tendência *</label>
                            <select v-model="form.tendencia_id"
                                class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-3 font-lora focus:border-blood-700 outline-none transition shadow-inner">
                                <option :value="null">Selecione uma tendência...</option>
                                <option v-for="t in tendencias" :key="t.id" :value="t.id">
                                    {{ t.nome }}<template v-if="t.apelido"> — {{ t.apelido }}</template>
                                </option>
                            </select>
                            <p v-if="form.errors.tendencia_id" class="text-blood-700 text-xs mt-1">{{ form.errors.tendencia_id }}</p>
                        </div>
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 mb-2 uppercase text-sm">Divindade (opcional)</label>
                            <select v-model="form.divindade"
                                class="w-full bg-parchment-100 border-2 border-parchment-400 rounded-lg p-3 font-lora focus:border-blood-700 outline-none transition shadow-inner">
                                <option value="">— Nenhuma —</option>
                                <option v-for="d in divindades" :key="d.id" :value="d.nome">
                                    {{ d.nome }}<template v-if="d.titulo"> — {{ d.titulo }}</template>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- ============ PASSO 2: RAÇA ============ -->
                <div v-if="step === 2" class="space-y-8">
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
                                <div class="font-lora italic text-parchment-800 leading-relaxed max-h-96 overflow-y-auto pr-2 space-y-1" v-html="racaDescricaoFormatada"></div>

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

                <!-- ============ PASSO 3: CLASSE ============ -->
                <div v-if="step === 3" class="space-y-8">
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
                                <div class="font-lora italic text-parchment-800 leading-relaxed max-h-96 overflow-y-auto pr-2 space-y-1" v-html="classeDescricaoFormatada"></div>

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

                <!-- ============ PASSO 4: ATRIBUTOS ============ -->
                <div v-if="step === 4" class="space-y-8">
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

                    <!-- Aviso se raça ainda não escolhida -->
                    <div v-if="!selectedRaca" class="p-3 bg-blood-700/10 border border-blood-700/40 rounded-lg font-lora italic text-sm text-center text-parchment-800">
                        <i class="fa-solid fa-triangle-exclamation mr-2 text-blood-700"></i>
                        Nenhuma raça selecionada — os atributos abaixo mostram apenas o valor base, sem modificadores raciais.
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
                                <span class="text-3xl font-cinzel font-bold w-12 text-center">{{ atributosRaw[attr.key] }}</span>
                                <button type="button" @click="incAtributo(attr.key)"
                                    class="w-8 h-8 rounded-full bg-parchment-300 hover:bg-blood-700 hover:text-white font-bold">+</button>
                            </div>

                            <!-- Rolagens: select do pool -->
                            <div v-else class="flex flex-col items-center">
                                <div v-if="atribsAtribuidos[attr.key] === undefined" class="text-parchment-600 italic text-xs mb-2">Não atribuído</div>
                                <div v-else class="text-3xl font-cinzel font-bold mb-2">{{ atributosRaw[attr.key] }}</div>
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

                            <!-- Modificador racial + total -->
                            <div v-if="modRacialPor[attr.key] !== 0" class="mt-3 flex items-center gap-2 text-xs font-cinzel">
                                <span class="opacity-60 uppercase">Raça</span>
                                <span :class="['px-2 py-0.5 rounded font-bold', modRacialPor[attr.key] > 0 ? 'bg-green-700/20 text-green-800' : 'bg-blood-700/20 text-blood-800']">
                                    {{ modRacialPor[attr.key] > 0 ? '+' : '' }}{{ modRacialPor[attr.key] }}
                                </span>
                            </div>

                            <div class="mt-3 pt-2 border-t border-parchment-300 w-full text-center">
                                <p class="text-[10px] font-cinzel opacity-60 uppercase">Total</p>
                                <div class="flex items-baseline justify-center gap-3">
                                    <span :class="['text-2xl font-cinzel font-bold', modRacialPor[attr.key] > 0 ? 'text-green-700' : modRacialPor[attr.key] < 0 ? 'text-blood-700' : 'text-parchment-900']">
                                        {{ atributoFinal(attr.key) }}
                                    </span>
                                    <span :class="['text-sm font-bold font-cinzel', getMod(atributoFinal(attr.key)) >= 0 ? 'text-green-700' : 'text-blood-700']">
                                        ({{ getMod(atributoFinal(attr.key)) >= 0 ? '+' : '' }}{{ getMod(atributoFinal(attr.key)) }})
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="form.metodo_atributos === 'point_buy'"
                         class="text-center p-4 rounded-lg font-cinzel font-bold text-sm"
                         :class="pontosRestantes === 0 ? 'bg-green-100 text-green-800' : pontosRestantes < 0 ? 'bg-blood-700 text-white' : 'bg-parchment-200 text-parchment-900'">
                        Pontos restantes: {{ pontosRestantes }} / {{ POINT_BUY_TOTAL }}
                    </div>
                </div>

                <!-- ============ PASSO 5: PERÍCIAS ============ -->
                <div v-if="step === 5" class="space-y-6">
                    <div v-if="!selectedClasse" class="p-6 bg-blood-700/10 border border-blood-700 rounded-lg font-lora italic text-center">
                        Escolha uma classe no passo 2 para calcular seus pontos de perícia.
                    </div>

                    <div v-else class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                        <div class="p-4 rounded-lg bg-parchment-200 border border-parchment-400">
                            <p class="text-[10px] uppercase font-cinzel opacity-60">Total (nível {{ form.nivel }})</p>
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

                    <div v-if="selectedClasse" class="p-3 bg-parchment-100 border border-parchment-300 rounded-lg text-xs font-lora text-parchment-800 flex flex-wrap gap-4 justify-center items-center">
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-green-700/60 inline-block"></span> <strong>De classe</strong>: 1 pt/grad, teto {{ nivelPersonagem + 3 }}</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-parchment-500 inline-block"></span> <strong>Fora da classe</strong>: 2 pts/grad, teto {{ Math.floor((nivelPersonagem + 3) / 2) }}</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-blood-700/60 inline-block"></span> <strong>Exclusiva de outra classe</strong>: proibida</span>
                    </div>

                    <div class="max-h-[500px] overflow-y-auto pr-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div v-for="p in pericias" :key="p.id"
                            :class="['flex items-center gap-3 p-3 rounded-lg border',
                                ehPericiaProibida(p) ? 'bg-blood-700/10 border-blood-700/40 opacity-60'
                                : ehPericiaDeClasse(p) ? 'bg-green-700/10 border-green-700/40'
                                : 'bg-parchment-200/50 border-parchment-300']">

                            <!-- Nome + habilidade chave + selo de status -->
                            <div class="flex-1 min-w-0">
                                <p class="font-lora text-sm font-bold truncate">{{ p.nome }}</p>
                                <div class="flex items-center gap-2">
                                    <p class="text-[10px] uppercase opacity-50 font-cinzel">{{ p.habilidade_chave }}</p>
                                    <span v-if="ehPericiaProibida(p)" class="text-[9px] font-cinzel font-bold uppercase bg-blood-700 text-white px-1.5 py-0.5 rounded">Proibida</span>
                                    <span v-else-if="ehPericiaDeClasse(p)" class="text-[9px] font-cinzel font-bold uppercase bg-green-700 text-white px-1.5 py-0.5 rounded">Classe · ×1</span>
                                    <span v-else class="text-[9px] font-cinzel font-bold uppercase bg-parchment-500 text-parchment-100 px-1.5 py-0.5 rounded">Fora · ×2</span>
                                </div>
                            </div>

                            <!-- Modificador da habilidade chave -->
                            <div class="text-center w-10">
                                <p class="text-[9px] font-cinzel opacity-60 uppercase leading-none">Hab</p>
                                <p :class="['text-sm font-bold font-cinzel leading-tight', modDaHabilidade(p) >= 0 ? 'text-green-700' : 'text-blood-700']">
                                    {{ modDaHabilidade(p) >= 0 ? '+' : '' }}{{ modDaHabilidade(p) }}
                                </p>
                            </div>

                            <!-- Bônus racial (só aparece se != 0) -->
                            <div v-if="bonusRacialDaPericia(p) !== 0" class="text-center w-10">
                                <p class="text-[9px] font-cinzel opacity-60 uppercase leading-none">Raça</p>
                                <p :class="['text-sm font-bold font-cinzel leading-tight', bonusRacialDaPericia(p) > 0 ? 'text-blue-700' : 'text-blood-700']">
                                    {{ bonusRacialDaPericia(p) > 0 ? '+' : '' }}{{ bonusRacialDaPericia(p) }}
                                </p>
                            </div>

                            <!-- Graduações (input) -->
                            <div class="text-center">
                                <p class="text-[9px] font-cinzel opacity-60 uppercase leading-none">Grad</p>
                                <input type="number" min="0" :max="maxGraduacoesDaPericia(p)"
                                    :value="form.pericias[p.id] ?? 0"
                                    @input="e => atualizarInputPericia(p.id, e)"
                                    :disabled="ehPericiaProibida(p) || (pontosPericiaRestantes <= 0 && graduacoesDaPericia(p) === 0)"
                                    :title="ehPericiaProibida(p) ? 'Exclusiva de outra classe' : pontosPericiaRestantes <= 0 && graduacoesDaPericia(p) === 0 ? 'Sem pontos restantes' : `Máx ${maxGraduacoesDaPericia(p)} · custa ${custoDaPericia(p)} pt(s)/grad`"
                                    class="w-12 bg-parchment-100 border border-parchment-400 rounded px-1 py-0.5 text-center font-bold text-sm disabled:opacity-40 disabled:cursor-not-allowed">
                                <p class="text-[9px] font-cinzel opacity-50 leading-none mt-0.5">/{{ maxGraduacoesDaPericia(p) }}</p>
                            </div>

                            <!-- Total -->
                            <div class="text-center w-12 border-l border-parchment-400 pl-2">
                                <p class="text-[9px] font-cinzel opacity-60 uppercase leading-none">Total</p>
                                <p :class="['text-lg font-bold font-cinzel leading-tight', totalDaPericia(p) >= 0 ? 'text-parchment-900' : 'text-blood-700']">
                                    {{ totalDaPericia(p) >= 0 ? '+' : '' }}{{ totalDaPericia(p) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============ PASSO 6: TALENTOS ============ -->
                <div v-if="step === 6" class="space-y-6">
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
                                    :disabled="(!form.talentos.includes(t.id)) && (!talentoAtendePreRequisitos(t) || talentosDisponiveis === 0)"
                                    :class="['text-left p-3 rounded-lg border-2 transition',
                                            form.talentos.includes(t.id)
                                                ? 'border-blood-700 bg-blood-700/10 shadow'
                                                : !talentoAtendePreRequisitos(t)
                                                    ? 'border-parchment-300 bg-parchment-300/30 opacity-50 cursor-not-allowed'
                                                    : 'border-parchment-300 hover:border-parchment-600 disabled:opacity-40 disabled:hover:border-parchment-300']">
                                    <div class="flex items-start justify-between gap-2">
                                        <p class="font-cinzel font-bold text-sm">{{ t.nome }}</p>
                                        <i v-if="!talentoAtendePreRequisitos(t)"
                                           class="fa-solid fa-lock text-blood-700 text-xs mt-0.5"
                                           title="Pré-requisitos não atendidos"></i>
                                        <i v-else-if="form.talentos.includes(t.id)"
                                           class="fa-solid fa-check text-green-700 text-xs mt-0.5"></i>
                                    </div>

                                    <div v-if="t.pre_requisitos && preReqsPorTalento[t.id]?.itens?.length" class="mt-1 space-y-0.5">
                                        <p class="text-[10px] font-cinzel uppercase opacity-60 tracking-widest">Pré-requisitos</p>
                                        <ul class="text-[10px] italic space-y-0.5">
                                            <li v-for="(item, idx) in preReqsPorTalento[t.id].itens" :key="idx"
                                                :class="item.ok ? 'text-green-700' : 'text-blood-700'">
                                                <i :class="['fa-solid mr-1', item.ok ? 'fa-circle-check' : 'fa-circle-xmark']"></i>
                                                {{ item.texto }}
                                            </li>
                                        </ul>
                                    </div>

                                    <p class="text-xs font-lora mt-2">{{ t.beneficio }}</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============ PASSO 7: ARSENAL & PROVISÕES ============ -->
                <div v-if="step === 7" class="space-y-6">
                    <div v-if="!selectedClasse" class="p-6 bg-blood-700/10 border border-blood-700 rounded-lg font-lora italic text-center">
                        Escolha uma classe no passo 3 para calcular seu ouro inicial.
                    </div>

                    <template v-else>
                        <!-- Painel de status: ouro e carga -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-center">
                            <div class="p-3 rounded-lg bg-parchment-200 border border-parchment-400">
                                <p class="text-[10px] uppercase font-cinzel opacity-60">Ouro Inicial</p>
                                <p class="text-xl font-cinzel font-bold text-parchment-900">{{ ouroInicial }} PO</p>
                            </div>
                            <div class="p-3 rounded-lg bg-parchment-200 border border-parchment-400">
                                <p class="text-[10px] uppercase font-cinzel opacity-60">Gasto</p>
                                <p class="text-xl font-cinzel font-bold text-parchment-900">{{ ouroGasto }} PO</p>
                            </div>
                            <div :class="['p-3 rounded-lg border font-cinzel font-bold',
                                ouroRestante < 0 ? 'bg-blood-700 text-parchment-100 border-blood-800' : 'bg-green-700/10 border-green-700/40']">
                                <p class="text-[10px] uppercase opacity-60">Restante</p>
                                <p class="text-xl">{{ ouroRestante }} PO</p>
                            </div>
                            <div :class="['p-3 rounded-lg border font-cinzel', nivelCarga.cor]">
                                <p class="text-[10px] uppercase opacity-70">Carga</p>
                                <p class="text-xl font-bold">{{ pesoTotal }} kg</p>
                                <p class="text-[10px] opacity-70">{{ nivelCarga.label }}</p>
                            </div>
                        </div>

                        <!-- Capacidade de carga por FOR -->
                        <div class="p-3 bg-parchment-100 border border-parchment-300 rounded-lg text-xs font-lora text-parchment-800 flex flex-wrap gap-4 justify-center items-center">
                            <span class="font-cinzel font-bold uppercase text-[10px] opacity-70">Capacidade (FOR {{ forcaFinal }})</span>
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-green-700/60 inline-block"></span> <strong>Leve</strong>: até {{ cargaLeveMax }} kg</span>
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-yellow-600/60 inline-block"></span> <strong>Média</strong>: até {{ cargaMediaMax }} kg</span>
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-orange-700/60 inline-block"></span> <strong>Pesada</strong>: até {{ cargaPesadaMax }} kg</span>
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-blood-700/60 inline-block"></span> <strong>Máximo</strong>: {{ cargaPesadaMax }} kg</span>
                        </div>

                        <!-- Abas do Arsenal -->
                        <div class="flex border-b-2 border-parchment-400 gap-1">
                            <button type="button" @click="abaArsenal = 'armaduras'"
                                :class="['px-6 py-3 font-cinzel font-bold uppercase text-sm tracking-wider rounded-t-lg border-2 border-b-0 transition',
                                    abaArsenal === 'armaduras' ? 'bg-parchment-100 border-parchment-400 text-blood-800' : 'bg-parchment-300/40 border-transparent text-parchment-700 hover:text-parchment-900']">
                                <i class="fa-solid fa-shield-halved mr-2"></i>
                                Armaduras
                                <span v-if="form.armaduras.length" class="ml-2 text-xs bg-blood-700 text-parchment-100 rounded-full px-2 py-0.5">{{ form.armaduras.length }}</span>
                            </button>
                            <button type="button" @click="abaArsenal = 'armas'"
                                :class="['px-6 py-3 font-cinzel font-bold uppercase text-sm tracking-wider rounded-t-lg border-2 border-b-0 transition',
                                    abaArsenal === 'armas' ? 'bg-parchment-100 border-parchment-400 text-blood-800' : 'bg-parchment-300/40 border-transparent text-parchment-700 hover:text-parchment-900']">
                                <i class="fa-solid fa-khanda mr-2"></i>
                                Armas
                                <span v-if="Object.keys(form.armas).length" class="ml-2 text-xs bg-blood-700 text-parchment-100 rounded-full px-2 py-0.5">{{ Object.values(form.armas).reduce((s, q) => s + Number(q || 0), 0) }}</span>
                            </button>
                            <button type="button" @click="abaArsenal = 'equipamentos'"
                                :class="['px-6 py-3 font-cinzel font-bold uppercase text-sm tracking-wider rounded-t-lg border-2 border-b-0 transition',
                                    abaArsenal === 'equipamentos' ? 'bg-parchment-100 border-parchment-400 text-blood-800' : 'bg-parchment-300/40 border-transparent text-parchment-700 hover:text-parchment-900']">
                                <i class="fa-solid fa-bag-shopping mr-2"></i>
                                Equipamentos
                                <span v-if="Object.keys(form.equipamentos).length" class="ml-2 text-xs bg-blood-700 text-parchment-100 rounded-full px-2 py-0.5">{{ Object.values(form.equipamentos).reduce((s, q) => s + Number(q || 0), 0) }}</span>
                            </button>
                        </div>

                        <!-- ABA: ARMADURAS (toggle simples — não há quantidade) -->
                        <div v-show="abaArsenal === 'armaduras'" class="space-y-4">
                            <p class="text-xs italic font-lora text-parchment-700">
                                <i class="fa-solid fa-info-circle mr-1"></i>
                                Armaduras funcionam como itens únicos (uma ou nenhuma). Você pode carregar mais de uma peça se quiser (ex.: armadura reserva), clicando novamente para desmarcar.
                            </p>
                            <div v-for="(lista, tipo) in armadurasPorTipo" :key="tipo" class="mb-4">
                                <p class="font-cinzel font-bold uppercase text-xs text-parchment-700 mb-2">{{ tipo }}</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    <button v-for="a in lista" :key="a.id" type="button"
                                        @click="toggleItem(form.armaduras, a.id)"
                                        :class="['text-left p-3 rounded-lg border-2 transition text-sm',
                                            form.armaduras.includes(a.id) ? 'border-blood-700 bg-blood-700/10 shadow' : 'border-parchment-300 hover:border-parchment-600']">
                                        <div class="flex items-start justify-between gap-2">
                                            <p class="font-cinzel font-bold">{{ a.nome }}</p>
                                            <i v-if="form.armaduras.includes(a.id)" class="fa-solid fa-check text-green-700 text-xs mt-0.5"></i>
                                        </div>
                                        <div class="flex flex-wrap gap-x-3 gap-y-0.5 mt-1 text-[11px] font-lora">
                                            <span><strong>CA</strong>: +{{ a.bonus_ca }}</span>
                                            <span v-if="a.destreza_max !== null"><strong>DES máx</strong>: +{{ a.destreza_max }}</span>
                                            <span><strong>Peso</strong>: {{ a.peso }} kg</span>
                                            <span class="text-blood-700"><strong>Preço</strong>: {{ a.preco }}</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- ABA: ARMAS (com quantidade) -->
                        <div v-show="abaArsenal === 'armas'" class="space-y-4">
                            <p class="text-xs italic font-lora text-parchment-700">
                                <i class="fa-solid fa-info-circle mr-1"></i>
                                Use os botões − e + para ajustar quantidades (ex.: 4 adagas de arremesso, 2 lanças curtas).
                            </p>
                            <div v-for="(lista, categoria) in armasPorCategoria" :key="categoria" class="mb-4">
                                <p class="font-cinzel font-bold uppercase text-xs text-parchment-700 mb-2">{{ categoria }}</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    <div v-for="w in lista" :key="w.id"
                                        :class="['flex items-center gap-3 p-3 rounded-lg border-2 transition text-sm',
                                            (form.armas[w.id] || 0) > 0 ? 'border-blood-700 bg-blood-700/10' : 'border-parchment-300']">
                                        <div class="flex-1 min-w-0">
                                            <p class="font-cinzel font-bold">{{ w.nome }}</p>
                                            <div class="flex flex-wrap gap-x-3 gap-y-0.5 mt-1 text-[11px] font-lora">
                                                <span><strong>Dano</strong>: {{ w.dano_m }}</span>
                                                <span><strong>Crit</strong>: {{ w.critico }}</span>
                                                <span v-if="w.alcance && w.alcance !== '-'"><strong>Alcance</strong>: {{ w.alcance }}</span>
                                                <span><strong>Peso</strong>: {{ w.peso }} kg</span>
                                                <span class="text-blood-700"><strong>Preço</strong>: {{ w.preco }}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-1.5 flex-shrink-0">
                                            <button type="button" @click="decQtd(form.armas, w.id)"
                                                :disabled="!form.armas[w.id]"
                                                class="w-8 h-8 rounded-full bg-parchment-300 hover:bg-blood-700 hover:text-white font-bold text-lg disabled:opacity-30 disabled:cursor-not-allowed transition">−</button>
                                            <span class="w-8 text-center font-cinzel font-bold text-lg">{{ form.armas[w.id] || 0 }}</span>
                                            <button type="button" @click="incQtd(form.armas, w.id)"
                                                class="w-8 h-8 rounded-full bg-parchment-300 hover:bg-blood-700 hover:text-white font-bold text-lg transition">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ABA: EQUIPAMENTOS (com quantidade) -->
                        <div v-show="abaArsenal === 'equipamentos'" class="space-y-4">
                            <p class="text-xs italic font-lora text-parchment-700">
                                <i class="fa-solid fa-info-circle mr-1"></i>
                                Provisões e itens diversos aceitam quantidades (ex.: 4 rações para viagem, 5 tochas, 2 potes de óleo).
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div v-for="e in equipamentos" :key="e.id"
                                    :class="['flex items-center gap-3 p-3 rounded-lg border-2 transition text-sm',
                                        (form.equipamentos[e.id] || 0) > 0 ? 'border-blood-700 bg-blood-700/10' : 'border-parchment-300']">
                                    <div class="flex-1 min-w-0">
                                        <p class="font-cinzel font-bold">{{ e.nome }}</p>
                                        <p v-if="e.descricao" class="text-[11px] italic opacity-70 mt-0.5">{{ e.descricao }}</p>
                                        <div class="flex flex-wrap gap-x-3 gap-y-0.5 mt-1 text-[11px] font-lora">
                                            <span><strong>Peso</strong>: {{ e.peso }} kg</span>
                                            <span class="text-blood-700"><strong>Preço</strong>: {{ e.preco }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1.5 flex-shrink-0">
                                        <button type="button" @click="decQtd(form.equipamentos, e.id)"
                                            :disabled="!form.equipamentos[e.id]"
                                            class="w-8 h-8 rounded-full bg-parchment-300 hover:bg-blood-700 hover:text-white font-bold text-lg disabled:opacity-30 disabled:cursor-not-allowed transition">−</button>
                                        <span class="w-8 text-center font-cinzel font-bold text-lg">{{ form.equipamentos[e.id] || 0 }}</span>
                                        <button type="button" @click="incQtd(form.equipamentos, e.id)"
                                            class="w-8 h-8 rounded-full bg-parchment-300 hover:bg-blood-700 hover:text-white font-bold text-lg transition">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Erros globais (aparecem se o submit falhar na validação do servidor) -->
                <div v-if="Object.keys(form.errors).length" class="mt-8 p-4 bg-blood-700/10 border-2 border-blood-700 rounded-lg">
                    <p class="font-cinzel font-bold text-blood-800 uppercase text-sm mb-2">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                        A forja rejeitou o registro. Corrija os itens abaixo:
                    </p>
                    <ul class="text-sm font-lora text-blood-800 list-disc list-inside space-y-1">
                        <li v-for="(msg, campo) in form.errors" :key="campo">
                            <span class="font-bold">{{ campo }}:</span> {{ msg }}
                        </li>
                    </ul>
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
