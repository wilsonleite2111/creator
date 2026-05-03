<?php

namespace Database\Factories;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClasseFactory extends Factory
{
    protected $model = Classe::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(),
            'versao' => '3.5',
            'descricao' => $this->faker->paragraph(),
            'dado_vida' => 'd' . $this->faker->randomElement([4, 6, 8, 10, 12]),
            'bba_progressao' => 'Alta',
            'resistencia_fortitude' => 'Boa',
            'resistencia_reflexos' => 'Ruim',
            'resistencia_vontade' => 'Ruim',
            'pontos_pericia' => $this->faker->numberBetween(2, 8),
        ];
    }
}
