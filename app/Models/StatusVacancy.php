<?php

namespace App\Models;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',      
       ];


       public function vacancies()
       {
         return $this->hasMany(Vacancy::class, 'id', 'status_id');
       }


}
