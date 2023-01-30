<?php

namespace App\Models;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
     'name',
     'slug'
    ];



    public function vacancies()
    {
      return $this->hasMany(Vacancy::class, 'id', 'type_id');
    }

}
