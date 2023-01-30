<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('type_vacancies')->insert(
            [
               'name' => 'CLT',    
               'slug' => 'clt',                                             
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        DB::table('type_vacancies')->insert(
            [
               'name' => 'Pessoa Jurídica',    
               'slug' => 'pessoa-juridica',                                             
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        DB::table('type_vacancies')->insert(
            [
               'name' => 'Freelancer',    
               'slug' => 'freelancer',                                             
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

    }
}
