<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('home');
});
Auth::routes(['register' => false]);

Auth::routes();


Route::middleware('auth:web')->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('user',UserController::class);
    Route::resource('branch',BranchController::class);
    Route::resource('brand',BrandController::class);
    Route::resource('product',ProductController::class);
    Route::resource('product-type',ProductTypeController::class);
    Route::resource('stock-out',StockOutController::class);
});

