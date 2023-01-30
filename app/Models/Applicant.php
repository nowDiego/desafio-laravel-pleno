<?php

namespace App\Models;

use App\Models\User;
use App\Models\ApplicantsVacancies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
       'itin',
       'name',
       'gender',
       'age',
       'photo'
    ];




    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
    

   
    public function vacancies()
    {
      return $this->belongsToMany(Vacancy::class,'applicants_vacancies','applicant_id','vacancy_id')->with(['employer','type','status']);;
  }


}
