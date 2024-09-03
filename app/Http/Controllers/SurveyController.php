<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    //
    public function index()
    {
        $title = 'Survey';
        $surveys = Survey::withCount('questions')->paginate(10);

        return view('admin.survey.index', compact('title', 'surveys'));
    }


    public function create()
    {
        $title = 'Create Survey';
        return view('admin.survey.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);


        $survey = new Survey();
        $survey->title = $request->title;
        $survey->status = $request->status;
        $survey->description = $request->description;

        if ($survey->save()) {
            return redirect()->route('questions.create', $survey->id)->with('success', 'Survey created successfully, Now Add Questions');
        }
        return redirect()->route('admin.surveys.create')->with('error', 'Failed to create survey');
    }
}
