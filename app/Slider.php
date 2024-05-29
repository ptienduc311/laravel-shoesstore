<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title', 'url', 'display_order', 'status', 'image_id', 'created_by'
    ];
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
