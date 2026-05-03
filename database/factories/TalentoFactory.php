<?php

namespace Database\Factories;

use App\Models\Talento;
use Illuminate\Database\Eloquent\Factories\Factory;

class TalentoFactory extends Factory
{
    protected $model = Talento::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(),
            'versao' => '3.5',
            'tipo' => 'Geral',
            'pre_requisitos' => $this->faker->sentence(),
            'beneficio' => $this->faker->paragraph(),
            'descricao' => $this->faker->paragraph(),
        ];
    }
}
