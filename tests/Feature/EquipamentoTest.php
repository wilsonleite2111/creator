<?php

namespace Tests\Feature;

use App\Models\Equipamento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipamentoTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_equipamentos()
    {
        Equipamento::factory()->count(3)->create();

        $response = $this->get(route('equipamentos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('equipamentos.index');
        $response->assertViewHas('equipamentos');
    }

    public function test_can_show_create_equipamento_form()
    {
        $response = $this->get(route('equipamentos.create'));

        $response->assertStatus(200);
        $response->assertViewIs('equipamentos.create');
    }

    public function test_can_store_new_equipamento()
    {
        $data = [
            'nome' => 'Espada Longa',
            'preco' => '15 po',
            'peso' => 2.0,
            'descricao' => 'Uma espada versátil.'
        ];

        $response = $this->post(route('equipamentos.store'), $data);

        $response->assertRedirect(route('equipamentos.index'));
        $this->assertDatabaseHas('equipamentos', [
            'nome' => 'Espada Longa'
        ]);
    }
}
