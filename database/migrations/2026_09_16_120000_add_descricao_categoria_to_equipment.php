<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('armas', function (Blueprint $table) {
            $table->text('descricao')->nullable()->after('uso');
        });

        Schema::table('armaduras', function (Blueprint $table) {
            $table->text('descricao')->nullable()->after('tipo');
        });

        Schema::table('equipamentos', function (Blueprint $table) {
            $table->string('categoria')->nullable()->after('nome');
        });
    }

    public function down(): void
    {
        Schema::table('armas', function (Blueprint $table) {
            $table->dropColumn('descricao');
        });

        Schema::table('armaduras', function (Blueprint $table) {
            $table->dropColumn('descricao');
        });

        Schema::table('equipamentos', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }
};
