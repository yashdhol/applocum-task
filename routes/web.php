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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('products', App\Http\Controllers\ProductController::class);
Route::post('product-data', [App\Http\Controllers\ProductController::class, 'productData']);
Route::resource('category', App\Http\Controllers\CategoryController::class);
Route::post('category-data', [App\Http\Controllers\CategoryController::class, 'categoryData']);
Route::resource('users', App\Http\Controllers\UsersController::class);
Route::post('users-data', [App\Http\Controllers\UsersController::class, 'usersData']);
