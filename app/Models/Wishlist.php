<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan
    protected $table = 'wishlists';

    // Tentukan kolom yang boleh diisi
    protected $fillable = [
        'user_id', 
        'product_id',
    ];

    /**
     * Relasi ke model Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
