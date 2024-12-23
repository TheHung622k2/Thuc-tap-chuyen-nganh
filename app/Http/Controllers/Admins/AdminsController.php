<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Order;
use App\Models\Product\Category;
use App\Models\Admin\Admin;
use Redirect;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    


    public function viewLogin() {

        return view('admins.login'); 
    }


    public function checkLogin(Request $request) {

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }


    public function index() {


        $productsCount = Product::select()->count();
        $ordersCount = Order::select()->count();
        $categoriesCount = Category::select()->count();
        $adminsCount = Admin::select()->count();

        return view('admins.index', compact('productsCount', 'ordersCount', 'categoriesCount', 'adminsCount')); 
    }



    public function displayAdmins() {

        
        $allAdmins = Admin::all();

        return view('admins.alladmins', compact('allAdmins')); 
    }

    public function createAdmins() {

        
        

        return view('admins.createadmins'); 
    }



    public function storeAdmins(Request $request) {

        $storeAdmins = Admin::create([

            "email" => $request->email,
            "name" => $request->name,
            "password" => Hash::make($request->password),
        ]);
        

        if($storeAdmins) {
            return Redirect::route("admins.all")->with(['success' => 'Admin created successfully']);

        }
    }


    public function displayCategories() {

        
        $allCategories = Category::select()->orderBy('id', 'desc')->get();

        return view('admins.allcategories', compact('allCategories')); 

    }


    public function createCategories() {

        
        

        return view('admins.createcategories'); 

    }



    public function storeCategories(Request $request) {


        $destinationPath = 'assets/img';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);


        $storeCategories = Category::create([

            "icon" => $request->icon,
            "name" => $request->name,
            "image" => $myimage,
        ]);
        

        if($storeCategories) {
            return Redirect::route("categories.all")->with(['success' => 'Category created successfully']);

        }
    }
    

    

    

    
    
    

    
}
