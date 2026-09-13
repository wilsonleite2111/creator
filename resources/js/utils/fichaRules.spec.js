import { describe, it, expect } from 'vitest';
import * as R from './fichaRules';

// ============ Utilitários ============

describe('slugify', () => {
    it('normaliza acentos e caixa', () => {
        expect(R.slugify('Bárbaro')).toBe('barbaro');
        expect(R.slugify('Clérigo')).toBe('clerigo');
        expect(R.slugify('Meio-Elfo')).toBe('meio-elfo');
        expect(R.slugify('Patrulheiro')).toBe('patrulheiro');
    });
    it('trata nulos e vazio', () => {
        expect(R.slugify(null)).toBe('');
        expect(R.slugify(undefined)).toBe('');
        expect(R.slugify('')).toBe('');
    });
});

describe('getMod', () => {
    it('retorna 0 para valores 10 e 11', () => {
        expect(R.getMod(10)).toBe(0);
        expect(R.getMod(11)).toBe(0);
    });
    it('retorna +1 para 12-13, +2 para 14-15, +4 para 18-19', () => {
        expect(R.getMod(12)).toBe(1);
        expect(R.getMod(13)).toBe(1);
        expect(R.getMod(14)).toBe(2);
        expect(R.getMod(15)).toBe(2);
        expect(R.getMod(18)).toBe(4);
        expect(R.getMod(19)).toBe(4);
    });
    it('retorna modificadores negativos', () => {
        expect(R.getMod(9)).toBe(-1);
        expect(R.getMod(8)).toBe(-1);
        expect(R.getMod(6)).toBe(-2);
        expect(R.getMod(1)).toBe(-5);
    });
    it('usa 10 como default para nulo', () => {
        expect(R.getMod(null)).toBe(0);
        expect(R.getMod(undefined)).toBe(0);
    });
});

// ============ Point Buy ============

describe('pontosGastosPointBuy', () => {
    it('array de 10s custa 12 (2×6)', () => {
        expect(R.pontosGastosPointBuy({ f: 10, d: 10, c: 10, i: 10, s: 10, ca: 10 })).toBe(12);
    });
    it('atributos padrão 15/14/13/12/10/8 custam 25 (build heroico)', () => {
        expect(R.pontosGastosPointBuy({ a: 15, b: 14, c: 13, d: 12, e: 10, f: 8 })).toBe(25);
    });
    it('18 sozinho custa 16', () => {
        expect(R.pontosGastosPointBuy({ a: 18 })).toBe(16);
    });
    it('ignora valores fora da tabela 8-18', () => {
        expect(R.pontosGastosPointBuy({ a: 20, b: 5, c: 18 })).toBe(16);
    });
});

// ============ Atributo com modificador racial ============

describe('atributoFinal', () => {
    it('soma base + racial', () => {
        expect(R.atributoFinal(14, 2)).toBe(16);
        expect(R.atributoFinal(10, -2)).toBe(8);
        expect(R.atributoFinal(10, 0)).toBe(10);
    });
    it('trata nulos como 10 e 0', () => {
        expect(R.atributoFinal(null, null)).toBe(10);
        expect(R.atributoFinal(15, null)).toBe(15);
    });
});

// ============ BBA ============

describe('bbaPorClasse', () => {
    it('progressão boa = nível', () => {
        expect(R.bbaPorClasse('boa', 1)).toBe(1);
        expect(R.bbaPorClasse('boa', 10)).toBe(10);
        expect(R.bbaPorClasse('boa', 20)).toBe(20);
    });
    it('progressão média = 3/4 do nível arredondado para baixo', () => {
        expect(R.bbaPorClasse('media', 1)).toBe(0);
        expect(R.bbaPorClasse('media', 4)).toBe(3);
        expect(R.bbaPorClasse('media', 8)).toBe(6);
        expect(R.bbaPorClasse('media', 20)).toBe(15);
    });
    it('progressão ruim = metade do nível arredondado para baixo', () => {
        expect(R.bbaPorClasse('ruim', 1)).toBe(0);
        expect(R.bbaPorClasse('ruim', 2)).toBe(1);
        expect(R.bbaPorClasse('ruim', 10)).toBe(5);
        expect(R.bbaPorClasse('ruim', 20)).toBe(10);
    });
    it('progressão desconhecida cai para ruim', () => {
        expect(R.bbaPorClasse('inexistente', 10)).toBe(5);
    });
});

