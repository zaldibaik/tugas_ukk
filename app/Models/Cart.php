<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama model
    protected $table = 'carts';

    // Tentukan kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'total_price',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);  // Asumsi ada model User
    }

    // Relasi dengan model Product
    public function product()
    {
        return $this->belongsTo(Product::class);  // Asumsi ada model Product
    }

    // Optional: Jika Anda ingin menghitung total harga dari quantity dan price
    public function calculateTotalPrice()
    {
        return $this->quantity * $this->price;
    }
}
