<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'subtotal', 'delivery', 'total', 'user_id', 'public_token', 'client',
        'message', 'language', 'payment_method',
    ];

    protected $casts = [
        'subtotal' => 'float',
        'delivery' => 'float',
        'total' => 'float',
        'client' => 'array',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
