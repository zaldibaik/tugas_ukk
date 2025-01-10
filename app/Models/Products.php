<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model
    protected $table = 'products';

    // Menentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'product_category_id',
        'product_name',
        'description',
        'price',
        'stok_quantity',
        'image1_url',
        'image2_url',
        'image3_url',
        'image4_url',
        'image5_url',
    ];

    // Relasi ke tabel kategori (jika ada relasi)
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    public function discounts()
    {
        return $this->hasMany(Discount::class, 'product_id'); // Sesuaikan 'product_id' dengan foreign key
    }


    // Jika Anda ingin menetapkan atribut default (misalnya, gambar default)
    protected $attributes = [
        'image1_url' => 'default_image_url.jpg',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    // Di model Product
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }




}
