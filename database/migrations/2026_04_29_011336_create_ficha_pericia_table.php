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
        Schema::create('ficha_pericia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ficha_id');
            $table->unsignedBigInteger('pericia_id');
            $table->float('graduacoes')->default(0);
            $table->timestamps();

            $table->foreign('ficha_id')->references('id')->on('fichas')->onDelete('cascade');
            $table->foreign('pericia_id')->references('id')->on('pericias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_pericia');
    }
};
