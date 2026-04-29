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
            $table->string('divindade', 100)->nullable()->change();
            $table->string('tamanho', 10)->nullable()->change();
            $table->integer('idade')->nullable()->change();
            $table->string('sexo', 10)->nullable()->change();
            $table->float('altura')->nullable()->change();
            $table->float('peso')->nullable()->change();
            $table->string('olhos')->nullable()->change();
            $table->string('cabelos')->nullable()->change();
            $table->string('pele')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fichas', function (Blueprint $table) {
            //
        });
    }
};
