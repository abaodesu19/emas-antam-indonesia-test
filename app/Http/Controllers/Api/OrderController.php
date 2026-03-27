<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\SummaryPenjualanHarian;
use App\Models\SummaryTop3Produk;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $totalPrice = 0;
            $itemsData = [];

            foreach ($validated['items'] as $item) {
                $totalPrice += ($item['qty'] * $item['price']);
                $itemsData[] = [
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                ];
            }

            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'order_date' => now(),
                'total_price' => $totalPrice,
            ]);
            $order->items()->createMany($itemsData);
            DB::commit();

            return response()->json([
                'message' => 'Order berhasil dibuat',
                'data' => [
                    'order_id' => $order->id, // Format ULID
                    'total_price' => $totalPrice
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Gagal memproses order: ' . $e->getMessage()], 500);
        }
    }

    public function penjualanDaily()
    {
        $data = SummaryPenjualanHarian::orderByDesc('tanggal')->get();
        return response()->json(['message' => 'Total Penjualan Daily', 'data' => $data]);
    }

    public function penjualanTop3()
    {
        $data = SummaryTop3Produk::orderByDesc('total_terjual')
                ->limit(3)
                ->get();
        return response()->json(['message' => 'Total Penjualan Top-3 Produk', 'data' => $data]);
    }
}