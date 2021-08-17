<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
    	'name',
    	'imageUrl',
    	'template_category_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function template_category()
    {
        return $this->hasOne(TemplateCategory::class, 'id', 'template_category_id');
    }

    public function template_option()
    {
        return $this->hasMany(TemplateOption::class, 'template_id', 'id');
    }


    public static function boot ()
    {
        parent::boot();

        self::deleting(function (Template $template) {

            foreach ($template->template_option as $sub)
            {
                $sub->delete();
            }
        });
    }
}
