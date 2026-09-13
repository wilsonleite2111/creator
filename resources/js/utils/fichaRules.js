// Regras puras da criação de fichas D&D 3.5.
// Este módulo é intencionalmente sem dependências para permitir testes unitários.

// ============ Utilitários ============

export const slugify = (str) => (str ?? '')
    .toString()
    .toLowerCase()
    .normalize('NFD').replace(/[̀-ͯ]/g, '')
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/(^-|-$)/g, '');

// Modificador de habilidade: (valor - 10) / 2 arredondado para baixo.
export const getMod = (val) => Math.floor(((val ?? 10) - 10) / 2);

// ============ Atributos: Point Buy (PHB 3.5) ============

export const POINT_BUY_TOTAL = 25;
export const custoPointBuy = { 8: 0, 9: 1, 10: 2, 11: 3, 12: 4, 13: 5, 14: 6, 15: 8, 16: 10, 17: 13, 18: 16 };

export const pontosGastosPointBuy = (atribs) => {
    return Object.values(atribs || {}).reduce((sum, v) => sum + (custoPointBuy[v] ?? 0), 0);
};

// ============ Modificadores raciais ============

// Aplica bônus racial a um valor bruto de atributo.
export const atributoFinal = (base, modRacial) => Number(base ?? 10) + Number(modRacial ?? 0);

// ============ BBA ============

// Bônus Base de Ataque conforme progressão da classe e nível do personagem.
export const bbaPorClasse = (progressao, nivel) => {
    const nv = Number(nivel || 1);
    const p = String(progressao || '').toLowerCase();
    if (p === 'boa') return nv;
    if (p === 'media') return Math.floor(nv * 3 / 4);
    return Math.floor(nv / 2);
};

// ============ Nível de conjurador ============

export const CASTERS_FULL = ['clerigo', 'druida', 'feiticeiro', 'mago', 'bardo'];
export const CASTERS_HALF = ['paladino', 'patrulheiro'];

export const nivelDeConjurador = (classeSlug, nivel) => {
    const nv = Number(nivel || 1);
    if (CASTERS_FULL.includes(classeSlug)) return nv;
    if (CASTERS_HALF.includes(classeSlug)) return nv >= 4 ? nv - 3 : 0;
    return 0;
};

// ============ Perícias: listas de classe (PHB 3.5) ============

