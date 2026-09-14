<script setup>
import { computed, ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    ficha: Object,
    racas: Array,
    classes: Array,
    tendencias: Array,
    divindades: Array,
    pericias: Array,
    talentos: Array,
    armas: Array,
    armaduras: Array,
    equipamentos: Array,
    magias: Array,
});

const asMap = (items, valueFn) => {
    const m = {};
    for (const it of (items || [])) m[it.id] = valueFn(it);
    return m;
};

const form = useForm({
    versao: props.ficha.versao || '3.5',
    nome_personagem: props.ficha.nome_personagem || '',
    nome_jogador: props.ficha.nome_jogador || '',
    raca_id: props.ficha.raca_id,
    classe_id: props.ficha.classe_id,
    tendencia_id: props.ficha.tendencia_id,
    divindade: props.ficha.divindade || '',
    tamanho: props.ficha.tamanho || '',
    idade: props.ficha.idade,
    sexo: props.ficha.sexo || '',
    altura: props.ficha.altura,
    peso: props.ficha.peso,
    olhos: props.ficha.olhos || '',
    cabelos: props.ficha.cabelos || '',
    pele: props.ficha.pele || '',
    nivel: props.ficha.nivel || 1,
    ouro: props.ficha.ouro || 0,
    forca_base: props.ficha.forca_base || 10,
    destreza_base: props.ficha.destreza_base || 10,
    constituicao_base: props.ficha.constituicao_base || 10,
    inteligencia_base: props.ficha.inteligencia_base || 10,
    sabedoria_base: props.ficha.sabedoria_base || 10,
    carisma_base: props.ficha.carisma_base || 10,
    pv_max: props.ficha.pv_max || 1,
    pv_atual: props.ficha.pv_atual || 1,
    bab: props.ficha.bab || 0,
    fortitude_base: props.ficha.fortitude_base || 0,
    reflexos_base: props.ficha.reflexos_base || 0,
    vontade_base: props.ficha.vontade_base || 0,
    xp_atual: props.ficha.xp_atual || 0,
    xp_proximo: props.ficha.xp_proximo || 0,
    deslocamento: props.ficha.deslocamento || '9m',
    iniciativa_misc: props.ficha.iniciativa_misc || 0,
    ca_natural: props.ficha.ca_natural || 0,
    ca_armadura: props.ficha.ca_armadura || 0,
    ca_escudo: props.ficha.ca_escudo || 0,
    ca_tamanho: props.ficha.ca_tamanho || 0,
    ca_deflexao: props.ficha.ca_deflexao || 0,
    ca_misc: props.ficha.ca_misc || 0,
    fortitude_misc: props.ficha.fortitude_misc || 0,
    fortitude_magia: props.ficha.fortitude_magia || 0,
    reflexos_misc: props.ficha.reflexos_misc || 0,
    reflexos_magia: props.ficha.reflexos_magia || 0,
    vontade_misc: props.ficha.vontade_misc || 0,
    vontade_magia: props.ficha.vontade_magia || 0,
    agarre_misc: props.ficha.agarre_misc || 0,
    agarre_tamanho: props.ficha.agarre_tamanho || 0,
    talentos_descricao: props.ficha.talentos_descricao || '',
    habilidades_especiais: props.ficha.habilidades_especiais || '',
    idiomas: props.ficha.idiomas || '',
    notas_combate: props.ficha.notas_combate || '',
    dinheiro_pc: props.ficha.dinheiro_pc || 0,
    dinheiro_pp: props.ficha.dinheiro_pp || 0,
    dinheiro_pl: props.ficha.dinheiro_pl || 0,
    pericias: asMap(props.ficha.pericias, p => Number(p.pivot?.graduacoes || 0)),
    talentos: (props.ficha.talentos || []).map(t => t.id),
    magias: (props.ficha.magias || []).map(m => m.id),
    armas: asMap(props.ficha.armas, a => Number(a.pivot?.quantidade || 1)),
    armaduras: asMap(props.ficha.armaduras, a => Number(a.pivot?.quantidade || 1)),
    equipamentos: asMap(props.ficha.equipamentos, e => Number(e.pivot?.quantidade || 1)),
});

