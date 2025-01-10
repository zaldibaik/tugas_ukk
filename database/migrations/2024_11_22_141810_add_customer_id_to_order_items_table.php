<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerIdToOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Menambahkan kolom customer_id
            $table->unsignedBigInteger('customer_id')->after('price');

            // Menambahkan foreign key yang menghubungkan dengan tabel customers
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Menghapus foreign key
            $table->dropForeign(['customer_id']);

            // Menghapus kolom customer_id
            $table->dropColumn('customer_id');
        });
    }
}
