<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Kolom 'id' dengan auto-increment dan unsigned
            $table->string('name', 50); // Kolom 'name' dengan panjang maksimal 50 karakter
            $table->string('phone', 20)->unique(); // Kolom 'phone' dengan panjang maksimal 20 karakter, harus unik
            $table->text('address1'); // Kolom 'address1' dengan tipe text
            $table->text('address2')->nullable(); // Kolom 'address2' dengan tipe text, boleh NULL
            $table->text('address3')->nullable(); // Kolom 'address3' dengan tipe text, boleh NULL
            $table->string('status', 20)->default('active'); // Menambahkan kolom 'status' dengan default 'active'
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
