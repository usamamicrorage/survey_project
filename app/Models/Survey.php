<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;


    public function questions()
    {
        return $this->hasMany(Questions::class);
    }
    public function totalResponses()
    {
        // Count distinct response groups for this survey
        return $this->hasMany(SurveyResponses::class)
            ->select('response_group_id')
            ->distinct()
            ->count('response_group_id');
    }
}
