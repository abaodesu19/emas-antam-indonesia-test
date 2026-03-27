<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('summary_penjualan_harian', function (Blueprint $table) {
            $table->ulid('id')->primary(); 
            $table->date('tanggal')->unique(); 
            $table->decimal('total_penjualan', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('summary_penjualan_harian');
    }
};