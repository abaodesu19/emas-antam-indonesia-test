<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;

Route::post('/orders', [OrderController::class, 'store'])->middleware('idempotency');
Route::get('/report/penjualan/daily', [OrderController::class, 'penjualanDaily']);
Route::get('/report/penjualan/top-3', [OrderController::class, 'penjualanTop3']);
