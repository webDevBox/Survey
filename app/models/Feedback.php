<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Camroncade\Timezone\Facades\Timezone;

class Feedback extends Model
{
    protected $fillable = [
    	'device_id',
    	'survey_id'
    ];

    // protected $hidden = [
    // 	'created_at',
    // 	'updated_at'
    // ];

    protected $appends = array('latest_feedback_at');

    public function feedbackDetail()
    {
    	return $this->hasOne('App\models\FeedbackDetail')->withDefault();
    }

    public function feedbackDetails()
    {
        return $this->hasMany('App\models\FeedbackDetail');
    }

    public function survey()
    {
        return $this->belongsTo('App\models\Survey');
    }

    public function questions()
    {
        return $this->hasManyThrough('App\models\Question','App\models\FeedbackDetail','question_id','question_id','id')->orderBy('id', 'desc');
    }

    public function customer()
    {
        return $this->hasOne('App\models\Customer');
    }

    public function getLatestFeedbackAtAttribute()
    {
        return dateFormat($this->created_at);
    }

    public function getCreatedAtAttribute($value)
    {   
        return Timezone::convertFromUTC($value, resolve('companyTimezone'));
    }

    public function scopeDeviceRelated($query, $deviceId)
    {
        return $query->where('device_id', $deviceId);
    }
}
