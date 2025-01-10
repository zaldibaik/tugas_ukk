<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveOrderIdFromOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Hapus foreign key constraint jika ada
            $table->dropForeign(['order_id']);

            // Hapus kolom order_id
            $table->dropColumn('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Tambahkan kembali kolom order_id
            $table->unsignedBigInteger('order_id')->nullable();

            // Jika sebelumnya memiliki foreign key, tambahkan kembali
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }
}

