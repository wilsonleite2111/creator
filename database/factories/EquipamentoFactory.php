<?php

namespace Database\Factories;

use App\Models\Equipamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipamentoFactory extends Factory
{
    protected $model = Equipamento::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(),
            'preco' => $this->faker->numberBetween(1, 100) . ' po',
            'peso' => $this->faker->randomFloat(1, 0.1, 50),
            'descricao' => $this->faker->sentence(),
        ];
    }
}
