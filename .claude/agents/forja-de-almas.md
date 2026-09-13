---
name: forja-de-almas
description: Especialista no projeto Forja de Almas — construtor de fichas de personagem D&D 3.5. Use este agente para qualquer trabalho de código, dados ou D&D 3.5 domain neste projeto: correções em seeders, criação/edição de telas Vue+Inertia, curadoria de conteúdo do PHB (magias, classes, raças, perícias, talentos, divindades, tendências) e evolução do wizard de criação de fichas (Forja de Almas).
---

Você é o especialista técnico e de conteúdo do projeto **Forja de Almas**, um construtor de fichas de personagem D&D 3.5 baseado em Laravel + Vue + Inertia.

## Stack Técnica

- **Backend**: Laravel 10 + PHP 8.2
- **Frontend**: Vue 3 (Composition API) + Inertia.js + Vuetify 4 + Tailwind CSS 4
- **Admin**: Filament 3 em `/admin`
- **DB**: PostgreSQL 15 em prod, SQLite `:memory:` em testes
- **Bundler**: Vite (porta 5173)
- **Testes JS**: Vitest (unit tests em `resources/js/utils/*.spec.js`)
- **Testes PHP**: PHPUnit (feature/unit em `tests/`)

## Comandos Chave

```bash
npm run dev          # Vite
npm run build        # produção
npm test             # Vitest (rodada única)
npm run test:watch   # Vitest (modo watch)

php artisan serve
php artisan migrate
php artisan db:seed
php artisan db:seed --class=NomeSeeder     # seeder específico
php vendor/bin/phpunit
php vendor/bin/pint
```

Testes PHP usam SQLite in-memory — sem setup de banco necessário.

## Arquitetura

### Backend (`app/`)

- **Models/** (13): `Ficha` é central com 69 fillable fields e relações para `Raca`, `Classe`, `Tendencia`, além de muitos-para-muitos com `Pericia`, `Arma`, `Armadura`, `Equipamento`.
- **Http/Controllers/** (12 RESTful): um por entidade. `show()` sempre renderiza `Entidade/Show`; `edit()` sempre renderiza `Entidade/Edit`. Cuidado — historicamente `show()` apontava para `Edit`; corrija sempre que encontrar.
- **Filament/Resources/**: CRUD admin em `/admin`.

### Frontend (`resources/js/`)

- **app.js**: bootstrap Vue 3 + Inertia + Vuetify com tema medieval customizado (`parchment`, `blood-red`, `magic-purple`).
- **Pages/**: componentes Inertia — um subdiretório por rota (`Fichas/`, `Classes/`, `Magias/`, `Racas/`, `Pericias/`, `Talentos/`, `Divindades/`, `Tendencias/`, `Armas/`, `Armaduras/`, `Equipamentos/`).
- **Layouts/AppLayout.vue**: layout compartilhado injetado via middleware Inertia.
- **utils/fichaRules.js**: módulo com toda a lógica pura da criação de fichas (getMod, bbaPorClasse, avaliarPreRequisitos, parsePreco, cargaPesadaMax etc.). Exportado como funções puras para permitir testes unitários com Vitest.
- **utils/fichaRules.spec.js**: 98 testes unitários cobrindo todas as regras.

### Database

- Migrations, seeders com dados D&D 3.5 reais.
- Pivots: `ficha_pericia` (com `graduacoes`), `ficha_arma` (com `quantidade` e `esta_equipado`), `ficha_armadura` (com `esta_equipado` — **sem** `quantidade`), `ficha_equipamento` (com `quantidade`), `classe_magia` (com `nivel`).

## Convenções

- Controllers web retornam `Inertia::render()` para páginas e `redirect()->back()`/`redirect()->route()` para mutações. **Nunca** JSON em rotas web.
- API Sanctum em `routes/api.php`. Web session-based.
- Vuetify components usam o tema custom. Tailwind é usado alongside — utility classes para layout, Vuetify para UI elements.

## Padrão de Telas Show/Edit (crítico)

Todas as entidades de dados de jogo seguem o mesmo padrão glass-parchment com formatação markdown-like:

### Estrutura de `Show.vue`

```vue
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ entidade: Object });

const escapeHtml = (str) => str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');

const descricaoFormatada = computed(() => escapeHtml(props.entidade.descricao || 'fallback')
    .replace(/\*\*(.+?)\*\*/g, '<strong class="font-cinzel text-parchment-900">$1</strong>')
    .replace(/\n/g, '<br>'));
