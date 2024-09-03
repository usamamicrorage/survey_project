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

        // Validate request data
        $request->validate([
            'profession_id' => 'required|exists:professions,id',
            'responses' => 'required|array',
            'responses.*' => 'required|in:agree,disagree,not_applicable',
        ]);

        // Generate a unique response group ID for this survey submission
        $responseGroupId = Str::uuid()->toString();

        // Save each question's response with the same response group ID
        foreach ($request->input('responses') as $questionId => $response) {
            SurveyResponses::create([
                'survey_id' => $survey->id,
                'question_id' => $questionId,
                'response' => $response,
                'profession_id' => $request->input('profession_id'),
                'response_group_id' => $responseGroupId, // Assign the group ID
            ]);
        }

        // Redirect with a success message
        return redirect()->route('survey.public.link', $survey->id)
            ->with('success', 'Your response has been submitted, Thank you for completing the survey!');
    }
}
