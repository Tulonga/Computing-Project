<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    public function index(){
        return view('products.index');
    }

    public function create(){
        return redirect()->route('products.index')
                            ->with('success', 'Products created successfully.');
    }


    public function store(Request $request){
        //
        $validatedData = $request->validate([
            'product_name' =>'required| string',
            'description' =>'required| string',
            'price' =>'required| numeric',
           'stock_quantity' =>'required| integer',
           'category_id' =>'required| integer',
        ]);
        dd($request);
    }

    public function showAllProducts(){
        $products = Products::all();
        return view('pages.products', ['products' => $products]);
    }

    
    public function show(Request $request, $id )
    {
         $products = Products::find();
    
        if (!$products) {
            return redirect()->route('products.index')
                                    ->with('error', 'Product not found.');
        }
    
        return view('pages.product_page', ['product' => $products ]);
    }


}
