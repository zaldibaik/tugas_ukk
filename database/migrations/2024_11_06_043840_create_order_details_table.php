<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // product_id -> bigInteger, foreign key
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // order_id -> bigInteger, foreign key
            $table->integer('quantity'); // quantity -> int
            $table->integer('subtotal'); // subtotal -> int
            $table->timestamps(); // created_at and updated_at -> timestamps
            
            // Set primary key
            $table->primary(['product_id', 'order_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
