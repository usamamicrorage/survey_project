<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Survey;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Login';
        return view('auth/auth', compact('title'));
    }


    public function fill_survey($survey_id)
    {
        $title = 'Fill Survey';
        $professions = Profession::all();
        $survey = Survey::with('questions')->find($survey_id);

        return view('index', compact('professions', 'survey', 'title'));
    }
}
