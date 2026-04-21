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
        Schema::create('fichas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_personagem', 100);
            $table->string('nome_jogador', 100);
            $table->integer('raca_id')->unsigned();
            $table->integer('tendencia_id')->unsigned();
            $table->string('divindade', 100);
            $table->string('tamanho', 10);
            $table->integer('idade');
            $table->string('sexo', 10);
            $table->float('altura');
            $table->float('peso');
            $table->string('olhos');
            $table->string('cabelos');
            $table->string('pele');


            $table->foreign('raca_id')->references('id')->on('racas');
            $table->foreign('tendencia_id')->references('id')->on('tendencias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichas');
    }
};