const modOf = (score) => Math.floor((Number(score) - 10) / 2);
const sign = (n) => (n >= 0 ? '+' : '') + n;

const mods = computed(() => ({
    forca:        modOf(form.forca_base),
    destreza:     modOf(form.destreza_base),
    constituicao: modOf(form.constituicao_base),
    inteligencia: modOf(form.inteligencia_base),
    sabedoria:    modOf(form.sabedoria_base),
    carisma:      modOf(form.carisma_base),
}));

const caTotal = computed(() =>
    10 + Number(form.ca_armadura) + Number(form.ca_escudo) + mods.value.destreza
    + Number(form.ca_tamanho) + Number(form.ca_natural) + Number(form.ca_deflexao) + Number(form.ca_misc)
);

const saveTotals = computed(() => ({
    fortitude: Number(form.fortitude_base) + mods.value.constituicao + Number(form.fortitude_magia) + Number(form.fortitude_misc),
    reflexos:  Number(form.reflexos_base)  + mods.value.destreza     + Number(form.reflexos_magia)  + Number(form.reflexos_misc),
    vontade:   Number(form.vontade_base)   + mods.value.sabedoria    + Number(form.vontade_magia)   + Number(form.vontade_misc),
}));

const iniciativaTotal = computed(() => mods.value.destreza + Number(form.iniciativa_misc));
const atkCorpo = computed(() => Number(form.bab) + mods.value.forca + Number(form.ca_tamanho));
const atkDist  = computed(() => Number(form.bab) + mods.value.destreza + Number(form.ca_tamanho));
const agarrar  = computed(() => Number(form.bab) + mods.value.forca + Number(form.agarre_tamanho) + Number(form.agarre_misc));

const filtros = ref({ pericia: '', talento: '', magia: '', arma: '', armadura: '', equipamento: '' });

const contains = (str, q) => !q || (str || '').toLowerCase().includes(q.toLowerCase());

const periciasFiltradas = computed(() =>
    (props.pericias || []).filter(p => contains(p.nome, filtros.value.pericia) || contains(p.habilidade_chave, filtros.value.pericia))
);
const talentosFiltrados = computed(() =>
    (props.talentos || []).filter(t => contains(t.nome, filtros.value.talento) || contains(t.tipo, filtros.value.talento))
);
const magiasFiltradas = computed(() =>
    (props.magias || []).filter(m => contains(m.nome, filtros.value.magia) || contains(m.escola, filtros.value.magia))
);
const armasFiltradas = computed(() =>
    (props.armas || []).filter(a => contains(a.nome, filtros.value.arma) || contains(a.categoria, filtros.value.arma))
);
const armadurasFiltradas = computed(() =>
    (props.armaduras || []).filter(a => contains(a.nome, filtros.value.armadura) || contains(a.tipo, filtros.value.armadura))
);
const equipFiltrados = computed(() =>
    (props.equipamentos || []).filter(e => contains(e.nome, filtros.value.equipamento) || contains(e.categoria, filtros.value.equipamento))
);

const toggleFromArray = (arr, id) => {
    const i = arr.indexOf(id);
    if (i >= 0) arr.splice(i, 1);
    else arr.push(id);
};

const setMapQty = (map, id, qty) => {
    const q = Math.max(0, Math.floor(Number(qty) || 0));
    if (q === 0) delete map[id];
    else map[id] = q;
};

const toggleMapItem = (map, id) => {
    if (map[id]) delete map[id];
    else map[id] = 1;
};

const setPericiaGrad = (id, grad) => {
    const g = Math.max(0, Number(grad) || 0);
    if (g === 0) delete form.pericias[id];
    else form.pericias[id] = g;
};

const submit = () => {
    form.put(route('fichas.update', props.ficha.id), { preserveScroll: true });
};

const hasError = (field) => Boolean(form.errors[field]);
</script>

