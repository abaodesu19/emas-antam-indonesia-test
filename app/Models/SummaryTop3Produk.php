<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class SummaryTop3Produk extends Model
{
    use HasUlids;
    protected $table = 'summary_top_3_produk';

    protected $fillable = [
        'product_id', 
        'total_terjual'
    ];

    protected $casts = [
        'product_id' => 'integer',
        'total_terjual' => 'integer',
    ];
}