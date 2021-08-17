<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $fillable = [
    	'question',
    	'type',
    	'survey_id',
        'deleted_at'
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at'
    ];

    public function survey()
    {
    	return $this->belongsTo('App\models\Survey');
    }

    public function options()
    {
        return $this->hasMany('App\models\QuestionOption');
    }
}
