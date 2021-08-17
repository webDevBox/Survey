<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateCategory extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'selection_type'
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    public function template()
    {
        return $this->hasMany(Template::class, 'template_category_id', 'id');
    } 

    public static function boot ()
    {
        parent::boot();

        self::deleting(function (TemplateCategory $category) {

            foreach ($category->template as $sub)
            {
                $sub->delete();
            }
        });
    }
}
