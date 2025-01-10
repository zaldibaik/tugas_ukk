<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Dalam file migrasi
public function up()
{
    if (!Schema::hasColumn('products', 'image1_url')) {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image1_url')->nullable();
        });
    }
}


public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('image1_url');
    });
}
};
