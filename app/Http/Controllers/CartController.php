<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Products;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {

        $product = Products::find($productId);


        $cartItem = Cart::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {

            $cartItem->quantity += 1;
            $cartItem->save();
        } else {

            $cartItem = new Cart();
            $cartItem->user_id = auth()->id();
            $cartItem->product_id = $product->id;
            $cartItem->quantity = 1;
            $cartItem->save();
        }

        return response()->json(['message' => 'Product added to cart']);
    }

   
}
