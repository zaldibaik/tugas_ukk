<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customers;
use App\Models\Product;
use App\Models\Payment;

class orderItem extends Model
{
    use HasFactory;

    protected $fillable = [
       'products_id', 'customers_id','product_name', 'total_price', 'quantity',
    ];
    // Relasi ke model Product
    // OrderItem.php
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    // Relasi ke model Order
    // Model OrderItem.php
    public function order()
    {
        return $this->belongsTo(orders::class, 'order_id');
    }
    
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
