<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $table = 'product_reviews';

    protected $fillable = [
        'customer_id',
        'product_id',
        'rating',
        'comment',
    ];

    // Relasi ke model Customer
    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customers_id', 'id'); // Sesuaikan jika nama modelnya Customer
    }

    // Relasi ke model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
