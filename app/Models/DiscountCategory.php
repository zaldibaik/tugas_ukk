<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCategory extends Model
{
    use HasFactory;

    // Nama tabel, jika mengikuti konvensi Laravel, Anda bisa menghilangkan properti ini
    protected $table = 'discount_categories';

    // Tentukan kolom yang bisa diisi (fillable) menggunakan mass assignment
    protected $fillable = [
        'category_name',  // Pastikan nama kolom sesuai dengan yang ada di tabel
    ];

    // Jika tabel memiliki kolom timestamps (created_at, updated_at)
    public $timestamps = true;

    // Relasi dengan model lain jika ada (contoh relasi dengan model Discount)
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}
