<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponses extends Model
{
    use HasFactory;

    protected $fillable = ['survey_id', 'question_id', 'response', 'profession_id', 'response_group_id'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function question()
    {
        return $this->belongsTo(Questions::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
