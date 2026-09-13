<?php

namespace Database\Seeders;

use App\Models\Talento;
use Illuminate\Database\Seeder;

class TalentoSeeder extends Seeder
{
    public function run(): void
    {
        $talentos = [
            // --- Gerais ---
            [
                'nome' => 'Alerta',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => '+2 em Ouvir e +2 em Observar.',
                'descricao' => "Seus sentidos aguçados tornam difícil surpreendê-lo — você percebe o farfalhar de folhas antes de outros, nota o brilho de uma lâmina saindo de uma bainha, escuta uma respiração contida atrás de uma porta.\n\n**Como Usar**: passivo, sempre ativo. Aplica-se automaticamente a todos os testes de Ouvir e Observar do personagem.\n**Efeito Detalhado**: os bônus de +2 são raciais/de talento e se acumulam com bônus de perícia, habilidade racial, itens mágicos (como Amuleto de Alertness) e magias.\n**Sinergias**: combina bem com **Iniciativa Aprimorada** para personagens que priorizam surpresa. Familiares proporcionam efeito idêntico automaticamente — Alerta redundante nesse caso.\n**Notas Táticas**: escolha essencial para batedores, ladinos, patrulheiros e qualquer aventureiro que queira reduzir chance de ser pego de surpresa. Barato: sem pré-requisitos.",
            ],
            [
                'nome' => 'Corrida',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => 'Corre 5 vezes seu deslocamento (em vez de 4). Não perde o bônus de DES na CA ao correr. Pode fazer testes de Saltar após corrida de apenas 3 m em vez de 6 m.',
                'descricao' => "Você domina a arte da corrida em velocidade extrema — mantém coordenação sobre pés que voam sobre o solo, olhos em direção ao horizonte, respiração medida.\n\n**Como Usar**: ativa-se automaticamente ao declarar corrida (Ação de Rodada Completa) durante o turno.\n**Efeito Detalhado**: (1) velocidade de corrida sobe de 4× para 5× o deslocamento base (bárbaros com Deslocamento Rápido correm ainda mais rápido); (2) sem penalidade -2 na CA por perder DES durante a corrida (correr normalmente elimina o bônus de DES); (3) permite Saltar com corrida efetiva a partir de 3 m em vez dos 6 m padrão.\n**Sinergias**: excelente com **Vigor** (resistir a fadiga de corrida prolongada) e habilidades de deslocamento aumentado. Bárbaros aproveitam ao máximo — 4×5 = 20× a velocidade base em terreno aberto.\n**Notas Táticas**: essencial para batedores, mensageiros, kiters (arqueiros que fogem em círculos), e para fugir de encontros perigosos. Barato: sem pré-requisitos.",
            ],
            [
                'nome' => 'Grande Fortitude',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => '+2 em todos os testes de resistência de Fortitude.',
                'descricao' => "Seu corpo é extraordinariamente resistente — capaz de suportar venenos que abateriam outros, doenças mortais, esforço físico prolongado sem colapso.\n\n**Como Usar**: passivo, sempre ativo. Aplica-se a todos os TR de Fortitude sem exceção.\n**Efeito Detalhado**: o bônus de +2 empilha-se com bônus racial, de classe e de itens. Uma classe com Fortitude Boa e Grande Fortitude gera diferença dramática em sobrevivência contra magias como Palavra do Poder, Desintegrar e efeitos de veneno.\n**Sinergias**: **Reflexos Rápidos** e **Vontade de Ferro** são os companheiros óbvios, formando o \"trio de resistências\" para conjuradores frágeis, ladinos e outros com TRs Ruins.\n**Notas Táticas**: escolha essencial para classes com Fortitude Ruim (Mago, Feiticeiro, Ladino) que enfrentam venenos frequentes ou magias de morte no alto nível. Para classes com Fortitude Boa já, é um reforço barato.",
            ],
            [
                'nome' => 'Iniciativa Aprimorada',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => '+4 em testes de iniciativa.',
                'descricao' => "Você reage antes dos demais em situações de combate — o coração está sempre pronto para acelerar, a mente está sempre um passo à frente do movimento inimigo.\n\n**Como Usar**: passivo, sempre ativo. Adiciona +4 automaticamente ao teste de iniciativa (1d20 + DES-mod + outros).\n**Efeito Detalhado**: bônus de +4 é substancial — em uma escala de 0 a 30 típica, aumenta drasticamente a chance de agir primeiro. Empatam iniciativas comparam o modificador de DES (então DES 18 costuma vencer DES 16 no empate).\n**Sinergias**: cruzada com **Alerta** para não ser surpreendido. Ideal para ladinos com Ataque Furtivo (primeiro golpe surpreende), conjuradores frágeis (evitar ser atacado antes de agir) e arqueiros (posicionamento rápido).\n**Notas Táticas**: um dos melhores talentos do jogo — a rodada de vantagem em iniciativa frequentemente decide encontros inteiros. Pico de valor em builds com Ataque Furtivo, magias de ação rápida ou combinações que dependem de agir antes.",
            ],
            [
                'nome' => 'Reflexos Rápidos',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => '+2 em todos os testes de resistência de Reflexos.',
                'descricao' => "Sua agilidade natural permite escapar de perigos repentinos — desviar de bolas de fogo, saltar de armadilhas mecânicas, esquivar de investidas.\n\n**Como Usar**: passivo, sempre ativo. Aplica-se a todos os TR de Reflexos, inclusive contra magias de área (Bola de Fogo, Cone de Frio, Relâmpago).\n**Efeito Detalhado**: bônus de +2 empilha-se com bônus de classe, DES e itens. Um conjurador com Reflexos Ruins mas Reflexos Rápidos, DES 14 e Capa da Resistência +2 vai de +0 (baseline) para +5 em Reflexos — diferença crítica contra magias devastadoras.\n**Sinergias**: **Evasão** (habilidade de classe do monge/ladino/patrulheiro) transforma cada TR passado em zero dano; Reflexos Rápidos amplia dramaticamente a proteção.\n**Notas Táticas**: essencial para classes com Reflexos Ruim (Guerreiro, Clérigo, Feiticeiro) que enfrentam magias de área. Também obrigatório em campanhas com muitas armadilhas mecânicas.",
            ],
            [
                'nome' => 'Vigor',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => '+4 nos testes de Constituição feitos para resistir a privação (exaustão, desidratação, sufocamento, calor extremo, jornadas forçadas).',
                'descricao' => "Você suporta esforços prolongados com facilidade incomum — sobrevive dias sem comida, marcha sob chuva torrencial sem cansar, permanece em ambientes hostis.\n\n**Como Usar**: passivo. Ativa-se automaticamente em testes de CON contra situações de privação: correr por mais de rodadas, marchar mais que 8 horas, prender respiração, resistir a temperatura extrema, aguentar fome/sede/sono.\n**Efeito Detalhado**: bônus de +4 (o dobro da maioria dos talentos de saves) é substancial. Além disso, o talento permite dormir com armadura leve ou média sem sofrer fadiga (normalmente impossível).\n**Sinergias**: combina naturalmente com **Corrida** (correr por mais rodadas), **Vitalidade** (mais PVs para absorver dano não-letal de privação) e **Grande Fortitude**.\n**Notas Táticas**: obrigatório em campanhas de exploração longa (desertos, montanhas, mares), sobrevivência ao ar livre, ou builds que dependem de manter armadura por longos períodos. Menos útil em campanhas urbanas ou dungeons rápidas.",
            ],
            [
                'nome' => 'Vitalidade',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => '+3 pontos de vida permanentes.',
                'descricao' => "Você é mais robusto e resistente que a média — carrega em si uma reserva vital adicional que o mantém em pé quando outros cairiam.\n\n**Como Usar**: passivo, permanente. Aumenta o PV máximo em +3 no momento em que é adquirido.\n**Efeito Detalhado**: o bônus é permanente e retroativo apenas ao personagem atual — quando você sobe de nível, os +3 PVs continuam somados ao total. Aplica-se ao cálculo total, então +3 num nível baixo compensa bem uma classe com Dado de Vida baixo.\n**Sinergias**: pode ser adquirido múltiplas vezes por classes com talentos bônus abundantes (guerreiros de alto nível costumam pegar duas ou três vezes). Cada aplicação adiciona +3 PVs (total: +3, +6, +9...).\n**Notas Táticas**: escolha excelente para classes de baixo dado de vida (Mago d4, Feiticeiro d4, Bardo d6) que precisam de mais margem para sobreviver aos primeiros níveis. Menos crítico para bárbaros d12 ou guerreiros d10 mas ainda útil.",
            ],
            [
                'nome' => 'Vontade de Ferro',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => '+2 em todos os testes de resistência de Vontade.',
                'descricao' => "Sua mente é uma fortaleza contra influências externas — resiste a encantos mentais, ilusões que enganam a razão, medos mágicos que paralisam a alma.\n\n**Como Usar**: passivo, sempre ativo. Aplica-se a todos os TR de Vontade, inclusive contra magias de Encantamento, Compulsão, Medo, Ilusão descrença.\n**Efeito Detalhado**: bônus de +2 empilha-se com bônus de classe, SAB e itens. Vontade é uma das defesas mais atacadas em combate por magos inimigos — Dominar Pessoa, Encantar Monstro, Sono, Sono Profundo, Confusão, Insanidade e outras confiam no fracasso do TR de Vontade.\n**Sinergias**: essencial para builds anti-magia. Combina com **Grande Fortitude** e **Reflexos Rápidos** para o trio completo de resistências. Certas magias como Mente em Branco tornam parte dela redundante.\n**Notas Táticas**: obrigatório para classes com Vontade Ruim (Guerreiro, Bárbaro, Ladino, Patrulheiro) que enfrentam conjuradores hostis. Um guerreiro dominado por Dominar Pessoa é o pesadelo de qualquer grupo.",
            ],

            // --- Combate: ofensivos ---
            [
                'nome' => 'Acuidade com Arma',
                'tipo' => 'Combate',
                'pre_requisitos' => 'BBA +1',
                'beneficio' => 'Usa o modificador de DES em vez de FOR nas jogadas de ataque com armas leves (também rapieira, corrente espigada, whip e ataques desarmados).',
                'descricao' => "Sua destreza superа a força bruta quando empunha armas ágeis — atinge alvos pela precisão dos movimentos, não pela força de empurrar aço.\n\n**Como Usar**: passivo, permanente. Substitui automaticamente o modificador de FOR pelo de DES em jogadas de ataque em melee com armas qualificadas.\n**Efeito Detalhado**: aplica-se apenas às **jogadas de ataque** — o dano continua sendo calculado com FOR (a menos que outros talentos como **Duel Weapon Finesse** ou capacidades de classe alterem isso). Armas qualificadas: qualquer arma leve, mais rapieira, corrente espigada, chicote (whip) e ataque desarmado.\n**Sinergias**: base essencial de builds \"Dex-based\" — combina com **Combate com Duas Armas**, ataques furtivos de ladino, monge desarmado. Também facilita builds sem foco em FOR (feiticeiros, bardos, magos que querem participar em melee).\n**Notas Táticas**: ideal para personagens com DES alta e FOR baixa. Um ladino com DES 18 e FOR 12 ganha +3 em vez de +1 nos ataques com rapieira — diferença massiva.",
            ],
            [
                'nome' => 'Ataque Poderoso',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Força 13',
                'beneficio' => 'Subtrai até seu BBA da jogada de ataque e adiciona o mesmo valor ao dano em melee. Ao empunhar arma com duas mãos, adiciona o dobro ao dano.',
                'descricao' => "Sacrifica precisão por poder devastador — golpes lentos e telegráfricos, mas quando conectam, esmagam tudo por trás da armadura.\n\n**Como Usar**: declarado antes da jogada de ataque a cada rodada — escolhe qual porcentagem do BBA converter em dano. Aplica-se apenas a ataques em melee (não à distância).\n**Efeito Detalhado**: converte 1 ponto de BBA em +1 de dano (arma de uma mão), ou +2 de dano (arma de duas mãos, incluindo lanças empunhadas com duas mãos). Guerreiro de 6° nível (BBA +6) pode gastar até 6 pontos em cada ataque, gerando +12 de dano com espada bastarda de duas mãos — dano quase duplicado.\n**Sinergias**: **Rachar** (Cleave) e **Grande Rachar** — combos legendários com Ataque Poderoso permitem eliminar inimigos em cadeia. Também combina com armas de dano crítico alto (falchion 18-20, ×2) e talentos de crítico.\n**Notas Táticas**: base absoluta de qualquer guerreiro ou bárbaro em melee. Escolha antecipada: personagens com FOR alta e BBA alto se beneficiam desproporcionalmente.",
            ],
            [
                'nome' => 'Ataque Rápido',
                'tipo' => 'Combate',
                'pre_requisitos' => 'BBA +1',
                'beneficio' => 'Saca ou guarda uma arma como ação livre em vez de ação de movimento.',
                'descricao' => "Você manuseia armas com velocidade surpreendente — o aço aparece na mão como se sempre estivesse lá.\n\n**Como Usar**: passivo. Sempre ativa quando você saca ou guarda uma arma.\n**Efeito Detalhado**: sacar arma sem esse talento é ação de movimento (sacrifica movimento na rodada); com Ataque Rápido, é ação livre (não custa nada). Permite: (1) sacar e atacar na mesma rodada com ataque total; (2) trocar entre múltiplas armas durante ataque total; (3) sacar arma escondida rapidamente para surpresa.\n**Sinergias**: perfeita para builds com múltiplas armas — arqueiro trocando para espada em melee, guerreiro com duas armas alternando, ladino com adaga escondida. Talentos como **Combate com Duas Armas** e **Iniciativa Aprimorada** também amplificam o benefício.\n**Notas Táticas**: obrigatório para builds versáteis com múltiplas armas. Menos crítico se você usa uma única arma sempre pronta, mas ainda útil para trocar em emergências (arma amaldiçoada, arma quebrada).",
            ],
            [
                'nome' => 'Carga Violenta',
                'tipo' => 'Combate',
                'pre_requisitos' => 'BBA +1',
                'beneficio' => 'Na carga, elimina a penalidade de -2 na CA e adiciona +2 no ataque (em vez do +2 normal, é +4).',
                'descricao' => "Suas cargas são rápidas e furiosas — a força do impacto compensa a defesa aberta, e o inimigo raramente resiste ao primeiro golpe.\n\n**Como Usar**: declarado ao iniciar uma carga (Ação de Rodada Completa que combina movimento e ataque). Você ainda deve seguir as regras normais de carga: linha reta, mínimo 3 m de movimento, sem terreno difícil, sem obstáculos.\n**Efeito Detalhado**: modifica a carga padrão: (1) o bônus de ataque de carga sobe de +2 para +4; (2) você NÃO sofre a penalidade normal de -2 na CA durante a rodada da carga. Total: você é 4 pontos mais provável de acertar e 2 pontos menos vulnerável.\n**Sinergias**: fundamental para builds de carga — bárbaros, cavaleiros mounted, guerreiros com lanças montadas ou armas de longo alcance. Combina com **Combate Montado**, **Perícia Montada**, **Ride-By Attack** e **Trample** para carga devastadora a cavalo.\n**Notas Táticas**: melhor talento para personagens que iniciam combate com uma carga longa (arenas abertas, corredores retos). Menos útil em dungeons apertadas ou combates onde não há espaço para acelerar.",
            ],
            [
                'nome' => 'Combate às Cegas',
                'tipo' => 'Combate',
                'pre_requisitos' => null,
                'beneficio' => 'Relança o dado de perda de chance por camuflagem total contra ataques em melee. Inimigos invisíveis não ganham bônus de flanqueamento contra você.',
                'descricao' => "Você luta bem mesmo sem visão — confiando em audição, olfato, tato através do aço, intuição refinada por anos de sparring.\n\n**Como Usar**: passivo. Aplica-se automaticamente quando atacado por inimigo com camuflagem total (invisível, escondido em escuridão total) OU quando você tenta atacar tais inimigos.\n**Efeito Detalhado**: (1) contra ataques em melee onde o oponente tem camuflagem total (invisível a você), você RELANÇA o resultado percentual de dispersão (50%/50% de errar) — efetivamente reduz a 25% de chance de falha; (2) inimigos invisíveis NÃO ganham +2 de flanqueamento como fariam normalmente.\n**Sinergias**: obrigatório contra magos que abusam de Invisibilidade Superior. Também útil em dungeons escuras contra criaturas com trevas naturais (drow, illithids, morcegos gigantes).\n**Notas Táticas**: talento circunstancial mas essencial em campanhas específicas — se seu Mestre gosta de encontros com stealth, monstros invisíveis, ou combates em escuridão, este talento reduz o pesadelo. Barato: sem pré-requisitos.",
            ],
            [
                'nome' => 'Combate com Duas Armas',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Destreza 15',
                'beneficio' => 'Reduz a penalidade de combate com duas armas para -2/-2 (arma leve na mão secundária) ou -4/-4 (arma normal na mão secundária).',
                'descricao' => "Você maneja duas armas com coordenação notável — cada mão age quase independentemente, cobrindo múltiplos ângulos simultaneamente.\n\n**Como Usar**: passivo. Aplica-se ao empunhar arma em cada mão e escolher ataque em rodada com ataque total.\n**Efeito Detalhado**: sem o talento, atacar com duas armas impõe -6 na mão principal e -10 na secundária (ou -4/-8 se leve). Com Combate com Duas Armas, essas penalidades caem para -4/-4 (arma normal na secundária) ou -2/-2 (arma leve na secundária). Uma segunda mão só ataca em ataque total, permitindo 1 ataque extra por rodada.\n**Sinergias**: primeira metade do trio TWF — **Combate com Duas Armas Aprimorado** (BBA +6, DES 17) e **Combate com Duas Armas Maior** (BBA +11, DES 19) permitem ataques extras adicionais. Combinado com **Acuidade com Arma**, permite builds Dex sem depender de FOR.\n**Notas Táticas**: essência de rangers e guerreiros com duas armas. Um patrulheiro de 2° nível ganha versão gratuita, tornando o talento menos crítico para eles.",
            ],
            [
                'nome' => 'Combate com Duas Armas Aprimorado',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Destreza 17, Combate com Duas Armas, BBA +6',
                'beneficio' => 'Permite um segundo ataque com a mão secundária (a -5) durante ataque total.',
                'descricao' => "Seu domínio sobre o combate bimanual aumenta sua cadência de ataques — a mão secundária torna-se quase tão letal quanto a principal.\n\n**Como Usar**: durante Ataque Total com duas armas, você faz um segundo ataque com a mão secundária no BBA reduzido em -5.\n**Efeito Detalhado**: um personagem de nível 6 com BBA +6/+1 normalmente teria 2 ataques (primária +6 e +1) + 1 secundária (mesmo BBA +6-2 = +4). Com este talento, adiciona 1 ataque secundário (+4-5 = -1). Total: +6/+1 (primária) + +4/-1 (secundária) = **4 ataques por rodada**.\n**Sinergias**: seguidor natural de **Combate com Duas Armas**. Combina com armas de dano furtivo (ladino) para multiplicar oportunidades de Ataque Furtivo. **Rapidez** adiciona mais um ataque na primária.\n**Notas Táticas**: pico do dano por rodada em builds de duas armas em níveis médios. Rangers com estilo de duas armas ganham gratuito no 6° nível.",
            ],
            [
                'nome' => 'Disparo a Longa Distância',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Tiro Certeiro',
                'beneficio' => 'Dobra o alcance incremental de armas de ataque à distância.',
                'descricao' => "Você é capaz de atingir alvos a distâncias extraordinárias — seus tiros voam mais longe e conservam precisão quando outros arcos falhariam.\n\n**Como Usar**: passivo. Sempre ativo em armas de ataque à distância.\n**Efeito Detalhado**: cada arma tem alcance incremental (arco longo: 30 m, arco curto: 18 m, funda: 15 m). Além do alcance incremental, ataques sofrem penalidade cumulativa -2 por incremento. Este talento DOBRA o alcance base: arco longo passa de 30 m para 60 m — permite tiros a 300 m com penalidade máxima manejável.\n**Sinergias**: obrigatório para arqueiros dedicados. Combina com **Disparo Rápido**, **Tiro Preciso** e **Tiro Certeiro** para o pacote completo. Cavaleiros/druidas montados sobre voadores podem estabelecer superioridade tática absoluta.\n**Notas Táticas**: excelente em campanhas com combate em terreno aberto ou aéreo. Menos útil em dungeons apertadas onde 30 m já é distância improvável.",
            ],
            [
                'nome' => 'Disparo Rápido',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Destreza 13, Tiro Certeiro',
                'beneficio' => 'Um ataque extra com arma de ataque à distância por rodada, porém todos os ataques da rodada sofrem -2.',
                'descricao' => "Sua cadência de tiro ultrapassa a maioria dos arqueiros — corda encaixada, corda solta, próxima flecha em mãos, uma sequência quase musical.\n\n**Como Usar**: declarado no início do turno se fará Ataque Total à distância. Cada ataque da rodada sofre -2 no ataque, mas você ganha 1 ataque adicional na primária.\n**Efeito Detalhado**: um arqueiro de 6° nível (BBA +6/+1) normalmente teria 2 ataques. Com Disparo Rápido, faz +6/+1 (ambos -2 = +4/-1) + 1 ataque extra (+6-2 = +4). Total: **3 ataques por rodada** com pequena redução de acurácia.\n**Sinergias**: base do pacote de arqueiro. Combina com **Manyshot** (múltiplas flechas por ação) e **Improved Precise Shot** para arqueiros de alto nível. Rangers com estilo Arqueiro recebem no 2° nível.\n**Notas Táticas**: obrigatório para builds de arqueiro sério. Permite mais dano por rodada apesar da penalidade — o ataque extra frequentemente vale a leve queda de acurácia.",
            ],
            [
                'nome' => 'Foco em Arma',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Proficiência com a arma, BBA +1',
                'beneficio' => '+1 em todas as jogadas de ataque com a arma escolhida.',
                'descricao' => "Você se especializou no uso de uma arma específica — cada movimento, cada golpe, cada finta com essa arma flui naturalmente.\n\n**Como Usar**: escolha uma arma específica ao adquirir o talento (não uma categoria: é 'espada bastarda' e não 'espadas'). Bônus de +1 aplica-se automaticamente a todos os ataques com aquela arma.\n**Efeito Detalhado**: pode ser adquirido múltiplas vezes, cada aplicação para arma diferente. Empilha com bônus de arma mágica, especialização, e outros talentos, mas apenas uma aplicação de Foco em Arma por arma.\n**Sinergias**: pré-requisito de **Foco em Arma Maior** (Guerreiro 8, +1 total +2) e **Especialização em Arma** (Guerreiro 4, +2 dano). Também pré-requisito de talentos avançados como **Golpe Aprimorado** e **Melhoria de Arma**.\n**Notas Táticas**: pilar de builds especializados em uma arma. Guerreiros o pegam cedo, especialmente para armas de alto crítico (falchion, machado grande, espada bastarda) — o +1 amplifica-se ao gerar mais críticos.",
            ],
            [
                'nome' => 'Foco em Arma Maior',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Foco em Arma, Guerreiro 8',
                'beneficio' => '+1 adicional nas jogadas de ataque com a arma escolhida (total +2 combinado com Foco em Arma).',
                'descricao' => "Seu domínio sobre a arma escolhida atinge um nível superior — cada aspecto do combate com ela é conhecido de forma profunda.\n\n**Como Usar**: aplica-se automaticamente aos ataques com a arma escolhida (a mesma de Foco em Arma).\n**Efeito Detalhado**: bônus total ao adquirir ambos: +2 em ataque com a arma. Combinado com Especialização em Arma e Especialização em Arma Maior (Guerreiro 12): +2 ataque, +4 dano por arma.\n**Sinergias**: apenas classes com talentos bônus abundantes (Guerreiro) conseguem juntar os quatro pilares: Foco (+1), Foco Maior (+1), Especialização (+2 dano), Especialização Maior (+2 dano) = total de +2 ataque, +4 dano.\n**Notas Táticas**: exclusivo de Guerreiro 8+ — é um dos motivos pelos quais Guerreiro compete em picos de dano contra outras classes.",
            ],
            [
                'nome' => 'Golpe Atordoante',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Destreza 13, Sabedoria 13, BBA +8 ou Monge 1',
                'beneficio' => 'Declare antes do ataque desarmado: se acertar, o alvo faz Fortitude (CD 10 + metade do nível + mod SAB) ou fica atordoado por 1 rodada.',
                'descricao' => "Seu golpe desnorteia o inimigo com precisão mortal — um ponto de pressão anatômico ou nervo exposto atinge com efeito devastador.\n\n**Como Usar**: declare ANTES da jogada de ataque desarmado. Se acertar, força TR Fortitude no alvo com CD = 10 + metade do seu nível + modificador de SAB.\n**Efeito Detalhado**: alvo que falha fica atordoado por 1 rodada — indefeso (ataques automáticos), sem bônus de DES à CA, ataques contra ele com +2, incapaz de conjurar ou agir. Se acerta mas ele passa no TR, apenas dano normal do ataque. Usos limitados por dia: 1 vez/dia normalmente, com aumento para monges (1/nível/dia).\n**Sinergias**: essencial para monges que combinam com **Rajada de Golpes**. Também combina com **Ataque Furtivo** (dano extra durante a ação de atordoamento) e **Precisão em Ataque**.\n**Notas Táticas**: talento icônico do monge — permite tirar inimigos poderosos de combate temporariamente. O TR baseado em SAB o torna dependente de alto SAB no monge.",
            ],
            [
                'nome' => 'Maestria em Combate',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Destreza 13',
                'beneficio' => 'Pode realizar ataques de oportunidade adicionais por rodada igual ao modificador de DES (mín. 1).',
                'descricao' => "Você explora cada brecha na defesa do inimigo — reflexos treinados o permitem punir cada movimento descuidado ao seu alcance.\n\n**Como Usar**: passivo. Aplica-se automaticamente quando você teria direito a um ataque de oportunidade.\n**Efeito Detalhado**: normalmente cada personagem tem 1 ataque de oportunidade por rodada. Com Maestria em Combate, você tem tantos quanto seu modificador de DES: DES 14 = +2 modificador = 3 AOs/rodada (o base + 2 adicionais). DES 20 = +5 = 6 AOs/rodada.\n**Sinergias**: combina brilhantemente com armas de longo alcance (lança comprida, alabarda) para dominar áreas grandes. Um guerreiro com Corrente Espigada em melee é o ideal — pode atacar 3-6 alvos por rodada saindo do seu quadrado.\n**Notas Táticas**: essencial para builds \"Área de Controle\" onde o objetivo é dominar o espaço em torno do lutador. Menos crítico para melee de foco único em um alvo.",
            ],
            [
                'nome' => 'Especialização em Arma',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Foco em Arma, Guerreiro 4',
                'beneficio' => '+2 de dano nas jogadas de dano com a arma escolhida.',
                'descricao' => "Você inflige ferimentos mais graves com sua arma especializada — cada golpe encontra a fresta certa, o ponto vulnerável, o angulo ideal.\n\n**Como Usar**: aplica-se automaticamente aos ataques com a arma escolhida (a mesma de Foco em Arma, que é pré-requisito).\n**Efeito Detalhado**: bônus de +2 de dano por golpe — cumulativo com dano de FOR, dano de arma mágica, dano de Ataque Poderoso. Em ataques múltiplos por rodada, cada um recebe o +2, multiplicando o benefício.\n**Sinergias**: pré-requisito de **Especialização em Arma Maior** (Guerreiro 12, +2 dano adicional = +4 total). Também combina naturalmente com **Foco em Arma Maior** para o pacote completo.\n**Notas Táticas**: exclusivo do Guerreiro (nível 4+). Uma das razões principais para tomar níveis puros de Guerreiro em builds de dano — outras classes não têm acesso.",
            ],
            [
                'nome' => 'Tiro Certeiro',
                'tipo' => 'Combate',
                'pre_requisitos' => null,
                'beneficio' => '+1 nas jogadas de ataque e de dano com armas de ataque à distância contra alvos a até 9 metros.',
                'descricao' => "Sua precisão em curta distância é extraordinária — flechas voam pelo espaço com a mesma velocidade e certeza que a mão de um atirador experiente.\n\n**Como Usar**: passivo. Aplica-se automaticamente a ataques à distância contra alvos até 9 m (o incremento próximo da maioria das armas).\n**Efeito Detalhado**: +1 no ataque E +1 no dano. Só em alvos até 9 m — perde o benefício em tiros longos. Como armas à distância normalmente disparam a curta distância na maioria dos combates de dungeon, o talento é frequentemente ativo.\n**Sinergias**: pré-requisito de **Tiro Preciso** (atirar em melee sem -4), **Disparo Rápido** (ataque extra) e **Disparo a Longa Distância** (alcance dobrado). Base do pacote de arqueiro.\n**Notas Táticas**: primeiro talento essencial para arqueiros — o +1 dobrado (ataque e dano) é excelente para custo de 1 talento sem pré-requisitos.",
            ],
            [
                'nome' => 'Tiro Preciso',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Tiro Certeiro',
                'beneficio' => 'Pode atirar ou arremessar armas de ataque à distância em combate corpo a corpo sem a penalidade de -4.',
                'descricao' => "Você seleciona seus alvos com precisão mesmo no caos do combate — encontra a brecha entre aliado e inimigo sem hesitar.\n\n**Como Usar**: passivo. Elimina automaticamente a penalidade de -4 que arqueiros normalmente sofrem quando atiram em alvo engajado em melee (adjacente a aliados).\n**Efeito Detalhado**: sem o talento, um arqueiro que atira em um inimigo próximo aos aliados sofre -4 no ataque e 50% de chance (se falha) de acertar um aliado adjacente. Com Tiro Preciso, o -4 é eliminado (o risco de acertar aliado permanece se falhar).\n**Sinergias**: pré-requisito de **Improved Precise Shot** (que ignora até camuflagem e ataca alvos incorpóreos com penalidade reduzida). Combina com **Disparo Rápido** para arqueiro versátil em qualquer situação.\n**Notas Táticas**: obrigatório para arqueiros em grupos com combatentes de melee — sem Tiro Preciso, o arqueiro é praticamente inútil enquanto os aliados estão engajados.",
            ],

            // --- Combate: defensivos ---
            [
                'nome' => 'Combate Defensivo',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Inteligência 13',
                'beneficio' => 'Subtrai até 5 da jogada de ataque para adicionar o mesmo valor à CA como bônus de esquiva. Efeito dura até o próximo turno.',
                'descricao' => "Você luta de forma técnica e defensiva, priorizando sua proteção — cada movimento inclui uma consideração pela sua sobrevivência.\n\n**Como Usar**: declare no início do turno o valor de -X que deseja sacrificar (0 a 5). Cada ataque na rodada sofre -X e você ganha +X de esquiva na CA até seu próximo turno.\n**Efeito Detalhado**: o bônus é do tipo esquiva (empilha com outros esquiva, como Esquiva). Aplica-se contra todos os ataques até o próximo turno. Pode ser aumentado até -10/+10 no 20° nível para personagens com BBA +20 (via progressão específica em outros livros; PHB limita a 5).\n**Sinergias**: **Esquiva** e **Mobilidade** (bônus de esquiva cumulativos). **Golpe Ofensivo** (opostoconceito).\n**Notas Táticas**: útil quando é preferível sobreviver a acertar. Um guerreiro em confronto contra dragão pode escolher Combate Defensivo para durar mais rodadas contra o breath weapon.",
            ],
            [
                'nome' => 'Esquiva',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Destreza 13',
                'beneficio' => '+1 de bônus de esquiva na CA contra um oponente designado por turno. Você pode mudar o alvo a cada turno.',
                'descricao' => "Seus reflexos permitem desviar de ataques com facilidade — foca em um único adversário e o observa com atenção sobrenatural.\n\n**Como Usar**: no início do turno, designe um único oponente. Todos os ataques dele até seu próximo turno sofrem -1 no acerto contra você (o +1 na sua CA é apenas contra ele).\n**Efeito Detalhado**: bônus de esquiva é cumulativo com outros esquiva (Combate Defensivo, Mobilidade). Perde efeito se ficar sem DES à CA (paralisado, surpreso, indefeso).\n**Sinergias**: pré-requisito de **Mobilidade** (+4 esquiva contra AOs de movimento) e **Salto Feérico** (mover + atacar + mover). Todos esquiva empilham entre si.\n**Notas Táticas**: talento cheap comum em builds Dex. O ganho de +1 é modesto, mas é degrau essencial para a árvore da esquiva completa.",
            ],
            [
                'nome' => 'Mobilidade',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Destreza 13, Esquiva',
                'beneficio' => '+4 de bônus de esquiva na CA contra ataques de oportunidade provocados por movimento.',
                'descricao' => "Você se move pelo campo de batalha com fluidez impecável — desliza entre inimigos sem oferecer aberturas.\n\n**Como Usar**: passivo. Aplica-se automaticamente contra ataques de oportunidade provocados quando você se move pela área ameaçada de inimigos (não contra AOs de outras causas como conjurar sem defesa).\n**Efeito Detalhado**: bônus de +4 (dobro de outros esquiva) especificamente contra AOs de movimento. Não protege contra AOs por conjurar magia, ficar de pé perto de inimigo, etc.\n**Sinergias**: pré-requisito de **Salto Feérico** e **Ataque em Movimento**. Cria a base do build \"ninja/scout\" que se move sem parar sem sofrer punição.\n**Notas Táticas**: essencial para builds skirmisher (ataque + movimento + reposicionamento). Ladinos e patrulheiros aproveitam bastante para posicionamento constante.",
            ],
            [
                'nome' => 'Salto Feérico',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Destreza 13, Esquiva, Mobilidade, BBA +4',
                'beneficio' => 'Move-se até o deslocamento, realiza um único ataque em melee e continua movendo-se, tudo como ação padrão.',
                'descricao' => "Você ataca enquanto se move, tornando-se um alvo difícil de atingir — cruza o campo, desfere golpe, sai antes do contra-ataque chegar.\n\n**Como Usar**: uma ação padrão (não Rodada Completa) que combina movimento + 1 ataque + movimento. Você deve mover-se pelo menos metade do deslocamento antes do ataque, o restante depois. O ataque ocorre no meio do movimento.\n**Efeito Detalhado**: como o ataque ocorre entre os movimentos, você não fica adjacente ao inimigo para ficar sujeito a AOs de dentro do alcance dele (assumindo que sai da área ameaçada). Combina perfeitamente com **Mobilidade** para evitar AOs de movimento também.\n**Sinergias**: base do build \"cavalier of movement\" — combatente que nunca fica parado. Excelente com **Corrida** (velocidade extra), **Acuidade com Arma** e talentos furtivos.\n**Notas Táticas**: pico da árvore de movimento defensivo. Permite hit-and-run devastador em builds especializadas em mobilidade.",
            ],

            // --- Habilidades de Classe ---
            [
                'nome' => 'Expulsão Aprimorada',
                'tipo' => 'Divino',
                'pre_requisitos' => 'Capacidade de expulsar mortos-vivos',
                'beneficio' => '4 tentativas adicionais de expulsar mortos-vivos por dia.',
                'descricao' => "Seu poder divino sobre os mortos-vivos é mais abundante — você canaliza a fé com mais frequência e força.\n\n**Como Usar**: passivo. Aumenta imediatamente o número máximo de tentativas de Expulsar Mortos-Vivos por dia.\n**Efeito Detalhado**: clérigos normalmente têm 3 + CAR-mod tentativas por dia. Com este talento, adicione 4 (total: 7 + CAR-mod). Um clérigo com CAR 16 (+3) tem: 3 + 3 + 4 = 10 tentativas por dia — o suficiente para múltiplos encontros com mortos-vivos.\n**Sinergias**: combina com **Expulsão Potente** (destrói em vez de afugentar), **Expulsão Poderosa** (dano/HD extra) e itens que consomem tentativas (bastão sagrado, algumas magias divinas espontâneas).\n**Notas Táticas**: obrigatório para clérigos em campanhas com muitos mortos-vivos. Também útil para paladinos com talentos abundantes.",
            ],
            [
                'nome' => 'Expulsão Potente',
                'tipo' => 'Divino',
                'pre_requisitos' => 'Capacidade de expulsar mortos-vivos, Carisma 21',
                'beneficio' => 'Mortos-vivos afetados pela expulsão são destruídos em vez de afugentados.',
                'descricao' => "Sua fé aniquila completamente os servos da morte — o poder divino não apenas os afugenta, mas os obliterа instantaneamente.\n\n**Como Usar**: passivo. Aplica-se automaticamente a cada uso de Expulsar Mortos-Vivos.\n**Efeito Detalhado**: normalmente, o resultado de expulsão determina quais mortos-vivos são afugentados (correm em pânico por 10 rodadas). Com Expulsão Potente, os que seriam afugentados são DESTRUÍDOS instantaneamente — mesmo mortos-vivos sem PV, como fantasmas e liches, são banidos permanentemente do plano material.\n**Sinergias**: combina especialmente com **Expulsão Aprimorada** (mais usos), CAR alta para força da expulsão e nível de clérigo alto (destrói mais HD por uso).\n**Notas Táticas**: fim de jogo contra mortos-vivos — nenhum susto ou fuga, apenas aniquilação. Requer investimento massivo em CAR (mínimo 21) e nível apropriado de classe.",
            ],

            // --- Metamagia ---
            [
                'nome' => 'Conjuração Aprimorada',
                'tipo' => 'Metamagia',
                'pre_requisitos' => null,
                'beneficio' => 'Aumenta efeitos variáveis de uma magia em 50%. Ocupa espaço de magia 2 níveis acima.',
                'descricao' => "Seus feitiços liberam uma energia mágica mais intensa — a mesma magia produz efeitos aumentados no dano, duração ou área.\n\n**Como Usar**: aplicado a uma magia específica quando preparada (magos) ou espontaneamente (feiticeiros, com aumento de tempo de conjuração para uma ação de rodada completa). A magia aprimorada ocupa espaço 2 níveis maior.\n**Efeito Detalhado**: aplica +50% em efeitos numéricos variáveis: dano (Bola de Fogo 10d6 → 15d6), duração (Escudo 1 min./nível → 1,5 min./nível), área (raio, alcance). NÃO afeta valores fixos como CD do TR ou nível de conjurador.\n**Sinergias**: combina com **Conjuração Maximizada** (dobra o benefício se maximizado e aprimorado) e outros metamagia. Feiticeiros aprovitam menos por lançarem espontaneamente (tempo aumentado).\n**Notas Táticas**: excelente para magos evocadores — Bola de Fogo em espaço de 5° causa 15d6 é dano premium por espaço. Menos útil para magias de utilidade sem valores variáveis.",
            ],
            [
                'nome' => 'Conjuração Ágil',
                'tipo' => 'Metamagia',
                'pre_requisitos' => null,
                'beneficio' => 'Lança a magia como ação livre. Ocupa espaço de magia 4 níveis acima.',
                'descricao' => "Você condensa o tempo de conjuração a um instante — a magia flui sem gestos elaborados, sem palavras longas.\n\n**Como Usar**: aplicado a uma magia específica ao preparar (magos) ou espontaneamente com tempo extra (feiticeiros). A magia ocupa espaço 4 níveis maior — Cura Ferimentos Leves (1°) vira magia de 5° com Ágil.\n**Efeito Detalhado**: transforma qualquer magia em ação livre — pode ser lançada durante o turno de outro personagem, entre ataques, ou como parte de outra ação. Só uma magia por rodada pode ser Ágil.\n**Sinergias**: combinada com magias de dano em Bola de Fogo Ágil (5° → 9°) permite lançar 2 magias por rodada (uma ação padrão + uma Ágil livre). Chave para conjuradores de alto nível.\n**Notas Táticas**: metamagia mais poderosa do PHB para uso em combate. O custo de 4 níveis é enorme, mas o \"free spell\" a cada rodada muda o poder do conjurador.",
            ],
            [
                'nome' => 'Conjuração Discreta',
                'tipo' => 'Metamagia',
                'pre_requisitos' => null,
                'beneficio' => 'Remove o componente gestual (Somático) de uma magia. Ocupa espaço de magia 1 nível acima.',
                'descricao' => "Você lança magias sem qualquer gesto perceptível — mãos amarradas, agarrado, em espaços apertados não impedem sua magia.\n\n**Como Usar**: aplicado a magia específica ao preparar (magos) ou espontaneamente (feiticeiros). Elimina completamente o componente S (Somático) da magia. Ocupa espaço 1 nível maior.\n**Efeito Detalhado**: permite conjurar sem mãos livres — útil quando agarrado, amarrado, usando escudo torre, ou em armadura sem proficiência (elimina risco de falha arcana por armadura). NÃO elimina componentes V, M, F ou XP.\n**Sinergias**: combina com **Conjuração Silenciosa** (V) para conjuração totalmente invisível. Útil para magos disfarçados como sacerdotes ou situações onde componentes visíveis chamariam atenção.\n**Notas Táticas**: preferido por bardo/feiticeiro que atuam socialmente ou em armaduras — cancela falha arcana. Barato: +1 nível apenas.",
            ],
            [
                'nome' => 'Conjuração Extensa',
                'tipo' => 'Metamagia',
                'pre_requisitos' => null,
                'beneficio' => 'Dobra a duração de uma magia com duração que não seja instantânea ou permanente. Ocupa espaço 1 nível acima.',
                'descricao' => "Suas magias perduram por muito mais tempo — buff dura o dobro, invisibilidade cobre mais do dia, magias de exploração ficam ativas rodadas extra.\n\n**Como Usar**: aplicado a magia específica ao preparar. Dobra a duração especificada na magia. Ocupa espaço 1 nível maior.\n**Efeito Detalhado**: não afeta magias instantâneas (Bola de Fogo, Curar Ferimentos) nem permanentes. Aplica-se a magias com duração em tempo (min./nível, horas/nível, dia/nível). Escudo 1 min./nível → 2 min./nível; Voar 1 min./nível → 2 min./nível; Invisibilidade Superior 1 rodada/nível → 2 rodadas/nível.\n**Sinergias**: combina com magias de buff longo (Armadura Arcana 1 hora/nível → 2 horas/nível) e magias de exploração (Detectar Magia dobrado).\n**Notas Táticas**: excelente para conjuradores em jornadas longas ou combates extensos. Barato: +1 nível apenas, valor imenso para builds preventivas.",
            ],
            [
                'nome' => 'Conjuração Maximizada',
                'tipo' => 'Metamagia',
                'pre_requisitos' => null,
                'beneficio' => 'Maximiza todos os efeitos variáveis de uma magia (dados de dano/cura são rolados como se dessem o valor máximo). Ocupa espaço de magia 3 níveis acima.',
                'descricao' => "Seu feitiço alcança seu potencial máximo absoluto — o dado da Bola de Fogo é 6 em cada d6, garantido.\n\n**Como Usar**: aplicado a magia específica ao preparar. Todos os efeitos numéricos rolados por dados são substituídos pelo valor máximo. Ocupa espaço 3 níveis maior.\n**Efeito Detalhado**: Bola de Fogo 10d6 (5-60, média 35) → Maximizada = 60 (garantido). Cura Ferimentos Sérios 3d8+15 (18-39, média 28,5) → 24+15 = 39 (garantido). Aplica-se a dano, cura, PVs temporários, penalidades numéricas.\n**Sinergias**: **Conjuração Aprimorada** + Maximizada dobra o efeito: Bola de Fogo Aprimorada e Maximizada = 15d6 max = 90 dano garantido. Ideal para magias com resultado alto por muitos dados.\n**Notas Táticas**: excelente para magias de dano puro. Custo alto (+3 níveis) reserva o uso para magias que realmente valem o espaço superior.",
            ],
            [
                'nome' => 'Conjuração Silenciosa',
                'tipo' => 'Metamagia',
                'pre_requisitos' => null,
                'beneficio' => 'Remove o componente Verbal de uma magia. Ocupa espaço de magia 1 nível acima.',
                'descricao' => "Você lança magias sem pronunciar palavra alguma — inaudível, indetectável por ouvido, ideal para infiltradores e capturados.\n\n**Como Usar**: aplicado a magia específica ao preparar. Elimina completamente o componente V (Verbal) da magia. Ocupa espaço 1 nível maior.\n**Efeito Detalhado**: permite conjurar em silêncio total — em zona de Silêncio, silenciado por magia, engasgado, submerso profundo, com mordaça. NÃO elimina componentes S (gestos), M (material), F (foco) ou XP.\n**Sinergias**: **Conjuração Discreta** (elimina S) combinada permite conjurar sem qualquer sinal externo — completamente invisível como conjuração. Útil para infiltradores, prisioneiros, mestres de disfarce.\n**Notas Táticas**: barato (+1 nível) e circunstancialmente devastador — permite conjuração em Silêncio, sob mordaça, ou submerso. Bardos e feiticeiros que dependem de componentes verbais adoram este talento.",
            ],
            [
                'nome' => 'Foco em Conjuração',
                'tipo' => 'Conjuração',
                'pre_requisitos' => null,
                'beneficio' => '+1 na CD para resistir às magias de uma escola escolhida.',
                'descricao' => "Suas magias de uma escola específica são mais difíceis de resistir — inimigos falham com mais frequência aos seus feitiços especializados.\n\n**Como Usar**: escolha uma escola (Abjuração, Conjuração, Adivinhação, Encantamento, Evocação, Ilusão, Necromancia, Transmutação). Aplica-se a todas as suas magias daquela escola.\n**Efeito Detalhado**: aumenta a CD do TR em +1 permanentemente. Todas as magias da escola escolhida têm CD = 10 + nível da magia + atributo de conjuração + 1. Alvo com bordado -2 no TR falha em mais 5% dos casos.\n**Sinergias**: pré-requisito de **Foco em Conjuração Maior** (+1 adicional, +2 total). Combina com especialização de mago na mesma escola.\n**Notas Táticas**: obrigatório para especialistas em uma escola. Ilusionistas foco em Ilusão, Necromantes em Necromancia. Também para builds de controle (Encantamento).",
            ],
            [
                'nome' => 'Foco em Conjuração Maior',
                'tipo' => 'Conjuração',
                'pre_requisitos' => 'Foco em Conjuração',
                'beneficio' => '+1 adicional na CD das magias da escola escolhida (total +2 combinado com Foco em Conjuração).',
                'descricao' => "Seu domínio sobre essa escola de magia é incomparável — sua especialização se manifesta em cada feitiço lançado.\n\n**Como Usar**: aplica-se automaticamente à mesma escola escolhida para Foco em Conjuração.\n**Efeito Detalhado**: bônus total +2 na CD do TR. Diferença dramática: um TR CD 20 sem talentos vira CD 22 com ambos, aumentando dramaticamente falhas do alvo.\n**Sinergias**: **Escola Especializada** (mago) na mesma escola + Foco + Foco Maior = magia devastadora naquele área. Combina com magias com CD alta (magias de dano/controle).\n**Notas Táticas**: pilar de builds especializadas de mago ou feiticeiro. O +2 na CD amplifica-se em toda a carreira do conjurador.",
            ],
            [
                'nome' => 'Penetrar Resistência a Magia',
                'tipo' => 'Conjuração',
                'pre_requisitos' => null,
                'beneficio' => '+2 nas rolagens de nível de conjurador para superar a Resistência a Magia de criaturas.',
                'descricao' => "Suas magias penetram as defesas mágicas com maior facilidade — a magia atravessa proteções que normalmente rejeitariam feitiços de outros conjuradores.\n\n**Como Usar**: passivo. Aplica-se automaticamente a testes de nível de conjurador para superar Resistência à Magia (RM) do alvo.\n**Efeito Detalhado**: RM funciona como CA para magias — o conjurador rola 1d20 + nível de conjurador contra RM. Com Penetrar Resistência a Magia, some +2 ao rolamento. Ex.: mago de 10° nível vs. drow (RM 21): rola 1d20+10, precisa 11+. Com o talento, precisa 9+ = 60% para 50%.\n**Sinergias**: combina com nível alto de conjurador (natural), varas de aumento de nível, e magias que ignoram RM (Ácido Respingado, algumas evocações).\n**Notas Táticas**: essencial em campanhas com muitos monstros com RM (dragões, elfos-negros, demônios, gigantes de gelo). Sem esse talento, magias frequentemente falham contra alvos poderosos.",
            ],

            // --- Criação de Itens ---
            [
                'nome' => 'Forja de Arma Mágica',
                'tipo' => 'Criação',
                'pre_requisitos' => 'Nível de conjurador 5',
                'beneficio' => 'Pode criar armas e armaduras mágicas conforme as regras de itens mágicos. Custo: 1/2 PO do valor + 1/25 XP.',
                'descricao' => "Você forja instrumentos de guerra imbuídos com poder arcano ou divino — cada trabalho leva dias, mas o resultado é uma arma que canta poder.\n\n**Como Usar**: escolhe forjar uma arma/armadura mágica, decide as propriedades, gasta materiais no valor de metade do preço final, gasta 1/25 do preço em XP, e trabalha 1 dia por 1.000 PO do preço final.\n**Efeito Detalhado**: pode adicionar bônus de melhoria (+1 a +5) e propriedades especiais (Chamas, Frost, Sagrado, Anarquismo, etc.). Requisitos podem incluir magias específicas conhecidas — o conjurador precisa saber Chamas se quer criar arma flamejante.\n**Sinergias**: com **Escrever Pergaminho** e outros talentos de criação, permite forjar arsenal para o grupo. Guerreiros com este talento (raro) ou Magos criadores.\n**Notas Táticas**: economiza dinheiro do grupo — comprar armas mágicas custa preço integral; forjar custa metade. XP consumido é o principal custo.",
            ],
            [
                'nome' => 'Forja de Anel',
                'tipo' => 'Criação',
                'pre_requisitos' => 'Nível de conjurador 12',
                'beneficio' => 'Pode criar anéis mágicos conforme as regras de itens mágicos. Custo: 1/2 PO do valor + 1/25 XP.',
                'descricao' => "Seus anéis canalizam poderes mágicos poderosos — bandas de metal precioso que armazenam magias contínuas ou ativáveis.\n\n**Como Usar**: escolhe forjar um anel mágico, escolhe a propriedade, gasta materiais valor metade do preço final, gasta 1/25 em XP, e trabalha 1 dia por 1.000 PO.\n**Efeito Detalhado**: anéis são versáteis — Anel de Proteção +X, Anel de Escudo Mental, Anel de Resistência a Fogo, Anel de Feathers Falling, etc. Cada anel específico tem requisitos próprios de magias conhecidas.\n**Sinergias**: alto nível (12°) o torna talento de alto nível. Combina com outros talentos de criação para um conjurador dedicado a apoio.\n**Notas Táticas**: um dos itens mágicos mais úteis, mas caro para forjar. Um anel personalizado para o grupo pode ser mais valioso que muitos itens genéricos.",
            ],
            [
                'nome' => 'Forja de Varinha',
                'tipo' => 'Criação',
                'pre_requisitos' => 'Nível de conjurador 5',
                'beneficio' => 'Pode criar varinhas mágicas contendo uma magia de nível 1 a 4, com 50 cargas. Custo: nível magia × nível conjurador × 750 PO/25 XP.',
                'descricao' => "Você imbui pedaços de madeira ou metal com poder mágico armazenado — 50 cargas que qualquer classe pode ativar com a magia certa.\n\n**Como Usar**: escolhe a magia que colocará (deve conhecer ou ter acesso), gasta materiais, XP e 1 dia por 1.000 PO. Varinha começa com 50 cargas.\n**Efeito Detalhado**: qualquer conjurador (mesmo bardo/ladino via Usar Instrumento Mágico) pode ativar. Varinhas de magias baratas (Curar Ferimentos Leves, Míssil Mágico) são as mais comuns e econômicas.\n**Sinergias**: nível 5 é acesso cedo. Combina bem com magias low-level úteis — Míssil Mágico, Curar Ferimentos, Invisibilidade.\n**Notas Táticas**: crítica em grupos com curadores dedicados — varinhas de Curar Ferimentos Leves (750 PO por 50 cargas) são o padrão de emergência.",
            ],
            [
                'nome' => 'Forja de Maravilha',
                'tipo' => 'Criação',
                'pre_requisitos' => 'Nível de conjurador 3',
                'beneficio' => 'Pode criar itens mágicos maravilhosos (capas, cintos, botas, amuletos, gemas etc.). Custo: 1/2 PO do valor + 1/25 XP.',
                'descricao' => "Seus itens mágicos carregam encantamentos variados e poderosos — desde botas que voam até amuletos que absorvem magias.\n\n**Como Usar**: escolhe um item específico (Botas de Velocidade, Capa da Resistência, Amuleto de Sabedoria, Cinturão de Força etc.), verifica pré-requisitos (magias conhecidas, feito específico, alinhamento), gasta metade em materiais e 1/25 em XP.\n**Efeito Detalhado**: categoria mais versátil — cobre 100+ itens diferentes. Cada item tem requisitos específicos listados no DMG.\n**Sinergias**: acesso muito cedo (nível 3), permite criar itens úteis desde o começo. Base do arsenal de qualquer conjurador criador.\n**Notas Táticas**: talento mais versátil de criação — cobre a maior variedade de itens. Combina com **Escrever Pergaminho** para pacote básico de criação inicial.",
            ],
            [
                'nome' => 'Escrever Pergaminho',
                'tipo' => 'Criação',
                'pre_requisitos' => 'Nível de conjurador 1',
                'beneficio' => 'Pode criar pergaminhos mágicos com magias que conhece. Custo: nível magia × nível conjurador × 12,5 PO/1 XP por pergaminho.',
                'descricao' => "Você registra magias em pergaminhos para uso posterior — magia armazenada em papel, ativável por qualquer conjurador que a saiba lançar.\n\n**Como Usar**: escolhe uma magia que conhece, gasta materiais e XP proporcionais, e escreve pergaminho em algumas horas.\n**Efeito Detalhado**: pergaminho contém uma única aplicação da magia. Ativa-se como conjuração normal (V, S, mas o pergaminho substitui componentes materiais). Nível de conjurador do pergaminho = nível do criador.\n**Sinergias**: acesso desde nível 1 — talento crescente que se torna mais valioso com magias de nível mais alto. Combina com todos os outros talentos de criação.\n**Notas Táticas**: primeiro talento de criação essencial para conjuradores. Permite guardar magias raramente utilizadas ou de emergência (Voar, Invisibilidade Superior) sem gastar espaços diários preciosos. Custo XP baixo.",
            ],
        ];

        foreach ($talentos as $talento) {
            Talento::updateOrCreate(
                ['nome' => $talento['nome'], 'versao' => '3.5'],
                array_merge($talento, ['versao' => '3.5'])
            );
        }
    }
}
