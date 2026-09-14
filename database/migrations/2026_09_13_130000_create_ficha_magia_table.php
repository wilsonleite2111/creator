<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ficha_magia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ficha_id');
            $table->unsignedBigInteger('magia_id');
            $table->boolean('preparada')->default(false);
            $table->timestamps();

            $table->foreign('ficha_id')->references('id')->on('fichas')->onDelete('cascade');
            $table->foreign('magia_id')->references('id')->on('magias')->onDelete('cascade');

            $table->unique(['ficha_id', 'magia_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ficha_magia');
    }
};
