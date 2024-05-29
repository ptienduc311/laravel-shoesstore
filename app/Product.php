<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'code', 'initial', 'price','stock_quantity', 'parameter', 'detail', 'is_featured', 'is_selling', 'status', 'category_id', 'created_by'
    ];
    function category(){
        return $this->belongsTo(ProductCategory::class);
    }
    public function sizes(){
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    public function images(){
        return $this->belongsToMany(Image::class, 'product_images');
    }
    public function orderDetails()
    {
        return $this->belongsToMany(OrderItem::class);
    }
    public function getStatusLabelAttribute()
    {
        $status = $this->status;
        $statusLabels = [
            'active' => 'Công khai',
            'in_active' => 'Không công khai',
            'out_of_stock' => 'Hết hàng'
        ];

        return $statusLabels[$status] ?? $status;
    }
}
