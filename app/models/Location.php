<?php

namespace App\models;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
    	'name',
    	'Description',
    	'tags',
    	'company_id',
    	'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function company()
    {
    	return $this->belongsTo('App\models\Company');
    }

    public function deviceSurveys()
    {
        return $this->hasManyThrough('App\models\DeviceSurvey','App\models\Device','location_id','device_id','id')->orderBy('id', 'desc');
    }

    public function device()
    {
        return $this->hasMany(Device::class, 'location_id', 'id');
    } 

    public static function boot ()
    {
        parent::boot();

        self::deleting(function (Location $location) {

            foreach ($location->device as $sub)
            {
                $sub->delete();
            }
        });
    }
}
