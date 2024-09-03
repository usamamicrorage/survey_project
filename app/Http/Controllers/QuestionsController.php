<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use App\Models\Survey;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    //
    public function create($survey_id)
    {
        $title = 'Create Questions';
        $survey_title = Survey::where('id', $survey_id)->first();
        return view('admin.questions.create', compact('survey_title', 'survey_id', 'title'));
    }


    public function show($survey_id)
    {
        $title = 'View Questions';
        $questions = Questions::where('survey_id', $survey_id)->paginate(10);

        return view("admin.questions.show", compact('title', 'questions', 'survey_id'));
    }


    public function store(Request $request, $survey_id)
    {
        // Save each question
        foreach ($request->input('questions') as $questionText) {
            $question = new Questions();
            $question->survey_id = $survey_id;
            $question->title = $questionText;
            $question->save();
        }

        return redirect()->route('survey')->with('success', 'Added questions in the survey.');
    }
}
