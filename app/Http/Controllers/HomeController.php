<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function home(){
        return view('pages.home.home');
    }

    public function productList(){
        $products = Product::with('category')->get();
        return view('pages.home.product.list')->with('products',$products);
    }
}
