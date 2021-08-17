<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends  Authenticatable
{

	protected $guard = 'company';


    protected $fillable = [
        'id',
        'name',
    	'email',
    	'password',
    	'contact_person_name',
    	'contact_person_phone',
    	'logo',
		'plan',
		'remember_token', 
		'email_verified_at',
        'status' 
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'deleted_at',
        'password',
        'remember_token', 
        'email_verified_at',
    ];

    protected $with = 'setting';

    public function getStatusAttribute($status)
    {
        return (bool)$status;
    }

    // public function getLogoAttribute($logo)
    // {
    //    return asset('app/'.$logo);
    // }

    public function active()
    {
        if ($this->status) {
            return true;
        }
        return false;
    }
    public function setting()
    {
        return $this->hasOne('App\models\CompanySetting');
    }

    public function surveys()
    {
        return $this->hasMany('App\models\Survey');
    }

    public function feedbacks()
    {
        return $this->hasManyThrough('App\models\Feedback','App\models\Survey','company_id','survey_id','id');
    }

    public function locations()
    {
        return $this->hasMany('App\models\Location');
    }
    
    public function devices()
    {
        return $this->hasMany('App\models\Device');
    }
}
