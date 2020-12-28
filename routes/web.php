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
//front-end
Route::get('/', 'App\Http\Controllers\HomeController@index');

//back-end
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');

Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
// Category Product
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');

Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');

Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
// Customer 


Route::get('/login', 'App\Http\Controllers\CustomersController@index_login');
Route::get('/register', 'App\Http\Controllers\CustomersController@index_register');
Route::post('/save-register-list', 'App\Http\Controllers\CustomersController@save_register_list');



