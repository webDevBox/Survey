<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DeviceSurvey extends Model
{
    protected $fillable = [
    	'device_id',
    	'survey_id',
        'isDeployed'
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at'
    ];

    // protected $with = 'survey';

    public function survey()
    {
    	return $this->belongsTo('App\models\Survey');
    }
}
