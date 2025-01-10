<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->bigIncrements('id');                   // id
            $table->unsignedBigInteger('customer_id');     // customer_id
            $table->unsignedBigInteger('product_id');      // product_id
            $table->timestamp('created_at')->nullable();   // created_at
            $table->timestamp('updated_at')->nullable();   // updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}
