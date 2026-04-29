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
        Schema::create('armas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('preco')->nullable();
            $table->string('dano_p')->nullable();
            $table->string('dano_m')->nullable();
            $table->string('critico')->nullable();
            $table->string('alcance')->nullable();
            $table->float('peso')->nullable();
            $table->string('tipo')->nullable(); // Cortante, Perfurante, Impacto
            $table->string('categoria')->nullable(); // Simples, Comum, Exótica
            $table->string('uso')->nullable(); // Leve, Uma Mão, Duas Mãos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armas');
    }
};
