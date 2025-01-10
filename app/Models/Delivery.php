<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'deliveries';

    protected $fillable = [
        'order_id',
        'shipping_date',
        'tracking_code',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
