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
                'descricao'              => 'Guerreiro feroz de terras selvagens que canaliza a fúria de batalha como arma. Possui resistência a encantamentos, movimento rápido e fúria por um número limitado de rodadas por dia.',
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
                'descricao'              => 'Artista versátil cuja música e magia inspiram aliados e desconcertam inimigos. Lança magias arcanas espontaneamente, possui habilidades de representação e é o mestre dos conhecimentos variados.',
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
                'descricao'              => 'Sacerdote guerreiro que invoca magias divinas concedidas por seu deus. Pode curar aliados, expulsar mortos-vivos e escolhe dois domínios divinos que concedem poderes especiais e magias extras.',
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
                'descricao'              => 'Guardião da natureza que invoca os poderes dos elementos e das criaturas selvagens. Pode transformar-se em animais (Forma Selvagem), possui um companheiro animal poderoso e acessa magias divinas da natureza.',
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
                'descricao'              => 'Conjurador arcano com magia inata que flui do sangue ou da alma. Lança magias espontaneamente sem necessidade de grimório, possui poucos feitiços conhecidos mas pode lançá-los com muito mais frequência que o mago.',
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
                'descricao'              => 'Mestre absoluto do combate marcial, treinado em todas as armas e armaduras. Ganha um talento de bônus a cada dois níveis (incluindo talentos exclusivos de guerreiro), tornando-se uma máquina de guerra imbatível.',
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
                'descricao'              => 'Especialista em furtividade, armadilhas e ataques pela retaguarda. O Ataque Furtivo causa dano extra a alvos desprevenidos, e a lista extensa de perícias de classe o torna o mais versátil em situações não-combativas.',
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
                'descricao'              => 'Conjurador arcano estudioso que registra magias em um grimório. Prepara magias diariamente e pode especializar-se em uma escola mágica, ganhando espaços de magia extras. Possui o maior leque de magias arcanas disponíveis.',
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
                'descricao'              => 'Artista marcial disciplinado que transcende os limites físicos pelo cultivo do ki. Luta sem armas com dano crescente, possui movimento aprimorado, queda suave, pureza do corpo e pode realizar proezas sobrenaturais.',
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
                'descricao'              => 'Guerreiro sagrado dedicado a uma divindade bondosa. Detecta o mal, possui imunidade a doenças, lança algumas magias divinas, pode curar com imposição das mãos e comanda um corcel celestial. Deve ser sempre Leal e Bom.',
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
                'descricao'              => 'Caçador e rastreador das terras selvagens especializado em um inimigo favorito. Pode lutar com duas armas ou com arco, possui um companheiro animal e acessa algumas magias divinas da natureza. Conhece seu ambiente como ninguém.',
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
