<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            [
                'nome'                   => 'Bárbaro',
                'versao'                 => '3.5',
                'descricao'              => "Guerreiro feroz das terras selvagens que canaliza a fúria de batalha como arma. Bárbaros são pessoas rústicas e temperamentais que preferem os desafios brutais da natureza aos refinamentos da civilização — vivem em tribos nômades, aldeias fronteiriças ou na solidão das montanhas.\n\n**Fúria**: 1 vez por dia no 1° nível (subindo até 6/dia no 20°). Concede +4 de Força e Constituição, +2 de moral em TR de Vontade e -2 na CA por 3+CON rodadas; deixa fatigado após.\n**Deslocamento Rápido**: +3 m no deslocamento base.\n**Esquiva Sobrenatural** (2°): não perde bônus de DES quando surpreso ou flanqueado.\n**Sentido de Perigo** (3°+): +1 crescente nos Reflexos e CA contra armadilhas.\n**Esquiva Sobrenatural Aprimorada** (5°): imune a flanqueio, exceto por ladino 4+ níveis acima.\n**Redução de Dano** (7°+): RD 1/— crescendo até RD 5/— no 19°.\n**Fúria Maior** (11°): +6 nos atributos durante a fúria.\n**Fúria Incansável** (17°): sem fadiga pós-fúria.\n**Fúria Poderosa** (20°): +8 nos atributos durante a fúria.\n\n**Atributos primários**: Força e Constituição.\n**Dado de Vida**: d12 (o maior do jogo).\n**BBA**: Boa | **Fortitude**: Boa | **Reflexos**: Ruim | **Vontade**: Ruim.\n**Pontos de perícia**: 4 + INT por nível.\n**Alinhamento**: não pode ser leal — tornar-se leal faz perder a habilidade de Fúria permanentemente.\n**Proficiências**: todas as armas simples e marciais; armaduras leves, médias e pesadas; escudos (exceto torre). Analfabeto por padrão.\n\n**Estilo de jogo**: tanque agressivo com PVs enormes e dano explosivo em rodadas de fúria. Ideal para campanhas de aventura direta com muitos combates curtos.",
                'dado_vida'              => 12,
                'bba_progressao'         => 'boa',
                'resistencia_fortitude'  => 'boa',
                'resistencia_reflexos'   => 'ruim',
                'resistencia_vontade'    => 'ruim',
                'pontos_pericia'         => 4,
            ],
            [
                'nome'                   => 'Bardo',
                'versao'                 => '3.5',
                'descricao'              => "Artista errante cuja música mágica e vasto conhecimento tornam-no o mais versátil aventureiro. Bardos são performers itinerantes — trovadores, contadores de histórias, atores, poetas — que absorvem conhecimento por onde passam e transformam a arte em poder tangível.\n\n**Música de Bardo**: usada por rodadas iguais ao nível/dia, com efeitos crescentes:\n- **Contrafeitiço** (1°): performance como Contra-magia.\n- **Fascinar** (1°): hipnotiza inimigos por 1 rodada/nível.\n- **Inspirar Coragem** (1°): +1 de moral em ataques e dano para aliados ouvintes (+2 no 8°, +3 no 14°, +4 no 20°).\n- **Inspirar Competência** (3°): +2 em uma perícia para um aliado.\n- **Sugestão** (6°): Sugestão via música em alvo fascinado.\n- **Inspirar Grandeza** (9°): DV extras, +2 em ataques e Fortitude para aliados.\n- **Sugestão em Massa** (12°): Sugestão em vários alvos fascinados.\n- **Inspirar Heroísmo** (15°): bônus massivos de moral para aliados escolhidos.\n- **Grito de Morte** (20°): mata alvos vulneráveis.\n\n**Conhecimento de Bardo**: soma nível + INT em verificações de conhecimento não treinado — o bibliotecário universal do grupo.\n**Conjuração Espontânea Arcana**: lança magias da lista de bardo sem preparo. Máximo 6° círculo (topo).\n\n**Atributo primário**: Carisma.\n**Dado de Vida**: d6.\n**BBA**: Média | **Fortitude**: Ruim | **Reflexos**: Boa | **Vontade**: Boa.\n**Pontos de perícia**: 6 + INT por nível.\n**Alinhamento**: não pode ser leal — a espontaneidade artística resiste à rigidez legal.\n**Proficiências**: armas simples + arco longo, arco curto, chicote, rapieira, espada curta, espada bastarda; armaduras leves (sem falha arcana — vantagem única); escudos leves; sem armaduras médias/pesadas ao conjurar.\n\n**Estilo de jogo**: coringa hábil — nunca o melhor em qualquer papel, mas presente em todos simultaneamente. Excelente em campanhas com narrativa social, exploração e combates de suporte.",
                'dado_vida'              => 6,
                'bba_progressao'         => 'media',
                'resistencia_fortitude'  => 'ruim',
                'resistencia_reflexos'   => 'boa',
                'resistencia_vontade'    => 'boa',
                'pontos_pericia'         => 6,
            ],
            [
                'nome'                   => 'Clérigo',
                'versao'                 => '3.5',
                'descricao'              => "Sacerdote guerreiro que canaliza os poderes divinos de sua deidade para o mundo mortal. Clérigos são combatentes espirituais — servos escolhidos de deuses específicos, cujas magias são orações concedidas e cuja força divina os torna simultaneamente curadores e destruidores.\n\n**Conjuração Divina**: prepara magias divinas diariamente da lista completa de clérigo (até 9° círculo). Diferente do mago, tem acesso a TODAS as magias da lista sem grimório — a lista inteira do PHB está disponível para escolha diária.\n**Domínios Divinos**: escolha 2 domínios apropriados à divindade. Cada domínio concede uma magia bônus por círculo (espaço extra) e uma habilidade especial (ex.: **Guerra** dá Foco em Arma; **Cura** aprimora conjuração espontânea de curas; **Sol** aumenta expulsão).\n**Conjuração Espontânea**: clérigos bons convertem qualquer magia preparada em Curar Ferimentos do mesmo círculo instantaneamente; malignos convertem em Infligir; neutros escolhem uma vez.\n**Expulsão de Mortos-Vivos**: 3+CAR vezes por dia. Bons e neutros afugentam mortos-vivos até 2×nível em HD; malignos controlam. Requer teste com CD baseado no HD do morto-vivo.\n**Aura**: aura sobrenatural detectável por Detectar Mal/Bem/Lei/Caos, correspondente ao alinhamento do deus.\n\n**Atributo primário**: Sabedoria (magias); Força e Constituição secundários (combate).\n**Dado de Vida**: d8.\n**BBA**: Média | **Fortitude**: Boa | **Reflexos**: Ruim | **Vontade**: Boa.\n**Pontos de perícia**: 2 + INT por nível.\n**Alinhamento**: dentro de um passo do alinhamento do deus.\n**Proficiências**: todas as armas simples + arma favorita do deus; todas as armaduras e escudos (exceto torre).\n\n**Estilo de jogo**: fundação essencial de qualquer grupo — cura, buffs, controle de mortos-vivos e melee ligeiro. Classe versátil que se adapta a qualquer campanha.",
                'dado_vida'              => 8,
                'bba_progressao'         => 'media',
                'resistencia_fortitude'  => 'boa',
                'resistencia_reflexos'   => 'ruim',
                'resistencia_vontade'    => 'boa',
                'pontos_pericia'         => 2,
            ],
            [
                'nome'                   => 'Druida',
                'versao'                 => '3.5',
                'descricao'              => "Guardião da natureza selvagem que canaliza os poderes elementais dos ciclos naturais. Druidas são sacerdotes das florestas, montanhas, tundras e desertos — servos não de deuses antropomórficos, mas da própria Natureza como conceito cósmico. Rejeitam a civilização como corrupção antinatural.\n\n**Conjuração Divina**: prepara magias divinas da lista específica de druida (até 9° círculo). Magias da natureza — Entrelaçar, Chamado da Natureza, Controle Meteorológico, Terremoto — dominam a lista.\n**Companheiro Animal** (1°): ganha um companheiro (lobo, urso, tigre, pantera) que cresce com o druida, ganhando PVs, atributos, RD, evasão.\n**Sentido da Natureza** (1°): +2 em Conhecimento (natureza) e Sobrevivência.\n**Empatia Selvagem** (1°): influencia atitudes de animais como Diplomacia influencia humanoides.\n**Passo Silencioso** (3°): não deixa rastros em ambientes naturais.\n**Percurso pela Selva** (3°): movimento normal em terreno difícil natural.\n**Resistir ao Chamado da Natureza** (4°): +4 em TR contra habilidades de fadas.\n**Forma Selvagem** (5°+): 1x/dia no 5° (mais usos crescentes até 6x/dia no 18°). Transforma-se em animal e depois plantas e elementais:\n- 5°: animais Pequeno ou Médio.\n- 6°: animais Grandes.\n- 8°: formas de planta e elementais Pequenos.\n- 10°: elementais Médios.\n- 12°: animais Enormes, elementais Grandes.\n- 16°: elementais Enormes.\n- Duração: horas equivalentes ao nível.\n**Imunidade a Venenos** (9°).\n**Mil Faces** (13°): pode alterar aparência à vontade (como Autometamorfose).\n**Corpo Atemporal** (15°): não envelhece mais.\n\n**Atributo primário**: Sabedoria.\n**Dado de Vida**: d8.\n**BBA**: Média | **Fortitude**: Boa | **Reflexos**: Ruim | **Vontade**: Boa.\n**Pontos de perícia**: 4 + INT por nível.\n**Alinhamento**: qualquer neutro (Verdadeiro Neutro, Leal Neutro, Neutro Bondoso, Neutro Maligno ou Caótico Neutro).\n**Proficiências**: armas simples selecionadas (clava, adaga, dardo, azagaia, lança, funda, cimitarra, cajado); armaduras leves ou médias sem metal; escudos de madeira. **Armadura ou escudo de metal** cancela magias e Forma Selvagem por 24 horas.\n\n**Estilo de jogo**: guardião polivalente — combatente feroz em Forma Selvagem, curador divino da natureza, invocador de aliados naturais e mestre de mudança de terreno.",
                'dado_vida'              => 8,
                'bba_progressao'         => 'media',
                'resistencia_fortitude'  => 'boa',
                'resistencia_reflexos'   => 'ruim',
                'resistencia_vontade'    => 'boa',
                'pontos_pericia'         => 4,
            ],
            [
                'nome'                   => 'Feiticeiro',
                'versao'                 => '3.5',
                'descricao'              => "Conjurador arcano nascido com magia no sangue — ancestralidade dracônica, herança celestial, corrupção infernal ou simplesmente uma gota de puro poder cósmico correndo em suas veias. Feiticeiros são o oposto do mago: enquanto o mago estuda, o feiticeiro sente; enquanto o mago tem repertório enorme, o feiticeiro tem magias intensivas.\n\n**Conjuração Espontânea Arcana**: lança magias arcanas da lista conhecida sem preparo antecipado. Aprende novas magias em níveis fixos:\n- 1° nível: 4 truques + 2 magias de 1° conhecidos.\n- Total no 20°: 9 truques + várias magias por círculo até o 9°.\n- Alcança 9° círculo no **17° nível** — 3 níveis antes do mago.\nNão estuda grimórios, não copia magias — as novas magias vêm como \"revelações internas\". Em troca, tem **mais espaços de magia por dia** que o mago no mesmo círculo.\n**Familiar** (1°): invoca familiar (gato, coruja, morcego, cobra, sapo, coelho, doninha, gralho, rato). Fornece +2 numa perícia específica, telepatia dentro de 1,5 km e permite armazenar magias tocando. Cresce em poder com o mestre.\n\n**Atributo primário**: Carisma (define magias/dia, CD dos TR e potência máxima).\n**Dado de Vida**: d4 (frágil, como o mago).\n**BBA**: Ruim | **Fortitude**: Ruim | **Reflexos**: Ruim | **Vontade**: Boa.\n**Pontos de perícia**: 2 + INT por nível.\n**Alinhamento**: qualquer.\n**Proficiências**: armas simples apenas; sem armaduras (falha arcana); sem escudos ao conjurar.\n\n**Estilo de jogo**: especialista em algumas magias favoritas que domina completamente. Menor flexibilidade dia-a-dia que o mago, mas maior potência sustentada. Ideal para jogadores que preferem menos decisões de preparação e mais uso frequente da magia predileta.",
                'dado_vida'              => 4,
                'bba_progressao'         => 'ruim',
                'resistencia_fortitude'  => 'ruim',
                'resistencia_reflexos'   => 'ruim',
                'resistencia_vontade'    => 'boa',
                'pontos_pericia'         => 2,
            ],
            [
                'nome'                   => 'Guerreiro',
                'versao'                 => '3.5',
                'descricao'              => "Mestre absoluto do combate marcial, treinado exaustivamente em todas as armas e armaduras. Guerreiros são a coluna vertebral de qualquer exército medieval e o membro mais confiável em melee de qualquer grupo aventureiro — cada nível é uma nova camada de perícia bélica.\n\n**Talentos de Bônus**: talento bônus no 1° nível + um talento adicional a cada 2 níveis (2°, 4°, 6°, 8°, 10°, 12°, 14°, 16°, 18°, 20°). Total: **11 talentos bônus** — mais que qualquer outra classe.\n\nEscolhidos de uma lista específica de talentos de combate direto: **Ataque Poderoso**, **Ataque Concentrado**, **Golpe Ofensivo**, **Deriva de Ataque**, **Foco em Arma**, **Especialização em Arma**, **Foco Maior em Arma**, **Especialização Maior em Arma**, **Tiro em Movimento**, **Precisão em Tiro** e muitos outros. Permite especialização profunda em qualquer estilo. Diferente de outras classes, o guerreiro não precisa usar seus talentos gerais para talentos de combate — usa os talentos bônus.\n\n**Atributos primários**: Força (melee) ou Destreza (arqueiro/scout); Constituição (PVs).\n**Dado de Vida**: d10.\n**BBA**: Boa (máxima do jogo) | **Fortitude**: Boa | **Reflexos**: Ruim | **Vontade**: Ruim.\n**Pontos de perícia**: 2 + INT por nível (a menor no PHB — dedicação total ao treinamento marcial).\n**Alinhamento**: qualquer.\n**Proficiências**: **TODAS** as armas simples e marciais; todas as armaduras leves, médias e pesadas; todos os escudos (incluindo torre). Única classe com proficiência universal.\n\n**Estilo de jogo**: chassi universal para qualquer conceito de combatente físico. Tanque, arqueiro, cavaleiro, duelista de duas armas, lanceiro — todos podem ser guerreiros, diferenciados apenas por talentos e equipamento. Simples de jogar, poderoso em qualquer estilo, e a classe mais confiável para novos jogadores que querem combatente puro sem magias.",
                'dado_vida'              => 10,
                'bba_progressao'         => 'boa',
                'resistencia_fortitude'  => 'boa',
                'resistencia_reflexos'   => 'ruim',
                'resistencia_vontade'    => 'ruim',
                'pontos_pericia'         => 2,
            ],
            [
                'nome'                   => 'Ladino',
                'versao'                 => '3.5',
                'descricao'              => "Especialista em furtividade, armadilhas e golpes traiçoeiros — o oportunista consumado de qualquer grupo aventureiro. Ladinos são batedores, arrombadores, espiões, assassinos ou simplesmente aventureiros que preferem inteligência a força bruta.\n\n**Ataque Furtivo**: dano extra contra alvos desprevenidos, flanqueados ou negados à Destreza. Progressão: **+1d6 no 1°**, +1d6 adicional a cada 2 níveis, até **+10d6 no 19°**. Funciona com qualquer arma em melee ou à distância (dentro de 9 m). Alvo precisa ser vulnerável a dano crítico — constructos, mortos-vivos, elementais e criaturas com concealment reduzem ou anulam.\n**Descoberta de Armadilhas** (1°): apenas ladinos detectam armadilhas mágicas com CD 21+ (via Percepção) e apenas ladinos as desativam (via Desativar Dispositivo).\n**Evasão** (2°): passar em TR de Reflexos contra dano de área anula completamente o dano (não apenas metade).\n**Sentido de Armadilha** (3°+): bônus crescente em Reflexos contra armadilhas e CA contra ataques delas.\n**Esquiva Sobrenatural** (4°): não perde bônus de DES quando surpreso ou flanqueado.\n**Esquiva Sobrenatural Aprimorada** (8°): imune a flanqueio, exceto por ladino 4+ níveis acima.\n**Evasão Aprimorada** (10°): dano à metade mesmo se falhar no TR de Reflexos.\n**Habilidades Especiais** (10°, 13°, 16°, 19°): escolha entre **Rufião** (dano furtivo extra), **Ataque Adaptável** (troca dano furtivo por outro efeito), **Mente Escorregadia** (novo TR contra Encantamento), **Oportunista** (ataque livre quando aliado acerta), **Golpe Furtivo à Distância Ampliado** (9 m → 18 m) e outras.\n\n**Atributos primários**: Destreza (esquiva, ataques à distância, várias perícias); Inteligência (mais perícias); Carisma (sociais).\n**Dado de Vida**: d6.\n**BBA**: Média | **Fortitude**: Ruim | **Reflexos**: Boa | **Vontade**: Ruim.\n**Pontos de perícia**: 8 + INT por nível (o máximo entre classes básicas).\n**Alinhamento**: qualquer.\n**Proficiências**: armas simples + boleadeira, besta de mão, punhal duplo, espada curta, chicote, rapieira; armaduras leves; sem escudos.\n\n**Estilo de jogo**: coringa versátil que resolve problemas fora do combate (perícias) e maximiza dano por posicionamento. Prefere combates com muitos aliados (flanqueio) e evita criaturas imunes a dano crítico.",
                'dado_vida'              => 6,
                'bba_progressao'         => 'media',
                'resistencia_fortitude'  => 'ruim',
                'resistencia_reflexos'   => 'boa',
                'resistencia_vontade'    => 'ruim',
                'pontos_pericia'         => 8,
            ],
            [
                'nome'                   => 'Mago',
                'versao'                 => '3.5',
                'descricao'              => "Conjurador arcano estudioso que registra magias em um grimório e as prepara diariamente por meio de intenso estudo intelectual. Magos são acadêmicos, sábios e artesãos do arcano — a antítese do feiticeiro emotivo.\n\n**Grimório e Preparação Arcana**: começa com grimório contendo 3 truques + 3 magias de 1° escolhidas. A cada nível ganho, aprende automaticamente 2 novas magias para o grimório. Além disso, **qualquer** magia arcana da lista de mago encontrada em outros grimórios, pergaminhos ou tomos pode ser copiada com um teste de Identificar Magia (CD 15 + nível) e custo em pergaminhos (100 PO/página). Grimórios de magos experientes contêm centenas de magias — mais que qualquer outra classe. Prepara magias diariamente: escolha bem = terá a magia certa; escolha mal = ficará sem.\n**Especialização de Escola** (opcional, 1°): escolha uma escola (**Abjuração**, **Conjuração**, **Adivinhação**, **Encantamento**, **Evocação**, **Ilusão**, **Necromancia** ou **Transmutação**) e ganhe um espaço adicional por círculo daquela escola. Em troca, abandone **duas escolas proibidas** — nunca poderá preparar magias delas. Alternativa: **Mago Universal** (não-especializado, sem slot bônus mas acesso pleno).\n**Familiar** (1°): invoca familiar (gato, coruja, morcego etc.), bônus temáticos, comunicação telepática dentro de 1,5 km. Cresce com o mestre.\n\n**Atributo primário**: Inteligência (define magias/dia, CD dos TR, potência máxima).\n**Dado de Vida**: d4 (o mais frágil do jogo).\n**BBA**: Ruim | **Fortitude**: Ruim | **Reflexos**: Ruim | **Vontade**: Boa.\n**Pontos de perícia**: 2 + INT por nível.\n**Alinhamento**: qualquer.\n**Proficiências**: armas simples selecionadas (adaga, bordão, cimitarra leve, dardo, funda, azagaia); sem armaduras nem escudos ao conjurar (falha arcana).\n\n**Estilo de jogo**: máxima versatilidade e adaptação dia-a-dia — o \"arsenal universal\" do grupo, mas requer planejamento cuidadoso e leitura das situações. Ideal para jogadores estratégicos que gostam de otimizar recursos e antecipar problemas.",
                'dado_vida'              => 4,
                'bba_progressao'         => 'ruim',
                'resistencia_fortitude'  => 'ruim',
                'resistencia_reflexos'   => 'ruim',
                'resistencia_vontade'    => 'boa',
                'pontos_pericia'         => 2,
            ],
            [
                'nome'                   => 'Monge',
                'versao'                 => '3.5',
                'descricao'              => "Artista marcial disciplinado que transcende os limites físicos cultivando o ki interior por décadas de treinamento monástico. Monges são combatentes-místicos sem paralelo — vivem em monastérios remotos ou peregrinações intermináveis pelas terras conhecidas em busca de perfeição espiritual através do corpo.\n\n**Ataque Desarmado Aprimorado** (1°): punhos, cotovelos, joelhos e pés são armas letais. Dano crescente por nível:\n- 1°-3°: 1d6\n- 4°-7°: 1d8\n- 8°-11°: 1d10\n- 12°-15°: 2d6\n- 16°-19°: 2d8\n- 20°: 2d10\n**Rajada de Golpes** (1°): ataques extras em ataque total com penalidade -2 em todos, chegando a 5+ ataques/rodada em altos níveis.\n**Bônus na CA** (2°): sem armadura, ganha bônus da SAB + 1 por 4 níveis (máx +5).\n**Movimento Rápido** (3°+): +3 m no deslocamento base, subindo até **+9 m no 18°**.\n**Queda Suave** (4°): próximo a parede, reduz altura da queda em 6 m.\n**Golpe Ki** (5°): ataques desarmados contam como mágicos, contornando RD.\n**Corpo Puro** (5°): imunidade a doenças, mesmo mágicas.\n**Domínio do Ki** (6°+): reserva de ki para efeitos especiais — golpes elementais, movimentos, magias limitadas.\n**Corpo de Diamante** (11°): imunidade a venenos.\n**Alma de Diamante** (13°): Resistência à Magia igual a 10 + nível.\n**Palma Vibrante** (15°): 1x/semana marca um alvo; até 24 h depois, o monge pode matá-lo instantaneamente.\n**Corpo Vazio** (19°): torna-se etéreo por 1 rodada/nível/dia.\n**Ser Perfeito** (20°): manifestação sobrenatural — imortal, imune a envelhecimento.\n\n**Atributos primários**: Sabedoria (CA e várias habilidades), Destreza (CA e ataques), Constituição (PVs).\n**Dado de Vida**: d8.\n**BBA**: Média | **Fortitude**: Boa | **Reflexos**: Boa | **Vontade**: Boa (única classe com **três TRs Boas** — a melhor resistência do jogo).\n**Pontos de perícia**: 4 + INT por nível.\n**Alinhamento**: deve ser **leal** — a disciplina rígida define a classe.\n**Proficiências**: armas simples selecionadas (punhal, dardo, azagaia, funda, bordão) + armas monásticas exóticas (adaga de vento, kama, nunchaku, sai, shuriken, siangham); sem armaduras nem escudos (perde bônus de classe se usar).\n\n**Estilo de jogo**: guerreiro móvel de habilidades místicas — muitos ataques/rodada, defesas superiores, mobilidade excepcional. Excelente contra magos (Alma de Diamante), venenosos (Corpo de Diamante) e hordas (Rajada). Depende de vários atributos altos, o que o torna o \"sofrido em MAD\" da lista.",
                'dado_vida'              => 8,
                'bba_progressao'         => 'media',
                'resistencia_fortitude'  => 'boa',
                'resistencia_reflexos'   => 'boa',
                'resistencia_vontade'    => 'boa',
                'pontos_pericia'         => 4,
            ],
            [
                'nome'                   => 'Paladino',
                'versao'                 => '3.5',
                'descricao'              => "Guerreiro sagrado dedicado a uma deidade bondosa, campeão da luz e destruidor do mal. Paladinos são a personificação da virtude marcial — heróis lendários que combinam habilidades marciais superiores com dons divinos concedidos por sua devoção inabalável.\n\n**Alinhamento**: **DEVE ser Leal e Bom**. Qualquer desvio permanente (ato caótico ou maligno) causa **perda IMEDIATA** de todas as habilidades sobrenaturais. Restauração exige magia Expiação, custosa e ritualística.\n\n**Detectar o Mal** (1°): como a magia, à vontade e ilimitado.\n**Golpe Sagrado** (1°+): 1x/dia no 1°, com usos adicionais em 5°, 10°, 15° e 20°. Ataque em melee contra criatura má com bônus de dano igual ao nível de paladino; dobra o dano contra alinhados ao mal absoluto (extraplanares, mortos-vivos, dragões alinhados).\n**Graça Divina** (2°): bônus de resistência igual ao modificador de Carisma em todos os TR.\n**Imposição das Mãos** (2°): cura até (nível × CAR-mod) PVs/dia, distribuídos como preferir. Contra mortos-vivos, funciona como dano.\n**Aura de Coragem** (3°): imunidade a medo para o paladino; aliados a 3 m ganham +4 em TR contra medo.\n**Cura Divina** (3°): imunidade a doenças, mesmo mágicas.\n**Expulsão de Mortos-Vivos** (4°): como clérigo 3 níveis abaixo.\n**Conjuração Divina** (4°+): magias divinas limitadas da lista de paladino, máximo 4° círculo.\n**Corcel Celestial** (5°): 1x/2 dias convoca corcel celestial — cavalo pesado especial com deslocamento aprimorado, RD, resistência a energias, telepatia e evasão. Cresce com o paladino.\n**Remoção de Doenças** (6°+): 1x/semana no 6°, com usos adicionais em níveis crescentes.\n\n**Atributos primários**: Carisma (Graça Divina, Golpe Sagrado, TR); Força (melee); Constituição (PVs).\n**Dado de Vida**: d10.\n**BBA**: Boa | **Fortitude**: Boa | **Reflexos**: Ruim | **Vontade**: Ruim.\n**Pontos de perícia**: 2 + INT por nível.\n**Proficiências**: todas as armas simples e marciais; todas as armaduras; todos os escudos (exceto torre).\n\n**Estilo de jogo**: combatente-líder resistente com utilidade sagrada contra mortos-vivos e mal. Menos poder marcial puro que guerreiro (menos talentos), mas compensa com magias, cura de campo e Golpe Sagrado devastador. Rígido em role-playing — restrições éticas absolutas podem ser desafiadoras em campanhas moralmente cinzentas.",
                'dado_vida'              => 10,
                'bba_progressao'         => 'boa',
                'resistencia_fortitude'  => 'boa',
                'resistencia_reflexos'   => 'ruim',
                'resistencia_vontade'    => 'ruim',
                'pontos_pericia'         => 2,
            ],
            [
                'nome'                   => 'Patrulheiro',
                'versao'                 => '3.5',
                'descricao'              => "Caçador, batedor e rastreador das terras selvagens, especializado em perseguir e destruir tipos específicos de inimigos. Patrulheiros são scouts que conhecem florestas, montanhas e desertos como suas próprias palmas — combinam habilidades marciais de guerreiro com magia divina limitada e conexão profunda com a natureza.\n\n**Inimigo Favorito** (1°+): escolha um tipo de criatura (aberrações, animais, constructos, dragões, fadas, gigantes, humanoides monstruosos, mortos-vivos, ou humanoides de subtipo específico como orcs, goblinoides, elfos-negros). Ganha **+2 em Blefar, Ouvir, Percepção, Sentir Motivação e Sobrevivência** contra ele + **+2 no dano** em ataques contra ele. A cada 5 níveis (5°, 10°, 15°, 20°), o bônus contra o favorito original aumenta em +2, ou escolhe novo inimigo começando em +2. No 20°, pode ter até **5 inimigos favoritos** com o mais antigo em **+10**.\n**Rastreamento** (1°): talento bônus gratuito — segue rastros mesmo em terrenos difíceis.\n**Empatia Selvagem** (1°): influencia atitudes de animais como Diplomacia influencia humanoides.\n**Estilo de Combate** (2°): escolha permanente entre:\n- **Combate com Duas Armas**: recebe TWF (sem pré-requisitos); Aprimorado no 6°; Maior no 11°.\n- **Arqueiro**: recebe Rapid Shot no 2°; Manyshot no 6°; Improved Precise Shot no 11°.\n**Conjuração Divina** (4°+): magias divinas limitadas da lista de patrulheiro, máximo 4° círculo.\n**Companheiro Animal** (4°): similar ao do druida, mas com poder equivalente a druida 3 níveis abaixo.\n**Passo Silencioso** (7°): não deixa rastros em ambientes naturais.\n**Percurso pela Selva** (7°): movimento normal em terreno difícil natural.\n\n**Atributos primários**: Sabedoria (magias); Destreza (arco) ou Força (duas armas); Constituição (PVs).\n**Dado de Vida**: d8.\n**BBA**: Boa | **Fortitude**: Boa | **Reflexos**: Boa | **Vontade**: Ruim.\n**Pontos de perícia**: 6 + INT por nível.\n**Alinhamento**: qualquer.\n**Proficiências**: todas as armas simples e marciais; armaduras leves e médias; todos os escudos (exceto torre).\n\n**Estilo de jogo**: guerreiro secundário especializado em explorar, rastrear e caçar. Excelente scout, útil em campanhas ao ar livre, complementar aos combatentes pesados. Menos poder puro que guerreiro ou bárbaro em combates simétricos, mas incomparável quando o alvo é um inimigo favorito.",
                'dado_vida'              => 8,
                'bba_progressao'         => 'boa',
                'resistencia_fortitude'  => 'boa',
                'resistencia_reflexos'   => 'boa',
                'resistencia_vontade'    => 'ruim',
                'pontos_pericia'         => 6,
            ],
        ];

        foreach ($classes as $classe) {
            Classe::updateOrCreate(
                ['nome' => $classe['nome'], 'versao' => $classe['versao']],
                $classe
            );
        }
    }
}
