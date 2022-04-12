<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;

class OrderController extends Controller
{
    public function orderList(){

        $orders = Order::with('customer')->get();

        // return  $orders;
        return view('pages.order.list')->with('orders',$orders);
    }

    public function delete(Request $request){
        $var = Order::where('id',$request->id)->first();
        $var->delete();
        return redirect()->route('order.list');
    }

    public function confirm(Request $request){
        $id = $request->id;
        // return $id;
        $var = Order::where('id',$request->id)->first();
        // $category = Category::where('id',$id)->first();
        
        $var->status = "Confirm";
        
        $var->save();
        //return "confirm";
       
        return redirect()->route('order.confirmList');


    }

    public function orderConfirmList(){
        
        
        //return "ok";
        $orders = Order::with('customer')->get();


        // return  $orders;
        return view('pages.order.confirmList')->with('orders',$orders);
    }
}
