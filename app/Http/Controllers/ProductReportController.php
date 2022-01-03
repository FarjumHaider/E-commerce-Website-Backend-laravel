<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductReportController extends Controller
{
        public function productReport(){

        $products = Product::with('category')->get();
        // return view('pages.products.list')->with('products',$products);
            
        return view('pages.Generate report.product')->with('products',$products);
    }

    public function reportSearch(Request $request){

        $from=$request->fromDate;
        $to=$request->toDate;

        $products = Product::with('category')->where('stock_date','>=',$from)->where('stock_date','<=',$to)->get();
        // return view('pages.products.list')->with('products',$products);
            
        return view('pages.Generate report.product')->with('products',$products);
            
        return $from;
    }

    
}
