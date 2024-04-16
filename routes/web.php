<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('products.index');
    })->name('dashboard');
});


require __DIR__.'/auth.php';


Route::get('/products', [ProductsController::class, 'index'])->name('Products.index');

Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');

Route::get('/products/create', [ProductsController::class, 'create'])->name('Products.create');

Route::post('/products', [ProductsController::class, 'store'])->name('Products.store');

Route::get('/products/cart', [ProductsController::class, 'cart'])->name('Products.cart');

require __DIR__.'/auth.php';
