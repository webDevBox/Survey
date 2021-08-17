<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
		'id',
    	'company_id',
    	'bg_color',
    	'bg_image',
    	'btn_submit_color',
    	'btn_cancel_color',
		'qr_title',
		'timezone',
        'version_number'
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

	public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    // public function getBgImageAttribute($bg_image)
    // {
    //    return asset('storage/app/'.$bg_image);
    // }

}
