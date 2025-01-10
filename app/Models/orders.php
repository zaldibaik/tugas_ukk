<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model  // Menggunakan huruf kapital di awal nama model
{
    use HasFactory;

    // Menambahkan kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'customer_id',  // Menyimpan ID customer yang melakukan pesanan
        'order_date',    // Tanggal pesanan
        'total_amount',  // Total harga
        'status',        // Status pesanan
    ];

    // Relasi ke model Customer
    public function customer() 
    {
        return $this->belongsTo(Customers::class); // Relasi dengan model Customer
    }

    // Relasi ke model OrderItem

    // Relasi ke model Payment (1 pembayaran untuk 1 order)
    public function payment()
    {
        return $this->hasOne(Payment::class); // Relasi dengan model pembayaran
    }
}


