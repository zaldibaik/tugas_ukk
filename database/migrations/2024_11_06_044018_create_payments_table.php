<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // id -> bigInteger, unsigned, auto-increment
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // order_id -> bigInteger, foreign key
            $table->dateTime('payment_date'); // payment_date -> datetime
            $table->string('payment_method', 255); // payment_method -> varchar(255)
            $table->bigInteger('amount'); // amount -> bigInteger
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
        Schema::dropIfExists('payments');
    }
}
