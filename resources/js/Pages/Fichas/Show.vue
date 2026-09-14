<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    ficha: Object
});

const mod = (score) => Math.floor((Number(score) - 10) / 2);

const mods = computed(() => ({
    forca:        mod(props.ficha.forca_base),
    destreza:     mod(props.ficha.destreza_base),
    constituicao: mod(props.ficha.constituicao_base),
    inteligencia: mod(props.ficha.inteligencia_base),
    sabedoria:    mod(props.ficha.sabedoria_base),
    carisma:      mod(props.ficha.carisma_base),
}));

const habChaveKey = (chave) => {
    const map = {
        'forca': 'forca', 'força': 'forca', 'for': 'forca',
        'destreza': 'destreza', 'des': 'destreza',
        'constituicao': 'constituicao', 'constituição': 'constituicao', 'con': 'constituicao',
        'inteligencia': 'inteligencia', 'inteligência': 'inteligencia', 'int': 'inteligencia',
        'sabedoria': 'sabedoria', 'sab': 'sabedoria',
        'carisma': 'carisma', 'car': 'carisma',
    };
    return map[String(chave || '').toLowerCase()] || null;
};

const sign = (n) => (n >= 0 ? '+' : '') + n;

const caTotal = computed(() =>
    10
    + Number(props.ficha.ca_armadura || 0)
    + Number(props.ficha.ca_escudo || 0)
    + mods.value.destreza
    + Number(props.ficha.ca_tamanho || 0)
    + Number(props.ficha.ca_natural || 0)
    + Number(props.ficha.ca_deflexao || 0)
    + Number(props.ficha.ca_misc || 0)
);

const caToque = computed(() =>
    10
    + mods.value.destreza
    + Number(props.ficha.ca_tamanho || 0)
    + Number(props.ficha.ca_deflexao || 0)
    + Number(props.ficha.ca_misc || 0)
);

const caSurpreso = computed(() =>
    caTotal.value - Math.max(0, mods.value.destreza)
);

const iniciativa = computed(() =>
    mods.value.destreza + Number(props.ficha.iniciativa_misc || 0)
);

const saves = computed(() => {
    const buildSave = (base, hab, magia, misc) => {
        const b = Number(base || 0);
        const m = Number(misc || 0);
        const mg = Number(magia || 0);
        return { base: b, hab, magia: mg, misc: m, total: b + hab + mg + m };
    };
    return {
        fortitude: buildSave(props.ficha.fortitude_base, mods.value.constituicao, props.ficha.fortitude_magia, props.ficha.fortitude_misc),
        reflexos:  buildSave(props.ficha.reflexos_base,  mods.value.destreza,     props.ficha.reflexos_magia,  props.ficha.reflexos_misc),
        vontade:   buildSave(props.ficha.vontade_base,   mods.value.sabedoria,    props.ficha.vontade_magia,   props.ficha.vontade_misc),
    };
});

const bab = computed(() => Number(props.ficha.bab || 0));
const atkCorpo = computed(() => bab.value + mods.value.forca + Number(props.ficha.ca_tamanho || 0));
const atkDist  = computed(() => bab.value + mods.value.destreza + Number(props.ficha.ca_tamanho || 0));
const agarrar  = computed(() => bab.value + mods.value.forca + Number(props.ficha.agarre_tamanho || 0) + Number(props.ficha.agarre_misc || 0));

const periciasCalc = computed(() => {
    const list = (props.ficha.pericias || []).map(p => {
        const key = habChaveKey(p.habilidade_chave);
        const habMod = key ? mods.value[key] : 0;
        const grad = Number(p.pivot?.graduacoes || 0);
        return {
            id: p.id,
            nome: p.nome,
            chave: (p.habilidade_chave || '').toString().toUpperCase().slice(0, 3),
            grad,
            hab: habMod,
            total: Math.floor(grad + habMod),
        };
    });
    return list.sort((a, b) => a.nome.localeCompare(b.nome, 'pt-BR'));
});

const magiasPorNivel = computed(() => {
    const grupos = { 0: [], 1: [], 2: [], 3: [], 4: [], 5: [], 6: [], 7: [], 8: [], 9: [] };
    const classeId = props.ficha.classe_id;
    for (const m of (props.ficha.magias || [])) {
        let nivel = null;
        for (const c of (m.classes || [])) {
            if (c.id === classeId) { nivel = Number(c.pivot?.nivel ?? 0); break; }
        }
        if (nivel === null && (m.classes || []).length) {
            nivel = Number(m.classes[0].pivot?.nivel ?? 0);
        }
        nivel = nivel ?? 0;
        if (nivel >= 0 && nivel <= 9) grupos[nivel].push(m);
    }
    return grupos;
});

