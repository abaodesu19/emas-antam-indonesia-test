<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use App\Models\OrderItem;

class Order extends Model
{
    use HasUlids;
    protected $table = 'orders';
    
    protected $fillable = [
        'customer_name', 
        'order_date', 
        'total_price'
    ];

    protected $casts = [
        'customer_name' => 'string',
        'order_date' => 'timestamp',
        'total_price' => 'decimal',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}