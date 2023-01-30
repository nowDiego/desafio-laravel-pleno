<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
     'trade',
     'ein'
    ];



    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
    

    public function vacancies()
    {
      return $this->hasMany(Vacancy::class, 'id', 'employer_id');
    }



}