const totalMagias = computed(() =>
    Object.values(magiasPorNivel.value).reduce((s, arr) => s + arr.length, 0)
);

const cargas = computed(() => {
    const str = Number(props.ficha.forca_base || 0);
    const base = {
        1:3, 2:6, 3:10, 4:13, 5:16, 6:20, 7:23, 8:26, 9:30, 10:33,
        11:38, 12:43, 13:50, 14:58, 15:66, 16:76, 17:86, 18:100, 19:116, 20:133,
        21:153, 22:173, 23:200, 24:233, 25:266, 26:306, 27:346, 28:400, 29:466,
    };
    let leve = 0;
    if (str >= 1) {
        if (str <= 29) leve = base[str];
        else {
            const ciclos = Math.trunc((str - 20) / 10);
            const resto = 20 + ((str - 20) % 10);
            leve = Math.round(base[resto] * Math.pow(4, ciclos));
        }
    }
    const pesada = leve * 3;
    return {
        leve, media: leve * 2, pesada,
        levantarCabeca: pesada,
        levantarSolo: pesada * 2,
        arrastar: pesada * 5,
    };
});

const pesoEquipado = computed(() => {
    let total = 0;
    for (const a of (props.ficha.armas || [])) {
        total += Number(a.peso || 0) * Number(a.pivot?.quantidade || 1);
    }
    for (const a of (props.ficha.armaduras || [])) {
        total += Number(a.peso || 0);
    }
    for (const e of (props.ficha.equipamentos || [])) {
        total += Number(e.peso || 0) * Number(e.pivot?.quantidade || 1);
    }
    return total;
});

const aparencia = computed(() => {
    const parts = [
        props.ficha.tamanho ? 'Estatura ' + String(props.ficha.tamanho).toLowerCase() : null,
        props.ficha.altura ? `${props.ficha.altura}m de altura` : null,
        props.ficha.peso ? `${props.ficha.peso}kg` : null,
        props.ficha.olhos ? 'olhos ' + String(props.ficha.olhos).toLowerCase() : null,
        props.ficha.cabelos ? 'cabelos ' + String(props.ficha.cabelos).toLowerCase() : null,
        props.ficha.pele ? 'pele ' + String(props.ficha.pele).toLowerCase() : null,
    ].filter(Boolean);
    if (!parts.length) return null;
    const s = parts.join(', ');
    return s.charAt(0).toUpperCase() + s.slice(1) + '.';
});

const attrDefs = [
    { key: 'forca',        label: 'FOR', field: 'forca_base' },
    { key: 'destreza',     label: 'DES', field: 'destreza_base' },
    { key: 'constituicao', label: 'CON', field: 'constituicao_base' },
    { key: 'inteligencia', label: 'INT', field: 'inteligencia_base' },
    { key: 'sabedoria',    label: 'SAB', field: 'sabedoria_base' },
    { key: 'carisma',      label: 'CAR', field: 'carisma_base' },
];

const xpFaltando = computed(() =>
    Math.max(0, Number(props.ficha.xp_proximo || 0) - Number(props.ficha.xp_atual || 0))
);

const openPrint = () => window.print();
</script>

