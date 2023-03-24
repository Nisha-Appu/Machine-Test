<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $fillable = [
        'productname','category','image','price'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at'=> 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
