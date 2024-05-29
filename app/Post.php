<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'status', 'image_id', 'category_id', 'created_by'
    ];
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function category()
    {
        return $this->belongsTo(PostCategory::class);
    }
    
}
