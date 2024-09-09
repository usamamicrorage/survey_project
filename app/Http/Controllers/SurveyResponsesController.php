<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SurveyResponsesController extends Controller
{
    // Handle survey response submission
    public function submitSurvey(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);

        $request->validate([
            'profession_id' => 'required|exists:professions,id',
            'responses' => 'required|array',
            'responses.*' => 'required|in:agree,disagree,not_applicable',
        ]);

        $responseGroupId = Str::uuid()->toString();

        foreach ($request->input('responses') as $questionId => $response) {
            SurveyResponses::create([
                'survey_id' => $survey->id,
                'question_id' => $questionId,
                'response' => $response,
                'profession_id' => $request->input('profession_id'),
                'response_group_id' => $responseGroupId,
                'age_group' => $request->input('age_group'),
                'education' => $request->input('education'),
            ]);
        }

        // Redirect with a success message
        return redirect()->route('survey.public.link', $survey->id)
            ->with('success', 'Your response has been submitted, Thank you for completing the survey!');
    }
}
