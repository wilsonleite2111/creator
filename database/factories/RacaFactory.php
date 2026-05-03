<?php

namespace Database\Factories;

use App\Models\Raca;
use Illuminate\Database\Eloquent\Factories\Factory;

class RacaFactory extends Factory
{
    protected $model = Raca::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(),
            'versao' => '3.5',
            'descricao' => $this->faker->paragraph(),
            'mod_forca' => $this->faker->numberBetween(-2, 4),
            'mod_destreza' => $this->faker->numberBetween(-2, 4),
            'mod_constituicao' => $this->faker->numberBetween(-2, 4),
            'mod_inteligencia' => $this->faker->numberBetween(-2, 4),
            'mod_sabedoria' => $this->faker->numberBetween(-2, 4),
            'mod_carisma' => $this->faker->numberBetween(-2, 4),
            'tamanho' => 'Médio',
            'deslocamento' => '9m',
        ];
    }
}
