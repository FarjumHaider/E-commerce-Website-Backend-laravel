<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DeliveryManController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Admin part start
//Admin dashboard
Route::get('/admin/dash', [DashboardController::class,'home'])->name('admin.home')->middleware('ValidAdmin');

// Admin CRUD
Route::get('/admin/create',[AdminController::class,'createAdmin'])->name('admin.create')->middleware('ValidAdmin');
Route::post('/admin/create',[AdminController::class,'createSubmit'])->name('admin.create')->middleware('ValidAdmin');
Route::get('/admin/list',[AdminController::class,'adminList'])->name('admin.list')->middleware('ValidAdmin');
Route::get('admin/edit/{id}/{name}',[AdminController::class,'adminEdit'])->middleware('ValidAdmin');
Route::post('/admin/edit',[AdminController::class,'editSubmit'])->name('admin.edit')->middleware('ValidAdmin');
Route::get('/admin/delete/{id}/{name}',[AdminController::class,'delete'])->middleware('ValidAdmin');

//Admin search
Route::get('/admin/search',[AdminController::class,'search'])->name('admin.search')->middleware('ValidAdmin');

// Employee CRUD
Route::get('/employee/create',[EmployeeController::class,'createEmployee'])->name('employee.create')->middleware('ValidAdmin');
Route::post('/employee/create',[EmployeeController::class,'createSubmit'])->name('employee.create')->middleware('ValidAdmin');
Route::get('/employee/list',[EmployeeController::class,'employeeList'])->name('employee.list')->middleware('ValidAdmin');
Route::get('employee/edit/{id}/{name}',[EmployeeController::class,'employeeEdit'])->middleware('ValidAdmin');
Route::post('/employee/edit',[EmployeeController::class,'editSubmit'])->name('employee.edit')->middleware('ValidAdmin');
Route::get('/employee/delete/{id}/{name}',[EmployeeController::class,'delete'])->middleware('ValidAdmin');

//Employee search
Route::get('/employee/search',[EmployeeController::class,'search'])->name('employee.search')->middleware('ValidAdmin');

//Salary 
Route::get('/employee/salary',[SalaryController::class,'salaryPayingList'])->name('salary.payingList')->middleware('ValidAdmin');
Route::get('/salary/paying/{id}/{name}',[SalaryController::class,'salaryPaying'])->name('salary.paying')->middleware('ValidAdmin');
Route::post('/salary/paying',[SalaryController::class,'payingSubmit'])->name('salary.paying')->middleware('ValidAdmin');
Route::get('/salary/payed/list',[SalaryController::class,'salaryPayedList'])->name('salary.payedList')->middleware('ValidAdmin');
Route::get('/salary/paying/due/{id}/{name}',[SalaryController::class,'salaryPayingDue'])->name('salary.payingDue')->middleware('ValidAdmin');
Route::post('/salary/paying/due',[SalaryController::class,'payingDueSubmit'])->name('salary.payingDue')->middleware('ValidAdmin');

//Salar search
Route::get('/salary/search/payinglist',[SalaryController::class,'searchPayingList'])->name('salaryPayingList.search')->middleware('ValidAdmin');

// Generate report
Route::get('/product/report',[ProductReportController::class,'productReport'])->name('product.report')->middleware('ValidAdmin');
Route::post('/product/report',[ProductReportController::class,'reportSearch'])->name('product.report')->middleware('ValidAdmin');
// Admin part end


// ****Employee part start****
//Employer Dashboard
Route::get('/employee/dash', [EmployeeController::class,'home'])->name('employee.home')->middleware('ValidEmployee');

//DeliveryMan CRUD
Route::get('/deliveryMan/create',[DeliveryManController::class,'createDeliveryMan'])->name('deliveryMan.create')->middleware('ValidEmployee');
Route::post('/deliveryMan/create',[DeliveryManController::class,'createSubmit'])->name('deliveryMan.create')->middleware('ValidEmployee');
Route::get('/deliveryMan/list',[DeliveryManController::class,'deliveryManList'])->name('deliveryMan.list')->middleware('ValidEmployee');
Route::get('deliveryMan/edit/{id}/{name}',[DeliveryManController::class,'deliveryManEdit'])->middleware('ValidEmployee');
Route::post('/deliveryMan/edit',[DeliveryManController::class,'editSubmit'])->name('deliveryMan.edit')->middleware('ValidEmployee');
Route::get('/deliveryMan/delete/{id}/{name}',[DeliveryManController::class,'delete'])->middleware('ValidEmployee');

