<?php

namespace Database\Seeders;

use App\Models\Raca;
use Illuminate\Database\Seeder;

class RacaSeeder extends Seeder
{
    public function run(): void
    {
        $racas = [
            // --- D&D 3.5 (PHB) ---
            [
                'nome'              => 'Anão',
                'versao'            => '3.5',
                'descricao'         => "Robustos e resistentes, os anões habitam montanhas, salões subterrâneos e cidadelas fortificadas em picos. Conhecidos por sua barba trançada, força física e maestria em trabalhos com pedra e metal. São teimosos, tradicionais e leais a seus clãs — vinganças de sangue podem durar gerações.\n\n**Visão no Escuro**: 18 m em preto e branco, sem necessidade de luz.\n**Deslocamento Estável**: velocidade de 6 m NÃO é reduzida por armadura pesada ou carga.\n**Sentido de Pedra**: +2 em Percepção para detectar trabalho anormal em pedra (armadilhas, portas secretas, construções falsas). Nota automaticamente elementos de pedra dentro de 3 m mesmo sem procurar. +2 em Avaliação de itens de pedra/metal e +2 em Ofício com pedra/metal.\n**Familiaridade com Armas**: machado de guerra anão e urgrosh anão contam como armas marciais (não exóticas).\n**Estabilidade**: +4 contra investidas e tentativas de derrubar quando de pé.\n**Resistência a Venenos**: +2 em TR contra venenos.\n**Resistência a Magias**: +2 em TR contra magias e habilidades mágicas.\n**Ódio Ancestral**: +1 em jogadas de ataque contra orcs e goblinoides.\n**Defesa contra Gigantes**: +4 de esquiva na CA contra criaturas do tipo gigante.\n\n**Modificadores**: +2 CON, -2 CAR.\n**Tamanho**: Médio.\n**Deslocamento**: 6 m.\n**Classe Favorita**: Guerreiro.\n**Idiomas**: Comum, Anão. Bônus: Gigante, Gnomo, Goblin, Orc, Terran, Subcomum.",
                'mod_forca'         => 0,
                'mod_destreza'      => 0,
                'mod_constituicao'  => 2,
                'mod_inteligencia'  => 0,
                'mod_sabedoria'     => 0,
                'mod_carisma'       => -2,
                'tamanho'           => 'Médio',
                'deslocamento'      => 6,
            ],
            [
                'nome'              => 'Elfo',
                'versao'            => '3.5',
                'descricao'         => "Graciosos e de longa vida, os elfos preferem florestas milenares e artes refinadas — música, poesia, pintura, magia. Vivem por séculos e consideram os humanos apressados demais para apreciar as coisas belas do mundo. Suas comunidades são reclusas, protegidas por magia e patrulheiros silenciosos.\n\n**Visão na Penumbra**: enxerga o dobro da distância normal em luz esmaecida.\n**Imunidade a Sono Mágico**: totalmente imune a magias e efeitos de sono (mágicos — sono natural funciona normalmente).\n**Resistência a Encantamentos**: +2 em TR contra magias e efeitos de Encantamento.\n**Proficiência em Armas**: proficiência automática com espada longa, rapieira, arco longo (composto ou não) e arco curto (composto ou não), independente da classe.\n**Sentidos Aguçados**: +2 em Ouvir, Percepção e Observar.\n**Passos Silenciosos**: quando passar dentro de 1,5 m de uma porta secreta, teste de Percepção automático (sem ação declarada).\n\n**Modificadores**: +2 DES, -2 CON.\n**Tamanho**: Médio.\n**Deslocamento**: 9 m.\n**Classe Favorita**: Mago.\n**Idiomas**: Comum, Élfico. Bônus: Dracônico, Gnoll, Gnomo, Goblin, Orc, Silvestre.",
                'mod_forca'         => 0,
                'mod_destreza'      => 2,
                'mod_constituicao'  => -2,
                'mod_inteligencia'  => 0,
                'mod_sabedoria'     => 0,
                'mod_carisma'       => 0,
                'tamanho'           => 'Médio',
                'deslocamento'      => 9,
            ],
            [
                'nome'              => 'Gnomo',
                'versao'            => '3.5',
                'descricao'         => "Curiosos, inventivos e alegres, os gnomos são bem-vindos em qualquer lugar como técnicos, alquimistas e ilusionistas. Amam pegadinhas, jóias, animais pequenos e trabalhos de precisão — muitos são joalheiros ou relojoeiros lendários. Vivem em colinas arborizadas, geralmente próximos a comunidades anãs ou humanas.\n\n**Visão na Penumbra**: enxerga o dobro da distância normal em luz esmaecida.\n**Familiaridade com Armas**: martelo cravado gnômico conta como arma marcial (não exótica).\n**Resistência a Ilusões**: +2 em TR contra magias e efeitos de Ilusão.\n**Foco em Ilusão**: +1 na CD dos testes de resistência contra magias de Ilusão conjuradas pelo gnomo (efetivamente, alvos passam com menos frequência).\n**Ódio a Reptilianos**: +1 nas jogadas de ataque contra kobolds e goblinoides.\n**Defesa contra Gigantes**: +4 de esquiva na CA contra criaturas do tipo gigante.\n**Sentidos Aguçados**: +2 em Ouvir.\n**Alquimia Natural**: +2 em Ofício (alquimia).\n**Habilidades Mágicas Inatas** (com CAR 10+, 1x/dia cada): Falar com Animais (apenas mamíferos escavadores — texugo, marmota etc., 1 min./nível), Luzes Dançantes, Som Fantasmagórico, Prestidigitação. Nível de conjurador igual ao nível do personagem; CD 10 + nível da magia + CAR-mod.\n\n**Modificadores**: -2 FOR, +2 CON.\n**Tamanho**: Pequeno (+1 em ataques e CA de tamanho, +4 em Furtividade, mas dano de arma menor).\n**Deslocamento**: 6 m.\n**Classe Favorita**: Bardo.\n**Idiomas**: Comum, Gnomo. Bônus: Dracônico, Anão, Élfico, Gigante, Goblin, Orc.",
                'mod_forca'         => -2,
                'mod_destreza'      => 0,
                'mod_constituicao'  => 2,
                'mod_inteligencia'  => 0,
                'mod_sabedoria'     => 0,
                'mod_carisma'       => 0,
                'tamanho'           => 'Pequeno',
                'deslocamento'      => 6,
            ],
            [
                'nome'              => 'Halfling',
                'versao'            => '3.5',
                'descricao'         => "Ágeis, sorrateiros e afáveis, os halflings são andarilhos práticos que preferem evitar problemas mas revelam-se surpreendentemente corajosos quando necessário. Vivem em comunidades bem organizadas próximas a centros humanos, cultivam laços familiares fortes e apreciam boa comida, música e tabaco.\n\n**Sorte Natural**: +1 racial em TODOS os testes de resistência (Fortitude, Reflexos e Vontade). A sorte parece caminhar com eles.\n**Bravura**: +2 de moral em TR contra medo, empilhando com o +1 racial anterior contra ameaças amedrontadoras (total +3 vs. medo).\n**Precisão em Arremesso**: +1 nas jogadas de ataque com armas de arremesso e fundas.\n**Perícias Ágeis**: +2 em Escalar, Saltar, Furtividade e Ouvir.\n\n**Modificadores**: -2 FOR, +2 DES.\n**Tamanho**: Pequeno (+1 em ataques e CA de tamanho, +4 em Furtividade, mas dano de arma menor).\n**Deslocamento**: 6 m.\n**Classe Favorita**: Ladino.\n**Idiomas**: Comum, Halfling. Bônus: Anão, Élfico, Gnomo, Goblin, Orc.",
                'mod_forca'         => -2,
                'mod_destreza'      => 2,
                'mod_constituicao'  => 0,
                'mod_inteligencia'  => 0,
                'mod_sabedoria'     => 0,
                'mod_carisma'       => 0,
                'tamanho'           => 'Pequeno',
                'deslocamento'      => 6,
            ],
            [
                'nome'              => 'Humano',
                'versao'            => '3.5',
                'descricao'         => "A raça mais adaptável, ambiciosa e numerosa do mundo. Humanos habitam praticamente todos os continentes, dominando climas e culturas diversas por sua flexibilidade sem paralelo. Enquanto elfos vivem séculos e anões medem em gerações, humanos comprimem paixões e feitos em uma única vida breve — o que os torna os mais empreendedores dos povos.\n\n**Talento Bônus** (1° nível): recebe um talento adicional na criação, além do talento normal de 1° nível.\n**Pontos de Perícia Extras**: 4 pontos adicionais no 1° nível e +1 ponto adicional em cada nível subsequente.\n**Idioma Bônus**: um idioma adicional à escolha (exceto secretos como Druídico ou Ladrão).\n**Sem Restrições de Atributo**: nenhum modificador racial em atributos — todos partem do valor base.\n\n**Modificadores**: nenhum.\n**Tamanho**: Médio.\n**Deslocamento**: 9 m.\n**Classe Favorita**: qualquer (escolhida na criação e mantida por toda a carreira).\n**Idiomas**: Comum + um idioma à escolha. Bônus: qualquer (exceto secretos).",
                'mod_forca'         => 0,
                'mod_destreza'      => 0,
                'mod_constituicao'  => 0,
                'mod_inteligencia'  => 0,
                'mod_sabedoria'     => 0,
                'mod_carisma'       => 0,
                'tamanho'           => 'Médio',
                'deslocamento'      => 9,
            ],
            [
                'nome'              => 'Meio-Elfo',
                'versao'            => '3.5',
                'descricao'         => "Caminhando entre dois mundos, os meio-elfos combinam a versatilidade humana com os dons ancestrais dos elfos. Frequentemente vistos como forasteiros por ambas as raças-mãe, encontram lar em comunidades tolerantes ou em uma vida de aventuras onde a origem importa menos. São diplomatas naturais, artistas sensíveis e viajantes incansáveis.\n\n**Visão na Penumbra**: enxerga o dobro da distância normal em luz esmaecida.\n**Imunidade a Sono Mágico**: totalmente imune a magias e efeitos de sono (herdado dos elfos).\n**Resistência a Encantamentos**: +2 em TR contra magias e efeitos de Encantamento.\n**Sentidos Aguçados**: +1 em Ouvir, Percepção e Observar (metade do bônus élfico).\n**Diplomata Natural**: +2 em Diplomacia e Obter Informações.\n**Sangue Élfico**: conta como elfo para qualquer efeito relacionado à raça (magias e itens específicos para elfos funcionam nele, como Fecho de Feitiço Anti-Elfo, itens élficos etc.).\n\n**Modificadores**: nenhum.\n**Tamanho**: Médio.\n**Deslocamento**: 9 m.\n**Classe Favorita**: qualquer (como humanos).\n**Idiomas**: Comum, Élfico. Bônus: qualquer (exceto secretos).",
                'mod_forca'         => 0,
                'mod_destreza'      => 0,
                'mod_constituicao'  => 0,
                'mod_inteligencia'  => 0,
                'mod_sabedoria'     => 0,
                'mod_carisma'       => 0,
                'tamanho'           => 'Médio',
                'deslocamento'      => 9,
            ],
            [
                'nome'              => 'Meio-Orc',
                'versao'            => '3.5',
                'descricao'         => "Fortes, intimidadores e físicos imponentes, os meio-orcs vivem nas fronteiras entre civilização e barbarismo. Frequentemente parecem ameaçadores por sua origem — músculos densos, presas proeminentes, olhos afundados — e sofrem preconceito social em cidades civilizadas. Muitos se voltam à vida de mercenário, aventureiro ou barbárie tribal onde a força é respeitada.\n\n**Visão no Escuro**: 18 m em preto e branco, sem necessidade de luz (herdado dos orcs).\n**Sangue Orc**: conta como orc para qualquer efeito relacionado à raça (magias e itens específicos para orcs funcionam nele).\n\n**Modificadores**: +2 FOR, -2 INT, -2 CAR.\n**Tamanho**: Médio.\n**Deslocamento**: 9 m.\n**Classe Favorita**: Bárbaro.\n**Idiomas**: Comum, Orc. Bônus: Dracônico, Gigante, Gnoll, Goblin, Abissal.\n\nA raça mais direta em concepção — sem habilidades supernaturais extras além dos essenciais da herança orc, os meio-orcs compensam com força bruta pura. A INT baixa penaliza estudo e magia arcana, mas nada impede um meio-orc talentoso de ser mago, bardo ou mesmo paladino se o alinhamento permitir.",
                'mod_forca'         => 2,
                'mod_destreza'      => 0,
                'mod_constituicao'  => 0,
                'mod_inteligencia'  => -2,
                'mod_sabedoria'     => 0,
                'mod_carisma'       => -2,
                'tamanho'           => 'Médio',
                'deslocamento'      => 9,
            ],
        ];

        foreach ($racas as $raca) {
            Raca::updateOrCreate(
                ['nome' => $raca['nome'], 'versao' => $raca['versao']],
                $raca
            );
        }
    }
}
