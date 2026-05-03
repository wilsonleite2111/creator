<?php

namespace Database\Factories;

use App\Models\Divindade;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivindadeFactory extends Factory
{
    protected $model = Divindade::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(),
            'titulo' => $this->faker->sentence(),
            'versao' => '3.5',
            'tendencia' => 'Leal e Bom',
            'dominios' => 'Bem, Proteção',
            'arma_preferida' => 'Espada Longa',
            'descricao' => $this->faker->paragraph(),
        ];
    }
}
