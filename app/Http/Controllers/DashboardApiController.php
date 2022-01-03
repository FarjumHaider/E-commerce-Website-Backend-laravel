<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Models\Employee;


class DashboardApiController extends Controller
{
    public function home(){

        $admins = Admin::all();
        $employees = Employee::all();
        $products = Product::all();
        $categories = Category::all();

        return response()->json([
            "admins"=>count($admins),
            "employees"=>count($employees),
            "products"=>count($products),
            "categories"=>count($categories),
        ]);
    }
}
