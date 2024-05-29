<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = [
        'name', 'src', 'size', 'created_by'
    ];
    public function postImg()
    {
        return $this->hasOne(Post::class);
    }
    public function productImgs(){
        return $this->belongsToMany(Product::class);
        // return $this->belongsToMany(Product::class, 'product_images', 'id','product_id');
    }
    public function sliderImg()
    {
        return $this->hasOne(Slider::class);
    }
}
