<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//products
Route::get('products/category/{id}', [App\Http\Controllers\Products\ProductsController::class, 'singleCategory'])->name('single.category');
Route::get('products/single-product/{id}', [App\Http\Controllers\Products\ProductsController::class, 'singleProduct'])->name('single.product');
Route::get('products/shop', [App\Http\Controllers\Products\ProductsController::class, 'shop'])->name('products.shop');

//cart
Route::post('products/add-cart', [App\Http\Controllers\Products\ProductsController::class, 'addToCart'])->name('products.add.cart');