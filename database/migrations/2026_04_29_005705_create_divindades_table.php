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
        Schema::create('divindades', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('titulo')->nullable();
            $table->string('versao')->nullable();
            $table->string('tendencia')->nullable();
            $table->string('dominios')->nullable();
            $table->string('arma_preferida')->nullable();
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divindades');
    }
};
