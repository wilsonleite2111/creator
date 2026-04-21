<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->string('versao')->default('3.5')->nullable(); // '3.5', '5.0', 'ad&d'
            $table->text('descricao')->nullable();
            $table->integer('dado_vida')->nullable(); // 4, 6, 8, 10, 12
            $table->string('bba_progressao')->nullable(); // 'ruim', 'media', 'boa'
            $table->string('resistencia_fortitude')->nullable(); // 'ruim', 'boa'
            $table->string('resistencia_reflexos')->nullable(); // 'ruim', 'boa'
            $table->string('resistencia_vontade')->nullable(); // 'ruim', 'boa'
            $table->integer('pontos_pericia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn([
                'versao',
                'descricao',
                'dado_vida',
                'bba_progressao',
                'resistencia_fortitude',
                'resistencia_reflexos',
                'resistencia_vontade',
                'pontos_pericia'
            ]);
        });
    }
};
