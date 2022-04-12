<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Customer;
use App\Models\Order;

class CustomerController extends Controller
{
    public function home(){
        return view('pages.customer.home');
    }

    //All order
    public function myOrders(){
        $customer_id = Session('Customer_id');
        $orders = Order::where('customer_id',$customer_id)->with('customer')->get();
        //return $orders;
        return view('pages.customer.myorders')->with('orders',$orders);
    }

    //order details
    public function orderdetails(Request $request){
        $id = $request->id;
        $order = Order::where('id',$id)->with('customer')->with('orderdetail')->first();
        //return $order->id;
        //return $order->products[0]->order->customer;
        return view('pages.customer.orderdetails')->with('order',$order);
    }

    //Registration form
    public function createCustomer(){
        return view('pages.customer.create');
    }

    //Create customer
    
    public function createSubmit(Request $request){

        $this->validate(
            $request,
            [
                'fname'=>'required|min:3|max:50',
                'lname'=>'required|min:3|max:50',
                'address'=>'required|min:4|max:50',
                'email'=>'email',
                'username'=>'required|min:4|max:20',
                'password'=>'required',
                'conpassword'=>'required|same:password',
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'image'=>'required'

            ],
            [
                'fname.required'=>'First name required',
                'fname.min'=>'First name should be more than 3 charcters',
                'fname.max'=>'First name should be less than 50 charcters',
                'lname.required'=>'last name required',
                'lname.min'=>'Fast name should be more than 3 charcters',
                'lname.max'=>'Fast name should be less than 50 charcters',
                'address.required'=>'Address required',
                'email.required'=>'Email required',
                'username.required'=>'Username required',
                'password.required'=>'Password required',
                'conpassword.required'=>'Confirm password required',
                'phone.required'=>'Phone number required',

            ]
        );

        $var = new Customer();
        $var->f_name= $request->fname;
        $var->l_name = $request->lname;
        $var->uname = $request->username;
        $var->password = $request->password;
        $var->email = $request->email;
        $var->phone = $request->phone;
        $var->address = $request->address;
        $var->status = "Pending";

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/customer_images/',$filename);
            $var->image = $filename;
        }
        $var->save();

        return redirect()->route('login');
        // return redirect()->route('productlist');   

        // return redirect()->route('customer.list');
    }

    
    //****manage by Employee start****
    //customer list 
    public function customerList(){

        $customers = Customer::all();
        return view('pages.customer.list')->with('customers',$customers);
    }

    //customer deactive
    public function deactive(Request $request){
        $var = Customer::where('id',$request->id)->first();
        $var->status = "Deactive";
        $var->save();
        return redirect()->route('customer.list');
    }

    //customer active 
    public function active(Request $request){
        $var = Customer::where('id',$request->id)->first();
        $var->status = "Active";
        $var->save();
        return redirect()->route('customer.list');
    }
    
    //****manage by Employee start****
}
