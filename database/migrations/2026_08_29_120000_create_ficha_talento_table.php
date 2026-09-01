<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ficha_talento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ficha_id');
            $table->unsignedBigInteger('talento_id');
            $table->timestamps();

            $table->foreign('ficha_id')->references('id')->on('fichas')->onDelete('cascade');
            $table->foreign('talento_id')->references('id')->on('talentos')->onDelete('cascade');
            $table->unique(['ficha_id', 'talento_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ficha_talento');
    }
};
