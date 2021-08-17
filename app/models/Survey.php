<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'name',
        'language',
        'company_id',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $with = 'device';

    public function device()
    {
    	return $this->belongsToMany('App\models\Device', 'device_surveys');
    }

    public function devices()
    {
    	return $this->belongsToMany('App\models\Device', 'device_surveys')->where('isDeployed',1);
    }

    public function company()
    {
        return $this->belongsTo('App\models\Company');
    }

    public function questions()
    {
        return $this->hasMany('App\models\Question');
    }

    public function questionOptions()
    {
        return $this->hasManyThrough('App\models\QuestionOption','App\models\Question','survey_id','question_id','id')->orderBy('id', 'desc');
    }

    public function feedback()
    {
        return $this->hasMany('App\models\Feedback');
    }

    public function feedbackByDates($lastMonthfirstDate, $lastMonthLastDate)
    {
        return $this->feedback()->whereDate('created_at', '>=', $lastMonthfirstDate)->whereDate('created_at', '<=', $lastMonthLastDate)->pluck('id');
    }

     public function feedbackByDeviceWithDates($deviceId, $lastMonthfirstDate, $lastMonthLastDate)
    {
        return $this->feedback()->whereDeviceId($deviceId)->whereDate('created_at', '>=', $lastMonthfirstDate)->whereDate('created_at', '<=', $lastMonthLastDate)->pluck('id');
    }

    public function feedbackDetail()
    {
        return $this->hasManyThrough('App\models\FeedbackDetail', 'App\models\Feedback', 'survey_id', 'feedback_id', 'id')->orderBy('id', 'desc');
    }

    // public function questionFeedbackDetail($questionId, $feedbackIds=null)
    // {
    //     $query = $this->feedbackDetail();
    //     if (!is_null($feedbackIds)) {
    //         $query = $query->whereIn('feedback_id', $feedbackIds);
    //     }
    //     return $query->whereQuestionId($questionId)->get();
    // }

    public function questionFeedbackDetail($questionId, $feedbackIds, $lastMonthfirstDate=null, $lastMonthLastDate=null)
    {
        $query = $this->feedbackDetail();
        if (!is_null($lastMonthfirstDate) && !is_null($lastMonthLastDate)) {
            return $query->whereIn('feedback_id', $feedbackIds)->whereDate('feedback_details.created_at', '>=', $lastMonthfirstDate)->whereDate('feedback_details.created_at', '<=', $lastMonthLastDate)->whereQuestionId($questionId)->orderBy('created_at', 'asc')->get()->groupBy(function($item) {
                return $item->created_at->format('Y-m-d');
            });
        }

        return $query->whereIn('feedback_id', $feedbackIds)->whereQuestionId($questionId)->get();
    }
         

    public function latestFeedback()
    {
        return $this->feedback()->orderBy('id', 'desc')->take(1);
    }
}
