<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Category;

class ProductsController extends Controller
{
    

    public function singleCategory($id) {

        $products = Product::select()->orderBy('id', 'desc')
         ->where('category_id', $id)->get();

         return view('products.singlecategory', compact('products'));
    }

    public function singleProduct($id) {

        $product = Product::find($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
         ->where('id', '!=', $id)
         ->get();

         return view('products.singleproduct', compact('product', 'relatedProducts'));
    }


    public function shop() {

        $categories = Category::select()->orderBy('id', 'desc')->get();

        $mostWanted = Product::select()->orderBy('name', 'desc')->take(5)
         ->get();

        $vegetables = Product::select()->where('category_id', "=", 5)
         ->orderBy('id', 'desc')->take(5)
         ->get();



        $meats = Product::select()->where('category_id', "=", 1)
         ->orderBy('id', 'desc')->take(5)
         ->get();


        $fishes = Product::select()->where('category_id', "=", 2)
         ->orderBy('id', 'desc')->take(5)
         ->get(); 


        $fruits = Product::select()->where('category_id', "=", 4)
         ->orderBy('id', 'desc')->take(5)
         ->get();




         return view('products.shop', compact('categories', 'mostWanted', 'vegetables', 'meats', 'fishes', 'fruits'));
    }


    
}
