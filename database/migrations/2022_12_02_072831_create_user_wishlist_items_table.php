<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('user_wishlist_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->integer('product_id')->references('id')->on('shop_products')->onDelete('CASCADE');
        });
    }

    public function down()   {
        Schema::dropIfExists('user_wishlist_items');
    }
};
