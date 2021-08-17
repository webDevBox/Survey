<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateOption extends Model
{

   use SoftDeletes;

    protected $fillable = [
    	'name',
    	'template_id',
        'label'

    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    public function template()
    {
    	return $this->belongsTo('App\models\Template');
    }
    
}