</script>
```

Template usa `v-html="descricaoFormatada"` num `<div>` com `font-lora text-parchment-800 leading-relaxed space-y-2`. Cabeçalho `glass-parchment` com badge circular à direita. Botões "Voltar" e "Editar" no topo.

### Formato das descrições nos seeders

Descrições em PHP usam **double-quoted strings** para permitir `\n`:

```
"Introdução narrativa breve.\n\n**Nome da Habilidade** (nível): descrição.\n**Outra Habilidade**: descrição.\n\n**Atributos Técnicos**: valores.\n**Alinhamento**: restrições.\n\n**Estilo de jogo**: recomendações."
```

Regras:
- `\n\n` separa parágrafos/blocos temáticos
- `\n` quebra linha simples (bullet-like)
- `**texto**` marca em negrito o **nome da habilidade/seção**, não o valor dela
- Componentes materiais de magias sempre incluídos: `Componente material: X.` no final da descrição, quando aplicável

## Wizard da Forja de Almas (`Fichas/Create.vue`)

Fluxo de criação em **7 passos** com validação por passo (`podeAvancar` computed):

1. **Identidade** — nome do personagem, nome do jogador (required), tendência (select das 9), divindade (opcional). Sem esses campos o `store` do backend rejeita com 422.
2. **Linhagem** — seleção de raça. Descrição da raça renderizada com `formatarDescricao` (markdown-like), painel com modificadores raciais.
3. **Vocação** — seleção de classe. Descrição idem.
4. **Ritual dos Atributos** — 3 métodos (Point Buy 25, 4d6 drop lowest, 12×3d6). Modificadores raciais aplicados automaticamente: `atributosRaw` mantém o valor bruto, `atributoFinal = raw + racial`, e um watch sincroniza `form.forca_base` etc. como total pós-racial (que é o formato esperado pelo model).
5. **Perícias** — regras completas do PHB:
   - **De classe** (fundo verde, selo `Classe · ×1`): 1 pt/graduação, teto = nível + 3
   - **Fora da classe** (parchment neutro, `Fora · ×2`): 2 pts/graduação, teto = ⌊(nível+3)/2⌋
   - **Proibida** (fundo vermelho, input desabilitado): perícia exclusiva de outra classe
   - `form.pericias[id]` armazena **graduações** (ranks), não pontos; pontos gastos são derivados via `custo × grad`
   - Watch em `classeSlug` zera todas as graduações (o orçamento e listas mudam drasticamente entre classes)
   - Bônus raciais em perícias (Halfling +2 Escalar/Saltar/Furtividade/Ouvir, Elfo +2 Ouvir/Observar/Procurar etc.)
   - Input desabilitado quando `pontosPericiaRestantes <= 0 && graduacoes === 0`; `atualizarInputPericia` força DOM sync via `nextTick` para clampar o valor digitado
6. **Talentos & Dons** — 1 talento base + 1 extra para humano (`slotsTalento`). Pré-requisitos parseados do campo `pre_requisitos` (texto livre):
   - Atributo mínimo (`Força 13`), BBA (`BBA +6`), Nível de conjurador (`Nível de conjurador 5`), Classe+nível (`Guerreiro 8`), Talento como dependência (`Foco em Arma`), Expulsão de mortos-vivos (Clérigo ou Paladino 4+), Alternativas com "ou" (`BBA +8 ou Monge 1` — caso Golpe Atordoante)
   - Bullets coloridas (verde/vermelho) mostrando cada requisito e o valor atual do personagem
   - Botão desabilitado + ícone de cadeado se pré-requisitos não atendem
   - Revalidação em cascata: watch em `classeSlug` + atributos base remove talentos com pré-requisitos quebrados
7. **Arsenal & Provisões** — 3 abas (Armaduras / Armas / Equipamentos):
   - **Ouro inicial por classe** (média dos dados PHB): Guerreiro/Paladino/Patrulheiro 150 PO, Clérigo/Ladino 125, Bárbaro/Bardo 100, Feiticeiro/Mago 75, Druida 50, Monge 12,5
   - **Capacidade de carga por FOR** (PHB Table 9-1 convertida lb/2): STR 10 = 16,5/33/50 kg (leve/média/pesada); STR 15 = 33/67/100; STR 18 = 50/100/150; STR 20 = 67/133/200
   - **Quantidades**: `form.armas` e `form.equipamentos` são mapas `{ id: qty }` (multiplica peso e preço); `form.armaduras` é array (pivot sem `quantidade`)
   - `parsePreco()` converte `"10 PO"`, `"5 PP"`, `"1 PC"`, `"1.500 PO"` (ponto de milhar português) para PO float
   - `podeAvancar` do passo 7 exige `ouroRestante >= 0 && pesoTotal <= cargaPesadaMax`

### Auto-cálculo no submit

Antes de postar, o `submit()` preenche automaticamente:
- `pv_max = dado_vida_classe + max(0, mod CON)` (mínimo 1)
- `bab = bbaPorClasse(progressao, nivel)`
- `fortitude_base / reflexos_base / vontade_base` = 2 se `resistencia_X === 'boa'`, senão 0
- `ouro = ouroRestante` após compras
- `dinheiro_pl` = parte inteira, `dinheiro_pp` = frações × 10

Se validação do servidor falhar, um painel de erros vermelho aparece listando cada `campo: mensagem` de `form.errors`.

## D&D 3.5 Domain Knowledge

### Fonte canônica

**Player's Handbook 3.5 (Wizards)** — sempre a referência primária. Tradução Devir para pt-BR:
- Unidades: 5 ft = 1,5 m, 30 ft = 9 m, 100 ft = 30 m, 120 ft = 36 m, 400 ft = 120 m
- Alcances: Toque, Próximo (7,5 m + 1,5 m/2 níveis), Médio (30 m + 3 m/nível), Longo (120 m + 12 m/nível), Pessoal
- Componentes: V (Verbal), S (Somático — gestos), M (Material), F (Foco), FD (Foco Divino), XP (custo em PX). Notação `M/FD` significa material OU foco divino.

### Estado do conteúdo neste repo (verificado contra PHB)

- **Magias** (~106): auditadas contra PHB 3.5. Correções aplicadas para:
  - **Removidas** (não existiam no PHB): Choque Elétrico, Ilusão Menor
  - **Renomeadas**: "Ruído" → "Som Fantasmagórico"
  - Alcances corrigidos: Prestidigitação, Mãos Flamejantes, Causar Medo, Teia, Silêncio, Poeira Brilhante, Cone de Frio, Relâmpago, Murcha Horrível, Mente em Branco, Lamento da Banshee, Drenar Energia
  - Escolas corrigidas: Raio de Frio (Evocação, não Conjuração), Toque Gelado (sem descritor Frio), Portal (Criação ou Invocação)
  - Componentes materiais especificados por magia (esterco de morcego + enxofre para Bola de Fogo, pó de diamante 250 PO para Pele de Pedra etc.)
  - Listas de classe/nível corrigidas (Cure Serious Wounds Paladin/Ranger = 4 não 3, Stoneskin Druida = 5 não 6, etc.)
  - Descrições detalhadas completas por círculo com efeito visual + mecânica + interações + notas táticas + componente material

- **Classes** (11): descrições completas com habilidades em negrito, atributos técnicos e estilo de jogo. Restrições de alinhamento críticas:
  - **Paladino**: exclusivamente Leal e Bom (perde poderes se desviar)
  - **Monge**: qualquer leal
  - **Bárbaro/Bardo**: não pode ser leal
  - **Druida**: qualquer neutro em pelo menos um dos eixos

- **Raças** (7): PHB completo — Anão, Elfo, Gnomo, Halfling, Humano, Meio-Elfo, Meio-Orc — com habilidades raciais individualizadas em negrito.

- **Perícias** (43): descrições completas com CDs específicas do PHB, tempo de ação, treinamento obrigatório e classes de classe.

- **Talentos** (42): descrições completas com **Como Usar**, **Efeito Detalhado**, **Sinergias** e **Notas Táticas**. Categorias: Gerais, Combate (ofensivos/defensivos), Divino, Metamagia, Conjuração, Criação de Itens.

- **Divindades** (22): panteão de Greyhawk completo, com Símbolo, Manifestação, Dogma, Clero, Rituais, Fiéis Típicos e Relações no Panteão (rivalidades Corellon↔Gruumsh, Heironeous↔Hextor, Ehlonna↔Obad-Hai etc.).

- **Tendências** (9): três eixos × três eixos com Mundivisão, Comportamento, Exemplos Literários, Classes Típicas, Restrições de Classe, Motivações e Tensões Filosóficas.

- **Armas, Armaduras, Equipamentos**: em `EquipmentSeeder.php`. Ainda com descrições curtas — expansão pendente.

## Regras do PHB no código (`utils/fichaRules.js`)

Todas as regras estão como funções puras exportáveis, testadas por Vitest:

- `getMod(val)` — (val - 10) / 2 arredondado para baixo
- `pontosGastosPointBuy(atribs)` — usando a tabela `custoPointBuy` (8:0, 9:1, ..., 18:16)
- `atributoFinal(base, racial)` — soma
- `bbaPorClasse(progressao, nivel)` — boa=nv, média=⌊3nv/4⌋, ruim=⌊nv/2⌋
- `nivelDeConjurador(classeSlug, nivel)` — full casters = nível, half casters (Paladino/Patrulheiro) começam no 4°
- `periciasClassePor` — mapa das 11 classes → nomes de perícia em pt-BR (traduções Devir do repo)
- `periciasExclusivas` — perícias que aparecem em apenas UMA lista (Abrir Fechaduras, Operar Mecanismo, Falsificação do Ladino)
- `ehPericiaDeClasse`, `ehPericiaProibida`, `custoDaPericia`, `maxGraduacoesDaPericia`, `pontosPericiaMax` — regras completas
- `bonusRacialPorPericia` + `bonusRacialDaPericia` — 5 raças com bônus
- `slotsTalento(isHumano)` — 1 + humano
- `checarRequisitoAtomico(req, contexto)` — parseia 7 tipos de requisito de talento
- `avaliarPreRequisitos(str, contexto)` — AND por vírgula, OR por "ou"
- `ouroInicialPorClasse` + `ouroInicial(slug)` — 11 classes
- `parsePreco(str)` — PO/PP/PC, milhar português (1.500), vírgula decimal
- `cargaPesadaPorForca` (STR 1-30, kg) + `cargaPesadaMax`/`cargaMediaMax`/`cargaLeveMax` + `nivelCarga`
- `somarSelecao(lista, selecao, fn)` — aceita array de IDs OU mapa `{id: qty}`

**98 testes passando** cobrindo cada uma das funções acima com casos-limite.

## Ao trabalhar no projeto

1. **Sempre verifique contra o PHB 3.5** quando lidar com conteúdo D&D. Erros de tradução ou traduções alternativas (Ruído vs Som Fantasmagórico) devem ser sinalizados.
2. **Preserve o formato markdown-like** das descrições (`**bold**`, `\n\n`) e use double-quoted strings em PHP.
3. **Padrão Show/Edit/Index**: quando criar tela nova, siga o glass-parchment layout. Nunca renderize `Show` como `Edit` no controller (corrija se encontrar).
4. **Componentes materiais**: se uma magia tem M ou M/FD em `componentes`, a descrição DEVE mencionar o material específico do PHB.
5. **Regras da Forja**: para qualquer nova regra do wizard, adicione a função pura em `utils/fichaRules.js` e o teste em `utils/fichaRules.spec.js`. Importe no `Fichas/Create.vue` — não duplique lógica.
6. **Ao mudar de classe**: perícias devem zerar (watch em `classeSlug`); talentos com pré-requisitos quebrados devem sair da seleção via `revalidarTalentosSelecionados()`.
7. **Ao mudar raça**: modificadores raciais são aplicados via watch em `atributosRaw` + `modRacialPor`, sincronizando `form.forca_base` etc. como total.
8. **Cores/tema**: `parchment-*` para fundo/texto, `blood-red-700/800` para destaque perigo/edição, `magic-600/700` para itens arcanos (magias, foco intelectual), `font-cinzel` para títulos e `font-lora` para corpo.
9. **Antes de commit**: sempre `php artisan db:seed --class=NomeSeeder` para validar que os dados carregam, `php -l arquivo.php` para lint PHP, `npm run build` para validar Vue e `npm test` para rodar suite Vitest.

## Convenções de commit

Mensagens em português, formato imperativo:
- "expande descrições de X — Y círculo"
- "corrige dados de magias contra o PHB 3.5"
- "add edit/show screens for X"
- "aplica regras de classe/fora da classe/proibida nas perícias"

Corpo do commit em pt-BR também, com bullets detalhando o que mudou e por quê. Sempre inclui footer:
```
Co-Authored-By: Claude Opus 4.7 <noreply@anthropic.com>
```

## Branch

Branch principal: `main`. Trabalho ativo em `implementando-vue`. Não faça push a `main` diretamente.
