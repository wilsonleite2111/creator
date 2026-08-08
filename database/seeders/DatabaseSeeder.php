<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TendenciaSeeder::class,
            RacaSeeder::class,
            ClassesTableSeeder::class,
            PericiaSeeder::class,
            TalentoSeeder::class,
            DivindadeSeeder::class,
            EquipmentSeeder::class,
            MagiaSeeder::class,
        ]);
    }
}
