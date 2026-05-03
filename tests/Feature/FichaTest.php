<?php

namespace Tests\Feature;

use App\Models\Ficha;
use App\Models\User;
use App\Models\Raca;
use App\Models\Classe;
use App\Models\Tendencia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FichaTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_fichas()
    {
        Ficha::factory()->count(3)->create();

        $response = $this->get(route('fichas.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('Fichas/Index'));
    }

    public function test_can_show_create_ficha_form()
    {
        $response = $this->get(route('fichas.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('Fichas/Create'));
    }

    public function test_can_store_new_ficha()
    {
        $raca = Raca::factory()->create(['versao' => '3.5']);
        $classe = Classe::factory()->create(['versao' => '3.5']);
        $tendencia = Tendencia::factory()->create();

        $data = [
            'versao' => '3.5',
            'nome_personagem' => 'Grog the Barbarian',
            'nome_jogador' => 'Wilson',
            'raca_id' => $raca->id,
            'classe_id' => $classe->id,
            'tendencia_id' => $tendencia->id,
            'nivel' => 1,
            'ouro' => 100,
            'forca_base' => 18,
            'destreza_base' => 12,
            'constituicao_base' => 16,
            'inteligencia_base' => 8,
            'sabedoria_base' => 10,
            'carisma_base' => 12,
            'pv_max' => 12,
            'bab' => 1,
            'fortitude_base' => 2,
            'reflexos_base' => 0,
            'vontade_base' => 0,
            'xp_atual' => 0,
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
            'dinheiro_pc' => 0,
            'dinheiro_pp' => 0,
            'dinheiro_pl' => 0,
            'xp_proximo' => 1000,
        ];

        $response = $this->post(route('fichas.store'), $data);

        $response->assertRedirect(route('fichas.index'));
        $this->assertDatabaseHas('fichas', [
            'nome_personagem' => 'Grog the Barbarian'
        ]);
    }

    public function test_can_show_ficha()
    {
        $ficha = Ficha::factory()->create();

        $response = $this->get(route('fichas.show', $ficha));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('Fichas/Show'));
    }

    public function test_can_update_ficha()
    {
        $ficha = Ficha::factory()->create(['nome_personagem' => 'Old Name']);

        $data = $ficha->toArray();
        $data['nome_personagem'] = 'New Name';

        $response = $this->put(route('fichas.update', $ficha), $data);

        $response->assertRedirect(route('fichas.show', $ficha));
        $this->assertDatabaseHas('fichas', [
            'id' => $ficha->id,
            'nome_personagem' => 'New Name'
        ]);
    }

    public function test_can_delete_ficha()
    {
        $ficha = Ficha::factory()->create();

        $response = $this->delete(route('fichas.destroy', $ficha));

        $response->assertRedirect(route('fichas.index'));
        $this->assertDatabaseMissing('fichas', ['id' => $ficha->id]);
    }
}
