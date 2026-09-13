<?php

namespace Database\Seeders;

use App\Models\Divindade;
use Illuminate\Database\Seeder;

class DivindadeSeeder extends Seeder
{
    public function run(): void
    {
        $divindades = [
            // --- Panteão de Greyhawk (PHB 3.5) ---
            [
                'nome'          => 'Boccob',
                'titulo'        => 'O Sem par, Senhor de Toda Magia',
                'tendencia'     => 'Neutro',
                'dominios'      => 'Conhecimento, Magia, Proteção',
                'arma_preferida'=> 'Cajado',
                'descricao'     => "Boccob é o deus mais antigo e reservado do panteão de Greyhawk — a personificação impessoal da magia arcana em si, indiferente às disputas morais dos mortais.\n\n**Símbolo**: um olho dentro de uma estrela de cinco pontas, gravado em pergaminho ou entalhado em pedra.\n**Manifestação**: aparece raramente, sempre como um velho sábio de barba branca em vestes bordadas com runas ancestrais, portando um cajado que pulsa com energia arcana. Nunca revela emoção, apenas curiosidade fria.\n**Dogma**: preservar e expandir o conhecimento mágico. Estudar cada magia, cada tomo, cada tradição. A magia é a força cósmica fundamental — mais importante que bem, mal, lei ou caos. Os magos devem se dedicar ao estudo antes de tudo.\n**Clero**: exclusivamente magos e sábios. Vestem robes negros ou índigo com adornos de estrelas prateadas. Vivem em torres reclusas ou bibliotecas antigas. Muitos servem como consultores de reinos em troca de acesso a tomos raros.\n**Rituais**: memorização diária ritualística de magias, catalogação de novos feitiços descobertos, festivais nos equinócios celebrando o equilíbrio arcano.\n**Fiéis Típicos**: magos, sábios, colecionadores de tomos, arqueomagos aposentados que se dedicam à pesquisa.\n**Relações no Panteão**: neutro em relação a quase todos, embora tenha rivalidade fria com Vecna (que corrompe conhecimento) e mantenha relação distante com Wee Jas (magia + morte, foco mais estreito).",
            ],
            [
                'nome'          => 'Corellon Larethian',
                'titulo'        => 'Criador dos Elfos, Senhor das Artes',
                'tendencia'     => 'Caótico e Bom',
                'dominios'      => 'Bem, Caos, Magia, Proteção, Guerra',
                'arma_preferida'=> 'Espada Longa',
                'descricao'     => "Corellon Larethian é o pai dos elfos, o criador supremo da raça, mestre das artes, da magia élfica e da bravura contra as forças da destruição — especialmente Gruumsh (que arrancou seu olho em duelo primordial) e Lolth (que caiu do panteão élfico).\n\n**Símbolo**: uma estrela de oito pontas prateada ou o crescente da lua em fundo estrelado.\n**Manifestação**: aparece como um elfo alto de beleza sobrenatural, cabelos prateados esvoaçantes, olhos que refletem estrelas. Empunha a Sahandrian, espada longa élfica encantada com magias antigas.\n**Dogma**: proteger e cultivar a raça élfica; refinar as artes — música, pintura, poesia, magia — como a expressão mais alta da consciência; combater as forças da destruição, especialmente orcs e drow.\n**Clero**: elfos de todos os tipos, alguns meio-elfos. Vestem robes brancos e prateados, portam espadas longas cerimonial. Vivem em templos-jardins nos bosques élficos.\n**Rituais**: cerimônias sazonais celebrando a natureza, festivais de arte e magia, duelos ritualísticos entre paladinos élficos.\n**Fiéis Típicos**: elfos em geral (especialmente elfos altos), bardos, arqueiros e magos élficos, meio-elfos que abraçam a herança élfica.\n**Relações no Panteão**: aliado dos deuses do bem; inimigo mortal de Gruumsh (orcs) e Lolth (drow); relação de respeito com Boccob e Pelor.",
            ],
            [
                'nome'          => 'Ehlonna',
                'titulo'        => 'Senhora das Florestas',
                'tendencia'     => 'Neutro e Bom',
                'dominios'      => 'Animais, Bem, Plantas, Sol',
                'arma_preferida'=> 'Lança Longa',
                'descricao'     => "Ehlonna é a deusa protetora das florestas verdejantes, das pastagens e de todos os animais e plantas benignos. Representa a face amigável e nutritiva da natureza, em contraste com o Obad-Hai (natureza selvagem e imparcial).\n\n**Símbolo**: um unicórnio empinado ou uma flecha atravessando uma folha de carvalho.\n**Manifestação**: aparece como uma jovem elfa ou humana de vestido verde-folhagem, cabelos castanhos entrelaçados com flores silvestres, montando um unicórnio ou acompanhada de cervos e coelhos.\n**Dogma**: proteger as florestas e todos os seres vivos que nela habitam; combater os que destroem a natureza gratuitamente; nutrir e curar, mas não hesitar em usar o arco contra invasores. Caçadores respeitosos são bem-vindos; poluidores devem ser punidos.\n**Clero**: majoritariamente druidas, patrulheiros e alguns clérigos. Vestem couro claro ou vestes verdes, adornam-se com folhas e conchas. Habitam bosques sagrados, jamais construções permanentes de pedra.\n**Rituais**: cerimônias da lua cheia em clareiras sagradas, plantios sazonais, libertação ritual de animais caçados injustamente.\n**Fiéis Típicos**: elfos silvestres, meio-elfos, humanos rurais, gnomos florestais, druidas, patrulheiros, caçadores éticos.\n**Relações no Panteão**: amiga de Corellon e Pelor; rivalidade filosófica com Obad-Hai (mais neutro/selvagem); inimiga dos deuses da destruição.",
            ],
            [
                'nome'          => 'Erythnul',
                'titulo'        => 'O Muitos Rostos, Senhor do Massacre',
                'tendencia'     => 'Caótico e Mau',
                'dominios'      => 'Caos, Mal, Trapaça, Guerra',
                'arma_preferida'=> 'Mangual Pesado',
                'descricao'     => "Erythnul é o deus da rage, do pânico, da inveja e do massacre gratuito. Enquanto Hextor busca dominar por meio da guerra organizada, Erythnul apenas quer ver sangue derramado — quanto mais horripilante, melhor. Ele exulta em atrocidades sem propósito.\n\n**Símbolo**: uma máscara sangrenta de horror; ou uma cabeça humana ensanguentada erguida.\n**Manifestação**: aparece de formas incoerentes e horríveis — ora humano grotesco de vários rostos, ora bestafera, ora bicho de pesadelo. Nunca mantém a mesma forma por muito tempo.\n**Dogma**: massacrar é sagrado; a guerra é festa; toda paz é fraqueza que merece ser destruída. Espalhar terror, ódio e caos entre povos organizados. Não há propósito além do próprio massacre.\n**Clero**: bárbaros, ogros, gnolls, orcs marginais, humanos degenerados. Vestem couro manchado de sangue e adornam-se com trofeus dos massacrados. Vivem em bandos itinerantes, saqueando aldeias.\n**Rituais**: sacrifícios humanos improvisados, batalhas ritualísticas onde inimigos são mortos brutalmente, orgias de destruição em festivais lunares.\n**Fiéis Típicos**: bárbaros violentos, humanoides sanguinários, gangues e cultos marginais.\n**Relações no Panteão**: inimigo de todos os deuses do bem, especialmente Heironeous e Pelor; aliado circumstancial de Hextor e Gruumsh, embora tenda a atrapalhar por indisciplina.",
            ],
            [
                'nome'          => 'Fharlanghn',
                'titulo'        => 'O Distante, Horizonte do Viajante',
                'tendencia'     => 'Neutro',
                'dominios'      => 'Sorte, Proteção, Viagem',
                'arma_preferida'=> 'Bordão',
                'descricao'     => "Fharlanghn é o deus das estradas abertas, dos caminhos serpentina e do horizonte perpétuo. Um dos deuses mais próximos dos mortais — não fica em templos, mas caminha entre os viajantes, protegendo os que percorrem longas distâncias.\n\n**Símbolo**: um disco marrom mostrando um horizonte curvo com o sol nascente/poente.\n**Manifestação**: aparece como um velho viajante de barba grisalha, bordão de pau, sandálias gastas, roupas do estradeiro comum. Fala pouco, dá conselhos sábios, some ao virar a esquina.\n**Dogma**: continuar em movimento é o caminho da vida; a estrada é sagrada; ajudar viajantes cansados e proteger mercadores/mensageiros. A jornada importa mais que o destino.\n**Clero**: viajantes profissionais — batedores, mensageiros, mercadores, guias de caravana. Vestem roupas comuns de estradeiro, portam bordão simples. Não vivem em templos fixos; peregrinam constantemente.\n**Rituais**: benções antes de longas viagens, cerimônias em cruzamentos de estradas, colocação de marcos protetores.\n**Fiéis Típicos**: batedores, patrulheiros, mensageiros, mercadores viajantes, aventureiros de estrada, ladinos itinerantes.\n**Relações no Panteão**: amigo de Olidammara (viagem e liberdade); respeita todos os deuses igualmente por sua neutralidade; irmão espiritual de Ehlonna (natureza) e Pelor (sol que orienta viajantes).",
            ],
            [
                'nome'          => 'Garl Glittergold',
                'titulo'        => 'O Protetor Brilhante, Rei dos Gnomos',
                'tendencia'     => 'Neutro e Bom',
                'dominios'      => 'Bem, Proteção, Trapaça',
                'arma_preferida'=> 'Machadinha de Batalha',
                'descricao'     => "Garl Glittergold é o deus supremo dos gnomos — patrono da joalheria, ilusão, humor e proteção do povo pequeno. Combina proteção séria com trapaças alegres, pois entende que a alegria é uma forma de resistência contra os poderosos.\n\n**Símbolo**: uma pepita de ouro dourada em fundo de gemas coloridas.\n**Manifestação**: aparece como um gnomo pequeno e brilhante, sorriso maroto, olhos que faíscam com humor, empunhando uma machadinha de batalha e uma pedra preciosa mágica.\n**Dogma**: proteger os gnomos e seus aliados; alegrar a vida com trapaças criativas contra os poderosos ou arrogantes; preservar o conhecimento das joias, alquimia e magia gnômica; usar humor e magia como defesa.\n**Clero**: gnomos, alguns halflings, ocasionalmente bardos humanos. Vestem cores vivas e brincam com pedras coloridas e adornos brilhantes. Vivem em vilas gnomicas subterrâneas ou colinas.\n**Rituais**: piadas ritualísticas em festivais, trocas de presentes escondidos, cerimônias de joalheria onde novos aprendizes ganham sua primeira pedra.\n**Fiéis Típicos**: gnomos em geral (essencialmente todos), alguns halflings, bardos e ilusionistas.\n**Relações no Panteão**: aliado de Moradin, Yondalla, Ehlonna e Corellon; inimigo de Kurtulmak (deus dos kobolds, arqui-inimigo dos gnomos); rival divertido de Olidammara em trapaças.",
            ],
            [
                'nome'          => 'Gruumsh',
                'titulo'        => 'O que Não Pisca, Senhor dos Orcs',
                'tendencia'     => 'Caótico e Mau',
                'dominios'      => 'Caos, Força, Mal, Guerra',
                'arma_preferida'=> 'Lança',
                'descricao'     => "Gruumsh é o deus supremo dos orcs — brutal, feroz, obcecado pela destruição dos elfos desde que Corellon Larethian arrancou-lhe o olho esquerdo em um duelo divino no início dos tempos. Um-Olhado, Um-Vingador, Um-Devastador.\n\n**Símbolo**: um olho vermelho sem pálpebra.\n**Manifestação**: um enorme orc de pele verde-escura, um único olho ardente, cicatriz no lugar do olho perdido, empunhando lança maciça e escudo cravado.\n**Dogma**: conquistar o mundo pela força; destruir os elfos primeiro, os anões em seguida, então os humanos que se opõem; sobreviva pela força bruta, mate os fracos, tome território pelo direito da lâmina.\n**Clero**: orcs xamãs, meio-orcs violentos, seguidores humanos degenerados. Vestem peles de animais, adornam-se com dentes e ossos. Vivem em tribos guerreiras.\n**Rituais**: sacrifícios de prisioneiros élficos, cerimônias de coming-of-age onde jovens orcs devem matar um elfo ou anão, celebrações após batalhas vitoriosas.\n**Fiéis Típicos**: orcs em geral, meio-orcs bárbaros, humanos xamânicos, ogros aliados.\n**Relações no Panteão**: arqui-inimigo eterno de Corellon; hostil a Moradin (anões), Pelor, Heironeous; aliado de Erythnul e Hextor em campanhas de destruição.",
            ],
            [
                'nome'          => 'Heironeous',
                'titulo'        => 'O Invencível',
                'tendencia'     => 'Leal e Bom',
                'dominios'      => 'Bem, Glória, Guerra, Lei',
                'arma_preferida'=> 'Espada Longa',
                'descricao'     => "Heironeous é o deus da justiça marcial, cavalaria, bravura e honra. Patrono dos paladinos e cavaleiros nobres do bem. Rival eterno de seu meio-irmão Hextor — os dois representam faces opostas da guerra: a nobre e a tirânica.\n\n**Símbolo**: um raio prateado.\n**Manifestação**: um cavaleiro alto vestido em armadura completa de aço polido, elmo empenado, capa azul-cobalto ondulante, empunhando espada longa que reluz com fogo sagrado.\n**Dogma**: proteger os inocentes, punir os malignos, combater a tirania com honra; a guerra deve ser feita com regras — nunca contra não-combatentes, nunca com traição; a bravura é a maior virtude, superior mesmo à sabedoria.\n**Clero**: paladinos, cavaleiros ordenados, guerreiros nobres, alguns clérigos. Vestem armaduras cerimoniais azul e prata, portam espadas longas benzidas. Vivem em fortalezas-igrejas com códigos rígidos.\n**Rituais**: torneios ritualísticos, cerimônias de armar cavaleiro, benção de armas antes de guerras justas, orações antes do combate.\n**Fiéis Típicos**: paladinos (a maioria), cavaleiros nobres, guerreiros leais e bons, algum clérigo militante.\n**Relações no Panteão**: aliado próximo de Pelor, Moradin, Corellon e São Cuthbert; inimigo mortal de Hextor (rivalidade fraterna), Erythnul e Gruumsh.",
            ],
            [
                'nome'          => 'Hextor',
                'titulo'        => 'Arauto da Guerra, Campeão do Mal',
                'tendencia'     => 'Leal e Mau',
                'dominios'      => 'Destruição, Guerra, Lei, Mal',
                'arma_preferida'=> 'Mangual Pesado',
                'descricao'     => "Hextor é o deus da guerra tirânica, da conquista brutal e da dominação implacável. Meio-irmão e rival eterno de Heironeous. Enquanto Heironeous defende a guerra justa, Hextor promove a guerra como instrumento de opressão organizada.\n\n**Símbolo**: um punho gauntleteado segurando seis flechas voltadas para baixo.\n**Manifestação**: um guerreiro grande de armadura negra tachonada, seis braços empunhando armas diferentes (mangual, machado, espada, lança, escudo, adaga), olhos vermelhos ardendo em ódio pelo irmão.\n**Dogma**: conquistar através de disciplina brutal; a ordem só existe pela imposição de força; os fracos existem para servir os fortes; a paz é ilusão de covardes — só o poder importa.\n**Clero**: clérigos militaristas, cavaleiros negros, comandantes tirânicos. Vestem armaduras negras adornadas de picos e espinhos. Vivem em fortalezas militares.\n**Rituais**: cerimônias de subjugação, sacrifícios de prisioneiros considerados desonrosos, celebrações de vitórias impiedosas.\n**Fiéis Típicos**: guerreiros tirânicos, cavaleiros negros, comandantes de exércitos malignos, magos militaristas.\n**Relações no Panteão**: rival eterno de Heironeous (fraternidade destruída); aliado circumstancial de Erythnul e Gruumsh em ofensivas contra reinos bons; inimigo de todos os deuses de bem.",
            ],
            [
                'nome'          => 'Kord',
                'titulo'        => 'O Senhor da Força',
                'tendencia'     => 'Caótico e Bom',
                'dominios'      => 'Bem, Caos, Força, Sorte',
                'arma_preferida'=> 'Espada Grande',
                'descricao'     => "Kord é o deus da força física, atletismo, esportes competitivos e coragem viril. Um dos deuses mais amistosos do panteão — bebe com seguidores, ri alto, incentiva a testar os limites. Patrono dos que preferem punhos a políticas.\n\n**Símbolo**: uma espada de duas mãos apontada para cima, cruzada por relâmpago.\n**Manifestação**: um humano gigante de músculos abundantes, cabelos ruivos ou dourados, sorriso feroz e alegre, empunhando espada grande que canta ao vento. Ri em batalha, chora quando amigos morrem, ama a vida.\n**Dogma**: teste seus limites físicos constantemente; a batalha honrosa é a mais alta expressão de vida; ajude os fracos que tentam se tornar fortes; combata a tirania — mas com força bruta, não estratégia.\n**Clero**: guerreiros musculosos, bárbaros do bem, monges atléticos, alguns bardos. Vestem couros e armaduras leves para não impedir movimento. Vivem em ginásios-igreja onde treinam constantemente.\n**Rituais**: torneios de força e resistência, competições de wrestling, provas atléticas em festivais lunares.\n**Fiéis Típicos**: bárbaros bons, guerreiros atléticos, monges, atletas, camponeses fortes.\n**Relações no Panteão**: aliado alegre de Heironeous (respeita a bravura); amizade descontraída com Olidammara; contra Hextor, Gruumsh e Erythnul (tiranos e degenerados).",
            ],
            [
                'nome'          => 'Moradin',
                'titulo'        => 'O Forjador de Almas, Pai dos Anões',
                'tendencia'     => 'Leal e Bom',
                'dominios'      => 'Bem, Lei, Proteção, Terra',
                'arma_preferida'=> 'Martelo de Guerra',
                'descricao'     => "Moradin é o deus supremo dos anões — criador da raça, patrono da forja, da família e da tradição. Segundo os mitos anões, ele forjou os primeiros anões a partir de mithril e pedra viva, imbuindo-os com resistência e ambição industriosa.\n\n**Símbolo**: um martelo com uma bigorna cruzada.\n**Manifestação**: um anão gigante de barba dourada trançada, avental de forjeiro, martelo enorme na mão. Trabalhando permanentemente na Grande Forja das Almas — cada nova alma anã sai dela.\n**Dogma**: honrar os ancestrais e o clã acima de tudo; preservar as tradições anãs; construir com pedra e metal, obras que durem eras; combater os orcs, gigantes e drow — inimigos ancestrais.\n**Clero**: exclusivamente anões (raríssimos não-anões). Vestem aventais forjados adornados de martelos, armaduras cerimoniais de mithril, barbas trançadas com adornos rúnicos. Vivem em templos-forja no coração das cidadelas.\n**Rituais**: forjas cerimoniais onde armas sagradas são criadas, celebrações de casamento em altares de pedra, ritos funerários onde armas do falecido são forjadas em novos artefatos.\n**Fiéis Típicos**: anões em geral, joalheiros, ferreiros, engenheiros anões, gigantes benevolentes ocasionalmente.\n**Relações no Panteão**: aliado próximo de Yondalla, Garl Glittergold, Heironeous; inimigo mortal de Gruumsh (orcs invadem cidadelas anãs há eras).",
            ],
            [
                'nome'          => 'Nerull',
                'titulo'        => 'O Ceifador, Senhor dos Mortos',
                'tendencia'     => 'Neutro e Mau',
                'dominios'      => 'Mal, Morte, Trevas',
                'arma_preferida'=> 'Foice',
                'descricao'     => "Nerull é o deus da morte violenta, das trevas e do assassinato deliberado. O mais odiado do panteão — não a morte natural que Wee Jas administra, mas a morte cruel, prematura, terrível. Nerull abomina a vida e busca encher seus reinos com almas colhidas.\n\n**Símbolo**: um crânio humano seguindo uma foice, ou apenas uma foice contra a lua vermelha.\n**Manifestação**: uma figura esquelética alta, envolta em manto negro que engolfa a luz, foice enorme mais alta que ele, apenas dois pontos vermelhos nos poços dos olhos.\n**Dogma**: matar os vivos, especialmente os poderosos ou virtuosos; espalhar terror e desespero antes da morte; assassinar cirurgicamente; culto dos mortos-vivos como estado superior à vida.\n**Clero**: assassinos, necromantes malignos, cultistas dos mortos-vivos. Vestem robes negros com bordado em prata sinistra, capuzes que cobrem o rosto. Vivem em criptas secretas, jamais expostos.\n**Rituais**: assassinatos ritualísticos, criação de mortos-vivos em cerimônias sombrias, cerimônias no equinócio de outono onde a fronteira entre mundos afina.\n**Fiéis Típicos**: assassinos malignos, necromantes obsessivos, cultistas dos mortos-vivos, líderes de sociedades secretas.\n**Relações no Panteão**: inimigo de todos os deuses do bem, especialmente Pelor (patrono da vida) e Heironeous; rival profissional de Wee Jas (que administra morte natural, ordeira).",
            ],
            [
                'nome'          => 'Obad-Hai',
                'titulo'        => 'O Senhor da Selva, Mestre das Eras',
                'tendencia'     => 'Neutro',
                'dominios'      => 'Ar, Animais, Terra, Fogo, Plantas, Água',
                'arma_preferida'=> 'Bordão',
                'descricao'     => "Obad-Hai é o deus da natureza selvagem em sua forma verdadeira — não a versão gentil de Ehlonna, mas a natureza fria, impessoal, cruel quando necessária. Ele acredita no equilíbrio absoluto: predadores e presas, chuva e seca, vida e morte, todos com igual valor.\n\n**Símbolo**: um carvalho e uma folha de acer, ou uma folha caída marcada pelo tempo.\n**Manifestação**: um velho hermético de longa barba grisalha, roupas de pele natural gasta, bordão de madeira nodosa, olhos que já viram eras passarem. Pode aparecer também como uma criatura selvagem qualquer — urso, lobo, veado.\n**Dogma**: preservar o equilíbrio da natureza absolutamente; nenhuma espécie deve dominar excessivamente; a civilização é uma ameaça a esse equilíbrio; caçadores e presas ambos servem à Grande Roda; nada deve morrer prematuramente, nada deve viver após seu tempo.\n**Clero**: druidas dedicados ao equilíbrio total. Vestem roupas de peles naturais, portam bordão de madeira. Não vivem em construções — apenas em cavernas naturais ou clareiras.\n**Rituais**: cerimônias sazonais respeitando ciclos, ritos de morte-e-renascimento nas estações intermediárias, caça ritual onde a presa é honrada.\n**Fiéis Típicos**: druidas hermeticos, patrulheiros solitários, humanoides selvagens que respeitam o ciclo.\n**Relações no Panteão**: rival filosófico de Ehlonna (que ele considera muito gentil demais); mantém neutralidade cuidadosa com Corellon e outros deuses da natureza.",
            ],
            [
                'nome'          => 'Olidammara',
                'titulo'        => 'O Alegre',
                'tendencia'     => 'Caótico e Neutro',
                'dominios'      => 'Caos, Sorte, Viagem, Trapaça',
                'arma_preferida'=> 'Rapieira',
                'descricao'     => "Olidammara é o deus da música, das festas, dos vinhos, das trapaças alegres e dos ladrões amistosos. O deus mais amado nas tabernas e o mais odiado pelos guardas. Um trapaceiro cósmico que ri de tudo, incluindo os outros deuses.\n\n**Símbolo**: uma máscara sorridente pendurada de fitas coloridas.\n**Manifestação**: um homem esbelto de meia-idade com traços jovens, roupas exageradas de bard, chapéu com pena, sorriso de canto, rapieira leve na cintura. Sempre parece prestes a fazer uma piada ou roubar um objeto.\n**Dogma**: viver plenamente e alegremente; roubar dos poderosos e dividir com os pobres (ou consigo mesmo); trapaças criativas contra os arrogantes; a vida é uma festa, o mundo é o palco.\n**Clero**: bardos, ladinos, boêmios, artistas itinerantes. Vestem roupas coloridas, portam instrumentos musicais e rapieiras. Não têm templos formais — reúnem-se em tabernas, teatros e festas ao ar livre.\n**Rituais**: festas prolongadas com bebida e música, jogos de azar cerimoniais, competições de trapaça criativa.\n**Fiéis Típicos**: bardos, ladinos alegres, artistas de rua, boêmios, aventureiros descontraídos.\n**Relações no Panteão**: amigo de Fharlanghn (viagens e liberdade); rival divertido de Garl Glittergold em trapaças; frequentemente irrita os deuses lolails; Kord considera-o simpático mas irresponsável.",
            ],
            [
                'nome'          => 'Pelor',
                'titulo'        => 'O Senhor do Sol',
                'tendencia'     => 'Neutro e Bom',
                'dominios'      => 'Bem, Cura, Sol, Força',
                'arma_preferida'=> 'Maça Pesada',
                'descricao'     => "Pelor é o deus do sol, da luz, da bondade, da cura e da força honesta. Um dos deuses mais adorados no panteão — o \"Pai Sol\", generoso e protetor. Combate ferozmente mortos-vivos e as trevas.\n\n**Símbolo**: um sol dourado com um rosto humano gentil sorrindo.\n**Manifestação**: um homem grande de meia-idade, cabelos e barba dourados como o sol, vestes brancas com bordado dourado, maça pesada nas mãos. Emana luz e calor confortante.\n**Dogma**: espalhar bondade e proteção; curar os enfermos e feridos; combater trevas em todas as formas — literalmente (sol) e metaforicamente (mal); ajudar os fracos e humildes; nutrir a vida.\n**Clero**: clérigos majoritariamente humanos, alguns meio-elfos e halflings. Vestem robes brancos e dourados com sol bordado. Vivem em templos abertos ao céu, com clarabóias.\n**Rituais**: cerimônias diárias ao amanhecer, festivais do solstício de verão, curas ritualísticas coletivas em templos.\n**Fiéis Típicos**: humanos comuns, camponeses, curadores, paladinos, clérigos de cura, aqueles que veneram vida.\n**Relações no Panteão**: aliado próximo de Heironeous, Moradin, Yondalla, Corellon; inimigo absoluto de Nerull, Vecna, Erythnul, todos os deuses malignos e patronos de mortos-vivos.",
            ],
            [
                'nome'          => 'São Cuthbert',
                'titulo'        => 'De Estrela Bilhante, Senhor da Retribuição',
                'tendencia'     => 'Leal e Neutro',
                'dominios'      => 'Destruição, Lei, Proteção, Força',
                'arma_preferida'=> 'Maça de Guerra',
                'descricao'     => "São Cuthbert é o deus da retribuição, do senso comum e da fé sincera aplicada por meio da lei. Sua abordagem é pragmática: as regras existem para funcionar, e transgressores devem sofrer as consequências apropriadas — sem misericórdia excessiva nem crueldade gratuita.\n\n**Símbolo**: uma bandeira estrelada segurada por um punho gauntleteado.\n**Manifestação**: um homem grande e forte com traços comuns e honestos, sem sofisticação, empunhando maça de guerra, olhos que não escondem julgamento nem tolerância a falsidades.\n**Dogma**: aplicar a lei com firmeza e justiça; punir os transgressores com a intensidade apropriada — não mais, não menos; usar senso comum; combater falsidade, hipocrisia e manipulação; proteger o povo comum das complicações que sofisticados tentam impor.\n**Clero**: clérigos comuns, paladinos práticos, guardas cidadãos. Vestem roupas simples com o símbolo bordado, portam maças de guerra. Vivem em templos de vila comuns, próximos ao povo.\n**Rituais**: sermões contra hipocrisia, cerimônias de julgamento comunitário, punições rituais para transgressores confessos.\n**Fiéis Típicos**: camponeses honestos, guardas municipais, juízes comuns, paladinos com senso prático, clérigos de vila.\n**Relações no Panteão**: aliado de Heironeous, Pelor, Moradin; considera Heironeous um pouco elitista demais; hostil a todos os deuses malignos, especialmente os que corrompem sinceramente.",
            ],
            [
                'nome'          => 'Tharizdun',
                'titulo'        => 'O Deus Acorrentado, O Escuro Eterno',
                'tendencia'     => 'Caótico e Mau',
                'dominios'      => 'Caos, Destruição, Mal, Conhecimento',
                'arma_preferida'=> 'Adaga Retorcida',
                'descricao'     => "Tharizdun é o deus da aniquilação universal e do caos eterno. Aprisionado por outros deuses antes dos tempos por sua natureza catastrófica — se libertado, poderia destruir a própria criação. Seus cultistas trabalham incansavelmente para libertá-lo.\n\n**Símbolo**: um trilho negro com adornos rúnicos malígnos, ou uma correte inclinada.\n**Manifestação**: raramente aparece; quando aparece, é como uma sombra corrompida esperando algo terrível, ou como visões de aniquilação em pesadelos dos cultistas. Nunca fisicamente presente na Grande Roda.\n**Dogma**: descobrir e libertar Tharizdun de sua prisão dimensional; trabalhar para a aniquilação total da criação; destruir tudo — vida, ordem, os próprios deuses; o Nada Absoluto é a única perfeição.\n**Clero**: cultistas fanáticos, muitas vezes escondidos em sociedades comuns, alguns aristocratas insanos. Vestem robes escuros com correntes cerimoniais. Vivem em cavernas secretas ou porões de templos abandonados.\n**Rituais**: sacrifícios sinistros para enfraquecer as correntes divinas, pesquisas em bibliotecas proibidas, cerimônias com artefatos de eras esquecidas.\n**Fiéis Típicos**: cultistas insanos, aristocratas corrompidos, arqueomagos que descobriram segredos proibidos.\n**Relações no Panteão**: TODOS os deuses o mantêm aprisionado; considera-se acima da rivalidade divina — é o inimigo cósmico de toda existência.",
            ],
            [
                'nome'          => 'Trithereon',
                'titulo'        => 'O Summonador, Senhor da Liberdade Individual',
                'tendencia'     => 'Caótico e Bom',
                'dominios'      => 'Bem, Caos, Proteção, Viagem',
                'arma_preferida'=> 'Lança',
                'descricao'     => "Trithereon é o deus da liberdade individual, do autocontrole responsável e da retribuição contra tiranos. Enquanto Heironeous protege por meio da ordem, Trithereon protege pelo direito de cada indivíduo de escolher seu próprio caminho — desde que não escravize outros.\n\n**Símbolo**: uma tríade de correntes quebradas em fundo azul.\n**Manifestação**: um jovem musculoso de traços de guerreiro nômade, roupas leves de couro, lança em riste, olhos ardendo com paixão por liberdade. Acompanhado por três criaturas totem: falcão (velocidade), lobo (companheirismo), grifão (vigilância).\n**Dogma**: defender o direito à autodeterminação de cada pessoa; punir tiranos que restringem a liberdade individual; guiar a alma através do controle próprio (não da imposição externa); ajudar oprimidos a se libertarem.\n**Clero**: patrulheiros libertários, mercenários éticos, alguns paladinos não-convencionais. Vestem couros e portam lanças. Vivem em pequenas comunidades independentes ou como viajantes.\n**Rituais**: cerimônias de libertação (literal ou simbólica), rituais de auto-conhecimento, jornadas de peregrinação para descobrir a própria identidade.\n**Fiéis Típicos**: patrulheiros solitários, mercenários éticos, escravos libertos, rebeldes contra tiranias.\n**Relações no Panteão**: aliado de Heironeous (com tensão filosófica), Pelor, Kord; inimigo de Hextor, Erythnul, Nerull, Tharizdun — todos os deuses da opressão.",
            ],
            [
                'nome'          => 'Ulaa',
                'titulo'        => 'Coração das Montanhas',
                'tendencia'     => 'Leal e Bom',
                'dominios'      => 'Bem, Lei, Terra',
                'arma_preferida'=> 'Martelo de Guerra',
                'descricao'     => "Ulaa é a deusa das colinas, montanhas, cavernas e pedras preciosas. Divindade principalmente venerada por anões, gnomos das montanhas, mineiros e joalheiros — os que retiram os tesouros da terra com respeito.\n\n**Símbolo**: uma montanha com um sol nascendo por trás.\n**Manifestação**: uma mulher robusta de anã ou humana forte, roupas simples de mineira, martelo pesado nas mãos, sempre carregando pequenas pedras preciosas nas mãos ou bolsos.\n**Dogma**: retirar tesouros da terra apenas com respeito e propósito; não desperdiçar riquezas naturais; construir com pedra durável; proteger os que trabalham nas profundezas; venerar a terra como fonte de toda riqueza física.\n**Clero**: anões, gnomos, humanos mineiros. Vestem couro trabalhoso e adornam-se com pedras semi-preciosas. Vivem em templos-mina onde a terra é venerada.\n**Rituais**: cerimônias antes de nova exploração de mina, benções sobre pedras preciosas trabalhadas, banquetes celebrando riquezas descobertas.\n**Fiéis Típicos**: anões, gnomos das montanhas, mineiros humanos, joalheiros dedicados, guardas de tesouros.\n**Relações no Panteão**: irmã espiritual de Moradin (ambos venerados por anões); aliada de Garl Glittergold; conflita filosoficamente com Obad-Hai (que vê mineração como violação).",
            ],
            [
                'nome'          => 'Vecna',
                'titulo'        => 'O Sussurrado, O Senhor dos Segredos',
                'tendencia'     => 'Neutro e Mau',
                'dominios'      => 'Mal, Conhecimento, Magia',
                'arma_preferida'=> 'Adaga',
                'descricao'     => "Vecna é o deus dos segredos, do conhecimento proibido, dos mortos-vivos poderosos e da manipulação por meio da informação. Único deus mortal-ascendido no panteão — foi um lich poderoso que descobriu segredos suficientes para se tornar divino.\n\n**Símbolo**: uma mão descarnada segurando um olho, ambos separados do corpo (marca das perdas de Vecna quando mortal).\n**Manifestação**: raramente aparece; quando aparece, é como uma figura magra em vestes negras, com apenas uma mão e um olho (perdidos em traições antigas), rosto encoberto por capuz, sussurros que rangem os nervos.\n**Dogma**: acumular segredos e conhecimento proibido; usar informação como arma; a fraqueza dos outros é sabê-los pouco; segredos guardados são mais poderosos que espadas; a morte é apenas um estado transitório rumo ao poder verdadeiro.\n**Clero**: necromantes obsessivos, magos corruptos, cultistas silenciosos. Vestem robes de tons escuros com bordados em símbolos incompreensíveis, capuzes sempre puxados. Vivem em torres isoladas ou catacumbas.\n**Rituais**: aquisição ritualística de segredos, criação de mortos-vivos poderosos, sacrifícios silenciosos para acessar informação proibida.\n**Fiéis Típicos**: necromantes ambiciosos, magos corrompidos, líderes de sociedades secretas, cultistas de conhecimento proibido.\n**Relações no Panteão**: rival intelectual de Boccob (que preserva magia neutralmente, sem corromper); inimigo de todos os deuses do bem; tenso com Nerull (rivais no domínio dos mortos-vivos).",
            ],
            [
                'nome'          => 'Wee Jas',
                'titulo'        => 'A Feiticeira da Morte, Joia dos Corvos',
                'tendencia'     => 'Leal e Neutro',
                'dominios'      => 'Lei, Magia, Morte',
                'arma_preferida'=> 'Adaga',
                'descricao'     => "Wee Jas é a deusa da magia ordenada e da morte natural. Representa o oposto de Nerull: a morte não é vilã, é apenas o próximo estado ordenado após a vida. Também deusa da magia — mas apenas da magia disciplinada, estudada, dominada.\n\n**Símbolo**: um crânio vermelho com adornos rubis nas cavidades oculares.\n**Manifestação**: uma mulher jovem de beleza fria e melancólica, vestido escarlate e negro, sem sorriso mas sem malícia, empunhando adaga cerimonial. Sempre acompanhada de corvos silenciosos.\n**Dogma**: estudar a magia com disciplina absoluta; a morte é natural e ordeira — deve ser respeitada, não temida nem manipulada; a hierarquia arcana deve ser mantida; combater necromancia caótica (mortos-vivos livres, ressurreições irregulares).\n**Clero**: magos de orientação legal, alguns necromantes éticos, clérigos que administram funerais. Vestem robes vermelhos e negros com adornos rubis. Vivem em templos-biblioteca.\n**Rituais**: cerimônias funerais formais que respeitam morte natural, estudos ritualísticos de magia arcana, cerimônias equinócio de outono.\n**Fiéis Típicos**: magos legais, feiticeiros ordenados, funerários, filósofos da morte, alguns necromantes éticos.\n**Relações no Panteão**: relação complicada com Boccob (mesma neutralidade em magia, mas ela adiciona a Lei); inimiga de Nerull (morte violenta) e Vecna (necromancia corrupta); respeitada por Pelor (que valoriza morte ordeira também).",
            ],
            [
                'nome'          => 'Yondalla',
                'titulo'        => 'A Provedora, Guardiã dos Halflings',
                'tendencia'     => 'Leal e Bom',
                'dominios'      => 'Bem, Lei, Proteção',
                'arma_preferida'=> 'Escudo Curto Espigado',
                'descricao'     => "Yondalla é a deusa suprema dos halflings — protetora, provedora, matriarca cósmica. Representa fertilidade, família, comunidade e a proteção sábia através da preparação e prevenção mais que da guerra ativa.\n\n**Símbolo**: um escudo com um cornucópia dentro, ou apenas um escudo curto adornado com trigo.\n**Manifestação**: uma matrona halfling de meia-idade, vestido simples de fazendeira, escudo curto ao lado, sorriso maternal, sempre com comida para oferecer. Emana calor de lar e proteção.\n**Dogma**: proteger a família e a comunidade halfling; provir para os que precisam com generosidade; preparar-se para dificuldades por meio de comida armazenada, aliados fiéis, boas relações; combater apenas quando necessário, preferindo negociação.\n**Clero**: halflings, alguns humanos matriarcais, alguns gnomos. Vestem vestes simples de fazendeiro-guerreiro, adornam-se com trigo e frutas. Vivem em vilas halfling ao redor de altares comunais.\n**Rituais**: celebrações da colheita, cerimônias de casamento e nascimento, banquetes comunitários mensais, preparação de estoque para o inverno.\n**Fiéis Típicos**: halflings em geral (praticamente todos), matriarcas humanas rurais, membros de comunidades pacíficas.\n**Relações no Panteão**: aliada próxima de Moradin, Garl Glittergold, Ehlonna; amizade com Heironeous, Pelor; hostil aos deuses da destruição — mas prefere que Heironeous ou Kord os combatam enquanto ela protege os fracos.",
            ],
        ];

        foreach ($divindades as $divindade) {
            Divindade::updateOrCreate(
                ['nome' => $divindade['nome'], 'versao' => '3.5'],
                array_merge($divindade, ['versao' => '3.5'])
            );
        }
    }
}
