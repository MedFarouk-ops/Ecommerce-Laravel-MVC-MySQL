<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',       // e.g., pending, processing, shipped, delivered
        'total_amount', // total price of the order
    ];

    /**
     * The user who placed the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The items in this order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
