<?php

namespace App\models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Device extends Authenticatable implements JWTSubject
{

    use SoftDeletes;

    protected $fillable = [
    	'name',
    	'pin',
        'location_id',
        'company_id',
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function location()
    {
    	return $this->belongsTo('App\models\Location');
    }

    public function survey()
    {
    	return $this->belongsToMany('App\models\Survey', 'device_surveys');
    }

    public function company()
    {
        return $this->belongsTo('App\models\Company');
    }
    public function latestSurvey()
    {
    	return $this->belongsToMany('App\models\Survey', 'device_surveys')->orderBy('id','Desc')->take(1);
    }

    public function feedbacks()
    {
        return $this->hasMany('App\models\Feedback');
    }
}
