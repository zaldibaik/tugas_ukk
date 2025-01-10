<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('name')->nullable();        // Nama pelanggan
        $table->string('phone')->nullable();       // Nomor telepon
        $table->string('address1')->nullable();    // Kota
        $table->string('address2')->nullable();    // Alamat jalan
        $table->string('address3')->nullable();    // Alamat lengkap
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['name', 'phone', 'address1', 'address2', 'address3']);
    });
}

};
