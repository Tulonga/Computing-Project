<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Define the relationship with the product
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}