// ============ Nível de conjurador ============

describe('nivelDeConjurador', () => {
    it('full casters (mago, clérigo, feiticeiro, druida, bardo) = nível do personagem', () => {
        expect(R.nivelDeConjurador('mago', 5)).toBe(5);
        expect(R.nivelDeConjurador('clerigo', 10)).toBe(10);
        expect(R.nivelDeConjurador('feiticeiro', 1)).toBe(1);
        expect(R.nivelDeConjurador('druida', 20)).toBe(20);
        expect(R.nivelDeConjurador('bardo', 3)).toBe(3);
    });
    it('paladino e patrulheiro começam a conjurar no 4°', () => {
        expect(R.nivelDeConjurador('paladino', 3)).toBe(0);
        expect(R.nivelDeConjurador('paladino', 4)).toBe(1);
        expect(R.nivelDeConjurador('patrulheiro', 4)).toBe(1);
        expect(R.nivelDeConjurador('patrulheiro', 20)).toBe(17);
    });
    it('classes não-conjuradoras (guerreiro, bárbaro, ladino, monge) = 0', () => {
        expect(R.nivelDeConjurador('guerreiro', 20)).toBe(0);
        expect(R.nivelDeConjurador('barbaro', 5)).toBe(0);
        expect(R.nivelDeConjurador('ladino', 10)).toBe(0);
        expect(R.nivelDeConjurador('monge', 1)).toBe(0);
    });
});

// ============ Perícias: classe/fora-da-classe/proibida ============

describe('ehPericiaDeClasse', () => {
    it('Escalar é de classe para bárbaro e guerreiro', () => {
        expect(R.ehPericiaDeClasse('barbaro', 'Escalar')).toBe(true);
        expect(R.ehPericiaDeClasse('guerreiro', 'Escalar')).toBe(true);
    });
    it('Concentração é de classe para clérigo mas não para bárbaro', () => {
        expect(R.ehPericiaDeClasse('clerigo', 'Concentração')).toBe(true);
        expect(R.ehPericiaDeClasse('barbaro', 'Concentração')).toBe(false);
    });
    it('Falsificação é apenas do ladino', () => {
        expect(R.ehPericiaDeClasse('ladino', 'Falsificação')).toBe(true);
        expect(R.ehPericiaDeClasse('mago', 'Falsificação')).toBe(false);
    });
});

describe('ehPericiaProibida', () => {
    it('perícias exclusivas do ladino são proibidas para outras classes', () => {
        expect(R.ehPericiaProibida('mago', 'Abrir Fechaduras')).toBe(true);
        expect(R.ehPericiaProibida('mago', 'Operar Mecanismo')).toBe(true);
        expect(R.ehPericiaProibida('mago', 'Falsificação')).toBe(true);
    });
    it('exclusivas NÃO são proibidas para a classe dona', () => {
        expect(R.ehPericiaProibida('ladino', 'Abrir Fechaduras')).toBe(false);
        expect(R.ehPericiaProibida('ladino', 'Falsificação')).toBe(false);
    });
    it('perícias em múltiplas listas nunca são proibidas', () => {
        expect(R.ehPericiaProibida('mago', 'Concentração')).toBe(false);
        expect(R.ehPericiaProibida('barbaro', 'Ofícios')).toBe(false);
    });
});

describe('custoDaPericia', () => {
    it('perícia de classe custa 1 ponto por graduação', () => {
        expect(R.custoDaPericia(true)).toBe(1);
    });
    it('perícia fora da classe custa 2 pontos por graduação', () => {
        expect(R.custoDaPericia(false)).toBe(2);
    });
});

describe('maxGraduacoesDaPericia', () => {
    it('classe no nível 1 = teto 4', () => {
        expect(R.maxGraduacoesDaPericia(1, true, false)).toBe(4);
    });
    it('fora da classe no nível 1 = teto 2 (metade arredondado para baixo)', () => {
        expect(R.maxGraduacoesDaPericia(1, false, false)).toBe(2);
    });
    it('classe no nível 5 = teto 8', () => {
        expect(R.maxGraduacoesDaPericia(5, true, false)).toBe(8);
    });
    it('fora da classe no nível 5 = teto 4', () => {
        expect(R.maxGraduacoesDaPericia(5, false, false)).toBe(4);
    });
    it('proibida sempre = 0', () => {
        expect(R.maxGraduacoesDaPericia(1, false, true)).toBe(0);
        expect(R.maxGraduacoesDaPericia(20, true, true)).toBe(0);
    });
});

