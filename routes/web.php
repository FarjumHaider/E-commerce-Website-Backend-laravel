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

// Category CRUD
Route::get('/category/create',[CategoryController::class,'createCategory'])->name('category.create')->middleware('ValidAdmin');
Route::post('/category/create',[CategoryController::class,'createSubmit'])->name('category.create')->middleware('ValidAdmin');
Route::get('/category/list',[CategoryController::class,'categoryList'])->name('category.list')->middleware('ValidAdmin');
Route::get('category/edit/{id}/{name}',[CategoryController::class,'categoryEdit'])->middleware('ValidAdmin');
Route::post('/category/edit',[CategoryController::class,'editSubmit'])->name('category.edit')->middleware('ValidAdmin');
Route::get('/category/delete/{id}/{name}',[CategoryController::class,'delete'])->middleware('ValidAdmin');

//Category search
Route::get('/category/search',[CategoryController::class,'search'])->name('category.search')->middleware('ValidAdmin');

// Product CRUD
Route::get('/product/create',[ProductController::class,'createProduct'])->name('product.create')->middleware('ValidAdmin');
Route::post('/product/create',[ProductController::class,'createSubmit'])->name('product.create')->middleware('ValidAdmin');
Route::get('/product/list',[ProductController::class,'productList'])->name('product.list');
Route::get('product/edit/{id}/{name}',[ProductController::class,'productEdit'])->middleware('ValidAdmin');
Route::post('/product/edit',[ProductController::class,'editSubmit'])->name('product.edit')->middleware('ValidAdmin');
Route::get('/product/delete/{id}/{name}',[ProductController::class,'delete'])->middleware('ValidAdmin');

//Product search
Route::get('/product/search',[ProductController::class,'search'])->name('product.search')->middleware('ValidAdmin');

// Generate report
Route::get('/product/report',[ProductReportController::class,'productReport'])->name('product.report')->middleware('ValidAdmin');
Route::post('/product/report',[ProductReportController::class,'reportSearch'])->name('product.report')->middleware('ValidAdmin');

//login
Route::get('/',[LoginController::class,'login'])->name('login');
Route::post('/',[LoginController::class,'loginSubmit'])->name('login');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');