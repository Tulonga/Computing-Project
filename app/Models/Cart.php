<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cart) {
            $cart->user_id = auth()->id();
        });
    }

    public function getTotalPriceAttribute()
    {
        return $this->product->price * $this->quantity;
    }
}