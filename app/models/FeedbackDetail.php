<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FeedbackDetail extends Model
{
    protected $fillable = [
    	'feedback_id',
    	'question_id',
    	'question_option_id'
    ];

    // protected $hidden = [
    // 	'created_at',
    // 	'updated_at'
    // ];

    protected $with = [
    	'questionOptions'
    ];

    public function questionOptions()
    {
    	return $this->belongsTo('App\models\QuestionOption', 'question_option_id', 'id');
    }

    public function feedback()
    {
        return $this->belongsTo('App\models\Feedback');
    }
}
