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
        Schema::table('fichas', function (Blueprint $table) {
            $table->string('deslocamento', 20)->default('9m')->after('ouro');
            $table->integer('iniciativa_misc')->default(0)->after('bab');
            $table->integer('ca_natural')->default(0)->after('iniciativa_misc');
            $table->integer('ca_deflexao')->default(0)->after('ca_natural');
            $table->integer('ca_misc')->default(0)->after('ca_deflexao');
            $table->integer('fortitude_misc')->default(0)->after('fortitude_base');
            $table->integer('reflexos_misc')->default(0)->after('reflexos_base');
            $table->integer('vontade_misc')->default(0)->after('vontade_base');
            $table->integer('agarre_misc')->default(0)->after('bab');
            $table->integer('xp_atual')->default(0)->after('nivel');
            $table->text('notas_combate')->nullable();
            $table->text('idiomas')->nullable();
            $table->text('talentos_descricao')->nullable();
            $table->text('habilidades_especiais')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fichas', function (Blueprint $table) {
            $table->dropColumn([
                'deslocamento', 'iniciativa_misc', 'ca_natural', 'ca_deflexao', 'ca_misc',
                'fortitude_misc', 'reflexos_misc', 'vontade_misc', 'agarre_misc',
                'xp_atual', 'notas_combate', 'idiomas', 'talentos_descricao', 'habilidades_especiais'
            ]);
        });
    }
};
