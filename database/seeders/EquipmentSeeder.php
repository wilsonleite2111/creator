<?php

namespace Database\Seeders;

use App\Models\Arma;
use App\Models\Armadura;
use App\Models\Equipamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpar tabelas
        Schema::disableForeignKeyConstraints();
        Arma::truncate();
        Armadura::truncate();
        Equipamento::truncate();
        Schema::enableForeignKeyConstraints();

        // --- ARMAS ---
        $armas = [
            // Simples Corpo-a-Corpo - Leves
            ['nome' => 'Adaga', 'preco' => '2 PO', 'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => '19-20/x2', 'alcance' => '3m', 'peso' => 0.5, 'tipo' => 'P ou C', 'categoria' => 'Simples', 'uso' => 'Leve'],
            ['nome' => 'Adaga de Soco', 'preco' => '2 PO', 'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => 'x3', 'alcance' => '-', 'peso' => 0.5, 'tipo' => 'P', 'categoria' => 'Simples', 'uso' => 'Leve'],
            ['nome' => 'Manopla', 'preco' => '2 PO', 'dano_p' => '1d2', 'dano_m' => '1d3', 'critico' => 'x2', 'alcance' => '-', 'peso' => 0.5, 'tipo' => 'I', 'categoria' => 'Simples', 'uso' => 'Leve'],
            ['nome' => 'Maça Leve', 'preco' => '5 PO', 'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '-', 'peso' => 2, 'tipo' => 'I', 'categoria' => 'Simples', 'uso' => 'Leve'],
            ['nome' => 'Hoz', 'preco' => '6 PO', 'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '-', 'peso' => 1, 'tipo' => 'C', 'categoria' => 'Simples', 'uso' => 'Leve'],
            
            // Simples Corpo-a-Corpo - Uma Mão
            ['nome' => 'Maça Pesada', 'preco' => '12 PO', 'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x2', 'alcance' => '-', 'peso' => 4, 'tipo' => 'I', 'categoria' => 'Simples', 'uso' => 'Uma Mão'],
            ['nome' => 'Lança Curta', 'preco' => '1 PO', 'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '6m', 'peso' => 1.5, 'tipo' => 'P', 'categoria' => 'Simples', 'uso' => 'Uma Mão'],
            
            // Simples Corpo-a-Corpo - Duas Mãos
            ['nome' => 'Lança Longa', 'preco' => '5 PO', 'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '-', 'peso' => 4.5, 'tipo' => 'P', 'categoria' => 'Simples', 'uso' => 'Duas Mãos'],
            ['nome' => 'Bordão', 'preco' => '-', 'dano_p' => '1d4/1d4', 'dano_m' => '1d6/1d6', 'critico' => 'x2', 'alcance' => '-', 'peso' => 2, 'tipo' => 'I', 'categoria' => 'Simples', 'uso' => 'Duas Mãos'],
            ['nome' => 'Lança Pesada', 'preco' => '2 PO', 'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '6m', 'peso' => 3, 'tipo' => 'P', 'categoria' => 'Simples', 'uso' => 'Duas Mãos'],

            // Marcial Corpo-a-Corpo - Leves
            ['nome' => 'Machadinha', 'preco' => '6 PO', 'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x3', 'alcance' => '-', 'peso' => 1.5, 'tipo' => 'C', 'categoria' => 'Marcial', 'uso' => 'Leve'],
            ['nome' => 'Cimitarra Leve', 'preco' => '15 PO', 'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => '18-20/x2', 'alcance' => '-', 'peso' => 1, 'tipo' => 'C', 'categoria' => 'Marcial', 'uso' => 'Leve'],
            ['nome' => 'Espada Curta', 'preco' => '10 PO', 'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => '19-20/x2', 'alcance' => '-', 'peso' => 1, 'tipo' => 'P', 'categoria' => 'Marcial', 'uso' => 'Leve'],

            // Marcial Corpo-a-Corpo - Uma Mão
            ['nome' => 'Machado de Batalha', 'preco' => '10 PO', 'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '-', 'peso' => 3, 'tipo' => 'C', 'categoria' => 'Marcial', 'uso' => 'Uma Mão'],
            ['nome' => 'Cimitarra', 'preco' => '20 PO', 'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => '18-20/x2', 'alcance' => '-', 'peso' => 2, 'tipo' => 'C', 'categoria' => 'Marcial', 'uso' => 'Uma Mão'],
            ['nome' => 'Espada Longa', 'preco' => '15 PO', 'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => '19-20/x2', 'alcance' => '-', 'peso' => 2, 'tipo' => 'C', 'categoria' => 'Marcial', 'uso' => 'Uma Mão'],
            ['nome' => 'Tridente', 'preco' => '15 PO', 'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x2', 'alcance' => '3m', 'peso' => 2, 'tipo' => 'P', 'categoria' => 'Marcial', 'uso' => 'Uma Mão'],
            ['nome' => 'Martelo de Guerra', 'preco' => '12 PO', 'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '-', 'peso' => 2.5, 'tipo' => 'I', 'categoria' => 'Marcial', 'uso' => 'Uma Mão'],

            // Marcial Corpo-a-Corpo - Duas Mãos
            ['nome' => 'Machado Grande', 'preco' => '20 PO', 'dano_p' => '1d10', 'dano_m' => '1d12', 'critico' => 'x3', 'alcance' => '-', 'peso' => 6, 'tipo' => 'C', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos'],
            ['nome' => 'Falcione', 'preco' => '75 PO', 'dano_p' => '1d6', 'dano_m' => '2d4', 'critico' => '18-20/x2', 'alcance' => '-', 'peso' => 4, 'tipo' => 'C', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos'],
            ['nome' => 'Glaive', 'preco' => '8 PO', 'dano_p' => '1d8', 'dano_m' => '1d10', 'critico' => 'x3', 'alcance' => '-', 'peso' => 5, 'tipo' => 'C', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos'],
            ['nome' => 'Alabarda', 'preco' => '10 PO', 'dano_p' => '1d8', 'dano_m' => '1d10', 'critico' => 'x3', 'alcance' => '-', 'peso' => 6, 'tipo' => 'C ou P', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos'],
            ['nome' => 'Espada Grande', 'preco' => '50 PO', 'dano_p' => '1d10', 'dano_m' => '2d6', 'critico' => '19-20/x2', 'alcance' => '-', 'peso' => 4, 'tipo' => 'C', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos'],

            // Ataque à Distância
            ['nome' => 'Besta Leve', 'preco' => '35 PO', 'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => '19-20/x2', 'alcance' => '24m', 'peso' => 2, 'tipo' => 'P', 'categoria' => 'Simples', 'uso' => 'Distância'],
            ['nome' => 'Besta Pesada', 'preco' => '50 PO', 'dano_p' => '1d8', 'dano_m' => '1d10', 'critico' => '19-20/x2', 'alcance' => '36m', 'peso' => 4, 'tipo' => 'P', 'categoria' => 'Simples', 'uso' => 'Distância'],
            ['nome' => 'Dardo', 'preco' => '5 PP', 'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => 'x2', 'alcance' => '6m', 'peso' => 0.25, 'tipo' => 'P', 'categoria' => 'Simples', 'uso' => 'Distância'],
            ['nome' => 'Arco Curto', 'preco' => '30 PO', 'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x3', 'alcance' => '18m', 'peso' => 1, 'tipo' => 'P', 'categoria' => 'Marcial', 'uso' => 'Distância'],
            ['nome' => 'Arco Longo', 'preco' => '75 PO', 'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '30m', 'peso' => 1.5, 'tipo' => 'P', 'categoria' => 'Marcial', 'uso' => 'Distância'],
        ];

        foreach ($armas as $arma) {
            Arma::create($arma);
        }

        // --- ARMADURAS ---
        $armaduras = [
            ['nome' => 'Acolchoada', 'preco' => '5 PO', 'bonus_ca' => 1, 'destreza_max' => 8, 'penalidade_armadura' => 0, 'falha_arcana' => 5, 'deslocamento_9m' => '9m', 'deslocamento_6m' => '6m', 'peso' => 5, 'tipo' => 'Leve'],
            ['nome' => 'Couro', 'preco' => '10 PO', 'bonus_ca' => 2, 'destreza_max' => 6, 'penalidade_armadura' => 0, 'falha_arcana' => 10, 'deslocamento_9m' => '9m', 'deslocamento_6m' => '6m', 'peso' => 7.5, 'tipo' => 'Leve'],
            ['nome' => 'Couro Batido', 'preco' => '25 PO', 'bonus_ca' => 3, 'destreza_max' => 5, 'penalidade_armadura' => -1, 'falha_arcana' => 15, 'deslocamento_9m' => '9m', 'deslocamento_6m' => '6m', 'peso' => 10, 'tipo' => 'Leve'],
            ['nome' => 'Camisão de Cota de Malha', 'preco' => '100 PO', 'bonus_ca' => 4, 'destreza_max' => 4, 'penalidade_armadura' => -2, 'falha_arcana' => 20, 'deslocamento_9m' => '9m', 'deslocamento_6m' => '6m', 'peso' => 12.5, 'tipo' => 'Leve'],
            
            ['nome' => 'Couro Batido Reforçado', 'preco' => '15 PO', 'bonus_ca' => 3, 'destreza_max' => 4, 'penalidade_armadura' => -3, 'falha_arcana' => 20, 'deslocamento_9m' => '6m', 'deslocamento_6m' => '4.5m', 'peso' => 10, 'tipo' => 'Média'],
            ['nome' => 'Brunea', 'preco' => '50 PO', 'bonus_ca' => 4, 'destreza_max' => 3, 'penalidade_armadura' => -4, 'falha_arcana' => 25, 'deslocamento_9m' => '6m', 'deslocamento_6m' => '4.5m', 'peso' => 15, 'tipo' => 'Média'],
            ['nome' => 'Cota de Malha', 'preco' => '150 PO', 'bonus_ca' => 5, 'destreza_max' => 2, 'penalidade_armadura' => -5, 'falha_arcana' => 30, 'deslocamento_9m' => '6m', 'deslocamento_6m' => '4.5m', 'peso' => 20, 'tipo' => 'Média'],
            ['nome' => 'Couraça', 'preco' => '200 PO', 'bonus_ca' => 5, 'destreza_max' => 3, 'penalidade_armadura' => -4, 'falha_arcana' => 25, 'deslocamento_9m' => '6m', 'deslocamento_6m' => '4.5m', 'peso' => 15, 'tipo' => 'Média'],

            ['nome' => 'Cota de Talas', 'preco' => '200 PO', 'bonus_ca' => 6, 'destreza_max' => 0, 'penalidade_armadura' => -7, 'falha_arcana' => 35, 'deslocamento_9m' => '6m', 'deslocamento_6m' => '4.5m', 'peso' => 22.5, 'tipo' => 'Pesada'],
            ['nome' => 'Cota de Anéis', 'preco' => '250 PO', 'bonus_ca' => 7, 'destreza_max' => 1, 'penalidade_armadura' => -6, 'falha_arcana' => 35, 'deslocamento_9m' => '6m', 'deslocamento_6m' => '4.5m', 'peso' => 25, 'tipo' => 'Pesada'],
            ['nome' => 'Placas', 'preco' => '600 PO', 'bonus_ca' => 7, 'destreza_max' => 0, 'penalidade_armadura' => -7, 'falha_arcana' => 40, 'deslocamento_9m' => '6m', 'deslocamento_6m' => '4.5m', 'peso' => 25, 'tipo' => 'Pesada'],
            ['nome' => 'Armadura Completa', 'preco' => '1.500 PO', 'bonus_ca' => 8, 'destreza_max' => 1, 'penalidade_armadura' => -6, 'falha_arcana' => 35, 'deslocamento_9m' => '6m', 'deslocamento_6m' => '4.5m', 'peso' => 25, 'tipo' => 'Pesada'],

            ['nome' => 'Escudo de Corpo', 'preco' => '30 PO', 'bonus_ca' => 4, 'destreza_max' => 2, 'penalidade_armadura' => -10, 'falha_arcana' => 50, 'deslocamento_9m' => '-', 'deslocamento_6m' => '-', 'peso' => 22.5, 'tipo' => 'Escudo'],
            ['nome' => 'Escudo Pesado', 'preco' => '7 PO', 'bonus_ca' => 2, 'destreza_max' => null, 'penalidade_armadura' => -2, 'falha_arcana' => 15, 'deslocamento_9m' => '-', 'deslocamento_6m' => '-', 'peso' => 7.5, 'tipo' => 'Escudo'],
            ['nome' => 'Escudo Leve', 'preco' => '3 PO', 'bonus_ca' => 1, 'destreza_max' => null, 'penalidade_armadura' => -1, 'falha_arcana' => 5, 'deslocamento_9m' => '-', 'deslocamento_6m' => '-', 'peso' => 2.5, 'tipo' => 'Escudo'],
        ];

        foreach ($armaduras as $armadura) {
            Armadura::create($armadura);
        }

        // --- EQUIPAMENTOS ---
        $equipamentos = [
            ['nome' => 'Mochila (vazia)', 'preco' => '2 PO', 'peso' => 1, 'descricao' => 'Capacidade 30kg.'],
            ['nome' => 'Barril (vazio)', 'preco' => '2 PO', 'peso' => 15, 'descricao' => 'Capacidade 150 litros.'],
            ['nome' => 'Cesto (vazio)', 'preco' => '4 PP', 'peso' => 0.5, 'descricao' => 'Capacidade 10kg.'],
            ['nome' => 'Garrafa de Vidro', 'preco' => '2 PO', 'peso' => 0.25, 'descricao' => 'Capacidade 0.75 litros.'],
            ['nome' => 'Balde (vazio)', 'preco' => '5 PC', 'peso' => 1, 'descricao' => 'Capacidade 15 litros.'],
            ['nome' => 'Baú (vazio)', 'preco' => '2 PO', 'peso' => 12.5, 'descricao' => 'Capacidade 100kg.'],
            ['nome' => 'Cantil', 'preco' => '1 PO', 'peso' => 2, 'descricao' => 'Cheio pesa 2kg.'],
            ['nome' => 'Saco (vazio)', 'preco' => '1 PP', 'peso' => 0.25, 'descricao' => 'Capacidade 15kg.'],
            
            ['nome' => 'Corda de Cânhamo (15m)', 'preco' => '1 PO', 'peso' => 5, 'descricao' => 'Resistente.'],
            ['nome' => 'Corda de Seda (15m)', 'preco' => '10 PO', 'peso' => 2.5, 'descricao' => 'Leve e forte.'],
            ['nome' => 'Pederneira e Isqueiro', 'preco' => '1 PO', 'peso' => 0, 'descricao' => 'Para fogo.'],
            ['nome' => 'Lanterna Furta-Fogo', 'preco' => '7 PO', 'peso' => 1, 'descricao' => 'Luz direcional.'],
            ['nome' => 'Lanterna a Óleo', 'preco' => '12 PO', 'peso' => 1, 'descricao' => 'Luz clara.'],
            ['nome' => 'Tocha', 'preco' => '1 PC', 'peso' => 0.5, 'descricao' => 'Luz por 1 hora.'],
            ['nome' => 'Óleo (frasco)', 'preco' => '1 PP', 'peso' => 0.5, 'descricao' => 'Combustível.'],
            
            ['nome' => 'Ração de Viagem (dia)', 'preco' => '5 PP', 'peso' => 0.5, 'descricao' => 'Comida seca.'],
            ['nome' => 'Estojo de Primeiros Socorros', 'preco' => '50 PO', 'peso' => 0.5, 'descricao' => '+2 em testes de Cura.'],
            ['nome' => 'Símbolo Sagrado (Madeira)', 'preco' => '1 PO', 'peso' => 0, 'descricao' => 'Foco divino.'],
            ['nome' => 'Símbolo Sagrado (Prata)', 'preco' => '25 PO', 'peso' => 0.5, 'descricao' => 'Foco divino luxuoso.'],
            ['nome' => 'Grimório (vazio)', 'preco' => '15 PO', 'peso' => 1.5, 'descricao' => '100 páginas de pergaminho.'],
        ];

        foreach ($equipamentos as $equip) {
            Equipamento::create($equip);
        }
    }
}
