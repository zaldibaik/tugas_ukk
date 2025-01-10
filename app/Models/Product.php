<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'description', 'price', 'stok_quantity', 'product_category_id'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function reviews()
{
    return $this->hasMany(ProductReview::class);
}

public function discounts()
{
    return $this->hasMany(Discount::class, 'product_id'); // Sesuaikan 'product_id' dengan foreign key
}
    
}
