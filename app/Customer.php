<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'fullname', 'email', 'phone', 'address', 'note'
    ];
    public function order(){
        return $this->hasOne(Order::class);
    }
}
