<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Add a product to the cart
    public function add(Request $request, $id)
    {
        // Find the product by its ID
        $product = Products::find($id);

        // If the product exists, add it to the cart
        if ($product) {
            // Check if the product already exists in the cart
            $cartItem = Cart::where('product_id', $product->id)->first();

            if ($cartItem) {
                // If the product already exists in the cart, increment its quantity
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                // If the product does not exist in the cart, create a new cart item
                $cart = new Cart();
                $cart->product_id = $product->id;
                $cart->quantity = 1;
                $cart->save();
            }

            // Return a success response
            return response()->json(['message' => 'Product added to cart successfully']);
        } else {
            // Return an error response if the product does not exist
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    // Remove a product from the cart
    public function remove($id)
    {
        // Find the cart item by its ID
        $cartItem = Cart::find($id);

        if ($cartItem) {
            // Delete the cart item
            $cartItem->delete();

            // Return a success response
            return response()->json(['message' => 'Product removed from cart successfully']);
        } else {
            // Return an error response if the cart item does not exist
            return response()->json(['error' => 'Cart item not found'], 404);
        }
    }
}