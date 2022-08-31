<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
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
//Admin
Route::get('/admin', [AdminController::class, 'dashboard']);
//Product
Route::get('/list-product', [ProductController::class, 'productList']);
Route::get('/insert-form-product', [ProductController::class, 'formInsertProduct']);
Route::get('/delete-product/{id_product}', [ProductController::class, 'deleteProduct']);
Route::get('/edit-form-product/{id_product}', [ProductController::class, 'editFormProduct']);
Route::post('/insert-product', [ProductController::class, 'insertProduct']);
Route::post('/edit-product/{id_product}', [ProductController::class, 'editProduct']);