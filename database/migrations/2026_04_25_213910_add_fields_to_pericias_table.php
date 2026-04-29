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
        Schema::table('pericias', function (Blueprint $table) {
            $table->string('versao')->nullable();
            $table->text('descricao')->nullable();
            $table->string('habilidade_chave')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pericias', function (Blueprint $table) {
            $table->dropColumn(['versao', 'descricao', 'habilidade_chave']);
        });
    }
};
