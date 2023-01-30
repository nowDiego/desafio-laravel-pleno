<?php

use App\Models\Employer;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ApplicantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Auth.login');
});


Route::get('/signup', function () {
    return view('Signup.index');
});

Route::get('/dashboard', function () {
    return view('Dashboard.index');
});


Route::post('/signup/applicant', [ApplicantController::class, 'store'])->name('signup.name');
Route::post('/signup/employer', [EmployerController::class, 'store'])->name('signup.employer');

Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/applicant/profile', [ApplicantController::class, 'profile'])->name('applicant.profile')->middleware(['auth','Applicant']);
Route::patch('/applicant/profile', [ApplicantController::class, 'profileUpdate'])->name('profile.update')->middleware(['auth','Applicant']);

Route::get('/applicant/applications', [ApplicantController::class, 'applications'])->name('applicant.applications')->middleware(['auth','Applicant']);
Route::get('/applicant', [ApplicantController::class, 'index'])->name('applicant.index')->middleware(['auth','Admin']);
Route::post('/applicant', [ApplicantController::class, 'store'])->name('applicant.store')->middleware(['auth','Admin']);
Route::get('/applicant/create', [ApplicantController::class, 'create'])->name('applicant.create')->middleware(['auth','Admin']);
Route::get('/applicant/{applicant}', [ApplicantController::class, 'show'])->name('applicant.show')->middleware(['auth','Admin']);
Route::patch('/applicant/{applicant}', [ApplicantController::class, 'update'])->name('applicant.update')->middleware(['auth','Admin']);
Route::delete('/applicant/{applicant}', [ApplicantController::class, 'destroy'])->name('applicant.destroy')->middleware(['auth','Admin']);
Route::get('/applicant/{applicant}/edit', [ApplicantController::class, 'edit'])->name('applicant.edit')->middleware(['auth','Admin']);


Route::get('/employer', [EmployerController::class, 'index'])->name('employer.index')->middleware(['auth','Admin']);
Route::post('/employer', [EmployerController::class, 'store'])->name('employer.store')->middleware(['auth','Admin']);
Route::get('/employer/create', [EmployerController::class, 'create'])->name('employer.create')->middleware(['auth','Admin']);
Route::get('/employer/{employer}', [EmployerController::class, 'show'])->name('employer.show')->middleware(['auth','Admin']);
Route::patch('/employer/{employer}', [EmployerController::class, 'update'])->name('employer.update')->middleware(['auth','Admin']);
Route::delete('/employer/{employer}', [EmployerController::class, 'destroy'])->name('employer.destroy')->middleware(['auth','Admin']);
Route::get('/employer/{employer}/edit', [EmployerController::class, 'edit'])->name('employer.edit')->middleware(['auth','Admin']);


Route::get('/vacancy/all', [VacancyController::class, 'all'])->name('vacancy.all')->middleware(['auth','Admin']);
Route::get('/vacancy/catalog', [VacancyController::class, 'catalog'])->name('vacancy.apply')->middleware(['auth','Applicant']);
Route::post('/vacancy/{vacancy}/subscribe', [VacancyController::class, 'subscribeVacancy'])->name('vacancy.subscribe')->middleware(['auth','Applicant']);
Route::delete('/vacancy/{vacancy}/unsubscribe', [VacancyController::class, 'unsubscribeVacancy'])->name('vacancy.unsubscribe')->middleware(['auth','Applicant']);
Route::get('/vacancy', [VacancyController::class, 'index'])->name('vacancy.index')->middleware(['auth','Employer']);
Route::post('/vacancy', [VacancyController::class, 'store'])->name('vacancy.store')->middleware(['auth','Employer']);
Route::get('/vacancy/create', [VacancyController::class, 'create'])->name('vacancy.create')->middleware(['auth','Employer']);
Route::get('/vacancy/{vacancy}', [VacancyController::class, 'show'])->name('vacancy.show')->middleware(['auth','Employer']);
Route::patch('/vacancy/{vacancy}', [VacancyController::class, 'update'])->name('vacancy.update')->middleware(['auth','Employer']);
Route::delete('/vacancy/{vacancy}', [VacancyController::class, 'destroy'])->name('vacancy.destroy')->middleware(['auth','Employer']);
Route::get('/vacancy/{vacancy}/edit', [VacancyController::class, 'edit'])->name('vacancy.edit')->middleware(['auth','Employer']);




Blade::if('isRole', function ($roles = []) {
    if (empty($roles) || !Auth::check()) {
        return false;
    }

    $user = str_replace("App\\Models\\","",Auth::user()->userable_type);       

    return in_array($user, $roles);
});


