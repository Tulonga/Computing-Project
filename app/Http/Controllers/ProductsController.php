<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('products.index', ['products' => $products]);
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Products::find($productId);
        
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'product' => $product,
                'quantity' => 1
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function store(Request $request)
    {
        dd($request);

        $validatedData = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image_url' => ['required', 'url'] 
        ]);

        $product = Products::create($validatedData);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
            
    }

    public function create()
    {
        return view('products.index');
    }

    public function show(Products $product)
    {
        return view('products.show', compact('product'));
    }


}

