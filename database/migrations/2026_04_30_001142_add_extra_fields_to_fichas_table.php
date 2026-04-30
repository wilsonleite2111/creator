<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('fichas', function (Blueprint $table) {
            // AC Breakdown
            $table->integer('ca_armadura')->default(0)->after('ca_natural');
            $table->integer('ca_escudo')->default(0)->after('ca_armadura');
            $table->integer('ca_tamanho')->default(0)->after('ca_escudo');
            
            // Saving Throw Magic Modifiers
            $table->integer('fortitude_magia')->default(0)->after('fortitude_misc');
            $table->integer('reflexos_magia')->default(0)->after('reflexos_misc');
            $table->integer('vontade_magia')->default(0)->after('vontade_misc');
            
            // Grapple Size
            $table->integer('agarre_tamanho')->default(0)->after('agarre_misc');
            
            // Currency
            $table->integer('dinheiro_pc')->default(0)->after('ouro');
            $table->integer('dinheiro_pp')->default(0)->after('dinheiro_pc');
            $table->integer('dinheiro_pl')->default(0)->after('dinheiro_pp');
            
            // Experience
            $table->integer('xp_proximo')->default(1000)->after('xp_atual');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fichas', function (Blueprint $table) {
            $table->dropColumn([
                'ca_armadura', 'ca_escudo', 'ca_tamanho',
                'fortitude_magia', 'reflexos_magia', 'vontade_magia',
                'agarre_tamanho', 'dinheiro_pc', 'dinheiro_pp', 'dinheiro_pl', 'xp_proximo'
            ]);
        });
    }
};
