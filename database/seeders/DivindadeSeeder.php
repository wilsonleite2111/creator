<?php

namespace Database\Seeders;

use App\Models\Divindade;
use Illuminate\Database\Seeder;

class DivindadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divindades = [
            [
                'nome' => 'Heironeous',
                'titulo' => 'O Invencível',
                'versao' => '3.5',
                'tendencia' => 'Leal e Bom',
                'dominios' => 'Bem, Guerra, Lei, Glória',
                'arma_preferida' => 'Espada Longa',
                'descricao' => 'Deus da justiça, cavalheirismo, bravura e honra. Ele é o patrono dos paladinos e guerreiros nobres.',
            ],
            [
                'nome' => 'Pelor',
                'titulo' => 'O Senhor do Sol',
                'versao' => '3.5',
                'tendencia' => 'Neutro e Bom',
                'dominios' => 'Bem, Cura, Sol, Força',
                'arma_preferida' => 'Maça Pesada',
                'descricao' => 'Deus do sol, luz, força e cura. Ele é uma divindade bondosa que se opõe ferozmente aos mortos-vivos.',
            ],
            [
                'nome' => 'Kord',
                'titulo' => 'O Lutador',
                'versao' => '3.5',
                'tendencia' => 'Caótico e Bom',
                'dominios' => 'Bem, Caos, Força, Sorte',
                'arma_preferida' => 'Espada Grande',
                'descricao' => 'Deus da força, atletismo, esportes e coragem física. Ele é o patrono daqueles que testam seus limites.',
            ],
            [
                'nome' => 'Moradin',
                'titulo' => 'O Forjador de Almas',
                'versao' => '3.5',
                'tendencia' => 'Leal e Bom',
                'dominios' => 'Bem, Lei, Proteção, Terra',
                'arma_preferida' => 'Martelo de Guerra',
                'descricao' => 'Divindade principal dos anões, deus da forja, criação e proteção da raça anã.',
            ],
            [
                'nome' => 'Corellon Larethian',
                'titulo' => 'Criador dos Elfos',
                'versao' => '3.5',
                'tendencia' => 'Caótico e Bom',
                'dominios' => 'Bem, Caos, Magia, Proteção',
                'arma_preferida' => 'Espada Longa',
                'descricao' => 'O líder do panteão élfico, deus da magia, artes e artesania élfica.',
            ],
            [
                'nome' => 'Wee Jas',
                'titulo' => 'A Feiticeira da Morte',
                'versao' => '3.5',
                'tendencia' => 'Leal e Neutro',
                'dominios' => 'Lei, Magia, Morte, Mente',
                'arma_preferida' => 'Adaga',
                'descricao' => 'Deusa da magia e da morte. Ela valoriza a ordem e o conhecimento arcano acima de tudo.',
            ],
            [
                'nome' => 'Hextor',
                'titulo' => 'O Arauto da Guerra',
                'versao' => '3.5',
                'tendencia' => 'Leal e Mau',
                'dominios' => 'Destruição, Guerra, Lei, Mal',
                'arma_preferida' => 'Mangual Pesado',
                'descricao' => 'Deus da guerra, discórdia, tirania e conflito. Meio-irmão e rival de Heironeous.',
            ],
            [
                'nome' => 'Vecna',
                'titulo' => 'O Sussurrado',
                'versao' => '3.5',
                'tendencia' => 'Neutro e Mau',
                'dominios' => 'Mal, Conhecimento, Magia',
                'arma_preferida' => 'Adaga',
                'descricao' => 'Deus dos segredos, do conhecimento proibido e dos mortos-vivos.',
            ],
        ];

        foreach ($divindades as $divindade) {
            Divindade::updateOrCreate(
                ['nome' => $divindade['nome'], 'versao' => '3.5'],
                $divindade
            );
        }
    }
}
