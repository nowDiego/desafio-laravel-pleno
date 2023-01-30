<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        DB::table('status_vacancies')->insert(
            [
                'id'=> 1,
               'name' => 'Ativo',                                                          
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        DB::table('status_vacancies')->insert(
            [
                'id'=> 2,
               'name' => 'Desativo',                                                          
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        DB::table('status_vacancies')->insert(
            [
                'id'=> 3,
               'name' => 'Pausado',                                                          
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );
    }
}
