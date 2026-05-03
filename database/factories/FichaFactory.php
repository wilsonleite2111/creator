<?php

namespace Database\Factories;

use App\Models\Ficha;
use App\Models\Raca;
use App\Models\Classe;
use App\Models\Tendencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class FichaFactory extends Factory
{
    protected $model = Ficha::class;

    public function definition(): array
    {
        return [
            'nome_personagem' => $this->faker->name(),
            'nome_jogador' => $this->faker->name(),
            'raca_id' => Raca::factory(),
            'classe_id' => Classe::factory(),
            'tendencia_id' => Tendencia::factory(),
            'versao' => '3.5',
            'nivel' => $this->faker->numberBetween(1, 20),
            'ouro' => $this->faker->numberBetween(0, 1000),
            'divindade' => $this->faker->word(),
            'tamanho' => 'Médio',
            'idade' => $this->faker->numberBetween(18, 100),
            'sexo' => $this->faker->randomElement(['Masculino', 'Feminino']),
            'altura' => $this->faker->randomElement([1.70, 1.80, 1.60]),
            'peso' => $this->faker->randomElement([70.5, 80.0, 60.2]),
            'olhos' => $this->faker->safeColorName(),
            'cabelos' => $this->faker->safeColorName(),
            'pele' => $this->faker->safeColorName(),
            'forca_base' => $this->faker->numberBetween(8, 18),
            'destreza_base' => $this->faker->numberBetween(8, 18),
            'constituicao_base' => $this->faker->numberBetween(8, 18),
            'inteligencia_base' => $this->faker->numberBetween(8, 18),
            'sabedoria_base' => $this->faker->numberBetween(8, 18),
            'carisma_base' => $this->faker->numberBetween(8, 18),
            'pv_max' => $this->faker->numberBetween(10, 200),
            'pv_atual' => $this->faker->numberBetween(10, 200),
            'bab' => $this->faker->numberBetween(0, 20),
            'fortitude_base' => $this->faker->numberBetween(0, 12),
            'reflexos_base' => $this->faker->numberBetween(0, 12),
            'vontade_base' => $this->faker->numberBetween(0, 12),
            'deslocamento' => '9m',
            'iniciativa_misc' => 0,
            'ca_natural' => 0,
            'ca_armadura' => 0,
            'ca_escudo' => 0,
            'ca_tamanho' => 0,
            'ca_deflexao' => 0,
            'ca_misc' => 0,
            'fortitude_misc' => 0,
            'fortitude_magia' => 0,
            'reflexos_misc' => 0,
            'reflexos_magia' => 0,
            'vontade_misc' => 0,
            'vontade_magia' => 0,
            'agarre_misc' => 0,
            'agarre_tamanho' => 0,
            'xp_atual' => 0,
            'xp_proximo' => 1000,
            'dinheiro_pc' => 0,
            'dinheiro_pp' => 0,
            'dinheiro_pl' => 0,
            'notas_combate' => $this->faker->sentence(),
            'idiomas' => 'Comum',
            'talentos_descricao' => $this->faker->paragraph(),
            'habilidades_especiais' => $this->faker->paragraph(),
        ];
    }
}
