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
                'descricao'     => 'Deus da magia e do conhecimento arcano. Boccob é indiferente à moral, preocupando-se apenas com a preservação e o avanço da magia no mundo.',
            ],
            [
                'nome'          => 'Corellon Larethian',
                'titulo'        => 'Criador dos Elfos, Senhor das Artes',
                'tendencia'     => 'Caótico e Bom',
                'dominios'      => 'Bem, Caos, Magia, Proteção, Guerra',
                'arma_preferida'=> 'Espada Longa',
                'descricao'     => 'Divindade principal do panteão élfico. Patrono das artes, magia, música e da proteção dos elfos contra Lolth e Gruumsh.',
            ],
            [
                'nome'          => 'Ehlonna',
                'titulo'        => 'Senhora das Florestas',
                'tendencia'     => 'Neutro e Bom',
                'dominios'      => 'Animais, Bem, Plantas, Sol',
                'arma_preferida'=> 'Lança Longa',
                'descricao'     => 'Deusa das florestas, das pastagens e de todos os animais e plantas. Protetora das criaturas da natureza e dos que vivem em harmonia com ela.',
            ],
            [
                'nome'          => 'Erythnul',
                'titulo'        => 'O Muitos Rostos, Senhor do Massacre',
                'tendencia'     => 'Caótico e Mau',
                'dominios'      => 'Caos, Mal, Trapaça, Guerra',
                'arma_preferida'=> 'Mangual Pesado',
                'descricao'     => 'Deus do ódio, da inveja, do massacre e do pânico. Seus seguidores caóticos e violentos são conhecidos por semear terror e destruição.',
            ],
            [
                'nome'          => 'Fharlanghn',
                'titulo'        => 'O Distante, Horizonte do Viajante',
                'tendencia'     => 'Neutro',
                'dominios'      => 'Sorte, Proteção, Viagem',
                'arma_preferida'=> 'Bordão',
                'descricao'     => 'Deus das estradas, das distâncias e da viagem. Protege mercadores, mensageiros e todos que percorrem longos caminhos.',
            ],
            [
                'nome'          => 'Garl Glittergold',
                'titulo'        => 'O Protetor Brilhante, Rei dos Gnomos',
                'tendencia'     => 'Neutro e Bom',
                'dominios'      => 'Bem, Proteção, Trapaça',
                'arma_preferida'=> 'Machadinha de Batalha',
                'descricao'     => 'Divindade principal dos gnomos. Patrono da ilusão, da joalheria, do humor e da proteção do povo gnômico.',
            ],
            [
                'nome'          => 'Gruumsh',
                'titulo'        => 'O que Não Pisca, Senhor dos Orcs',
                'tendencia'     => 'Caótico e Mau',
                'dominios'      => 'Caos, Força, Mal, Guerra',
                'arma_preferida'=> 'Lança',
                'descricao'     => 'Divindade principal dos orcs. Um-Olhado após conflito com Corellon Larethian, comanda seus seguidores a destruir elfos e conquistar territórios.',
            ],
            [
                'nome'          => 'Heironeous',
                'titulo'        => 'O Invencível',
                'tendencia'     => 'Leal e Bom',
                'dominios'      => 'Bem, Glória, Guerra, Lei',
                'arma_preferida'=> 'Espada Longa',
                'descricao'     => 'Deus da justiça, cavalheirismo, bravura e honra. Patrono dos paladinos e guerreiros nobres. Rival eterno de seu meio-irmão Hextor.',
            ],
            [
                'nome'          => 'Hextor',
                'titulo'        => 'Arauto da Guerra, Campeão do Mal',
                'tendencia'     => 'Leal e Mau',
                'dominios'      => 'Destruição, Guerra, Lei, Mal',
                'arma_preferida'=> 'Mangual Pesado',
                'descricao'     => 'Deus da guerra, discórdia, massacres e tirania. Meio-irmão e rival de Heironeous, comanda exércitos malignos com mão de ferro.',
            ],
            [
                'nome'          => 'Kord',
                'titulo'        => 'O Senhor da Força',
                'tendencia'     => 'Caótico e Bom',
                'dominios'      => 'Bem, Caos, Força, Sorte',
                'arma_preferida'=> 'Espada Grande',
                'descricao'     => 'Deus da força, atletismo, esportes e coragem física. Patrono de guerreiros e atletas que testam constantemente seus limites.',
            ],
            [
                'nome'          => 'Moradin',
                'titulo'        => 'O Forjador de Almas, Pai dos Anões',
                'tendencia'     => 'Leal e Bom',
                'dominios'      => 'Bem, Lei, Proteção, Terra',
                'arma_preferida'=> 'Martelo de Guerra',
                'descricao'     => 'Divindade principal dos anões. Deus da criação, da forja, da família e da proteção da raça anã desde os tempos primordiais.',
            ],
            [
                'nome'          => 'Nerull',
                'titulo'        => 'O Ceifador, Senhor dos Mortos',
                'tendencia'     => 'Neutro e Mau',
                'dominios'      => 'Mal, Morte, Trevas',
                'arma_preferida'=> 'Foice',
                'descricao'     => 'Deus da morte, das trevas e do assassinato. O mais odiado dos deuses, Nerull abomina a vida e os vivos, buscando encher seus reinos com almas.',
            ],
            [
                'nome'          => 'Obad-Hai',
                'titulo'        => 'O Senhor da Selva, Mestre das Eras',
                'tendencia'     => 'Neutro',
                'dominios'      => 'Ar, Animais, Terra, Fogo, Plantas, Água',
                'arma_preferida'=> 'Bordão',
                'descricao'     => 'Deus da natureza selvagem, das estações e dos ambientes não domesticados. Rival de Ehlonna, Obad-Hai representa a face implacável da natureza.',
            ],
            [
                'nome'          => 'Olidammara',
                'titulo'        => 'O Alegre',
                'tendencia'     => 'Caótico e Neutro',
                'dominios'      => 'Caos, Sorte, Viagem, Trapaça',
                'arma_preferida'=> 'Rapieira',
                'descricao'     => 'Deus da música, das festas, dos vinhos e dos ladrões. Um ser alegre e imprevisível, patrono dos boêmios, artistas e ladinos.',
            ],
            [
                'nome'          => 'Pelor',
                'titulo'        => 'O Senhor do Sol',
                'tendencia'     => 'Neutro e Bom',
                'dominios'      => 'Bem, Cura, Sol, Força',
                'arma_preferida'=> 'Maça Pesada',
                'descricao'     => 'Deus do sol, da luz, da força e da cura. Pelor é bondoso e generoso, mas combate ferozmente os mortos-vivos e as forças das trevas.',
            ],
            [
                'nome'          => 'São Cuthbert',
                'titulo'        => 'De Estrela Bilhante, Senhor da Retribuição',
                'tendencia'     => 'Leal e Neutro',
                'dominios'      => 'Destruição, Lei, Proteção, Força',
                'arma_preferida'=> 'Maça de Guerra',
                'descricao'     => 'Deus da retribuição, do senso comum e da devoção sincera. São Cuthbert acredita que as leis devem ser aplicadas com firmeza para o bem da sociedade.',
            ],
            [
                'nome'          => 'Tharizdun',
                'titulo'        => 'O Deus Acorrentado, O Escuro Eterno',
                'tendencia'     => 'Caótico e Mau',
                'dominios'      => 'Caos, Destruição, Mal, Conhecimento',
                'arma_preferida'=> 'Adaga Retorcida',
                'descricao'     => 'Deus do caos eterno e da aniquilação. Aprisionado por outros deuses antes dos tempos, seus cultistas trabalham para libertar essa entidade demente e destrutiva.',
            ],
            [
                'nome'          => 'Trithereon',
                'titulo'        => 'O Summonador, Senhor da Liberdade Individual',
                'tendencia'     => 'Caótico e Bom',
                'dominios'      => 'Bem, Caos, Proteção, Viagem',
                'arma_preferida'=> 'Lança',
                'descricao'     => 'Deus da liberdade, da retribuição e do autocontrole. Defende ferozmente o direito de cada indivíduo à autodeterminação e pune os tiranos.',
            ],
            [
                'nome'          => 'Ulaa',
                'titulo'        => 'Coração das Montanhas',
                'tendencia'     => 'Leal e Bom',
                'dominios'      => 'Bem, Lei, Terra',
                'arma_preferida'=> 'Martelo de Guerra',
                'descricao'     => 'Deusa das colinas, das montanhas e das pedras preciosas. Venerada principalmente por mineiros, joalheiros e anões das montanhas.',
            ],
            [
                'nome'          => 'Vecna',
                'titulo'        => 'O Sussurrado, O Senhor dos Segredos',
                'tendencia'     => 'Neutro e Mau',
                'dominios'      => 'Mal, Conhecimento, Magia',
                'arma_preferida'=> 'Adaga',
                'descricao'     => 'Deus dos segredos, do conhecimento proibido e dos mortos-vivos. Vecna foi um lich poderoso que ascendeu à divindade, guardando segredos que podem destruir o mundo.',
            ],
            [
                'nome'          => 'Wee Jas',
                'titulo'        => 'A Feiticeira da Morte, Joia dos Corvos',
                'tendencia'     => 'Leal e Neutro',
                'dominios'      => 'Lei, Magia, Morte',
                'arma_preferida'=> 'Adaga',
                'descricao'     => 'Deusa da magia e da morte. Valoriza a ordem, o conhecimento arcano e a transição natural da morte. Patrona de magos e necromantes de orientação legal.',
            ],
            [
                'nome'          => 'Yondalla',
                'titulo'        => 'A Provedora, Guardiã dos Halflings',
                'tendencia'     => 'Leal e Bom',
                'dominios'      => 'Bem, Lei, Proteção',
                'arma_preferida'=> 'Escudo Curto Espigado',
                'descricao'     => 'Divindade principal dos halflings. Deusa da proteção, da fertilidade e da família. Yondalla guia seu povo com sabedoria e os protege dos perigos do mundo.',
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