export const periciasClassePor = {
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

// Perícias que aparecem em apenas UMA lista de classe (exclusivas).
export const calcularPericiasExclusivas = () => {
    const contagem = {};
    Object.values(periciasClassePor).forEach(lista =>
        lista.forEach(nome => { contagem[nome] = (contagem[nome] || 0) + 1; })
    );
    const exclusivas = {};
    Object.entries(periciasClassePor).forEach(([classe, lista]) => {
        lista.forEach(nome => { if (contagem[nome] === 1) exclusivas[nome] = classe; });
    });
    return exclusivas;
};

export const periciasExclusivas = calcularPericiasExclusivas();

export const ehPericiaDeClasse = (classeSlug, nomePericia) => {
    const lista = periciasClassePor[classeSlug];
    return Array.isArray(lista) && lista.includes(nomePericia);
};

// Uma perícia é proibida para uma classe se é exclusiva de OUTRA classe.
export const ehPericiaProibida = (classeSlug, nomePericia) => {
    const dono = periciasExclusivas[nomePericia];
    return !!dono && dono !== classeSlug;
};

export const custoDaPericia = (isClass) => (isClass ? 1 : 2);

// Teto de graduações: (nivel + 3) para perícia de classe; metade (arredondado para baixo) para fora da classe; 0 para proibida.
export const maxGraduacoesDaPericia = (nivel, isClass, isProibida) => {
    if (isProibida) return 0;
    const teto = Number(nivel || 1) + 3;
    return isClass ? teto : Math.floor(teto / 2);
};

// Orçamento total de pontos de perícia no 1° nível: (pontos_classe + mod INT) * 4 (+4 para humanos).
export const pontosPericiaMax = (classePontos, modInt, isHumano) => {
    const base = Number(classePontos ?? 2);
    const total = Math.max(1, base + Number(modInt || 0)) * 4;
    return total + (isHumano ? 4 : 0);
};

// ============ Bônus raciais em perícias (PHB 3.5) ============

export const bonusRacialPorPericia = {
    'anao':      { 'Avaliação': 2, 'Ofícios': 2, 'Procurar': 2 },
    'elfo':      { 'Ouvir': 2, 'Observar': 2, 'Procurar': 2 },
    'gnomo':     { 'Ouvir': 2, 'Ofícios': 2 },
    'halfling':  { 'Escalar': 2, 'Saltar': 2, 'Furtividade': 2, 'Ouvir': 2 },
    'meio-elfo': { 'Ouvir': 1, 'Observar': 1, 'Procurar': 1, 'Diplomacia': 2, 'Obter Informação': 2 },
};

export const bonusRacialDaPericia = (racaSlug, nomePericia) => {
    const mapa = bonusRacialPorPericia[racaSlug];
    return (mapa && mapa[nomePericia]) ?? 0;
};

// ============ Talentos ============

export const slotsTalento = (isHumano) => 1 + (isHumano ? 1 : 0);

export const NOMES_CLASSES_PT = ['Bárbaro', 'Bardo', 'Clérigo', 'Druida', 'Feiticeiro', 'Guerreiro', 'Ladino', 'Mago', 'Monge', 'Paladino', 'Patrulheiro'];

export const nomeAtributoParaChave = {
    'Força': 'forca',
    'Destreza': 'destreza',
    'Constituição': 'constituicao',
    'Inteligência': 'inteligencia',
    'Sabedoria': 'sabedoria',
    'Carisma': 'carisma',
};

// Verifica um único requisito atômico (sem "ou").
// contexto = { atributos: {forca, destreza, ...}, bba, nivelConjurador, classeSlug, nivel, talentosSelecionados: [nome], todosTalentosNomes: [nome] }
export const checarRequisitoAtomico = (req, contexto = {}) => {
    const t = String(req ?? '').trim();
    if (!t) return { ok: true, texto: t };

    // Atributo mínimo
    for (const [nome, chave] of Object.entries(nomeAtributoParaChave)) {
        const m = t.match(new RegExp(`^${nome}\\s+(\\d+)$`, 'i'));
        if (m) {
            const alvo = Number(m[1]);
            const atual = Number(contexto.atributos?.[chave] ?? 0);
            return { ok: atual >= alvo, texto: `${nome} ${alvo} (você: ${atual})` };
        }
    }

    // BBA
    const mBBA = t.match(/^BBA\s*\+?(\d+)$/i);
    if (mBBA) {
        const alvo = Number(mBBA[1]);
        const bba = Number(contexto.bba ?? 0);
        return { ok: bba >= alvo, texto: `BBA +${alvo} (você: +${bba})` };
    }

    // Nível de conjurador
    const mConj = t.match(/^N[íi]vel de conjurador\s+(\d+)$/i);
    if (mConj) {
        const alvo = Number(mConj[1]);
        const conj = Number(contexto.nivelConjurador ?? 0);
        return { ok: conj >= alvo, texto: `Nível de conjurador ${alvo} (você: ${conj})` };
    }

    // Expulsar mortos-vivos
    if (/^Capacidade de expulsar mortos-vivos$/i.test(t)) {
        const slug = contexto.classeSlug;
        const nivel = Number(contexto.nivel ?? 1);
        const ok = slug === 'clerigo' || (slug === 'paladino' && nivel >= 4);
        return { ok, texto: t };
    }

    // Proficiência com a arma
    if (/^Profici[êe]ncia com a arma$/i.test(t)) return { ok: true, texto: t };

    // Classe + nível
    for (const nomeClasse of NOMES_CLASSES_PT) {
        const m = t.match(new RegExp(`^${nomeClasse}\\s+(\\d+)$`, 'i'));
        if (m) {
            const alvo = Number(m[1]);
            const slug = slugify(nomeClasse);
            const ok = contexto.classeSlug === slug && Number(contexto.nivel ?? 1) >= alvo;
            return { ok, texto: `${nomeClasse} ${alvo}` };
        }
    }

    // Talento por nome
    if ((contexto.todosTalentosNomes || []).includes(t)) {
        return { ok: (contexto.talentosSelecionados || []).includes(t), texto: `Talento: ${t}` };
    }

    // Requisito desconhecido: não bloqueia.
    return { ok: true, texto: `${t} (não verificado)` };
};

// Avalia a string completa de pré-requisitos (vírgulas separam AND, "ou" separa OR interno).
export const avaliarPreRequisitos = (preRequisitos, contexto = {}) => {
    if (!preRequisitos) return { ok: true, itens: [] };
    const partes = String(preRequisitos).split(',').map(s => s.trim()).filter(Boolean);
    const itens = partes.map(parte => {
        if (/\bou\b/i.test(parte)) {
            const alternativas = parte.split(/\bou\b/i).map(s => s.trim()).filter(Boolean);
            const avaliadas = alternativas.map(alt => checarRequisitoAtomico(alt, contexto));
            return {
                ok: avaliadas.some(a => a.ok),
                texto: avaliadas.map(a => a.texto).join(' OU '),
            };
        }
        return checarRequisitoAtomico(parte, contexto);
    });
    return { ok: itens.every(i => i.ok), itens };
};

// ============ Arsenal: ouro inicial ============

export const ouroInicialPorClasse = {
    'barbaro': 100, 'bardo': 100, 'clerigo': 125, 'druida': 50,
    'feiticeiro': 75, 'guerreiro': 150, 'ladino': 125, 'mago': 75,
    'monge': 12.5, 'paladino': 150, 'patrulheiro': 150,
};

export const ouroInicial = (classeSlug) => ouroInicialPorClasse[classeSlug] ?? 0;

// ============ Arsenal: parser de preços ============

// Converte string "10 PO", "5 PP", "1 PC", "1.500 PO" para peças de ouro (float).
// Retorna 0 para strings inválidas, vazias, "-" ou "—".
export const parsePreco = (str) => {
    if (str === null || str === undefined) return 0;
    const s = String(str).trim();
    if (!s || s === '-' || s === '—') return 0;
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

// ============ Arsenal: capacidade de carga ============

// Tabela PHB 3.5 (Table 9-1) convertida (lb/2 ≈ kg).
export const cargaPesadaPorForca = {
    1: 5,   2: 10,  3: 15,  4: 20,  5: 25,  6: 30,  7: 35,  8: 40,  9: 45,
    10: 50, 11: 58, 12: 65, 13: 75, 14: 88, 15: 100, 16: 115, 17: 130, 18: 150,
    19: 175, 20: 200, 21: 230, 22: 260, 23: 300, 24: 350, 25: 400,
    26: 460, 27: 520, 28: 600, 29: 700, 30: 800,
};

export const cargaPesadaMax = (forca) => {
    const f = Math.min(30, Math.max(1, Number(forca || 10)));
    return cargaPesadaPorForca[f] ?? 50;
};
export const cargaMediaMax = (forca) => Math.round((cargaPesadaMax(forca) * 2 / 3) * 10) / 10;
export const cargaLeveMax  = (forca) => Math.round((cargaPesadaMax(forca) / 3) * 10) / 10;

export const nivelCarga = (peso, forca) => {
    const p = Number(peso ?? 0);
    if (p > cargaPesadaMax(forca)) return 'excedida';
    if (p > cargaMediaMax(forca))  return 'pesada';
    if (p > cargaLeveMax(forca))   return 'media';
    return 'leve';
};

// Soma peso ou preço de uma seleção. selecao pode ser array de IDs OU mapa {id: qty}.
// fn(item) devolve o valor unitário (peso ou preço). Quantidade é multiplicada quando disponível.
export const somarSelecao = (lista, selecao, fn) => {
    if (!Array.isArray(lista) || lista.length === 0 || !selecao) return 0;
    let total = 0;
    if (Array.isArray(selecao)) {
        for (const id of selecao) {
            const item = lista.find(x => x.id === id);
            if (item) total += Number(fn(item)) || 0;
        }
    } else if (typeof selecao === 'object') {
        for (const [id, qty] of Object.entries(selecao)) {
            const q = Number(qty || 0);
            if (q <= 0) continue;
            const item = lista.find(x => x.id === Number(id));
            if (item) total += (Number(fn(item)) || 0) * q;
        }
    }
    return total;
};
