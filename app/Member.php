<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'fullname', 'phone', 'address', 'user_id'
    ];
}
