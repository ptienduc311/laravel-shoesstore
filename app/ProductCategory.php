<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'category_name', 'category_slug', 'category_desc', 'parent_id', 'created_by'
    ];
    function products(){
        return $this->hasMany('App\Product','category_id');
    }
}
