<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\TypeVacancySeeder;
use Database\Seeders\StatusVacancySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TypeVacancySeeder::class,
            StatusVacancySeeder::class
        ]);
    }
}