describe('pontosPericiaMax', () => {
    it('mago com INT 14: (2+2)×4 = 16 pontos', () => {
        expect(R.pontosPericiaMax(2, 2, false)).toBe(16);
    });
    it('ladino com INT 14: (8+2)×4 = 40 pontos', () => {
        expect(R.pontosPericiaMax(8, 2, false)).toBe(40);
    });
    it('bônus humano adiciona 4 pontos', () => {
        expect(R.pontosPericiaMax(2, 2, true)).toBe(20);
    });
    it('nunca desce de 1 ponto base por nível (× 4 = 4)', () => {
        // guerreiro (2 pts) com INT 6 (mod -2) → 2 + (-2) = 0, min = 1, × 4 = 4
        expect(R.pontosPericiaMax(2, -2, false)).toBe(4);
    });
});

// ============ Bônus racial em perícias ============

describe('bonusRacialDaPericia', () => {
    it('halfling ganha +2 em Escalar, Saltar, Furtividade, Ouvir', () => {
        expect(R.bonusRacialDaPericia('halfling', 'Escalar')).toBe(2);
        expect(R.bonusRacialDaPericia('halfling', 'Saltar')).toBe(2);
        expect(R.bonusRacialDaPericia('halfling', 'Furtividade')).toBe(2);
        expect(R.bonusRacialDaPericia('halfling', 'Ouvir')).toBe(2);
    });
    it('elfo ganha +2 em Ouvir, Observar, Procurar', () => {
        expect(R.bonusRacialDaPericia('elfo', 'Ouvir')).toBe(2);
        expect(R.bonusRacialDaPericia('elfo', 'Observar')).toBe(2);
        expect(R.bonusRacialDaPericia('elfo', 'Procurar')).toBe(2);
    });
    it('meio-elfo ganha +1/+2 conforme a perícia', () => {
        expect(R.bonusRacialDaPericia('meio-elfo', 'Ouvir')).toBe(1);
        expect(R.bonusRacialDaPericia('meio-elfo', 'Diplomacia')).toBe(2);
    });
    it('humano e meio-orc não têm bônus racial de perícia', () => {
        expect(R.bonusRacialDaPericia('humano', 'Escalar')).toBe(0);
        expect(R.bonusRacialDaPericia('meio-orc', 'Escalar')).toBe(0);
    });
    it('raça inexistente retorna 0', () => {
        expect(R.bonusRacialDaPericia('inexistente', 'Escalar')).toBe(0);
    });
});

// ============ Talentos ============

describe('slotsTalento', () => {
    it('personagem base tem 1 slot', () => {
        expect(R.slotsTalento(false)).toBe(1);
    });
    it('humano ganha um slot bônus (total 2)', () => {
        expect(R.slotsTalento(true)).toBe(2);
    });
});

describe('checarRequisitoAtomico — atributo mínimo', () => {
    it('Força 13 satisfeito com FOR 14', () => {
        const r = R.checarRequisitoAtomico('Força 13', { atributos: { forca: 14 } });
        expect(r.ok).toBe(true);
    });
    it('Força 13 falha com FOR 12', () => {
        const r = R.checarRequisitoAtomico('Força 13', { atributos: { forca: 12 } });
        expect(r.ok).toBe(false);
    });
    it('Destreza 15 satisfeito com DES 15', () => {
        const r = R.checarRequisitoAtomico('Destreza 15', { atributos: { destreza: 15 } });
        expect(r.ok).toBe(true);
    });
    it('Carisma 21 falha em personagens comuns', () => {
        const r = R.checarRequisitoAtomico('Carisma 21', { atributos: { carisma: 18 } });
        expect(r.ok).toBe(false);
    });
});

describe('checarRequisitoAtomico — BBA', () => {
    it('BBA +1 satisfeito por guerreiro nível 1', () => {
        const r = R.checarRequisitoAtomico('BBA +1', { bba: 1 });
        expect(r.ok).toBe(true);
    });
    it('BBA +6 falha com BBA +3', () => {
        const r = R.checarRequisitoAtomico('BBA +6', { bba: 3 });
        expect(r.ok).toBe(false);
    });
});

