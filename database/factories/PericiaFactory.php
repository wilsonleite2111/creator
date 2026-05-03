<?php

namespace Database\Factories;

use App\Models\Pericia;
use Illuminate\Database\Eloquent\Factories\Factory;

class PericiaFactory extends Factory
{
    protected $model = Pericia::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(),
            'versao' => '3.5',
            'descricao' => $this->faker->paragraph(),
            'habilidade_chave' => $this->faker->randomElement(['FOR', 'DES', 'CON', 'INT', 'SAB', 'CAR']),
        ];
    }
}