//DeliveryMan search
Route::get('/deliveryMan/search',[DeliveryManController::class,'search'])->name('deliveryMan.search')->middleware('ValidEmployee');

//Manage Customer
Route::get('/customer/list',[CustomerController::class,'customerList'])->name('customer.list')->middleware('ValidEmployee');
Route::get('/customer/deactive/{id}',[CustomerController::class,'deactive'])->middleware('ValidEmployee');
Route::get('/customer/active/{id}',[CustomerController::class,'active'])->middleware('ValidEmployee');

//Manage Order
Route::get('/order/list',[OrderController::class,'orderList'])->name('order.list')->middleware('ValidEmployee');
Route::get('/order/delete/{id}',[OrderController::class,'delete'])->middleware('ValidEmployee');
Route::get('/order/confirm/list',[OrderController::class,'orderConfirmList'])->name('order.confirmList')->middleware('ValidEmployee');
Route::get('/order/confirm/{id}',[OrderController::class,'confirm'])->middleware('ValidEmployee');
// ****Employee part end****


// Common for Admin & Employee start
// Category CRUD
Route::get('/category/create',[CategoryController::class,'createCategory'])->name('category.create')->middleware('ValidAdminEmployee');
Route::post('/category/create',[CategoryController::class,'createSubmit'])->name('category.create')->middleware('ValidAdminEmployee');
Route::get('/category/list',[CategoryController::class,'categoryList'])->name('category.list')->middleware('ValidAdminEmployee');
Route::get('category/edit/{id}/{name}',[CategoryController::class,'categoryEdit'])->middleware('ValidAdminEmployee');
Route::post('/category/edit',[CategoryController::class,'editSubmit'])->name('category.edit')->middleware('ValidAdminEmployee');
Route::get('/category/delete/{id}/{name}',[CategoryController::class,'delete'])->middleware('ValidAdminEmployee');

//Category search
Route::get('/category/search',[CategoryController::class,'search'])->name('category.search')->middleware('ValidAdminEmployee');


// Product CRUD
Route::get('/product/create',[ProductController::class,'createProduct'])->name('product.create')->middleware('ValidAdminEmployee');
Route::post('/product/create',[ProductController::class,'createSubmit'])->name('product.create')->middleware('ValidAdminEmployee');
Route::get('/product/list',[ProductController::class,'productList'])->name('product.list');
Route::get('product/edit/{id}/{name}',[ProductController::class,'productEdit'])->middleware('ValidAdminEmployee');
Route::post('/product/edit',[ProductController::class,'editSubmit'])->name('product.edit')->middleware('ValidAdminEmployee');
Route::get('/product/delete/{id}/{name}',[ProductController::class,'delete'])->middleware('ValidAdminEmployee');

//Product search
Route::get('/product/search',[ProductController::class,'search'])->name('product.search')->middleware('ValidAdminEmployee');
// Common for Admin & Employee end


//login
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/login',[LoginController::class,'loginSubmit']);
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

//Home page
Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/home/product/list',[HomeController::class,'productList'])->name('home.product.list');


//Customer
Route::get('/addtocart/{id}',[ProductController::class,'addtocart'])->name('products.addtocart');
Route::get('/cart',[ProductController::class,'mycart'])->name('products.mycart');
Route::get('/emptycart',[ProductController::class,'emptycart'])->name('products.emptycart');
Route::post('/checkout',[ProductController::class,'checkout'])->name('checkout')->middleware('ValidCustomer');

Route::get('/customer/registration',[CustomerController::class,'createCustomer'])->name('customer.create');
Route::post('/customer/registration',[CustomerController::class,'createSubmit'])->name('customer.create');
Route::get('/customer/dash', [CustomerController::class,'home'])->name('customer.home')->middleware('ValidCustomer');
Route::get('/customer/myorders',[CustomerController::class,'myorders'])->name('customer.myorders')->middleware('ValidCustomer');
Route::get('/customer/myorders/details/{id}',[CustomerController::class,'orderdetails'])->name('customer.myorders.details')->middleware('ValidCustomer');
