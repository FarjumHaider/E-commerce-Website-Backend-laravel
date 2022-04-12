<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Models\Employee;


class DashboardController extends Controller
{
    public function home(){

        $admins = Admin::all();
        $employees = Employee::all();
        $products = Product::all();
        $categories = Category::all();

        return view('pages.admin.home')
        ->with('admins',$admins)
        ->with('products',$products)
        ->with('employees',$employees);
    }
}
