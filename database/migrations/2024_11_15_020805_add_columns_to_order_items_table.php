<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->unsignedBigInteger('order_id')->after('id');
        $table->unsignedBigInteger('product_id')->after('order_id');
        $table->integer('quantity')->after('product_id');
        $table->decimal('price', 10, 2)->after('quantity');
        
        // Jika ingin menambahkan foreign key, gunakan ini:
        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->dropColumn(['order_id', 'product_id', 'quantity', 'price']);
    });
}

};
