<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'buyer_name',
        'buyer_address',
        'total_price',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