<template>
    <AppLayout>
        <Head :title="'Ficha: ' + ficha.nome_personagem" />

        <div class="mb-6 flex justify-between items-center flex-wrap gap-2">
            <Link :href="route('fichas.index')" class="text-parchment-800 font-cinzel hover:text-blood-700 transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Voltar ao Salão
            </Link>
            <div class="flex space-x-2 flex-wrap gap-2">
                <Link :href="route('fichas.edit', ficha.id)" class="bg-blue-700 text-white px-6 py-2 rounded font-cinzel shadow-md hover:bg-blue-800 transition">
                    <i class="fa-solid fa-pen-nib mr-2"></i> Editar Ficha
                </Link>
                <a :href="route('fichas.pdf', ficha.id)" class="bg-parchment-900 text-white px-6 py-2 rounded font-cinzel shadow-md hover:bg-parchment-800 transition">
                    <i class="fa-solid fa-file-pdf mr-2"></i> Baixar PDF
                </a>
                <button class="bg-blood-700 text-white px-6 py-2 rounded font-cinzel shadow-md hover:bg-blood-800 transition" @click="openPrint">
                    <i class="fa-solid fa-print mr-2"></i> Imprimir
                </button>
            </div>
        </div>

        <div class="glass-parchment shadow-2xl rounded-sm border-2 border-parchment-900 bg-parchment-pattern max-w-7xl mx-auto printable-sheet overflow-hidden">

            <!-- Banner -->
            <div class="bg-parchment-900 text-parchment-100 px-8 py-5 border-b-4 border-blood-700">
                <h1 class="text-3xl md:text-4xl font-cinzel font-bold tracking-widest uppercase">{{ ficha.nome_personagem || '—' }}</h1>
                <p class="text-sm mt-1 tracking-wider opacity-80 font-lora">
                    {{ ficha.classe?.nome || '—' }} nível {{ ficha.nivel }}
                    · {{ ficha.raca?.nome || '—' }}
                    · {{ ficha.tendencia?.nome || '—' }}
                    <template v-if="ficha.divindade"> · Devoto(a) de <span class="italic">{{ ficha.divindade }}</span></template>
                </p>
            </div>

            <div class="p-6 md:p-8 space-y-5">

                <!-- Identidade -->
                <section class="section-frame">
                    <h2 class="section-title">Identidade</h2>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 px-4 py-3">
                        <div class="kv"><span>Jogador</span><p>{{ ficha.nome_jogador || '—' }}</p></div>
                        <div class="kv"><span>Tamanho</span><p>{{ ficha.tamanho || '—' }}</p></div>
                        <div class="kv"><span>Idade</span><p>{{ ficha.idade || '—' }}</p></div>
                        <div class="kv"><span>Sexo</span><p>{{ ficha.sexo || '—' }}</p></div>
                        <div class="kv"><span>Deslocamento</span><p>{{ ficha.deslocamento || '—' }}</p></div>
                        <div class="kv"><span>Altura</span><p>{{ ficha.altura ? ficha.altura + ' m' : '—' }}</p></div>
                        <div class="kv"><span>Peso</span><p>{{ ficha.peso ? ficha.peso + ' kg' : '—' }}</p></div>
                        <div class="kv"><span>Olhos</span><p>{{ ficha.olhos || '—' }}</p></div>
                        <div class="kv"><span>Cabelos</span><p>{{ ficha.cabelos || '—' }}</p></div>
                        <div class="kv"><span>Pele</span><p>{{ ficha.pele || '—' }}</p></div>
                    </div>
                </section>

                <!-- Atributos + Vitais + Combate -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                    <!-- Atributos -->
                    <section class="section-frame lg:col-span-3">
                        <h2 class="section-title">Atributos</h2>
                        <div class="p-4 space-y-2">
                            <div v-for="a in attrDefs" :key="a.key" class="flex items-stretch">
                                <div class="bg-parchment-900 text-parchment-100 w-14 flex flex-col items-center justify-center rounded-l">
                                    <span class="text-[8px] font-cinzel font-bold tracking-widest opacity-70">{{ a.label }}</span>
                                    <span class="text-lg font-cinzel font-bold">{{ sign(mods[a.key]) }}</span>
                                </div>
                                <div class="flex-grow border-2 border-parchment-900 border-l-0 p-2 text-center rounded-r bg-parchment-50">
                                    <p class="text-2xl font-cinzel font-bold text-parchment-900">{{ ficha[a.field] }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Vitais + Resistências + Combate -->
                    <section class="lg:col-span-6 space-y-4">
                        <!-- Vitais -->
                        <div class="section-frame">
                            <h2 class="section-title">Sinais Vitais</h2>
                            <div class="grid grid-cols-4 gap-2 p-4">
                                <div class="stat-box">
                                    <p class="stat-label">PV Máx.</p>
                                    <p class="stat-value">{{ ficha.pv_max }}</p>
                                </div>
                                <div class="stat-box">
                                    <p class="stat-label">PV Atual</p>
                                    <p class="stat-value">{{ ficha.pv_atual }}</p>
                                </div>
                                <div class="stat-box">
                                    <p class="stat-label">CA</p>
                                    <p class="stat-value text-blood-700">{{ caTotal }}</p>
                                </div>
                                <div class="stat-box">
                                    <p class="stat-label">Iniciativa</p>
                                    <p class="stat-value">{{ sign(iniciativa) }}</p>
                                </div>
                                <div class="stat-box col-span-2">
                                    <p class="stat-label">CA Toque</p>
                                    <p class="stat-value">{{ caToque }}</p>
                                </div>
                                <div class="stat-box col-span-2">
                                    <p class="stat-label">CA Surpreso</p>
                                    <p class="stat-value">{{ caSurpreso }}</p>
                                </div>
                            </div>
                            <div class="px-4 pb-3">
                                <table class="w-full text-[10px] text-center">
                                    <thead>
                                        <tr class="text-parchment-800 font-cinzel">
                                            <th class="py-1">Armad.</th>
                                            <th>Escudo</th>
                                            <th>Des</th>
                                            <th>Tam.</th>
                                            <th>Nat.</th>
                                            <th>Defl.</th>
                                            <th>Div.</th>
                                        </tr>
                                    </thead>
                                    <tbody class="font-cinzel">
                                        <tr class="border-t border-parchment-900/20">
                                            <td>{{ sign(Number(ficha.ca_armadura || 0)) }}</td>
                                            <td>{{ sign(Number(ficha.ca_escudo || 0)) }}</td>
                                            <td>{{ sign(mods.destreza) }}</td>
                                            <td>{{ sign(Number(ficha.ca_tamanho || 0)) }}</td>
                                            <td>{{ sign(Number(ficha.ca_natural || 0)) }}</td>
                                            <td>{{ sign(Number(ficha.ca_deflexao || 0)) }}</td>
                                            <td>{{ sign(Number(ficha.ca_misc || 0)) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Resistências -->
                        <div class="section-frame">
                            <h2 class="section-title">Testes de Resistência</h2>
                            <div class="p-4">
                                <table class="w-full text-sm">
                                    <thead class="text-[10px] uppercase font-cinzel text-parchment-800">
                                        <tr>
                                            <th class="text-left py-1">Teste</th>
                                            <th class="py-1">Total</th>
                                            <th>Base</th>
                                            <th>Hab.</th>
                                            <th>Mág.</th>
                                            <th>Div.</th>
                                        </tr>
                                    </thead>
                                    <tbody class="font-cinzel">
                                        <tr v-for="(save, key) in saves" :key="key" class="border-t border-parchment-900/10">
                                            <td class="py-1 font-bold text-blood-700 capitalize">{{ key }}</td>
                                            <td class="text-center text-lg font-bold">{{ sign(save.total) }}</td>
                                            <td class="text-center">{{ sign(save.base) }}</td>
                                            <td class="text-center">{{ sign(save.hab) }}</td>
                                            <td class="text-center">{{ sign(save.magia) }}</td>
                                            <td class="text-center">{{ sign(save.misc) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Combate -->
                        <div class="section-frame">
                            <h2 class="section-title">Combate</h2>
                            <div class="grid grid-cols-3 gap-2 p-4">
                                <div class="stat-box"><p class="stat-label">BAB</p><p class="stat-value">{{ sign(bab) }}</p></div>
                                <div class="stat-box"><p class="stat-label">Corpo a Corpo</p><p class="stat-value">{{ sign(atkCorpo) }}</p></div>
                                <div class="stat-box"><p class="stat-label">Distância</p><p class="stat-value">{{ sign(atkDist) }}</p></div>
                                <div class="stat-box"><p class="stat-label">Agarrar</p><p class="stat-value">{{ sign(agarrar) }}</p></div>
                                <div class="stat-box"><p class="stat-label">Iniciativa</p><p class="stat-value">{{ sign(iniciativa) }}</p></div>
                                <div class="stat-box"><p class="stat-label">Deslocamento</p><p class="stat-value text-base">{{ ficha.deslocamento || '—' }}</p></div>
                            </div>
                        </div>
                    </section>

                    <!-- Perícias -->
                    <section class="section-frame lg:col-span-3">
                        <h2 class="section-title">Perícias ({{ periciasCalc.length }})</h2>
                        <div class="p-3">
                            <p v-if="!periciasCalc.length" class="text-parchment-800 italic text-sm text-center py-4">
                                Nenhuma perícia com graduações.
                            </p>
                            <table v-else class="w-full text-[11px]">
                                <thead class="text-[9px] uppercase font-cinzel text-parchment-800">
                                    <tr>
                                        <th class="text-left py-1">Perícia</th>
                                        <th>Hab.</th>
                                        <th class="pr-1">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in periciasCalc" :key="p.id" class="border-t border-parchment-900/10">
                                        <td class="py-[3px]">{{ p.nome }}</td>
                                        <td class="text-center text-parchment-800">{{ p.chave || '—' }}</td>
                                        <td class="text-center font-cinzel font-bold text-blood-700 pr-1">{{ sign(p.total) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

                <!-- Armas & Armaduras -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <section class="section-frame">
                        <h2 class="section-title">Armas &amp; Ataques ({{ (ficha.armas || []).length }})</h2>
                        <div class="p-3">
                            <p v-if="!(ficha.armas || []).length" class="text-parchment-800 italic text-sm text-center py-3">Nenhuma arma registrada.</p>
                            <table v-else class="w-full text-xs">
                                <thead class="text-[9px] uppercase font-cinzel text-parchment-800 border-b border-parchment-900/30">
                                    <tr>
                                        <th class="text-left py-1">Nome</th>
                                        <th>Dano</th>
                                        <th>Crítico</th>
                                        <th>Alcance</th>
                                        <th>Tipo</th>
                                        <th>Peso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="a in ficha.armas" :key="a.id" class="border-b border-parchment-900/10">
                                        <td class="py-1">
                                            <span class="font-bold text-parchment-900">{{ a.nome }}</span>
                                            <span v-if="(a.pivot?.quantidade || 1) > 1" class="text-parchment-700 text-[10px]"> ×{{ a.pivot.quantidade }}</span>
                                        </td>
                                        <td class="text-center">{{ a.dano_m || a.dano_p || '—' }}</td>
                                        <td class="text-center">{{ a.critico || '—' }}</td>
                                        <td class="text-center">{{ a.alcance || '—' }}</td>
                                        <td class="text-center">{{ a.tipo || '—' }}</td>
                                        <td class="text-center">{{ a.peso ? a.peso + 'kg' : '—' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <section class="section-frame">
                        <h2 class="section-title">Armaduras &amp; Escudo ({{ (ficha.armaduras || []).length }})</h2>
                        <div class="p-3">
                            <p v-if="!(ficha.armaduras || []).length" class="text-parchment-800 italic text-sm text-center py-3">Sem proteções vestidas.</p>
                            <table v-else class="w-full text-xs">
                                <thead class="text-[9px] uppercase font-cinzel text-parchment-800 border-b border-parchment-900/30">
                                    <tr>
                                        <th class="text-left py-1">Nome</th>
                                        <th>Bônus</th>
                                        <th>Máx Des</th>
                                        <th>Penal.</th>
                                        <th>Falha</th>
                                        <th>Peso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="a in ficha.armaduras" :key="a.id" class="border-b border-parchment-900/10">
                                        <td class="py-1 font-bold text-parchment-900">{{ a.nome }}</td>
                                        <td class="text-center">{{ sign(Number(a.bonus_ca || 0)) }}</td>
                                        <td class="text-center">{{ a.destreza_max ?? '—' }}</td>
                                        <td class="text-center">{{ Number(a.penalidade_armadura || 0) }}</td>
                                        <td class="text-center">{{ a.falha_arcana != null ? a.falha_arcana + '%' : '—' }}</td>
                                        <td class="text-center">{{ a.peso ? a.peso + 'kg' : '—' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

                <!-- Talentos & Habilidades Especiais -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <section class="section-frame">
                        <h2 class="section-title">Talentos ({{ (ficha.talentos || []).length }})</h2>
                        <div class="p-3 space-y-2">
                            <p v-if="!(ficha.talentos || []).length" class="text-parchment-800 italic text-sm text-center py-3">Sem talentos adquiridos.</p>
                            <div v-for="t in ficha.talentos" :key="t.id" class="border-l-4 border-blood-700 bg-parchment-50/70 pl-3 pr-2 py-2">
                                <div class="flex justify-between items-baseline">
                                    <p class="font-cinzel font-bold text-parchment-900">{{ t.nome }}</p>
                                    <span v-if="t.tipo" class="text-[10px] uppercase tracking-wider text-blood-700 italic">{{ t.tipo }}</span>
                                </div>
                                <p v-if="t.beneficio" class="text-xs mt-1 leading-snug text-parchment-900/90">{{ t.beneficio }}</p>
                            </div>
                        </div>
                    </section>

                    <section class="section-frame">
                        <h2 class="section-title">Habilidades Especiais</h2>
                        <div class="p-4 text-sm font-lora whitespace-pre-line leading-relaxed">
                            <template v-if="ficha.habilidades_especiais">{{ ficha.habilidades_especiais }}</template>
                            <p v-else class="text-parchment-800 italic text-center py-3">Nenhuma habilidade especial registrada.</p>
                        </div>
                    </section>
                </div>

                <!-- Grimório -->
                <section class="section-frame" v-if="totalMagias > 0">
                    <h2 class="section-title">Grimório de Magias ({{ totalMagias }})</h2>
                    <div class="p-3 space-y-2">
                        <template v-for="(magias, nivel) in magiasPorNivel" :key="nivel">
                            <div v-if="magias.length" class="border border-parchment-900/20 rounded bg-parchment-50/60 px-3 py-2">
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="bg-magic-700 text-parchment-100 font-cinzel font-bold text-[10px] px-2 py-[2px] rounded tracking-widest">NÍVEL {{ nivel }}</span>
                                    <span class="text-parchment-800 text-[10px] italic">{{ magias.length }} {{ magias.length === 1 ? 'magia' : 'magias' }}</span>
                                </div>
                                <div class="text-xs leading-relaxed">
                                    <span v-for="(m, i) in magias" :key="m.id">
                                        <span class="text-parchment-900">{{ m.nome }}</span>
                                        <span v-if="m.escola" class="text-parchment-700 italic"> ({{ m.escola.substring(0, 3) }})</span>
                                        <span v-if="i < magias.length - 1" class="text-parchment-800"> · </span>
                                    </span>
                                </div>
                            </div>
                        </template>
                    </div>
                </section>

                <!-- Equipamentos + Bolsa/Carga/XP -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <section class="section-frame">
                        <h2 class="section-title">Equipamentos ({{ (ficha.equipamentos || []).length }})</h2>
                        <div class="p-3">
                            <p v-if="!(ficha.equipamentos || []).length" class="text-parchment-800 italic text-sm text-center py-3">Sem equipamentos registrados.</p>
                            <table v-else class="w-full text-xs">
                                <thead class="text-[9px] uppercase font-cinzel text-parchment-800 border-b border-parchment-900/30">
                                    <tr>
                                        <th class="text-left py-1">Item</th>
                                        <th>Categoria</th>
                                        <th>Qtd</th>
                                        <th>Peso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="e in ficha.equipamentos" :key="e.id" class="border-b border-parchment-900/10">
                                        <td class="py-1">{{ e.nome }}</td>
                                        <td class="text-center text-parchment-800">{{ e.categoria || '—' }}</td>
                                        <td class="text-center">{{ e.pivot?.quantidade || 1 }}</td>
                                        <td class="text-center">{{ e.peso ? e.peso + 'kg' : '—' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <div class="space-y-4">
                        <section class="section-frame">
                            <h2 class="section-title">Bolsa &amp; Riqueza</h2>
                            <div class="p-4 grid grid-cols-3 gap-3 text-center">
                                <div class="stat-box"><p class="stat-label">Cobre</p><p class="stat-value text-blood-700">{{ Number(ficha.dinheiro_pc || 0) }}</p></div>
                                <div class="stat-box"><p class="stat-label">Prata</p><p class="stat-value text-blood-700">{{ Number(ficha.dinheiro_pp || 0) }}</p></div>
                                <div class="stat-box"><p class="stat-label">Ouro</p><p class="stat-value text-blood-700">{{ Number(ficha.dinheiro_pl || 0) }}</p></div>
                            </div>
                            <p v-if="ficha.ouro" class="text-center pb-3 text-sm">
                                <span class="text-parchment-800 italic">Ouro em bolsa:</span>
                                <span class="ml-2 font-cinzel font-bold text-blood-700">{{ Number(ficha.ouro).toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}) }} PO</span>
                            </p>
                        </section>

                        <section class="section-frame">
                            <h2 class="section-title">Capacidade de Carga (kg)</h2>
                            <div class="p-3">
                                <table class="w-full text-xs text-center">
                                    <thead class="text-[9px] uppercase font-cinzel text-parchment-800">
                                        <tr>
                                            <th class="py-1">Leve</th>
                                            <th>Média</th>
                                            <th>Pesada</th>
                                            <th>Levantar</th>
                                            <th>Do Chão</th>
                                            <th>Arrastar</th>
                                        </tr>
                                    </thead>
                                    <tbody class="font-cinzel font-bold text-blood-700">
                                        <tr class="border-t border-parchment-900/20">
                                            <td class="py-1">{{ cargas.leve }}</td>
                                            <td>{{ cargas.media }}</td>
                                            <td>{{ cargas.pesada }}</td>
                                            <td>{{ cargas.levantarCabeca }}</td>
                                            <td>{{ cargas.levantarSolo }}</td>
                                            <td>{{ cargas.arrastar }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="text-center text-xs pt-2">
                                    <span class="text-parchment-800 italic">Peso equipado:</span>
                                    <span class="ml-2 font-cinzel font-bold">{{ pesoEquipado.toLocaleString('pt-BR', {minimumFractionDigits: 1, maximumFractionDigits: 1}) }} kg</span>
                                </p>
                            </div>
                        </section>

                        <section class="section-frame">
                            <h2 class="section-title">Jornada de Experiência</h2>
                            <div class="p-4 grid grid-cols-3 gap-3 text-center">
                                <div class="stat-box">
                                    <p class="stat-label">XP Atual</p>
                                    <p class="stat-value text-parchment-900">{{ Number(ficha.xp_atual || 0).toLocaleString('pt-BR') }}</p>
                                </div>
                                <div class="stat-box">
                                    <p class="stat-label">Próximo</p>
                                    <p class="stat-value">{{ Number(ficha.xp_proximo || 0).toLocaleString('pt-BR') }}</p>
                                </div>
                                <div class="stat-box">
                                    <p class="stat-label">Faltam</p>
                                    <p class="stat-value text-blood-700">{{ xpFaltando.toLocaleString('pt-BR') }}</p>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <!-- Idiomas + Aparência + Notas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <section class="section-frame">
                        <h2 class="section-title">Idiomas</h2>
                        <div class="p-4 font-lora text-sm whitespace-pre-line">
                            {{ ficha.idiomas || 'Comum' }}
                        </div>
                    </section>

                    <section class="section-frame">
                        <h2 class="section-title">Aparência</h2>
                        <div class="p-4 font-lora text-sm italic">
                            {{ aparencia || 'Sem descrição registrada.' }}
                        </div>
                    </section>

                    <section class="section-frame">
                        <h2 class="section-title">Notas de Combate</h2>
                        <div class="p-4 font-lora text-sm whitespace-pre-line">
                            <template v-if="ficha.notas_combate">{{ ficha.notas_combate }}</template>
                            <span v-else class="text-parchment-800 italic">Nenhuma nota registrada.</span>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.section-frame {
    border: 2px solid #4b3b26;
    background: rgba(253, 246, 227, 0.55);
    border-radius: 3px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}

.section-title {
    background: #4b3b26;
    color: #f5e6b8;
    font-family: 'Cinzel', serif;
    font-weight: 700;
    font-size: 11px;
    letter-spacing: 3px;
    text-transform: uppercase;
    padding: 4px 12px;
    border-bottom: 2px solid #8a6d1f;
}

.kv span {
    display: block;
    font-family: 'Cinzel', serif;
    font-size: 9px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #6b4a2b;
    font-weight: 700;
}

.kv p {
    font-family: 'Lora', serif;
    font-weight: 600;
    border-bottom: 1px dotted rgba(75, 59, 38, 0.35);
    padding: 2px 0;
    color: #2a2118;
}

.stat-box {
    border: 1px solid #8a6d1f;
    background: rgba(253, 246, 227, 0.7);
    padding: 6px 4px;
    text-align: center;
    border-radius: 2px;
}

.stat-label {
    font-family: 'Cinzel', serif;
    font-size: 9px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #6b4a2b;
    font-weight: 700;
}

.stat-value {
    font-family: 'Cinzel', serif;
    font-weight: 700;
    font-size: 22px;
    line-height: 1.1;
    color: #2a2118;
}

@media print {
    aside, footer, .mb-6 { display: none !important; }
    .printable-sheet {
        border: none !important;
        box-shadow: none !important;
        margin: 0 !important;
        padding: 0 !important;
        background: white !important;
    }
}
</style>
