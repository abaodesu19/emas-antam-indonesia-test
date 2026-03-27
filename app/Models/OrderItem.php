<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use App\Models\Order;

class OrderItem extends Model
{
    use HasUlids;
    protected $table = 'order_items';

    protected $fillable = [
        'order_id', 
        'product_id', 
        'qty', 
        'price'
    ];

    protected $casts = [
        'order_id' => 'string',
        'product_id' => 'integer',
        'qty' => 'integer',
        'price' => 'decimal',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}