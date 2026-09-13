<?php

namespace Database\Seeders;

use App\Models\Pericia;
use Illuminate\Database\Seeder;

class PericiaSeeder extends Seeder
{
    public function run(): void
    {
        $pericias = [
            [
                'nome' => 'Abrir Fechaduras',
                'habilidade_chave' => 'DES',
                'descricao' => "Abre fechaduras mecânicas e dispositivos de tranca usando ferramentas de ladrão delicadas. Cada mecanismo desconhecido é um pequeno enigma físico a ser decifrado.\n\n**Uso Principal**: destrancar fechaduras. CDs: 20 (simples), 25 (mediana), 30 (boa), 40 (excelente ou obra-prima).\n**Ação**: 1 rodada completa por tentativa.\n**Ferramentas**: exige um estojo de ferramentas de ladrão; sem elas, penalidade de -2 (ou impossível para fechaduras superiores).\n**Tentar Novamente**: sim, sem penalidade.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Ladino.",
            ],
            [
                'nome' => 'Acrobacia',
                'habilidade_chave' => 'DES',
                'descricao' => "Realiza rolamentos, cambalhotas e movimentos evasivos para atravessar terreno perigoso ou evitar golpes. Também usada para amortecer quedas.\n\n**Uso Principal**: mover metade do deslocamento através de área ameaçada sem provocar ataque de oportunidade (CD 15). Reduz dano de queda (CD 15 = ignora primeiros 3 m de dano).\n**Movimento Total**: dobrar velocidade através de área ameaçada exige CD 25.\n**Ação**: nenhuma (parte do movimento).\n**Armadura**: penalidade de armadura aplica-se.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Monge, Ladino.",
            ],
            [
                'nome' => 'Adestrar Animais',
                'habilidade_chave' => 'CAR',
                'descricao' => "Treina animais para executar comandos, acalma feras hostis ou controla montarias em situações difíceis. Perícia essencial para druidas, cavaleiros e patrulheiros.\n\n**Uso Principal**: manejar um animal treinado (CD 10 para cada truque conhecido); forçar animal a executar truque não-treinado (CD 25); ensinar novo truque (CD 15, uma semana de treino); criar animal jovem selvagem (CD 15).\n**Truques Comuns**: Atacar, Defender, Vir, Deitar, Buscar, Ficar, Trabalhar, Guardar, Sentar.\n**Ação**: manejo em combate = ação de movimento; treino = semanas.\n**Treinamento**: obrigatório para forçar/ensinar truques.\n**Classes de Classe**: Bárbaro, Druida, Guerreiro, Paladino, Patrulheiro.",
            ],
            [
                'nome' => 'Arte da Fuga',
                'habilidade_chave' => 'DES',
                'descricao' => "Escapa de agarramentos, cordas, algemas e espaços apertados através de flexibilidade e técnica. Habilidade favorita de ladinos capturados e prestidigitadores de palco.\n\n**Uso Principal**: escapar de agarramento (oposto ao teste de Agarrar do captor); libertar-se de cordas (CD 20 + Usar Cordas do amarrador); algemas comuns (CD 30) ou de obra-prima (CD 35); passar por espaço apertado (CD 30 para atravessar uma cabeça menor).\n**Ação**: rodada completa para escapar; longa (10 min ou mais) para amarras complexas.\n**Tentar Novamente**: sim, mas cada tentativa toma tempo.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Monge, Ladino.",
            ],
            [
                'nome' => 'Atuação',
                'habilidade_chave' => 'CAR',
                'descricao' => "Entretém plateias através de arte performática — música, dança, teatro, oratória. Base indispensável das habilidades mágicas do bardo.\n\n**Categorias**: canto, dança, atuação teatral, oratória, comédia, instrumento de sopro, instrumento de cordas, instrumento de teclado, percussão (escolha uma categoria por rank, como Ofícios).\n**Uso Principal**: performance impressiona plateia — CD 10 (moeda de cobre), CD 15 (moeda de prata), CD 20 (moeda de ouro), CD 25 (contratado por nobre), CD 30 (fama regional).\n**Ganho**: perícia funciona como fonte de renda para bardos entre aventuras (moedas equivalentes ao resultado do teste por semana).\n**Ação**: variável (minutos a horas).\n**Classes de Classe**: Bardo, Monge.",
            ],
            [
                'nome' => 'Avaliação',
                'habilidade_chave' => 'INT',
                'descricao' => "Determina o valor de mercado de itens, gemas, obras de arte, armas antigas ou equipamentos. Habilidade indispensável para negociantes e caçadores de tesouro.\n\n**Uso Principal**: identificar valor exato — CD 12 (item comum), CD 15 (bem-feito), CD 20 (raro ou incomum), CD 25 (excepcional/obra de arte), CD 30 (peça única ou antiga).\n**Ação**: 1 minuto de análise cuidadosa.\n**Falha por 5+**: você estima o valor errado (mestre pode inventar valor plausível mas incorreto).\n**Especialização**: avaliação de itens mágicos exige a magia Identificar ou perícia Identificar Magia.\n**Treinamento**: não requer.\n**Classes de Classe**: Bardo, Ladino, Mago.",
            ],
            [
                'nome' => 'Blefar',
                'habilidade_chave' => 'CAR',
                'descricao' => "Convence outros de mentiras, cria distrações, engana com meias-verdades ou desconcerta oponentes em combate. Oposto natural de Sentir Motivação.\n\n**Uso Principal**: contar mentira convincente — oposto ao teste de Sentir Motivação do ouvinte. Modificadores baseados na plausibilidade: mentira crível (+5 para o mentiroso), improvável (0), impossível (-5 a -10), auto-destrutiva (-20).\n**Fintar em Combate**: oposto ao teste de Sentir Motivação do oponente; sucesso nega o bônus de DES à CA no próximo ataque em melee. Ação padrão.\n**Passar Mensagem Secreta**: cifra rápida entre aliados durante conversa (CD 15 para mensagens simples, 20 para complexas).\n**Ação**: 1 rodada normalmente.\n**Classes de Classe**: Bardo, Feiticeiro, Ladino.",
            ],
            [
                'nome' => 'Cavalgar',
                'habilidade_chave' => 'DES',
                'descricao' => "Monta e controla cavalos, cães de guerra, pôneis e outras montarias em terrenos difíceis, combate e manobras arriscadas.\n\n**Uso Principal**: manobras equestres com CDs variáveis:\n- Guiar com os joelhos (para lutar com duas mãos): CD 5.\n- Permanecer selado após dano: CD 5.\n- Combate montado (montaria treinada): CD 10; sem treino: CD 20.\n- Buscar cobertura atrás da montaria: CD 15.\n- Aterrisagem suave após queda: CD 15.\n- Salto com montaria: CD 15.\n- Esporear a montaria (deslocamento aumentado): CD 15.\n**Ação**: livre para maioria; padrão para manobras avançadas.\n**Classes de Classe**: Bárbaro, Druida, Guerreiro, Paladino, Patrulheiro.",
            ],
            [
                'nome' => 'Concentração',
                'habilidade_chave' => 'CON',
                'descricao' => "Mantém foco enquanto conjura magias sob condições adversas — sofrer dano, ser derrubado, ser sacudido. Habilidade fundamental de qualquer conjurador aventureiro.\n\n**Uso Principal**: manter magia em conjuração sob perturbação.\n- Lançar defensivamente (evitar oportunidade): CD 15 + nível da magia.\n- Sofreu dano durante conjuração: CD 10 + dano recebido + nível da magia.\n- Envolvido em vento forte, movimento violento: CD 10 a 20 + nível da magia.\n- Confuso ou fatigado: CD 10 + nível da magia.\n**Ação**: nenhuma extra — é rolada durante a conjuração.\n**Falha**: a magia é perdida, o espaço é gasto sem efeito.\n**Classes de Classe**: Bardo, Clérigo, Druida, Feiticeiro, Mago, Paladino, Patrulheiro (todos os conjuradores).",
            ],
            [
                'nome' => 'Conhecimento (Arcano)',
                'habilidade_chave' => 'INT',
                'descricao' => "Estudo formal das tradições arcanas — magias, criaturas mágicas, planos arcanos, símbolos místicos. Base intelectual do mago e essencial para identificar ameaças mágicas.\n\n**Uso Principal**: recordar conhecimento arcano relevante:\n- Fato comum: CD 10 (símbolo mágico básico, criatura conhecida).\n- Fato incomum: CD 15 (magia moderadamente conhecida, monstro específico).\n- Fato raro: CD 20 (magia obscura, tradição perdida).\n- Fato lendário: CD 25-30 (informação de tomos secretos).\n**Identificar Criatura Mágica**: CD 10 + HD (permite conhecer imunidades e ataques especiais).\n**Ação**: livre em resposta a evento; 1 rodada para pesquisa concentrada.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Clérigo, Feiticeiro, Mago.",
            ],
            [
                'nome' => 'Conhecimento (Arquitetura e Engenharia)',
                'habilidade_chave' => 'INT',
                'descricao' => "Estudo formal de construções, estruturas, castelos, pontes, sistemas de água, torres de cerco, técnicas de engenharia civil e militar.\n\n**Uso Principal**: recordar conhecimento sobre estruturas — pontos fracos de uma torre, técnicas para atravessar muralha, tipos de armadilhas comuns em construções, autor provável de uma catedral (CDs 10 a 30 conforme obscuridade).\n**Aplicações Práticas**: encontrar passagem secreta em construção (bônus em Procurar), avaliar segurança de estrutura antes de atravessar, planejar um cerco ou reforçar defesas.\n**Ação**: livre em resposta a evento; até 1 dia para análise cuidadosa de projeto.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Clérigo, Mago.",
            ],
            [
                'nome' => 'Conhecimento (Dungeon)',
                'habilidade_chave' => 'INT',
                'descricao' => "Estudo de calabouços, cavernas, ambientes subterrâneos, armadilhas típicas, monstros das profundezas e ecologia caverneira.\n\n**Uso Principal**: recordar conhecimento sobre caverneiros — comportamento de aberrações (aboletas, illithids), tipos de fungos e gosmas, riscos de escombros e alagamentos, ecossistemas do Subterrâneo.\n**Identificar Monstro**: CD 10 + HD para reconhecer aberrações, gosmas, alguns constructos e mortos-vivos comuns das dungeons (permite conhecer resistências e táticas).\n**Ação**: livre; 1 rodada para pesquisa.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Clérigo, Mago, Patrulheiro (parcial).",
            ],
            [
                'nome' => 'Conhecimento (Geografia)',
                'habilidade_chave' => 'INT',
                'descricao' => "Estudo formal de terras, regiões, climas, topografia, cartografia, culturas do mundo e viagens comerciais.\n\n**Uso Principal**: recordar conhecimento geográfico — clima de uma região distante, rota comercial entre cidades, cultura de povos exóticos, fronteiras políticas atuais ou históricas (CDs 10 a 25 conforme distância e obscuridade).\n**Aplicações Práticas**: navegar sem mapa em terra conhecida, prever tempestades sazonais, escolher a melhor época para atravessar uma passagem montanhosa.\n**Ação**: livre em resposta a evento; até 1 hora para análise cuidadosa.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Clérigo, Druida, Mago, Patrulheiro.",
            ],
            [
                'nome' => 'Conhecimento (História)',
                'habilidade_chave' => 'INT',
                'descricao' => "Estudo formal de guerras, dinastias, lendas, eventos históricos, civilizações antigas e figuras influentes do passado.\n\n**Uso Principal**: recordar conhecimento histórico — batalha famosa, linha sucessória, ruínas de império antigo, personagem lendário (CDs 10-30 conforme era e obscuridade).\n**Identificar Artefato**: reconhecer origem histórica de item antigo, tomo perdido, símbolo de dinastia extinta.\n**Uso em Aventura**: identificar propósito de ruínas ao explorá-las, entender contexto de profecias, reconhecer descendentes de linhagens famosas.\n**Ação**: livre; 1 rodada para pesquisa profunda.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Clérigo, Mago.",
            ],
            [
                'nome' => 'Conhecimento (Local)',
                'habilidade_chave' => 'INT',
                'descricao' => "Conhecimento aprofundado sobre uma região ou cidade específica — seus habitantes, leis, costumes, facções, boatos e figuras influentes. Diferente das outras Conhecimentos, cada aplicação foca em UMA localidade única.\n\n**Uso Principal**: recordar informação sobre a região escolhida — quem manda em qual bairro, qual guilda controla o porto, qual noble tem escândalos, quais tabernas são frequentadas por espiões (CDs 10 a 25 conforme obscuridade).\n**Diferença**: bardos e alguns ladinos aprendem Conhecimento (Local) para várias cidades diferentes; cada versão é uma perícia separada.\n**Ação**: livre em resposta a evento.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Ladino.",
            ],
            [
                'nome' => 'Conhecimento (Natureza)',
                'habilidade_chave' => 'INT',
                'descricao' => "Estudo dos ciclos naturais — animais, plantas, terreno, clima, criaturas de fada, ecossistemas. Complemento essencial das perícias de druida e patrulheiro.\n\n**Uso Principal**: identificar plantas, animais e criaturas mágicas naturais — reconhecer flora venenosa (CD 10-15), identificar rastros de fera específica (CD 15-20), prever clima local (CD 10-20).\n**Identificar Criatura**: CD 10 + HD para animais, plantas, fadas, gigantes.\n**Uso em Aventura**: encontrar ervas curativas, evitar plantas hostis, identificar territórios de feras.\n**Ação**: livre; 1 rodada para observação cuidadosa.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Druida, Patrulheiro, Mago.",
            ],
            [
                'nome' => 'Conhecimento (Nobreza e Realeza)',
                'habilidade_chave' => 'INT',
                'descricao' => "Estudo formal de linhagens nobres, brasões, heráldica, protocolos, famílias reais, ordens de cavalaria e etiqueta de corte.\n\n**Uso Principal**: recordar conhecimento cortesão — reconhecer brasão de família (CD 10-20), identificar hierarquia de corte (CD 10-15), ordem de sucessão de um reino (CD 15-25), origem heráldica de um cavaleiro (CD 15-25).\n**Uso Prático**: apresentar-se corretamente à nobreza (bônus em Diplomacia), reconhecer impostor no meio de nobres (Sentir Motivação com sinergia), decifrar símbolos em armaduras de guerra antigas.\n**Ação**: livre; 1 rodada para observação cuidadosa.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Clérigo, Paladino, Mago.",
            ],
            [
                'nome' => 'Conhecimento (Os Planos)',
                'habilidade_chave' => 'INT',
                'descricao' => "Estudo cosmológico dos planos de existência — Astral, Etéreo, Elementais, Celestiais, Abissais, e criaturas planares diversas.\n\n**Uso Principal**: identificar criaturas extraplanares (demônios, diabos, anjos, celestiais, elementais), conhecer características de outro plano, reconhecer portal ou sinal de proveniência extraplanar (CDs 10-30 conforme raridade).\n**Identificar Criatura Planar**: CD 10 + HD, revelando resistências, imunidades, subtipos (Caótico, Legal, Bem, Mal, Frio, Fogo) e nome próprio se lendário.\n**Uso em Aventura**: preparar exorcismos, planejar viagens planares, negociar com invocações.\n**Ação**: livre; até 1 hora para pesquisa profunda.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Clérigo, Mago.",
            ],
            [
                'nome' => 'Conhecimento (Religião)',
                'habilidade_chave' => 'INT',
                'descricao' => "Estudo formal de deuses, dogmas, rituais, ordens sagradas, criaturas sagradas ou malignas e mortos-vivos.\n\n**Uso Principal**: recordar teologia — panteão de uma cultura (CD 10-15), símbolos de deus específico (CD 10), doutrinas de igreja (CD 15-25), rituais de exorcismo (CD 20-30).\n**Identificar Morto-vivo**: CD 10 + HD para reconhecer imunidades (energia negativa, veneno, doença), fraquezas (energia positiva, luz solar para vampiros) e táticas comuns.\n**Uso Prático**: prever comportamento de cultistas, reconhecer heresias, dedicar altar corretamente.\n**Ação**: livre; 1 rodada para pesquisa.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Clérigo, Mago, Paladino.",
            ],
            [
                'nome' => 'Cura',
                'habilidade_chave' => 'SAB',
                'descricao' => "Aplica primeiros socorros, estabiliza moribundos, trata doenças e venenos com curativos e conhecimento médico não-mágico.\n\n**Uso Principal**: aplicar cuidados:\n- Estabilizar moribundo (0 PVs ou negativo): CD 15, ação padrão, evita novo teste de morte por hora.\n- Cuidados prolongados (durante repouso): CD 15, permite aliados descansados curarem 2x pontos/nível/dia (4x se especialmente cuidadoso).\n- Tratar veneno: CD = CD do veneno, permite novo TR contra dano secundário.\n- Tratar doença: CD = CD da doença, mesmo efeito.\n- Tratar ferimento de pontas (caltrops, espinhos): CD 15.\n**Ação**: variável — padrão para primeiros socorros, hora ou mais para cuidados prolongados.\n**Kit de Cura**: bônus de +2 se disponível.\n**Classes de Classe**: Clérigo, Druida, Paladino, Patrulheiro.",
            ],
            [
                'nome' => 'Decifrar Escrita',
                'habilidade_chave' => 'INT',
                'descricao' => "Decifra textos em línguas desconhecidas, códigos cifrados, mapas antigos, pergaminhos místicos e escritas incomuns.\n\n**Uso Principal**: entender língua desconhecida (CD 25) ou cifra simples (CD 20-30 conforme complexidade), até uma página por minuto. Passar por 10 na CD revela apenas o assunto geral; passar reveladamente revela o conteúdo.\n**Escritas Mágicas**: usar essa perícia com pergaminhos exige combinação com Identificar Magia — Decifrar apenas revela o significado da escrita, não permite conjurar.\n**Falha por 5+**: interpretação errada (mestre pode inventar conteúdo falso plausível).\n**Ação**: 1 minuto por página.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Ladino, Mago.",
            ],
            [
                'nome' => 'Diplomacia',
                'habilidade_chave' => 'CAR',
                'descricao' => "Melhora a atitude de NPCs, medeia conflitos, negocia acordos e convence grupos por argumentação pacífica. Habilidade central de personagens sociais e paladinos.\n\n**Uso Principal**: mudar atitude de NPC — CDs baseados na atitude inicial:\n- Hostil → Inimigo: CD 20; → Neutro: CD 25; → Amigável: CD 35; → Prestativo: CD 50.\n- Antipático → Indiferente: CD 15; → Amigável: CD 25.\n- Neutro → Amigável: CD 15; → Prestativo: CD 30.\n**Ação**: 1 minuto de conversação; em combate, ação de rodada completa com penalidade -10.\n**Modificadores**: circunstâncias podem dar bônus (+2 a +10) ou penalidades (-2 a -10) ao teste.\n**Classes de Classe**: Bardo, Clérigo, Monge, Paladino, Ladino.",
            ],
            [
                'nome' => 'Disfarce',
                'habilidade_chave' => 'CAR',
                'descricao' => "Altera aparência para passar-se por outra pessoa — mudando voz, roupas, postura, maquiagem. Ferramenta essencial de espiões e infiltradores.\n\n**Uso Principal**: criar disfarce eficaz, cujo resultado é oposto pelo teste de Observar de qualquer observador.\n- Sem mudança significativa: teste com bônus.\n- Detalhe pequeno (roupa, cabelo): -0.\n- Disfarçado como classe diferente: -2.\n- Gênero, raça ou idade diferente: -2 cada.\n- Duas ou mais dessas diferenças acumulam: -4, -6 etc.\n**Kit de Disfarce**: +2 com maquiagem, perucas e roupas apropriadas.\n**Ação**: 1d3 × 10 minutos para preparar.\n**Verificação Automática**: observador rola Observar automaticamente ao ver o disfarçado.\n**Classes de Classe**: Bardo, Ladino.",
            ],
            [
                'nome' => 'Equilíbrio',
                'habilidade_chave' => 'DES',
                'descricao' => "Mantém a postura sobre superfícies estreitas, escorregadias ou instáveis — cordas bambas, cornijas, gelo, telhados.\n\n**Uso Principal**: caminhar em superfície com CD variável:\n- Corda esticada: CD 10.\n- Cornija estreita (15-30 cm): CD 15.\n- Superfície muito estreita (< 15 cm) ou escorregadia: CD 20.\n- Superfície molhada, coberta de gelo, movendo-se: +5 na CD.\n**Movimento Rápido**: caminhar rápido (velocidade normal) exige +5 na CD; correr é impossível.\n**Falha por 5+**: cai.\n**Enquanto Balança**: personagem em equilíbrio precário perde bônus de DES à CA e ataques em melee sofrem penalidade -2.\n**Ação**: nenhuma (parte do movimento).\n**Classes de Classe**: Bardo, Monge, Ladino.",
            ],
            [
                'nome' => 'Escalar',
                'habilidade_chave' => 'FOR',
                'descricao' => "Sobe paredes, penhascos, árvores, muralhas e outras superfícies verticais ou muito inclinadas. Habilidade universal de aventureiros.\n\n**Uso Principal**: escalar com CDs variáveis:\n- Rampa íngreme: CD 0.\n- Encosta com pegadas fáceis: CD 5.\n- Superfície rústica com bordas: CD 10.\n- Parede áspera (pedra irregular, árvore): CD 15.\n- Superfície lisa com raras protuberâncias: CD 20.\n- Corda com laterais para escalar: CD 15 (0 se treinado).\n- Superfície escorregadia ou molhada: +5 na CD.\n**Velocidade**: escala a 1/4 do deslocamento normal (metade se passar por 5+); corre em movimento acelerado dobrando velocidade.\n**Movimento**: usar Escalar sem perder DES à CA se passar no teste + 5.\n**Cair**: falha por 5+ = cai; sofre 1d6 de dano por 3 m de altura.\n**Corda Segura**: bônus +2 a +10 dependendo da situação.\n**Classes de Classe**: Bárbaro, Bardo, Druida, Guerreiro, Monge, Patrulheiro, Ladino.",
            ],
            [
                'nome' => 'Esconder-se',
                'habilidade_chave' => 'DES',
                'descricao' => "Permanece fora de vista usando cobertura, sombras, ambiente natural e camuflagem. Não pode ser tentado sem cobertura, encobrimento ou distração.\n\n**Uso Principal**: teste oposto ao de Observar dos observadores. Requer cobertura ou encobrimento — corpo parcial ou total oculto pelo cenário.\n**Modificadores**:\n- Tamanho: Diminuto +12, Miúdo +8, Pequeno +4, Médio 0, Grande -4, Enorme -8, Colossal -12.\n- Movimento: velocidade metade não altera; velocidade normal -5; correndo -20; ataque -20.\n- Ambiente natural ou familiar: +5.\n**Preparação**: personagem pode se esconder ao passar por área com encobrimento como parte de movimento (não sozinho no meio).\n**Distração**: um teste de Blefar pode criar chance de esconder-se de novo por causa da distração.\n**Ação**: parte do movimento.\n**Classes de Classe**: Bardo, Monge, Patrulheiro, Ladino.",
            ],
            [
                'nome' => 'Falsificação',
                'habilidade_chave' => 'INT',
                'descricao' => "Cria documentos falsos convincentes — cartas de recomendação, ordens reais, contratos de comércio — e detecta falsificações produzidas por outros.\n\n**Uso Principal**: criar falsificação — teste oposto pelo teste de Falsificação do leitor. Modificadores baseados na disponibilidade do original:\n- Cópia idêntica na frente: 0.\n- Amostra de escrita disponível: -2.\n- Sem amostra, apenas descrição: -4.\n- Estilo desconhecido: -8.\n**Detectar Falsificação**: teste oposto ao criador; se o leitor não conhece a escrita original, penalidade -2.\n**Ação**: 1 minuto por página comum; até uma hora para trabalhos elaborados (selos, brasões).\n**Ferramentas**: exige tinta, penas e conhecimento do estilo — bônus se houver amostra.\n**Classes de Classe**: Bardo, Ladino.",
            ],
            [
                'nome' => 'Furtividade',
                'habilidade_chave' => 'DES',
                'descricao' => "Move-se em silêncio absoluto, minimizando ruídos de passos, roupas farfalhantes e equipamento. Perícia central de ladinos e infiltradores.\n\n**Uso Principal**: teste oposto ao de Ouvir dos observadores.\n**Modificadores**:\n- Velocidade metade: 0.\n- Velocidade normal: -5.\n- Correndo: -20 (impossível permanecer furtivo em corrida real).\n- Ataque durante movimento silencioso: penalidade adicional.\n- Terreno duro (madeira, pedra): 0.\n- Terreno silencioso (grama, terra fofa): +5.\n- Terreno barulhento (folhas secas, cascalho, gelo): -5.\n**Armadura**: penalidade de armadura aplica-se ao teste.\n**Movimento Baseado**: separada de Esconder-se — pode andar silencioso sem estar oculto, mas os dois combinados são comuns em infiltração.\n**Ação**: parte do movimento.\n**Classes de Classe**: Bardo, Monge, Patrulheiro, Ladino.",
            ],
            [
                'nome' => 'Identificar Magia',
                'habilidade_chave' => 'INT',
                'descricao' => "Reconhece magias sendo lançadas, identifica escritas mágicas, decifra efeitos em progresso e analisa itens mágicos. Perícia central de qualquer conjurador estudioso.\n\n**Uso Principal**: várias aplicações:\n- Identificar magia sendo conjurada: CD 15 + nível da magia, ação livre no momento da conjuração (permite Contra-magia).\n- Identificar magia ativa em objeto ou área: CD 20 + nível, ação padrão.\n- Identificar magia via inscrição mágica: CD 20 + nível.\n- Identificar item mágico via testagem: CD 25 + nível, complementar a Identificar (magia).\n**Ação**: livre no caso de contra-magia; padrão para outras.\n**Tentar Novamente**: geralmente não — falha significativa faz o mestre inventar informação errada.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Clérigo, Druida, Feiticeiro, Mago.",
            ],
            [
                'nome' => 'Intimidar',
                'habilidade_chave' => 'CAR',
                'descricao' => "Força cooperação por meio de ameaças, demonstrações de poder, gritos e postura ameaçadora. Alternativa dura à Diplomacia.\n\n**Uso Principal**: oposto ao TR de Vontade do alvo, com bônus/penalidade por diferença de tamanho, PVs relativos e circunstâncias:\n- +4 para cada tamanho maior; -4 para cada menor.\n- +4 se alvo estiver ferido gravemente; +2 se em desvantagem.\n- Mudar atitude Neutro → Amigável (temporariamente) ou Hostil → Antipático: possível.\n- **Não** pode ser usado para forçar ações claramente contrárias à natureza do alvo.\n**Efeito Durável**: sucesso melhora atitude por 1d6×10 minutos apenas. Depois disso, o alvo se torna Antipático (guarda rancor).\n**Ação**: 1 minuto de intimidação (padrão em combate).\n**Fintar em Combate**: pode ser usado como Blefar para negar bônus de DES à CA — ação padrão.\n**Classes de Classe**: Bárbaro, Guerreiro, Ladino.",
            ],
            [
                'nome' => 'Natação',
                'habilidade_chave' => 'FOR',
                'descricao' => "Nada, mergulha e movimenta-se em água — corrente calma, torrentes ou tempestades. Sem essa perícia, personagens em armadura pesada correm risco real de afogamento.\n\n**Uso Principal**: nadar em CD variável:\n- Água calma: CD 10.\n- Água agitada: CD 15.\n- Água tempestuosa: CD 20.\n**Falha por 5+**: personagem afunda e começa a se afogar em rodadas subsequentes.\n**Armadura**: armadura de qualquer tipo aplica sua penalidade ao teste; armadura pesada praticamente proíbe natação para não-treinados.\n**Sem Perícia**: personagens não treinados usam apenas o modificador de FOR, geralmente insuficiente em água agitada ou pior.\n**Velocidade**: nada a 1/4 do deslocamento base; +10 no teste dobra a velocidade.\n**Prender Respiração**: separada de Concentração — CD 10 + rodadas para submerso.\n**Ação**: parte do movimento.\n**Classes de Classe**: Bárbaro, Bardo, Druida, Guerreiro, Monge, Patrulheiro, Ladino.",
            ],
            [
                'nome' => 'Observar',
                'habilidade_chave' => 'SAB',
                'descricao' => "Detecta criaturas escondidas visualmente, nota detalhes suspeitos, percebe elementos fora do comum no ambiente. Complemento essencial da perícia Procurar.\n\n**Uso Principal**: teste oposto ao de Esconder-se; ou CD fixa dependendo da distância e condições:\n- Ver criatura pequena a 30 m: teste de Observar contra Esconder-se do alvo.\n- Distância: -1 na CD para cada 3 m além do primeiro (visão) ou 3 m (audição).\n- Ambiente: penalidade em escuridão parcial, choque total etc.\n**Uso Reativo**: geralmente rolado passivamente pelo mestre quando alvo tenta se esconder.\n**Diferença de Ouvir**: Observar é visual, Ouvir é audível; ambos podem ser usados em situações apropriadas.\n**Ação**: livre (passiva); padrão para busca ativa em área.\n**Classes de Classe**: Druida, Monge, Patrulheiro, Ladino.",
            ],
            [
                'nome' => 'Obter Informação',
                'habilidade_chave' => 'CAR',
                'descricao' => "Coleta boatos, notícias e informações locais em tavernas, mercados, docas e outros lugares públicos. Ferramenta essencial de bardos, ladinos e investigadores.\n\n**Uso Principal**: obter boatos/informação em CD variável:\n- Boatos comuns (fofocas, notícias públicas): CD 10.\n- Informação incomum (paradeiro de figura específica, boato específico): CD 15-20.\n- Informação rara ou secreta (localização de crime, plano criminoso, boato conspiratório): CD 25-30.\n**Custo**: 1d10 PO em gorjetas para bebidas e favores; passar por 5+ na CD reduz custo, falha aumenta.\n**Ação**: 1d4 horas de mistura em ambientes públicos.\n**Falha**: pode gerar boato falso; falha por 5+ chama atenção de forças hostis (mestre decide).\n**Classes de Classe**: Bardo, Ladino.",
            ],
            [
                'nome' => 'Ofícios',
                'habilidade_chave' => 'INT',
                'descricao' => "Produz e trabalha com artes manuais e profissionais artesanais — ferraria, alquimia, carpintaria, tecelagem, joalheria, cerâmica etc.\n\n**Categorias**: você escolhe uma categoria por rank (armas, armaduras, alquimia, tecelagem, carpintaria, ferraria, joalheria, cerâmica, sapataria etc.), como Ofícios (armas), Ofícios (alquimia).\n**Uso Principal**: produzir item — quanto tempo × CD determina custo e valor final. Fórmula simplificada: (verificação × CD × semana) = valor produzido em prata (SP). CDs por item:\n- Item simples: CD 5-10.\n- Item de qualidade média: CD 15.\n- Item de qualidade excelente: CD 20.\n- Obra-prima: CD 25.\n**Renda**: Ofícios pode gerar renda entre aventuras (metade do teste × dias em SP).\n**Materiais**: exige matéria-prima no valor de 1/3 do valor final; falha na produção destrói metade dos materiais.\n**Ação**: dias ou semanas.\n**Classes de Classe**: qualquer.",
            ],
            [
                'nome' => 'Operar Mecanismo',
                'habilidade_chave' => 'INT',
                'descricao' => "Desarma armadilhas mecânicas, sabota dispositivos complexos, abre cofres cifrados e desativa mecanismos perigosos. Perícia essencial de ladinos.\n\n**Uso Principal**: desarmar armadilha ou dispositivo — CD = CD específica da armadilha, geralmente 20-30 para armadilhas mecânicas normais.\n**Armadilha Mágica**: apenas ladinos com pelo menos 5 ranks podem desarmar armadilhas mágicas de CD 21+.\n**Ação**: 2d4 rodadas para armadilha simples; mais tempo para armadilhas complexas ou cofres.\n**Falha por 5+**: dispara a armadilha (dando tempo para não ser afetado se rolou bem).\n**Sabotagem**: pode ser usada para deixar armadilha em condição pronta para disparar quando outro passar (CD 25-30 conforme complexidade).\n**Treinamento**: obrigatório.\n**Classes de Classe**: Ladino.",
            ],
            [
                'nome' => 'Ouvir',
                'habilidade_chave' => 'SAB',
                'descricao' => "Detecta sons baixos, conversas sussurradas, movimentos ocultos e ameaças invisíveis. Complemento crucial de Observar em ambientes escuros ou boscosos.\n\n**Uso Principal**: teste oposto ao de Furtividade; ou CD fixa para sons específicos:\n- Batalha barulhenta a média distância: CD 0.\n- Pessoas conversando normalmente: CD 5.\n- Cachorro andando: CD 10.\n- Sussurro em silêncio: CD 15.\n- Guarda em movimento cauteloso: CD 20.\n- Gato caminhando: CD 25.\n- Coruja voando: CD 30.\n**Distância**: -1 na CD para cada 3 m além do primeiro; barreiras adicionam mais.\n**Uso Reativo**: geralmente rolado pelo mestre quando alvo tenta se mover em silêncio.\n**Ação**: livre (passiva); ação de movimento para ouvir ativamente à porta.\n**Classes de Classe**: Bárbaro, Bardo, Druida, Monge, Patrulheiro, Ladino.",
            ],
            [
                'nome' => 'Prestidigitação',
                'habilidade_chave' => 'DES',
                'descricao' => "Realiza truques de mão, bate carteiras, oculta objetos pequenos e faz movimentos furtivos das mãos. Diferente do truque mágico Prestidigitação (uma magia distinta).\n\n**Uso Principal**: várias aplicações:\n- Palma objeto pequeno na mão: CD 10, oposto por Observar.\n- Bater uma carteira: CD 20, oposto por Observar (falha por 5+ = pego em flagrante).\n- Substituir um objeto por outro sem ser notado: CD 10.\n- Colocar objeto em bolso de outro (contra-roubar): CD 20, oposto por Observar do alvo.\n- Fazer moeda desaparecer entre os dedos: CD 10 para performance.\n**Ação**: livre para palmar; padrão para roubar bolso.\n**Falha por 5+**: alvo percebe a tentativa imediatamente.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Ladino.",
            ],
            [
                'nome' => 'Procurar',
                'habilidade_chave' => 'INT',
                'descricao' => "Encontra objetos ocultos, portas secretas, compartimentos falsos, gavetas escondidas e pistas por busca sistemática de um quadrado de 1,5 m.\n\n**Uso Principal**: buscar em quadrado específico — CD 10 (objeto óbvio), CD 20 (bem oculto), CD 30 (excelente esconderijo).\n**Portas Secretas**: CD 20 para descoberta ativa (elfos podem detectar automaticamente ao passar por 1,5 m).\n**Armadilhas Comuns**: CD específica da armadilha (10-30). Apenas Ladinos com 5+ ranks podem detectar armadilhas mágicas de CD 21+.\n**Diferença de Observar**: Procurar exige busca ativa (uma ação de rodada completa por quadrado de 1,5 m); Observar é reativo/passivo. Um treinado tem grande vantagem sobre um observador casual.\n**Ação**: 1 rodada completa por quadrado de 1,5 m.\n**Classes de Classe**: Patrulheiro, Ladino.",
            ],
            [
                'nome' => 'Profissão',
                'habilidade_chave' => 'SAB',
                'descricao' => "Exerce uma profissão não-artesanal — marinheiro, fazendeiro, soldado, cozinheiro, curandeiro, cavador, guia — cada uma sendo uma perícia separada.\n\n**Categorias**: escolha uma profissão específica por rank, como Profissão (marinheiro), Profissão (guia), Profissão (cozinheiro).\n**Uso Principal**: exercer a profissão. Renda semanal = 1/2 resultado do teste em PO (ex: teste 20 = 10 PO/semana).\n**Uso em Aventura**: aplicar conhecimento profissional — marinheiro navega em tempestade, guia rastreia caminho, cozinheiro prepara refeição especial.\n**Ação**: dias ou semanas para renda; minutos para uso pontual em aventura.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Clérigo, Druida, Guerreiro, Paladino, Patrulheiro, Mago.",
            ],
            [
                'nome' => 'Saltar',
                'habilidade_chave' => 'FOR',
                'descricao' => "Realiza saltos em distância e altura para atravessar obstáculos, alcançar prateleiras altas ou ganhar posição elevada em combate.\n\n**Uso Principal**: distância ou altura:\n- Salto em distância com corrida (mínimo 6 m): 1 m por 5 pontos do teste (ex: teste 15 = 3 m).\n- Salto em distância sem corrida: metade da distância normal.\n- Salto em altura (com corrida): 30 cm por 4 pontos do teste (ex: teste 16 = 1,2 m).\n**Sinergia**: 5+ ranks em Acrobacia dão +2 em Saltar.\n**Movimento**: parte do movimento durante o turno.\n**Deslocamento Reduzido**: personagens com deslocamento reduzido (armadura pesada, tamanho pequeno) recebem penalidade de -6 em Saltar por cada 1,5 m de deslocamento perdido.\n**Ação**: parte do movimento.\n**Classes de Classe**: Bárbaro, Bardo, Druida, Guerreiro, Monge, Patrulheiro, Ladino.",
            ],
            [
                'nome' => 'Sentir Motivação',
                'habilidade_chave' => 'SAB',
                'descricao' => "Detecta mentiras, percebe emoções ocultas, identifica comportamento suspeito e reconhece manipulação. Oposto natural de Blefar.\n\n**Uso Principal**: várias aplicações:\n- Detectar mentira: oposto ao teste de Blefar do mentiroso.\n- Ter palpite: CD 20 — a magia lhe diz se algo está errado em uma situação (informação vaga).\n- Detectar encantamento: CD 25 — perceber que alvo está sob controle mental externo.\n- Reconhecer disfarce: use como oposto ao teste de Disfarce.\n**Ação**: 1 minuto de conversa/observação; menos em combate ou situação urgente.\n**Modificadores**: contexto familiar dá +2; barreiras de comunicação (idioma, cultura) dão -5.\n**Classes de Classe**: Bardo, Clérigo, Monge, Paladino, Ladino.",
            ],
            [
                'nome' => 'Sobrevivência',
                'habilidade_chave' => 'SAB',
                'descricao' => "Encontra abrigo, água e comida em ambientes selvagens; rastreia criaturas; navega sem instrumentos; sobrevive em climas hostis.\n\n**Uso Principal**: várias aplicações:\n- Encontrar comida e água: CD 10 (área comum), CD 15 (deserto/pântano).\n- Não se perder em terreno: CD 15.\n- Prever clima: CD 15.\n- Evitar perigos naturais (avalanche, tempestade): CD 15.\n- Rastrear: CD baseada no terreno e criatura (CD 10-25 comum), avança conforme rastro (rastreamento é teoricamente possível sem essa perícia mas apenas com sucesso limitado).\n**Rastreamento**: só faz efetivamente com o talento Rastreamento — sem ele, exige teste com CD +5 e só rastros muito visíveis. Patrulheiros têm Rastreamento gratuito no 1° nível.\n**Ação**: 1 hora para achar comida/água; contínuo para rastrear.\n**Classes de Classe**: Bárbaro, Druida, Patrulheiro.",
            ],
            [
                'nome' => 'Usar Cordas',
                'habilidade_chave' => 'DES',
                'descricao' => "Amarra nós, prende prisioneiros, prepara cordas para escalada e usa laços com segurança em manobras arriscadas.\n\n**Uso Principal**: várias aplicações:\n- Amarrar prisioneiro (para escapar exige teste oposto de Arte da Fuga): CD 10, +10 na CD para escapar.\n- Amarrar carga: CD 15 (para ficar segura em movimento).\n- Dar um nó especial (laço, escorregadio, camuflado): CD 10-15.\n- Preparar corda para escalada (segurar aliado que cai): CD 15.\n- Usar corda como laço no ar: CD 20.\n**Sinergia**: 5+ ranks em Usar Cordas dão +2 em Escalar (quando escalando corda) e +2 em Arte da Fuga (para escapar de amarras próprias, curiosamente).\n**Ação**: 1 rodada por nó comum.\n**Classes de Classe**: Bardo, Patrulheiro, Ladino.",
            ],
            [
                'nome' => 'Usar Instrumento Mágico',
                'habilidade_chave' => 'CAR',
                'descricao' => "Ativa varinhas, pergaminhos, cajados e outros itens mágicos que normalmente exigem uma classe de conjurador específica. Ferramenta indispensável de ladinos e bardos que querem magia sem estudar.\n\n**Uso Principal**: emular requisito de classe/alinhamento/raça para usar item:\n- Emular classe: CD 20 (você conta como conjurador daquela classe naquela rodada).\n- Emular alinhamento: CD 30 (você é temporariamente considerado do alinhamento requerido).\n- Emular raça: CD 25.\n- Emular atributo (para atender requisito mínimo): CD 15 + valor exigido - seu valor atual.\n**Falha por 10+**: você não pode tentar usar aquele item de novo por 24 horas.\n**Ação**: padrão para tentar.\n**Uso Comum**: bardos e ladinos escaneiam pergaminhos que só magos poderiam usar; feiticeiros usam itens de clérigo etc.\n**Treinamento**: obrigatório.\n**Classes de Classe**: Bardo, Ladino.",
            ],
        ];

        foreach ($pericias as $pericia) {
            Pericia::updateOrCreate(
                ['nome' => $pericia['nome'], 'versao' => '3.5'],
                array_merge($pericia, ['versao' => '3.5'])
            );
        }
    }
}
