<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderDateToCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Menambahkan kolom order_date setelah address3
            $table->date('order_date')->nullable()->after('address3');
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Menghapus kolom order_date
            $table->dropColumn('order_date');
        });
    }
}
