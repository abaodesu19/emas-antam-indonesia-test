<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\SummaryPenjualanHarian;
use App\Models\SummaryTop3Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CalculateReports extends Command
{
    protected $signature = 'reports:calculate';
    protected $description = 'Menghitung ulang summary data penjualan dan produk top 3';

    public function handle()
    {
        //Penjualan Harian
        $this->info('Start Report Penjualan Harian ...');
        $recentSales = Order::selectRaw('DATE(order_date) as tanggal, SUM(total_price) as total_penjualan')
            ->where('order_date', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->get();

        $dailySalesData = [];
        foreach ($recentSales as $sale) {
            $dailySalesData[] = [
                'id' => (string) Str::ulid(),
                'tanggal' => $sale->tanggal, 
                'total_penjualan' => $sale->total_penjualan,
            ];
        }
        if (!empty($dailySalesData)) {
            SummaryPenjualanHarian::upsert($dailySalesData, ['tanggal'], ['total_penjualan']);
        }

        $this->info('Summary Penjualan Harian Done');

        //Top 3 Produk
        $this->info('Start Report Top 3 Produk ...');
        $topProducts = DB::table('order_items')
            ->selectRaw('product_id, SUM(qty) as total_terjual')
            ->groupBy('product_id')
            ->get();

        $topProductsData = [];
        foreach ($topProducts as $product) {
            $topProductsData[] = [
                'id' => (string) Str::ulid(),
                'product_id' => $product->product_id,
                'total_terjual' => $product->total_terjual,
            ];
        }
        if (!empty($topProductsData)) {
            foreach (array_chunk($topProductsData, 1000) as $chunk) {
                SummaryTop3Produk::upsert($chunk, ['product_id'], ['total_terjual']);
            }
        }
        
        $this->info('Summary Top 3 Produk Done');
    }
}