describe('checarRequisitoAtomico — nível de conjurador', () => {
    it('Nível de conjurador 5 satisfeito com nível 5', () => {
        expect(R.checarRequisitoAtomico('Nível de conjurador 5', { nivelConjurador: 5 }).ok).toBe(true);
    });
    it('Nível de conjurador 12 falha com nível 3', () => {
        expect(R.checarRequisitoAtomico('Nível de conjurador 12', { nivelConjurador: 3 }).ok).toBe(false);
    });
});

describe('checarRequisitoAtomico — classe + nível', () => {
    it('Guerreiro 4 satisfeito por guerreiro nível 4', () => {
        const r = R.checarRequisitoAtomico('Guerreiro 4', { classeSlug: 'guerreiro', nivel: 4 });
        expect(r.ok).toBe(true);
    });
    it('Guerreiro 8 falha para guerreiro nível 5', () => {
        const r = R.checarRequisitoAtomico('Guerreiro 8', { classeSlug: 'guerreiro', nivel: 5 });
        expect(r.ok).toBe(false);
    });
    it('Monge 1 falha para bárbaro', () => {
        const r = R.checarRequisitoAtomico('Monge 1', { classeSlug: 'barbaro', nivel: 1 });
        expect(r.ok).toBe(false);
    });
});

describe('checarRequisitoAtomico — expulsão de mortos-vivos', () => {
    it('Clérigo satisfaz em qualquer nível', () => {
        const r = R.checarRequisitoAtomico('Capacidade de expulsar mortos-vivos', { classeSlug: 'clerigo', nivel: 1 });
        expect(r.ok).toBe(true);
    });
    it('Paladino satisfaz apenas a partir do nível 4', () => {
        expect(R.checarRequisitoAtomico('Capacidade de expulsar mortos-vivos', { classeSlug: 'paladino', nivel: 3 }).ok).toBe(false);
        expect(R.checarRequisitoAtomico('Capacidade de expulsar mortos-vivos', { classeSlug: 'paladino', nivel: 4 }).ok).toBe(true);
    });
    it('Guerreiro não satisfaz', () => {
        expect(R.checarRequisitoAtomico('Capacidade de expulsar mortos-vivos', { classeSlug: 'guerreiro', nivel: 20 }).ok).toBe(false);
    });
});

describe('checarRequisitoAtomico — talento por nome', () => {
    it('Talento pré-requisito não selecionado falha', () => {
        const r = R.checarRequisitoAtomico('Esquiva', {
            todosTalentosNomes: ['Esquiva', 'Mobilidade'],
            talentosSelecionados: [],
        });
        expect(r.ok).toBe(false);
    });
    it('Talento pré-requisito já selecionado passa', () => {
        const r = R.checarRequisitoAtomico('Esquiva', {
            todosTalentosNomes: ['Esquiva', 'Mobilidade'],
            talentosSelecionados: ['Esquiva'],
        });
        expect(r.ok).toBe(true);
    });
});

