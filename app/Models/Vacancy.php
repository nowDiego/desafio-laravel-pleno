<?php

namespace App\Models;

use App\Models\Employer;
use App\Models\Applicant;
use App\Models\TypeVacancy;
use App\Models\StatusVacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacancy extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
      'title',
      'description',
      'requirement',
      'employer_id',
      'status_id',
      'type_id',
      
    ];


    public function status()
    {
      return $this->belongsTo(StatusVacancy::class, 'status_id', 'id');
    }


    public function employer()
    {
      return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }

    public function type()
    {
      return $this->belongsTo(TypeVacancy::class, 'type_id', 'id');
    }


    public function applicants()
    {
      return $this->belongsToMany(Applicant::class,'applicants_vacancies','vacancy_id','applicant_id');
    }


    

}
