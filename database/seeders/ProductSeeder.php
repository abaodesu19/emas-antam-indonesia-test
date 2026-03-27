<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $produk = [
            ['name' => 'EmasKITA Gift Series 0.1 Gram', 'price' => 150000],
            ['name' => 'EmasKITA Gift Series 0.25 Gram', 'price' => 350000],
            ['name' => 'Emas Antam Gift Series 0.5 Gram', 'price' => 700000],
            ['name' => 'Emas Antam Kepingan 1 Gram', 'price' => 1400000],
            ['name' => 'Emas Antam Kepingan 2 Gram', 'price' => 2750000],
            ['name' => 'Emas Antam Kepingan 3 Gram', 'price' => 4100000],
            ['name' => 'Emas Antam Kepingan 5 Gram', 'price' => 6800000],
            ['name' => 'Emas Antam Kepingan 10 Gram', 'price' => 13500000],
            ['name' => 'Emas Antam Kepingan 25 Gram', 'price' => 33500000],
            ['name' => 'Emas Antam Kepingan 50 Gram', 'price' => 66500000],
        ];

        Product::upsert($produk, ['name'], ['price']);
    }
}