<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // id -> bigInteger, unsigned, auto-increment
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // customer_id -> bigInteger, unsigned, foreign key
            $table->dateTime('order_date'); // order_date -> datetime
            $table->bigInteger('total_amount'); // total_amount -> bigInteger
            $table->string('status', 20); // status -> varchar(20)
            $table->timestamps(); // created_at and updated_at -> timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