<template>
    <AppLayout>
        <Head :title="'Editar: ' + form.nome_personagem" />

        <form @submit.prevent="submit">
            <div class="mb-6 flex justify-between items-center flex-wrap gap-2">
                <Link :href="route('fichas.show', ficha.id)" class="text-parchment-800 font-cinzel hover:text-blood-700 transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Voltar à Ficha
                </Link>
                <div class="flex gap-2 items-center flex-wrap">
                    <span v-if="form.recentlySuccessful" class="text-green-700 font-cinzel text-sm animate-pulse">
                        <i class="fa-solid fa-check mr-1"></i> Salvo
                    </span>
                    <Link :href="route('fichas.show', ficha.id)" class="bg-parchment-500 text-parchment-900 px-6 py-2 rounded font-cinzel shadow-md hover:bg-parchment-600 transition">
                        Cancelar
                    </Link>
                    <button type="submit" :disabled="form.processing" class="bg-green-700 text-white px-6 py-2 rounded font-cinzel shadow-md hover:bg-green-800 transition disabled:opacity-50">
                        <i class="fa-solid fa-save mr-2"></i>
                        <span v-if="form.processing">Salvando...</span>
                        <span v-else>Salvar Alterações</span>
                    </button>
                </div>
            </div>

            <div class="glass-parchment shadow-2xl rounded-sm border-2 border-parchment-900 bg-parchment-pattern max-w-7xl mx-auto overflow-hidden">
                <div class="bg-parchment-900 text-parchment-100 px-8 py-4 border-b-4 border-blood-700">
                    <h1 class="text-2xl md:text-3xl font-cinzel font-bold tracking-widest uppercase">Editar Ficha</h1>
                    <p class="text-sm mt-1 opacity-80 font-lora italic">{{ ficha.nome_personagem || 'Personagem sem nome' }}</p>
                </div>

                <div class="p-6 md:p-8 space-y-5">

                    <!-- Identidade -->
                    <section class="section-frame">
                        <h2 class="section-title">Identidade</h2>
                        <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="lbl">Nome do Personagem</label>
                                <input v-model="form.nome_personagem" type="text" class="inp" :class="{ 'inp-err': hasError('nome_personagem') }" required>
                                <p v-if="hasError('nome_personagem')" class="err">{{ form.errors.nome_personagem }}</p>
                            </div>
                            <div>
                                <label class="lbl">Jogador</label>
                                <input v-model="form.nome_jogador" type="text" class="inp" required>
                            </div>
                            <div>
                                <label class="lbl">Divindade</label>
                                <input v-model="form.divindade" type="text" class="inp" list="lista-divindades">
                                <datalist id="lista-divindades">
                                    <option v-for="d in divindades" :key="d.id" :value="d.nome">{{ d.nome }}</option>
                                </datalist>
                            </div>
                            <div>
                                <label class="lbl">Classe</label>
                                <select v-model="form.classe_id" class="inp" required>
                                    <option :value="null">— selecione —</option>
                                    <option v-for="c in classes" :key="c.id" :value="c.id">{{ c.nome }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="lbl">Raça</label>
                                <select v-model="form.raca_id" class="inp" required>
                                    <option :value="null">— selecione —</option>
                                    <option v-for="r in racas" :key="r.id" :value="r.id">{{ r.nome }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="lbl">Tendência</label>
                                <select v-model="form.tendencia_id" class="inp" required>
                                    <option :value="null">— selecione —</option>
                                    <option v-for="t in tendencias" :key="t.id" :value="t.id">{{ t.nome }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="lbl">Nível</label>
                                <input v-model.number="form.nivel" type="number" min="1" max="20" class="inp" required>
                            </div>
                            <div>
                                <label class="lbl">Tamanho</label>
                                <select v-model="form.tamanho" class="inp">
                                    <option value="">—</option>
                                    <option value="Minúsculo">Minúsculo</option>
                                    <option value="Diminuto">Diminuto</option>
                                    <option value="Miúdo">Miúdo</option>
                                    <option value="Pequeno">Pequeno</option>
                                    <option value="Médio">Médio</option>
                                    <option value="Grande">Grande</option>
                                    <option value="Enorme">Enorme</option>
                                    <option value="Imenso">Imenso</option>
                                    <option value="Colossal">Colossal</option>
                                </select>
                            </div>
                            <div>
                                <label class="lbl">Deslocamento</label>
                                <input v-model="form.deslocamento" type="text" class="inp" placeholder="ex: 9m" required>
                            </div>
                        </div>
                    </section>

                    <!-- Descrição física -->
                    <section class="section-frame">
                        <h2 class="section-title">Descrição Física</h2>
                        <div class="p-4 grid grid-cols-2 md:grid-cols-6 gap-3">
                            <div><label class="lbl">Idade</label><input v-model.number="form.idade" type="number" class="inp"></div>
                            <div>
                                <label class="lbl">Sexo</label>
                                <select v-model="form.sexo" class="inp">
                                    <option value="">—</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Outro">Outro</option>
                                </select>
                            </div>
                            <div><label class="lbl">Altura (m)</label><input v-model.number="form.altura" type="number" step="0.01" class="inp"></div>
                            <div><label class="lbl">Peso (kg)</label><input v-model.number="form.peso" type="number" step="0.1" class="inp"></div>
                            <div><label class="lbl">Olhos</label><input v-model="form.olhos" type="text" class="inp"></div>
                            <div><label class="lbl">Cabelos</label><input v-model="form.cabelos" type="text" class="inp"></div>
                            <div><label class="lbl">Pele</label><input v-model="form.pele" type="text" class="inp"></div>
                        </div>
                    </section>

                    <!-- Atributos -->
                    <section class="section-frame">
                        <h2 class="section-title">Atributos</h2>
                        <div class="p-4 grid grid-cols-2 md:grid-cols-6 gap-3">
                            <div v-for="a in [
                                { key: 'forca',        label: 'FOR', field: 'forca_base' },
                                { key: 'destreza',     label: 'DES', field: 'destreza_base' },
                                { key: 'constituicao', label: 'CON', field: 'constituicao_base' },
                                { key: 'inteligencia', label: 'INT', field: 'inteligencia_base' },
                                { key: 'sabedoria',    label: 'SAB', field: 'sabedoria_base' },
                                { key: 'carisma',      label: 'CAR', field: 'carisma_base' },
                            ]" :key="a.key" class="text-center">
                                <label class="block font-cinzel text-xs font-bold text-parchment-800 tracking-widest">{{ a.label }}</label>
                                <input v-model.number="form[a.field]" type="number" min="1" max="60" class="inp text-center text-2xl font-cinzel font-bold">
                                <p class="text-blood-700 font-cinzel font-bold mt-1">{{ sign(mods[a.key]) }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- Vitais / CA / Combate -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <section class="section-frame">
                            <h2 class="section-title">Sinais Vitais &amp; Experiência</h2>
                            <div class="p-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                                <div><label class="lbl">PV Máximo</label><input v-model.number="form.pv_max" type="number" class="inp" required></div>
                                <div><label class="lbl">PV Atual</label><input v-model.number="form.pv_atual" type="number" class="inp"></div>
                                <div><label class="lbl">XP Atual</label><input v-model.number="form.xp_atual" type="number" class="inp" required></div>
                                <div><label class="lbl">XP Próximo</label><input v-model.number="form.xp_proximo" type="number" class="inp" required></div>
                            </div>
                        </section>

                        <section class="section-frame">
                            <h2 class="section-title">Classe de Armadura <span class="text-parchment-300 font-normal">(Total: <span class="text-blood-400 font-bold">{{ caTotal }}</span>)</span></h2>
                            <div class="p-4 grid grid-cols-3 md:grid-cols-6 gap-2">
                                <div><label class="lbl">Armadura</label><input v-model.number="form.ca_armadura" type="number" class="inp" required></div>
                                <div><label class="lbl">Escudo</label><input v-model.number="form.ca_escudo" type="number" class="inp" required></div>
                                <div><label class="lbl">Natural</label><input v-model.number="form.ca_natural" type="number" class="inp" required></div>
                                <div><label class="lbl">Tamanho</label><input v-model.number="form.ca_tamanho" type="number" class="inp" required></div>
                                <div><label class="lbl">Deflexão</label><input v-model.number="form.ca_deflexao" type="number" class="inp" required></div>
                                <div><label class="lbl">Diverso</label><input v-model.number="form.ca_misc" type="number" class="inp" required></div>
                            </div>
                        </section>
                    </div>

                    <!-- Combate + Resistências -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <section class="section-frame">
                            <h2 class="section-title">Combate</h2>
                            <div class="p-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                                <div><label class="lbl">BAB</label><input v-model.number="form.bab" type="number" class="inp" required></div>
                                <div><label class="lbl">Iniciativa (Div.)</label><input v-model.number="form.iniciativa_misc" type="number" class="inp" required></div>
                                <div><label class="lbl">Agarrar Tam.</label><input v-model.number="form.agarre_tamanho" type="number" class="inp" required></div>
                                <div><label class="lbl">Agarrar Div.</label><input v-model.number="form.agarre_misc" type="number" class="inp" required></div>
                            </div>
                            <div class="mx-4 mb-4 grid grid-cols-4 gap-2 text-center">
                                <div class="derived-box"><p class="lbl">C.a.C</p><p class="dv">{{ sign(atkCorpo) }}</p></div>
                                <div class="derived-box"><p class="lbl">Distância</p><p class="dv">{{ sign(atkDist) }}</p></div>
                                <div class="derived-box"><p class="lbl">Agarrar</p><p class="dv">{{ sign(agarrar) }}</p></div>
                                <div class="derived-box"><p class="lbl">Iniciativa</p><p class="dv">{{ sign(iniciativaTotal) }}</p></div>
                            </div>
                        </section>

                        <section class="section-frame">
                            <h2 class="section-title">Testes de Resistência</h2>
                            <div class="p-4">
                                <table class="w-full text-sm">
                                    <thead class="text-[10px] uppercase font-cinzel text-parchment-800">
                                        <tr>
                                            <th class="text-left py-1">Teste</th>
                                            <th>Base</th>
                                            <th>Mágico</th>
                                            <th>Diverso</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="s in [
                                            { key: 'fortitude', label: 'Fortitude' },
                                            { key: 'reflexos',  label: 'Reflexos' },
                                            { key: 'vontade',   label: 'Vontade' },
                                        ]" :key="s.key" class="border-t border-parchment-900/10">
                                            <td class="py-1 font-bold text-blood-700">{{ s.label }}</td>
                                            <td><input v-model.number="form[s.key + '_base']" type="number" class="inp-sm" required></td>
                                            <td><input v-model.number="form[s.key + '_magia']" type="number" class="inp-sm" required></td>
                                            <td><input v-model.number="form[s.key + '_misc']" type="number" class="inp-sm" required></td>
                                            <td class="text-center font-cinzel font-bold text-blood-700">{{ sign(saveTotals[s.key]) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>

                    <!-- Perícias -->
                    <section class="section-frame">
                        <h2 class="section-title">Perícias</h2>
                        <div class="p-3 border-b border-parchment-900/20">
                            <input v-model="filtros.pericia" type="text" placeholder="Buscar perícia..." class="inp">
                        </div>
                        <div class="p-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 max-h-96 overflow-y-auto">
                            <div v-for="p in periciasFiltradas" :key="p.id" class="flex items-center gap-2 border border-parchment-900/20 rounded px-2 py-1 bg-parchment-50/50">
                                <span class="text-xs flex-grow">
                                    <span class="font-bold">{{ p.nome }}</span>
                                    <span class="text-parchment-800 ml-1">({{ (p.habilidade_chave || '').toUpperCase().slice(0,3) }})</span>
                                </span>
                                <input
                                    :value="form.pericias[p.id] ?? ''"
                                    @input="e => setPericiaGrad(p.id, e.target.value)"
                                    type="number"
                                    step="0.5"
                                    min="0"
                                    placeholder="0"
                                    class="w-16 inp-sm text-center"
                                >
                            </div>
                        </div>
                    </section>

                    <!-- Talentos + Magias -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <section class="section-frame">
                            <h2 class="section-title">Talentos ({{ form.talentos.length }})</h2>
                            <div class="p-3 border-b border-parchment-900/20">
                                <input v-model="filtros.talento" type="text" placeholder="Buscar talento..." class="inp">
                            </div>
                            <div class="p-3 space-y-1 max-h-96 overflow-y-auto">
                                <label v-for="t in talentosFiltrados" :key="t.id" class="flex items-start gap-2 border border-parchment-900/20 rounded px-2 py-1 cursor-pointer hover:bg-parchment-50/70" :class="{ 'bg-parchment-50/70 border-blood-700': form.talentos.includes(t.id) }">
                                    <input type="checkbox" :checked="form.talentos.includes(t.id)" @change="toggleFromArray(form.talentos, t.id)" class="mt-1">
                                    <span class="text-xs flex-grow">
                                        <span class="font-cinzel font-bold text-parchment-900">{{ t.nome }}</span>
                                        <span v-if="t.tipo" class="text-blood-700 italic text-[10px] ml-1">· {{ t.tipo }}</span>
                                        <span v-if="t.beneficio" class="block text-parchment-800 text-[10px] leading-snug line-clamp-2">{{ t.beneficio }}</span>
                                    </span>
                                </label>
                            </div>
                        </section>

                        <section class="section-frame">
                            <h2 class="section-title">Magias ({{ form.magias.length }})</h2>
                            <div class="p-3 border-b border-parchment-900/20">
                                <input v-model="filtros.magia" type="text" placeholder="Buscar magia..." class="inp">
                            </div>
                            <div class="p-3 space-y-1 max-h-96 overflow-y-auto">
                                <label v-for="m in magiasFiltradas" :key="m.id" class="flex items-center gap-2 border border-parchment-900/20 rounded px-2 py-1 cursor-pointer hover:bg-parchment-50/70" :class="{ 'bg-magic-100/40 border-magic-700': form.magias.includes(m.id) }">
                                    <input type="checkbox" :checked="form.magias.includes(m.id)" @change="toggleFromArray(form.magias, m.id)">
                                    <span class="text-xs flex-grow">
                                        <span class="font-cinzel font-bold text-parchment-900">{{ m.nome }}</span>
                                        <span v-if="m.escola" class="text-magic-700 italic text-[10px] ml-1">· {{ m.escola }}</span>
                                    </span>
                                </label>
                            </div>
                        </section>
                    </div>

                    <!-- Armas -->
                    <section class="section-frame">
                        <h2 class="section-title">Armas ({{ Object.keys(form.armas).length }})</h2>
                        <div class="p-3 border-b border-parchment-900/20">
                            <input v-model="filtros.arma" type="text" placeholder="Buscar arma..." class="inp">
                        </div>
                        <div class="p-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 max-h-96 overflow-y-auto">
                            <div v-for="a in armasFiltradas" :key="a.id" class="flex items-center gap-2 border border-parchment-900/20 rounded px-2 py-1" :class="{ 'bg-parchment-50/70 border-blood-700': form.armas[a.id] }">
                                <input type="checkbox" :checked="!!form.armas[a.id]" @change="toggleMapItem(form.armas, a.id)">
                                <span class="text-xs flex-grow">
                                    <span class="font-bold">{{ a.nome }}</span>
                                    <span v-if="a.dano_m" class="text-parchment-800 ml-1">· {{ a.dano_m }}</span>
                                </span>
                                <input
                                    :value="form.armas[a.id] ?? ''"
                                    @input="e => setMapQty(form.armas, a.id, e.target.value)"
                                    type="number"
                                    min="0"
                                    placeholder="qtd"
                                    class="w-14 inp-sm text-center"
                                    :disabled="!form.armas[a.id]"
                                >
                            </div>
                        </div>
                    </section>

                    <!-- Armaduras -->
                    <section class="section-frame">
                        <h2 class="section-title">Armaduras &amp; Escudos ({{ Object.keys(form.armaduras).length }})</h2>
                        <div class="p-3 border-b border-parchment-900/20">
                            <input v-model="filtros.armadura" type="text" placeholder="Buscar armadura..." class="inp">
                        </div>
                        <div class="p-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 max-h-72 overflow-y-auto">
                            <div v-for="a in armadurasFiltradas" :key="a.id" class="flex items-center gap-2 border border-parchment-900/20 rounded px-2 py-1" :class="{ 'bg-parchment-50/70 border-blood-700': form.armaduras[a.id] }">
                                <input type="checkbox" :checked="!!form.armaduras[a.id]" @change="toggleMapItem(form.armaduras, a.id)">
                                <span class="text-xs flex-grow">
                                    <span class="font-bold">{{ a.nome }}</span>
                                    <span v-if="a.tipo" class="text-parchment-800 ml-1">· {{ a.tipo }}</span>
                                </span>
                                <input
                                    :value="form.armaduras[a.id] ?? ''"
                                    @input="e => setMapQty(form.armaduras, a.id, e.target.value)"
                                    type="number"
                                    min="0"
                                    placeholder="qtd"
                                    class="w-14 inp-sm text-center"
                                    :disabled="!form.armaduras[a.id]"
                                >
                            </div>
                        </div>
                    </section>

                    <!-- Equipamentos -->
                    <section class="section-frame">
                        <h2 class="section-title">Equipamentos ({{ Object.keys(form.equipamentos).length }})</h2>
                        <div class="p-3 border-b border-parchment-900/20">
                            <input v-model="filtros.equipamento" type="text" placeholder="Buscar equipamento..." class="inp">
                        </div>
                        <div class="p-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 max-h-96 overflow-y-auto">
                            <div v-for="e in equipFiltrados" :key="e.id" class="flex items-center gap-2 border border-parchment-900/20 rounded px-2 py-1" :class="{ 'bg-parchment-50/70 border-blood-700': form.equipamentos[e.id] }">
                                <input type="checkbox" :checked="!!form.equipamentos[e.id]" @change="toggleMapItem(form.equipamentos, e.id)">
                                <span class="text-xs flex-grow">
                                    <span class="font-bold">{{ e.nome }}</span>
                                    <span v-if="e.categoria" class="text-parchment-800 ml-1">· {{ e.categoria }}</span>
                                </span>
                                <input
                                    :value="form.equipamentos[e.id] ?? ''"
                                    @input="ev => setMapQty(form.equipamentos, e.id, ev.target.value)"
                                    type="number"
                                    min="0"
                                    placeholder="qtd"
                                    class="w-14 inp-sm text-center"
                                    :disabled="!form.equipamentos[e.id]"
                                >
                            </div>
                        </div>
                    </section>

                    <!-- Descrições / Textareas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <section class="section-frame">
                            <h2 class="section-title">Descrição de Talentos</h2>
                            <div class="p-4">
                                <textarea v-model="form.talentos_descricao" rows="4" class="inp font-lora"></textarea>
                            </div>
                        </section>
                        <section class="section-frame">
                            <h2 class="section-title">Habilidades Especiais</h2>
                            <div class="p-4">
                                <textarea v-model="form.habilidades_especiais" rows="4" class="inp font-lora"></textarea>
                            </div>
                        </section>
                        <section class="section-frame">
                            <h2 class="section-title">Idiomas</h2>
                            <div class="p-4">
                                <textarea v-model="form.idiomas" rows="3" class="inp font-lora"></textarea>
                            </div>
                        </section>
                        <section class="section-frame">
                            <h2 class="section-title">Notas de Combate</h2>
                            <div class="p-4">
                                <textarea v-model="form.notas_combate" rows="3" class="inp font-lora"></textarea>
                            </div>
                        </section>
                    </div>

                    <!-- Dinheiro -->
                    <section class="section-frame">
                        <h2 class="section-title">Bolsa &amp; Riqueza</h2>
                        <div class="p-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                            <div><label class="lbl">Peças de Cobre</label><input v-model.number="form.dinheiro_pc" type="number" class="inp" required></div>
                            <div><label class="lbl">Peças de Prata</label><input v-model.number="form.dinheiro_pp" type="number" class="inp" required></div>
                            <div><label class="lbl">Peças de Ouro</label><input v-model.number="form.dinheiro_pl" type="number" class="inp" required></div>
                            <div><label class="lbl">Ouro (legado)</label><input v-model.number="form.ouro" type="number" step="0.01" class="inp" required></div>
                        </div>
                    </section>

                </div>
            </div>

            <div class="max-w-7xl mx-auto mt-6 flex justify-end gap-2 flex-wrap">
                <Link :href="route('fichas.show', ficha.id)" class="bg-parchment-500 text-parchment-900 px-6 py-2 rounded font-cinzel shadow-md hover:bg-parchment-600 transition">
                    Cancelar
                </Link>
                <button type="submit" :disabled="form.processing" class="bg-green-700 text-white px-8 py-2 rounded font-cinzel shadow-md hover:bg-green-800 transition disabled:opacity-50">
                    <i class="fa-solid fa-save mr-2"></i>
                    <span v-if="form.processing">Salvando...</span>
                    <span v-else>Salvar Alterações</span>
                </button>
            </div>

            <div v-if="Object.keys(form.errors).length" class="max-w-7xl mx-auto mt-4 p-4 bg-red-50 border-2 border-red-700 rounded">
                <p class="font-cinzel font-bold text-red-900 mb-2">
                    <i class="fa-solid fa-triangle-exclamation mr-1"></i>
                    Há campos com problemas:
                </p>
                <ul class="text-sm text-red-800 space-y-1 font-lora">
                    <li v-for="(msg, field) in form.errors" :key="field">
                        <span class="font-bold">{{ field }}:</span> {{ msg }}
                    </li>
                </ul>
            </div>
        </form>
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

.lbl {
    display: block;
    font-family: 'Cinzel', serif;
    font-size: 9px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #6b4a2b;
    font-weight: 700;
    margin-bottom: 2px;
}

.inp {
    width: 100%;
    border: 1px solid #8a6d1f;
    background: rgba(255, 251, 232, 0.85);
    padding: 4px 8px;
    font-family: 'Lora', serif;
    font-size: 13px;
    color: #2a2118;
    border-radius: 2px;
    outline: none;
    transition: border-color 0.15s;
}

.inp:focus {
    border-color: #7a0e17;
    box-shadow: 0 0 0 2px rgba(122, 14, 23, 0.15);
}

.inp-err {
    border-color: #dc2626;
    background: #fef2f2;
}

.inp-sm {
    border: 1px solid #8a6d1f;
    background: rgba(255, 251, 232, 0.85);
    padding: 2px 4px;
    font-family: 'Cinzel', serif;
    font-size: 12px;
    color: #2a2118;
    border-radius: 2px;
    outline: none;
    width: 100%;
}

.inp-sm:focus {
    border-color: #7a0e17;
}

.inp-sm:disabled {
    opacity: 0.35;
    cursor: not-allowed;
}

.err {
    font-size: 11px;
    color: #b91c1c;
    margin-top: 2px;
    font-family: 'Lora', serif;
}

.derived-box {
    border: 1px solid #8a6d1f;
    background: rgba(253, 246, 227, 0.85);
    padding: 4px;
    border-radius: 2px;
}

.derived-box .lbl {
    margin-bottom: 0;
    font-size: 8px;
}

.derived-box .dv {
    font-family: 'Cinzel', serif;
    font-weight: 700;
    font-size: 16px;
    color: #7a0e17;
    line-height: 1.2;
}
</style>