describe('avaliarPreRequisitos', () => {
    it('sem pré-requisitos = ok', () => {
        expect(R.avaliarPreRequisitos(null).ok).toBe(true);
        expect(R.avaliarPreRequisitos('').ok).toBe(true);
    });
    it('múltiplos requisitos com AND (vírgulas): todos devem passar', () => {
        const r = R.avaliarPreRequisitos('Destreza 17, Combate com Duas Armas, BBA +6', {
            atributos: { destreza: 17 },
            bba: 6,
            todosTalentosNomes: ['Combate com Duas Armas'],
            talentosSelecionados: ['Combate com Duas Armas'],
        });
        expect(r.ok).toBe(true);
    });
    it('falha se um dos requisitos AND falha', () => {
        const r = R.avaliarPreRequisitos('Destreza 17, Combate com Duas Armas, BBA +6', {
            atributos: { destreza: 15 }, // falha aqui
            bba: 6,
            todosTalentosNomes: ['Combate com Duas Armas'],
            talentosSelecionados: ['Combate com Duas Armas'],
        });
        expect(r.ok).toBe(false);
    });
    it('OR ("ou"): satisfaz se qualquer alternativa for verdadeira — caso Golpe Atordoante', () => {
        // Monge nível 1: satisfaz via alternativa "Monge 1"
        const monge = R.avaliarPreRequisitos('Destreza 13, Sabedoria 13, BBA +8 ou Monge 1', {
            atributos: { destreza: 13, sabedoria: 13 },
            bba: 0,
            classeSlug: 'monge',
            nivel: 1,
        });
        expect(monge.ok).toBe(true);

        // Guerreiro nível 8: satisfaz via alternativa "BBA +8"
        const gLevel8 = R.avaliarPreRequisitos('Destreza 13, Sabedoria 13, BBA +8 ou Monge 1', {
            atributos: { destreza: 13, sabedoria: 13 },
            bba: 8,
            classeSlug: 'guerreiro',
            nivel: 8,
        });
        expect(gLevel8.ok).toBe(true);

        // Guerreiro nível 1: nenhuma alternativa satisfeita, falha
        const gLevel1 = R.avaliarPreRequisitos('Destreza 13, Sabedoria 13, BBA +8 ou Monge 1', {
            atributos: { destreza: 13, sabedoria: 13 },
            bba: 1,
            classeSlug: 'guerreiro',
            nivel: 1,
        });
        expect(gLevel1.ok).toBe(false);
    });
    it('Foco em Arma Maior: exige Foco em Arma + Guerreiro 8', () => {
        const r = R.avaliarPreRequisitos('Foco em Arma, Guerreiro 8', {
            classeSlug: 'guerreiro',
            nivel: 8,
            todosTalentosNomes: ['Foco em Arma', 'Foco em Arma Maior'],
            talentosSelecionados: ['Foco em Arma'],
        });
        expect(r.ok).toBe(true);
    });
    it('Foco em Arma Maior falha para guerreiro nível 4', () => {
        const r = R.avaliarPreRequisitos('Foco em Arma, Guerreiro 8', {
            classeSlug: 'guerreiro',
            nivel: 4,
            todosTalentosNomes: ['Foco em Arma', 'Foco em Arma Maior'],
            talentosSelecionados: ['Foco em Arma'],
        });
        expect(r.ok).toBe(false);
    });
});

// ============ Ouro inicial ============

describe('ouroInicial', () => {
    it('guerreiro, paladino, patrulheiro começam com 150 PO', () => {
        expect(R.ouroInicial('guerreiro')).toBe(150);
        expect(R.ouroInicial('paladino')).toBe(150);
        expect(R.ouroInicial('patrulheiro')).toBe(150);
    });
    it('clérigo e ladino começam com 125 PO', () => {
        expect(R.ouroInicial('clerigo')).toBe(125);
        expect(R.ouroInicial('ladino')).toBe(125);
    });
    it('bárbaro e bardo começam com 100 PO', () => {
        expect(R.ouroInicial('barbaro')).toBe(100);
        expect(R.ouroInicial('bardo')).toBe(100);
    });
    it('feiticeiro e mago começam com 75 PO', () => {
        expect(R.ouroInicial('feiticeiro')).toBe(75);
        expect(R.ouroInicial('mago')).toBe(75);
    });
    it('druida começa com 50 PO', () => {
        expect(R.ouroInicial('druida')).toBe(50);
    });
    it('monge começa com 12,5 PO (voto de pobreza)', () => {
        expect(R.ouroInicial('monge')).toBe(12.5);
    });
    it('classe desconhecida = 0', () => {
        expect(R.ouroInicial('inexistente')).toBe(0);
    });
});

// ============ Parser de preço ============

describe('parsePreco', () => {
    it('parse PO (peça de ouro)', () => {
        expect(R.parsePreco('10 PO')).toBe(10);
        expect(R.parsePreco('1 PO')).toBe(1);
    });
    it('parse PP (prata) = 1/10 PO', () => {
        expect(R.parsePreco('5 PP')).toBe(0.5);
        expect(R.parsePreco('1 PP')).toBe(0.1);
    });
    it('parse PC (cobre) = 1/100 PO', () => {
        expect(R.parsePreco('1 PC')).toBe(0.01);
        expect(R.parsePreco('5 PC')).toBe(0.05);
    });
    it('parse números com separador de milhar português (1.500 PO)', () => {
        expect(R.parsePreco('1.500 PO')).toBe(1500);
        expect(R.parsePreco('10.000 PO')).toBe(10000);
    });
    it('parse números com vírgula decimal', () => {
        expect(R.parsePreco('2,5 PO')).toBe(2.5);
    });
    it('vazio, hífen ou nulo = 0', () => {
        expect(R.parsePreco('')).toBe(0);
        expect(R.parsePreco('-')).toBe(0);
        expect(R.parsePreco('—')).toBe(0);
        expect(R.parsePreco(null)).toBe(0);
        expect(R.parsePreco(undefined)).toBe(0);
    });
    it('formatos inválidos = 0', () => {
        expect(R.parsePreco('abc')).toBe(0);
        expect(R.parsePreco('10')).toBe(0);
        expect(R.parsePreco('10 XX')).toBe(0);
    });
});

