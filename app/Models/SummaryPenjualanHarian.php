<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class SummaryPenjualanHarian extends Model
{
    use HasUlids;
    protected $table = 'summary_penjualan_harian'; 

    protected $fillable = [
        'tanggal', 
        'total_penjualan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total_penjualan' => 'decimal:2',
    ];
    
}