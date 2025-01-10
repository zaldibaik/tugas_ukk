<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeProductCategoryIdNullable extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat kolom product_category_id nullable.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('product_category_id')->nullable()->change(); // Menjadikan kolom nullable
        });
    }

    /**
     * Membalikkan perubahan pada migrasi ini.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('product_category_id')->nullable(false)->change(); // Mengubah kembali kolom menjadi tidak nullable
        });
    }
}
