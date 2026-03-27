<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name', 
        'price'
    ];

    protected $casts = [
        'name' => 'string',
        'price' => 'decimal:2',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }

    public function summaryTop3()
    {
        return $this->hasOne(SummaryTop3Produk::class, 'product_id', 'id');
    }
}