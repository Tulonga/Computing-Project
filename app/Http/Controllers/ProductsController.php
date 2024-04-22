<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class productsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('products.index', compact('products'));
    }

    public function addToCart(Request $request, $productsId)
    {
        $products = Products::find($productsId);
        if (!$products) {
            return redirect()->back()->withErrors(['message' => 'products not found.']);
        }
        
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$productsId])) {
            $cart[$productsId]['quantity']++;
        } else {
            $cart[$productsId] = [
                'products' => $products,
                'quantity' => 1
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'products added to cart.');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'products_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image_url' => ['required', 'url'] 
        ]);

        // Begin a new database transaction
        DB::beginTransaction();

        try {
            // Create a new products using the validated data
            $products = Products::create($validatedData);

            // Check if the products creation was successful
            if ($products) {
                // products created successfully, now send HTTP POST request to API
                $response = Http::post('/api/products', $validatedData);

                if ($response->successful()) {
                    // API call successful, handle the created products
                    $apiproducts = $response->json();
                    // Handle the created products from the API response
                } else {
                    // API call failed, rollback the database transaction and throw an exception
                    throw new \Exception('API call failed with status code ' . $response->status());
                }

                // Commit the database transaction
                DB::commit();

                // Redirect back to the index page with a success message
                return redirect()->route('products.index')->with('success', 'products created successfully.');
            } else {
                // products creation failed, rollback the database transaction and throw an exception
                throw new \Exception('Failed to create products in the local database.');
            }
        } catch (\Exception $e) {
            // Rollback the database transaction and log the error
            DB::rollBack();
            Log::error($e->getMessage());

            // Redirect back with an error message
            throw ValidationException::withMessages(['message' => 'An error occurred while creating the products. Please try again later.']);
        }
    }

    public function create()
    {
        return view('products.create');
    }

    public function show(Products $products)
    {
        return view('products.index');
    }

    public function cart()
    {
        return view('products.cart');
    }
}
