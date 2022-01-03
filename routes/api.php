<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\DashboardApiController;
use App\Http\Controllers\LoginApiController;
use App\Http\Controllers\SalaryApiController;
use App\Http\Controllers\LogoutApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Admin dashboard
Route::get('/admin/home', [DashboardApiController::class,'home'])->middleware('APIAuth');


//Admin
Route::get('/admin/list',[AdminApiController::class,'AdminApiList'])->middleware('APIAuth');
Route::get('/admin/details/{id}/{name}',[AdminApiController::class,'AdminAPIDetails'])->middleware('APIAuth');
Route::post('/add/admin',[AdminApiController::class,'AdminAPICreate'])->middleware('APIAuth');
Route::get('/admin/delete/{id}',[AdminApiController::class,'AdminAPIdelete'])->middleware('APIAuth');
Route::get('/edit/admin/{id}',[AdminApiController::class,'AdminApiEdit'])->middleware('APIAuth');
Route::post('/edit/admin',[AdminApiController::class,'AdminApiEditSubmit'])->middleware('APIAuth');


//Category
Route::get('/category/list',[CategoryApiController::class,'CategoryApiList'])->middleware('APIAuth');
Route::get('/category/delete/{id}',[CategoryApiController::class,'CategoryAPIdelete'])->middleware('APIAuth');
Route::post('/add/category',[CategoryApiController::class,'CategoryAPICreate'])->middleware('APIAuth');
Route::get('/edit/category/{id}/{name}',[CategoryApiController::class,'CategoryApiEdit'])->middleware('APIAuth');
Route::post('/edit/category',[CategoryApiController::class,'CategoryApiEditSubmit'])->middleware('APIAuth');


//Product
Route::get('/product/list',[ProductApiController::class,'ProductApiList'])->middleware('APIAuth');
Route::post('/add/product',[ProductApiController::class,'ProductAPICreate'])->middleware('APIAuth');
Route::get('/edit/product/{id}',[ProductApiController::class,'ProductApiEdit'])->middleware('APIAuth');
Route::post('/edit/product',[ProductApiController::class,'ProductApiEditSubmit'])->middleware('APIAuth');
Route::get('/product/delete/{id}',[ProductApiController::class,'ProductAPIdelete'])->middleware('APIAuth');
Route::get('/product/details/{id}/{name}',[ProductApiController::class,'ProductAPIDetails'])->middleware('APIAuth');


//Salary
Route::get('/employee/salary',[SalaryApiController::class,'salaryPayingApiList'])->middleware('APIAuth');
Route::get('/salary/payed/list',[SalaryApiController::class,'salaryPayedList'])->middleware('APIAuth');
Route::get('/salary/paying/{id}',[SalaryApiController::class,'salaryPaying'])->middleware('APIAuth');
Route::post('/salary/paying',[SalaryApiController::class,'payingSubmit'])->middleware('APIAuth');
Route::get('/salary/paying/due/{id}',[SalaryApiController::class,'salaryPayingDue'])->middleware('APIAuth');
Route::post('/salary/paying/due',[SalaryApiController::class,'payingDueSubmit'])->middleware('APIAuth');

//login
Route::post('/login',[LoginApiController::class,'loginApiSubmit']);

Route::get('/logout/{tokenkey}',[LogoutApiController::class,'logout']);