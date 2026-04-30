<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Magia;
use App\Models\Classe;

class MagiaSeeder extends Seeder
{
    public function run(): void
    {
        $mago = Classe::where('nome', 'Mago')->first();
        $feiticeiro = Classe::where('nome', 'Feiticeiro')->first();
        $bardo = Classe::where('nome', 'Bardo')->first();

        $bolaDeFogo = Magia::create([
            'nome' => 'Bola de Fogo',
            'escola' => 'Evocação [Fogo]',
            'componentes' => 'V, S, M (uma bola de guano de morcego e enxofre)',
            'tempo_execucao' => '1 ação padrão',
            'alcance' => 'Longo (120m + 12m/nível)',
            'alvo_area_efeito' => 'Explosão com 6m de raio',
            'duracao' => 'Instantânea',
            'teste_resistencia' => 'Reflexos parcial',
            'resistencia_magia' => 'Sim',
            'descricao' => 'Uma bola de fogo é uma explosão de chama que detona com um estampido baixo e causa dano de fogo a todas as criaturas na área. O dano é de 1d6 por nível de conjurador (máximo 10d6).',
            'versao' => '3.5'
        ]);

        if ($mago) $bolaDeFogo->classes()->attach($mago->id, ['nivel' => 3]);
        if ($feiticeiro) $bolaDeFogo->classes()->attach($feiticeiro->id, ['nivel' => 3]);

        $sono = Magia::create([
            'nome' => 'Sono',
            'escola' => 'Encantamento (Compulsão) [Mental]',
            'componentes' => 'V, S, M (um pouco de areia fina, pétalas de rosa ou um grilo vivo)',
            'tempo_execucao' => '1 rodada completa',
            'alcance' => 'Médio (30m + 3m/nível)',
            'alvo_area_efeito' => 'Uma ou mais criaturas vivas em uma explosão com 3m de raio',
            'duracao' => '1 min./nível',
            'teste_resistencia' => 'Vontade anula',
            'resistencia_magia' => 'Sim',
            'descricao' => 'Uma magia de sono faz com que um estado de torpor mágico caia sobre 4 Dados de Vida de criaturas.',
            'versao' => '3.5'
        ]);

        if ($mago) $sono->classes()->attach($mago->id, ['nivel' => 1]);
        if ($bardo) $sono->classes()->attach($bardo->id, ['nivel' => 1]);
    }
}
