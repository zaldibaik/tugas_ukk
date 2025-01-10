<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');                  // id
            $table->unsignedBigInteger('order_id');       // order_id
            $table->dateTime('shipping_date');            // shipping_date
            $table->string('tracking_code', 20);          // tracking_code
            $table->string('status', 20);                 // status
            $table->timestamp('created_at')->nullable();  // created_at
            $table->timestamp('updated_at')->nullable();  // updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
