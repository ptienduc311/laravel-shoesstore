<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code', 'quantity', 'total_amout', 'order_date', 'payment', 'address', 'status', 'customer_id'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute()
    {
        $status = $this->status;
        $statusLabels = [
            'pending' => 'Đang chờ',
            'processing' => 'Đang xử lý',
            'shipping' => 'Đang giao hàng',
            'delivered' => 'Đã giao',
            'canceled' => 'Đã hủy'
        ];

        return $statusLabels[$status] ?? $status;
    }
}
