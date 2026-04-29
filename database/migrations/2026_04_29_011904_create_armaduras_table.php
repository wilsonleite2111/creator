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
        Schema::create('armaduras', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('preco')->nullable();
            $table->integer('bonus_ca')->default(0);
            $table->integer('destreza_max')->nullable();
            $table->integer('penalidade_armadura')->default(0);
            $table->integer('falha_arcana')->default(0);
            $table->string('deslocamento_9m')->nullable();
            $table->string('deslocamento_6m')->nullable();
            $table->float('peso')->nullable();
            $table->string('tipo')->nullable(); // Leve, Média, Pesada, Escudo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armaduras');
    }
};
