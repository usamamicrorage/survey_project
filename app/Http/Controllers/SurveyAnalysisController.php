<?php

namespace App\Http\Controllers;

use App\Utils\KMeansClustering;
use App\Utils\SentimentAnalyzer;
use App\Utils\SimpleLinearRegression;
use App\Models\SurveyResponses;

class SurveyAnalysisController extends Controller
{
    public function getSurveyData($surveyId)
    {
        $responses = SurveyResponses::where('survey_id', $surveyId)
            ->with(['question', 'profession'])
            ->get();
        $data = $responses->groupBy('response_group_id')->map(function ($group) {
            return [
                'responses' => $group->pluck('response')->toArray(),
                'profession' => $group->first()->profession->name,
            ];
        })->values()->toArray();

        return $data;
    }
    public function performClusteringAnalysis($surveyId)
    {
        $data = $this->getSurveyData($surveyId);
        $numericData = array_map(function ($item) {
            return array_map(function ($response) {
                return match ($response) {
                    'agree' => 1,
                    'disagree' => -1,
                    'not applicable' => 0,
                    default => 0,
                };
            }, $item['responses']);
        }, $data);

        $kmeans = new KMeansClustering($numericData, 2);
        $clusters = $kmeans->assignClusters();

        return view('surveys.clustering_results', compact('clusters'));
    }

    public function performSentimentAnalysis($surveyId)
    {
        $data = $this->getSurveyData($surveyId);
        $analyzer = new SentimentAnalyzer();
        $sentimentResults = [];

        foreach ($data as $responseGroup) {
            $responses = implode(' ', $responseGroup['responses']);
            $sentimentResults[] = [
                'profession' => $responseGroup['profession'],
                'sentiment' => $analyzer->analyze($responses),
            ];
        }

        return view('surveys.sentiment_results', compact('sentimentResults'));
    }

    public function performRegressionAnalysis($surveyId)
    {
        $data = $this->getSurveyData($surveyId);
        $x = [];
        $y = [];

        foreach ($data as $key => $responseGroup) {
            $x[] = $key + 1;
            $y[] = array_sum(array_map(function ($response) {
                return match ($response) {
                    'agree' => 1,
                    'disagree' => -1,
                    'not applicable' => 0,
                    default => 0,
                };
            }, $responseGroup['responses']));
        }

        $regression = new SimpleLinearRegression($x, $y);
        $predictions = array_map(fn($val) => $regression->predict($val), $x);

        return view('surveys.regression_results', compact('predictions'));
    }
}
