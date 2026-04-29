<?php

namespace Database\Seeders;

use App\Models\Talento;
use Illuminate\Database\Seeder;

class TalentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $talentos = [
            [
                'nome' => 'Ataque Poderoso',
                'versao' => '3.5',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Força 13',
                'beneficio' => 'O personagem pode subtrair um valor de sua jogada de ataque e adicioná-lo à sua jogada de dano (até o limite do seu BBA).',
                'descricao' => 'Você é capaz de realizar ataques brutais sacrificando precisão por força bruta.',
            ],
            [
                'nome' => 'Especialização em Combate',
                'versao' => '3.5',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Inteligência 13',
                'beneficio' => 'O personagem pode subtrair um valor de sua jogada de ataque e adicioná-lo à sua CA como um bônus de esquiva.',
                'descricao' => 'Você utiliza sua inteligência para lutar de forma defensiva e técnica.',
            ],
            [
                'nome' => 'Esquiva',
                'versao' => '3.5',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Destreza 13',
                'beneficio' => 'O personagem recebe +1 de bônus de esquiva na CA contra um oponente designado durante seu turno.',
                'descricao' => 'Seus reflexos permitem que você evite ataques com facilidade.',
            ],
            [
                'nome' => 'Iniciativa Aprimorada',
                'versao' => '3.5',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => 'O personagem recebe +4 de bônus em testes de iniciativa.',
                'descricao' => 'Você reage mais rápido que a maioria em situações de combate.',
            ],
            [
                'nome' => 'Tiro Certeiro',
                'versao' => '3.5',
                'tipo' => 'Combate',
                'pre_requisitos' => null,
                'beneficio' => 'O personagem recebe +1 de bônus nas jogadas de ataque e dano com armas de ataque à distância contra alvos a até 9 metros.',
                'descricao' => 'Sua precisão com armas de longo alcance é excepcional em distâncias curtas.',
            ],
            [
                'nome' => 'Vitalidade',
                'versao' => '3.5',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => 'O personagem recebe +3 pontos de vida.',
                'descricao' => 'Você é mais resistente e durão que a média.',
            ],
            [
                'nome' => 'Vontade de Ferro',
                'versao' => '3.5',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => 'O personagem recebe +2 de bônus em todos os testes de resistência de Vontade.',
                'descricao' => 'Sua mente é uma fortaleza contra influências externas.',
            ],
            [
                'nome' => 'Grande Fortitude',
                'versao' => '3.5',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => 'O personagem recebe +2 de bônus em todos os testes de resistência de Fortitude.',
                'descricao' => 'Seu corpo é extremamente resiliente a venenos e exaustão.',
            ],
            [
                'nome' => 'Reflexos Rápidos',
                'versao' => '3.5',
                'tipo' => 'Geral',
                'pre_requisitos' => null,
                'beneficio' => 'O personagem recebe +2 de bônus em todos os testes de resistência de Reflexos.',
                'descricao' => 'Sua agilidade natural permite que você escape de perigos repentinos.',
            ],
            [
                'nome' => 'Foco em Arma',
                'versao' => '3.5',
                'tipo' => 'Combate',
                'pre_requisitos' => 'Proficiência com a arma escolhida, BBA +1',
                'beneficio' => 'O personagem recebe +1 de bônus em todas as jogadas de ataque com a arma selecionada.',
                'descricao' => 'Você se especializou no uso de uma arma específica.',
            ],
        ];

        foreach ($talentos as $talento) {
            Talento::updateOrCreate(
                ['nome' => $talento['nome'], 'versao' => '3.5'],
                $talento
            );
        }
    }
}
