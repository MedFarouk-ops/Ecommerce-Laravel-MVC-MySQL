<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'city',
        'postal_code',
        'notes',
        'payment_method',
        'total_amount',
        'shipping_cost',
        'status', // pending, processing, etc.
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
