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
                'descricao'         => 'Robustos e resistentes, os anões habitam montanhas e subterrâneos. Conhecidos por sua habilidade em combate, resistência a magias e maestria em trabalhos com pedra e metal. Recebem bônus contra gigantes e habilidade de sentido de pedra.',
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
                'descricao'         => 'Graciosos e de longa vida, os elfos preferem florestas e artes. São imunes a efeitos de sono mágico e possuem resistência a encantamentos. Recebem proficiência com arco longo, arco curto composto, espada longa e rapieira.',
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
                'descricao'         => 'Curiosos e inventivos, os gnomos são bem-vindos em qualquer lugar como técnicos, alquimistas e ilusionistas. Possuem habilidades inatas de ilusão e falam com animais subterrâneos. Recebem bônus contra kobolds e goblinoides.',
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
                'descricao'         => 'Ágeis e sorrateiros, os halflings são andarilhos práticos que preferem evitar problemas mas são corajosos quando necessário. Recebem +1 em todos os testes de resistência e +2 em Furtividade e Ouvir.',
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
                'descricao'         => 'A raça mais adaptável e ambiciosa. Humanos recebem um talento extra no 1º nível, 4 pontos de perícia extras no 1º nível e 1 ponto adicional a cada nível, além de um idioma extra. Sua versatilidade os torna os mais comuns de todos os povos.',
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
                'descricao'         => 'Caminhando entre dois mundos, os meio-elfos combinam a versatilidade humana com os dons élficos. Possuem visão no escuro, resistência a encantos de sono e bonificação em Procurar, Ouvir e Observar. São diplomáticos naturais.',
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
                'descricao'         => 'Fortes e intimidadores, os meio-orcs vivem nas fronteiras entre civilização e barbarismo. Possuem visão no escuro e força física impressionante, mas sofrem preconceito social em muitas regiões.',
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
