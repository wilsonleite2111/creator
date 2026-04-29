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
            $table->unsignedBigInteger('classe_id')->after('raca_id')->nullable();
            $table->integer('nivel')->default(1)->after('classe_id');
            
            // Atributos (Valores base sem modificadores raciais)
            $table->integer('forca_base')->default(10);
            $table->integer('destreza_base')->default(10);
            $table->integer('constituicao_base')->default(10);
            $table->integer('inteligencia_base')->default(10);
            $table->integer('sabedoria_base')->default(10);
            $table->integer('carisma_base')->default(10);
            
            // Pontos de Vida
            $table->integer('pv_max')->default(0);
            $table->integer('pv_atual')->default(0);
            
            // Parâmetros de Combate (Base)
            $table->integer('bab')->default(0);
            $table->integer('fortitude_base')->default(0);
            $table->integer('reflexos_base')->default(0);
            $table->integer('vontade_base')->default(0);

            $table->foreign('classe_id')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fichas', function (Blueprint $table) {
            $table->dropForeign(['classe_id']);
            $table->dropColumn([
                'classe_id', 'nivel', 'forca_base', 'destreza_base', 
                'constituicao_base', 'inteligencia_base', 'sabedoria_base', 
                'carisma_base', 'pv_max', 'pv_atual', 'bab', 
                'fortitude_base', 'reflexos_base', 'vontade_base'
            ]);
        });
    }
};
