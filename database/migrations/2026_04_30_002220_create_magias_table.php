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
        Schema::create('magias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('escola')->nullable();
            $table->string('componentes')->nullable();
            $table->string('tempo_execucao')->nullable();
            $table->string('alcance')->nullable();
            $table->string('alvo_area_efeito')->nullable();
            $table->string('duracao')->nullable();
            $table->string('teste_resistencia')->nullable();
            $table->string('resistencia_magia')->nullable();
            $table->text('descricao')->nullable();
            $table->string('versao')->default('3.5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magias');
    }
};