// ============ Capacidade de carga ============

describe('cargaPesadaMax', () => {
    it('FOR 10 = 50 kg', () => expect(R.cargaPesadaMax(10)).toBe(50));
    it('FOR 15 = 100 kg (dobra a cada +5)', () => expect(R.cargaPesadaMax(15)).toBe(100));
    it('FOR 18 = 150 kg', () => expect(R.cargaPesadaMax(18)).toBe(150));
    it('FOR 20 = 200 kg', () => expect(R.cargaPesadaMax(20)).toBe(200));
    it('FOR 25 = 400 kg', () => expect(R.cargaPesadaMax(25)).toBe(400));
    it('valores fora da tabela são clampados', () => {
        expect(R.cargaPesadaMax(-5)).toBe(5);   // FOR 1
        expect(R.cargaPesadaMax(50)).toBe(800); // cap em 30
    });
});

describe('cargaMediaMax e cargaLeveMax', () => {
    it('FOR 10: 33 média e 16.5 leve (2/3 e 1/3 da pesada)', () => {
        expect(R.cargaMediaMax(10)).toBeCloseTo(33.3, 1);
        expect(R.cargaLeveMax(10)).toBeCloseTo(16.7, 1);
    });
    it('FOR 15: 66,7 média e 33,3 leve', () => {
        expect(R.cargaMediaMax(15)).toBeCloseTo(66.7, 1);
        expect(R.cargaLeveMax(15)).toBeCloseTo(33.3, 1);
    });
});

describe('nivelCarga', () => {
    it('FOR 10 e 20 kg = leve', () => {
        expect(R.nivelCarga(10, 10)).toBe('leve');
    });
    it('FOR 10 e 25 kg = media (acima de leve, dentro de média)', () => {
        expect(R.nivelCarga(25, 10)).toBe('media');
    });
    it('FOR 10 e 40 kg = pesada', () => {
        expect(R.nivelCarga(40, 10)).toBe('pesada');
    });
    it('FOR 10 e 60 kg = excedida', () => {
        expect(R.nivelCarga(60, 10)).toBe('excedida');
    });
    it('zero peso = leve', () => {
        expect(R.nivelCarga(0, 10)).toBe('leve');
    });
});

// ============ Soma de seleção ============

describe('somarSelecao', () => {
    const lista = [
        { id: 1, peso: 2, preco: '10 PO' },
        { id: 2, peso: 0.5, preco: '5 PP' },
        { id: 3, peso: 5, preco: '1 PO' },
    ];

    it('array de IDs soma sem quantidade (1× cada)', () => {
        expect(R.somarSelecao(lista, [1, 2], i => i.peso)).toBe(2.5);
    });

    it('mapa {id: qty} multiplica pela quantidade', () => {
        expect(R.somarSelecao(lista, { 1: 3, 2: 4 }, i => i.peso)).toBe(2 * 3 + 0.5 * 4);
    });

    it('ignora IDs inexistentes', () => {
        expect(R.somarSelecao(lista, { 99: 5 }, i => i.peso)).toBe(0);
    });

    it('ignora quantidades zero ou negativas', () => {
        expect(R.somarSelecao(lista, { 1: 0, 2: -3, 3: 2 }, i => i.peso)).toBe(10);
    });

    it('lista vazia = 0', () => {
        expect(R.somarSelecao([], { 1: 1 }, i => i.peso)).toBe(0);
    });

    it('funciona para soma de preços via parsePreco', () => {
        // 3× "10 PO" + 4× "5 PP" (0.5 PO cada) = 30 + 2 = 32 PO
        expect(R.somarSelecao(lista, { 1: 3, 2: 4 }, i => R.parsePreco(i.preco))).toBe(32);
    });
});
