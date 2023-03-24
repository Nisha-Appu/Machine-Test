<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customername','phone','order_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at'=> 'datetime',
    ];
}
