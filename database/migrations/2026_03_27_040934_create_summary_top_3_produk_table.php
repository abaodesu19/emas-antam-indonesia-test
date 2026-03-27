<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('summary_top_3_produk', function (Blueprint $table) {
            $table->ulid('id')->primary(); 
            $table->integer('product_id')->unique(); 
            $table->integer('total_terjual')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('summary_top_3_produk');
    }
};