<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;

class ProductsController extends Controller
{
    

    public function singleCategory($id) {

        $products = Product::select()->orderBy('id', 'desc')
         ->where('category_id', $id)->get();

         return view('products.singlecategory', compact('products'));
    }

    public function singleProduct($id) {

        $product = Product::find($id);

         return view('products.singleproduct', compact('product'));
    }


    
}
