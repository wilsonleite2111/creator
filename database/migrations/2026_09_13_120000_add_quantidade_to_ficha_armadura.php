<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ficha_armadura', function (Blueprint $table) {
            $table->integer('quantidade')->default(1)->after('armadura_id');
        });
    }

    public function down(): void
    {
        Schema::table('ficha_armadura', function (Blueprint $table) {
            $table->dropColumn('quantidade');
        });
    }
};
