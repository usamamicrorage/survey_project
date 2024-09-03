<?php

namespace App\Utils;

class SentimentAnalyzer
{
    protected $positiveWords = ['agree', 'good', 'happy', 'positive'];
    protected $negativeWords = ['disagree', 'bad', 'sad', 'negative'];

    protected $neutralWords = ['not_applicable', 'neutral'];
    public function analyze($text)
    {
        $words = explode(' ', strtolower($text));
        $score = 0;

        foreach ($words as $word) {
            if (in_array($word, $this->positiveWords)) {
                $score++;
            } elseif (in_array($word, $this->negativeWords)) {
                $score--;
            } else if (in_array($word, $this->neutralWords)) {
                $score += 0;
            }
        }

        return $score > 0 ? 'positive' : ($score < 0 ? 'negative' : 'neutral');
    }
}
