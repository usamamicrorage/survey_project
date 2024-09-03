<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyResponsesController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/login', [HomeController::class, 'index'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('profession', ProfessionController::class);
    Route::get('survey', [SurveyController::class, 'index'])->name('survey');
    Route::get('survey/create', [SurveyController::class, 'create'])->name('survey.create');
    Route::post('survey/store', [SurveyController::class, 'store'])->name('survey.store');
    Route::get('question/create/{survey_id}', [QuestionsController::class, 'create'])->name('questions.create');
    Route::post('questions/store/{survey_id}', [QuestionsController::class, 'store'])->name('questions.store');
    Route::get('questions/show/{survey_id}', [QuestionsController::class, 'show'])->name('questions.show');
});

Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');

Route::get('fill_survey/{survey_id}', [HomeController::class, 'fill_survey'])->name('survey.public.link');

Route::post('submit_survey/{survey_id}', [SurveyResponsesController::class, 'submitSurvey'])->name('survey_reponse.submit');

Route::get('logout', [AuthController::class, 'logout']);
