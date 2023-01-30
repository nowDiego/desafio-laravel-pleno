<?php

namespace App\Models;

use App\Models\Vacancy;
use App\Models\Applicant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantsVacancies extends Model
{
    use HasFactory;

    protected $fillable = [
       'applicant_id',
       'vacancy_id'
    ];


    public function applicants()
    {
      return $this->belongsToMany(Applicant::class, 'id', 'applicant_id');
    }

    public function vacancies()
    {
      return $this->belongsToMany(Vacancy::class, 'id', 'vacancy_id');
    }
    
}
