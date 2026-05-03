<?php

namespace Database\Factories;

use App\Models\Tendencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class TendenciaFactory extends Factory
{
    protected $model = Tendencia::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(),
            'apelido' => $this->faker->word(),
            'iniciais' => strtoupper($this->faker->lexify('??')),
            'descricao' => $this->faker->paragraph(),
        ];
    }
}
