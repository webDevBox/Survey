<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'question_options';

    protected $fillable = [
    	'question_id',
    	'label',
        'value',
        'colour'
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    ];

    public function question()
    {
    	return $this->belongsTo('App\models\Question');
    }

    public function templateOption()
    {
    	return $this->belongsTo('App\models\TemplateOption');
    }

    public function template()
    {
    	return $this->templateOption->template;
    }
}
