<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'nome' => 'Bárbaro',
                'versao' => '3.5',
                'descricao' => 'Um guerreiro feroz que usa a fúria e o instinto para derrubar adversários.',
                'dado_vida' => 12,
                'bba_progressao' => 'boa',
                'resistencia_fortitude' => 'boa',
                'resistencia_reflexos' => 'ruim',
                'resistencia_vontade' => 'ruim',
                'pontos_pericia' => 4,
            ],
            [
                'nome' => 'Bardo',
                'versao' => '3.5',
                'descricao' => 'Um artista cuja música e magia inspiram aliados e fascinam inimigos.',
                'dado_vida' => 6,
                'bba_progressao' => 'media',
                'resistencia_fortitude' => 'ruim',
                'resistencia_reflexos' => 'boa',
                'resistencia_vontade' => 'boa',
                'pontos_pericia' => 6,
            ],
            [
                'nome' => 'Clérigo',
                'versao' => '3.5',
                'descricao' => 'Um sacerdote que conjura magias divinas e possui o poder de curar e expulsar mortos-vivos.',
                'dado_vida' => 8,
                'bba_progressao' => 'media',
                'resistencia_fortitude' => 'boa',
                'resistencia_reflexos' => 'ruim',
                'resistencia_vontade' => 'boa',
                'pontos_pericia' => 2,
            ],
            [
                'nome' => 'Druida',
                'versao' => '3.5',
                'descricao' => 'Um conjurador divino que invoca os poderes da natureza e pode adotar formas animais.',
                'dado_vida' => 8,
                'bba_progressao' => 'media',
                'resistencia_fortitude' => 'boa',
                'resistencia_reflexos' => 'ruim',
                'resistencia_vontade' => 'boa',
                'pontos_pericia' => 4,
            ],
            [
                'nome' => 'Feiticeiro',
                'versao' => '3.5',
                'descricao' => 'Um conjurador arcano com magia inata, capaz de lançar magias espontaneamente.',
                'dado_vida' => 4,
                'bba_progressao' => 'ruim',
                'resistencia_fortitude' => 'ruim',
                'resistencia_reflexos' => 'ruim',
                'resistencia_vontade' => 'boa',
                'pontos_pericia' => 2,
            ],
            [
                'nome' => 'Guerreiro',
                'versao' => '3.5',
                'descricao' => 'Um mestre em combate marcial, treinado no uso de uma vasta gama de armas e armaduras.',
                'dado_vida' => 10,
                'bba_progressao' => 'boa',
                'resistencia_fortitude' => 'boa',
                'resistencia_reflexos' => 'ruim',
                'resistencia_vontade' => 'ruim',
                'pontos_pericia' => 2,
            ],
            [
                'nome' => 'Ladino',
                'versao' => '3.5',
                'descricao' => 'Um explorador furtivo e habilidoso, especialista em desarmar armadilhas e ataques furtivos.',
                'dado_vida' => 6,
                'bba_progressao' => 'media',
                'resistencia_fortitude' => 'ruim',
                'resistencia_reflexos' => 'boa',
                'resistencia_vontade' => 'ruim',
                'pontos_pericia' => 8,
            ],
            [
                'nome' => 'Mago',
                'versao' => '3.5',
                'descricao' => 'Um conjurador arcano estudioso, que prepara suas magias a partir de um grimório.',
                'dado_vida' => 4,
                'bba_progressao' => 'ruim',
                'resistencia_fortitude' => 'ruim',
                'resistencia_reflexos' => 'ruim',
                'resistencia_vontade' => 'boa',
                'pontos_pericia' => 2,
            ],
            [
                'nome' => 'Monge',
                'versao' => '3.5',
                'descricao' => 'Um artista marcial disciplinado, que luta sem armaduras e usa o ki para realizar proezas.',
                'dado_vida' => 8,
                'bba_progressao' => 'media',
                'resistencia_fortitude' => 'boa',
                'resistencia_reflexos' => 'boa',
                'resistencia_vontade' => 'boa',
                'pontos_pericia' => 4,
            ],
            [
                'nome' => 'Paladino',
                'versao' => '3.5',
                'descricao' => 'Um guerreiro sagrado que defende a justiça, destrói o mal e protege os inocentes.',
                'dado_vida' => 10,
                'bba_progressao' => 'boa',
                'resistencia_fortitude' => 'boa',
                'resistencia_reflexos' => 'ruim',
                'resistencia_vontade' => 'ruim',
                'pontos_pericia' => 2,
            ],
            [
                'nome' => 'Ranger',
                'versao' => '3.5',
                'descricao' => 'Um caçador selvagem e rastreador, hábil no combate com duas armas ou arco e flecha.',
                'dado_vida' => 8,
                'bba_progressao' => 'boa',
                'resistencia_fortitude' => 'boa',
                'resistencia_reflexos' => 'boa',
                'resistencia_vontade' => 'ruim',
                'pontos_pericia' => 6,
            ]
        ];

        foreach ($classes as $classe) {
            \App\Models\Classe::updateOrCreate(
                ['nome' => $classe['nome'], 'versao' => $classe['versao']],
                $classe
            );
        }
    }
}
