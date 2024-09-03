<?php

namespace App\Utils;

class SimpleLinearRegression
{
    protected $x;
    protected $y;
    protected $slope;
    protected $intercept;

    public function __construct(array $x, array $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->calculate();
    }

    // Calculate the slope and intercept for linear regression
    private function calculate()
    {
        $n = count($this->x);
        $sumX = array_sum($this->x);
        $sumY = array_sum($this->y);
        $sumXY = array_sum(array_map(fn($x, $y) => $x * $y, $this->x, $this->y));
        $sumX2 = array_sum(array_map(fn($x) => pow($x, 2), $this->x));

        $this->slope = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - pow($sumX, 2));
        $this->intercept = ($sumY - $this->slope * $sumX) / $n;
    }

    // Predict the value of y for a given x
    public function predict($x)
    {
        return $this->intercept + $this->slope * $x;
    }
}
