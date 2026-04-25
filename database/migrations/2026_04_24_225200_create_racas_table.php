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
        Schema::table('racas', function (Blueprint $table) {
            $table->string('versao')->nullable();
            $table->text('descricao')->nullable();
            
            // Modifiers
            $table->integer('mod_forca')->default(0);
            $table->integer('mod_destreza')->default(0);
            $table->integer('mod_constituicao')->default(0);
            $table->integer('mod_inteligencia')->default(0);
            $table->integer('mod_sabedoria')->default(0);
            $table->integer('mod_carisma')->default(0);
            
            $table->string('tamanho')->nullable();
            $table->integer('deslocamento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('racas', function (Blueprint $table) {
            $table->dropColumn([
                'versao', 'descricao', 'mod_forca', 'mod_destreza', 
                'mod_constituicao', 'mod_inteligencia', 'mod_sabedoria', 
                'mod_carisma', 'tamanho', 'deslocamento'
            ]);
        });
    }
};
