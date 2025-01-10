<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_category_id');
            $table->string('product_name', 100);
            $table->text('description');
            $table->integer('price');
            $table->integer('stok_quantity');
            $table->string('image1_url', 255);
            $table->string('image2_url', 255)->nullable();
            $table->string('image3_url', 255)->nullable();
            $table->string('image4_url', 255)->nullable();
            $table->string('image5_url', 255)->nullable();
            $table->timestamps();

            // Optional: add foreign key constraint for product_category_id if related table exists
            // $table->foreign('product_category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
