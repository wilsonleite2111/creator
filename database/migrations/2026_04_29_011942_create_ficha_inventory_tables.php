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
        Schema::dropIfExists('ficha_inventory_tables');
        
        Schema::create('ficha_arma', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ficha_id');
            $table->unsignedBigInteger('arma_id');
            $table->integer('quantidade')->default(1);
            $table->boolean('esta_equipado')->default(false);
            $table->timestamps();

            $table->foreign('ficha_id')->references('id')->on('fichas')->onDelete('cascade');
            $table->foreign('arma_id')->references('id')->on('armas')->onDelete('cascade');
        });

        Schema::create('ficha_armadura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ficha_id');
            $table->unsignedBigInteger('armadura_id');
            $table->boolean('esta_equipado')->default(false);
            $table->timestamps();

            $table->foreign('ficha_id')->references('id')->on('fichas')->onDelete('cascade');
            $table->foreign('armadura_id')->references('id')->on('armaduras')->onDelete('cascade');
        });

        Schema::create('ficha_equipamento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ficha_id');
            $table->unsignedBigInteger('equipamento_id');
            $table->integer('quantidade')->default(1);
            $table->timestamps();

            $table->foreign('ficha_id')->references('id')->on('fichas')->onDelete('cascade');
            $table->foreign('equipamento_id')->references('id')->on('equipamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_arma');
        Schema::dropIfExists('ficha_armadura');
        Schema::dropIfExists('ficha_equipamento');
    }
};
