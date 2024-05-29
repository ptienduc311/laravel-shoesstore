<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = [
        'category_name', 'category_desc', 'parent_id', 'created_by'
    ];
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
    public function children(){
        return $this->hasMany(PostCategory::class,'parent_id')->with('children');
    }
}
