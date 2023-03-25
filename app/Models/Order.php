<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $total =0;
    use HasFactory;
    protected $fillable = [
        'customer_id','product','quantity',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at'=> 'datetime',
    ];

    protected $guarded=['id'];
    public function product(){

        return $this->belongsToMany(Product::class,'product')->withPivot('quantity', 'price','total')->withTimestamps();
    }
}
