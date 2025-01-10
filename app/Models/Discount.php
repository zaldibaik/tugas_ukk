<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'category_discount_id',
        'product_id',
        'start_date',
        'end_date',
        'percentage',
    ];

    // Tipe atribut yang akan di-cast
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Relasi ke model CategoryDiscount (jika ada)
     * Misalnya, jika Anda memiliki model CategoryDiscount yang terhubung dengan kolom category_discount_id
     */
    public function categoryDiscount()
    {
        return $this->belongsTo(DiscountCategory::class, 'category_discount_id');
    }
    

    /**
     * Relasi ke model Product (jika ada)
     * Misalnya, jika Anda memiliki model Product yang terhubung dengan kolom product_id
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}   
