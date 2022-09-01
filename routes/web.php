<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
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
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');
//Category
Route::get('/list-category',[CategoryController::class, 'categoryList'])->name('category.listCategory');
Route::get('/insert-form-category', [CategoryController::class, 'formInsertCategory'])->name('category.insertFormCategory');
Route::post('/insert-category', [CategoryController::class, 'insertCategory'])->name('category.insertCategory');
//Product
// đặt tên cho tất cả các route
Route::get('/list-product', [ProductController::class, 'productList'])->name('product.listFormProduct');
Route::get('/insert-form-product', [ProductController::class, 'formInsertProduct'])->name('product.insertFormProduct');
Route::get('/delete-product/{id_product}', [ProductController::class, 'deleteProduct'])->name('product.deleteProduct');
Route::get('/edit-form-product/{id_product}', [ProductController::class, 'editFormProduct'])->name('product.editFormProduct');
Route::post('/insert-product', [ProductController::class, 'insertProduct'])->name('product.insertProduct');
Route::post('/edit-product/{id_product}', [ProductController::class, 'editProduct'])->name('product.editProduct');
