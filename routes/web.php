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
Route::get('/users_login', 'App\Http\Controllers\UserController@index');
Route::get('/users_register', 'App\Http\Controllers\UserController@index_register');


//back-end
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');

Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
<<<<<<< Updated upstream
// Category Product
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
<<<<<<< Updated upstream
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all-category-product');
=======

>>>>>>> Stashed changes
=======
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');
>>>>>>> Stashed changes
