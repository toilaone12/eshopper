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
// Route: giup dinh tuyen cac URL path tuong ung MVC
//Admin
Route::prefix('admin')->group(function(){ //tiền tố cho các uri bên trong $callback
    Route::get('/login',[AdminController::class,'login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/save-login',[AdminController::class,'saveLogin'])->name('admin.saveLogin');
    //Category
    Route::prefix('category')->group(function(){
        Route::get('/list-category',[CategoryController::class, 'categoryList'])->name('category.listCategory');
        Route::get('/insert-form-category', [CategoryController::class, 'formInsertCategory'])->name('category.insertFormCategory');
        Route::get('/edit-form-category/{idCategory}', [CategoryController::class, 'editFormCategory'])->name('category.editFormCategory');
        Route::get('/delete-category/{idCategory}', [CategoryController::class, 'deleteCategory'])->name('category.deleteCategory');
        Route::post('/insert-category', [CategoryController::class, 'insertCategory'])->name('category.insertCategory');
        Route::post('/edit-category/{idCategory}', [CategoryController::class, 'editCategory'])->name('category.editCategory');
    });
    //Product
    // đặt tên cho tất cả các route
    Route::prefix('product')->group(function(){
        Route::get('/list-product', [ProductController::class, 'productList'])->name('product.listFormProduct');
        Route::get('/insert-form-product', [ProductController::class, 'formInsertProduct'])->name('product.insertFormProduct');
        Route::get('/delete-product/{idProduct}', [ProductController::class, 'deleteProduct'])->name('product.deleteProduct');
        Route::get('/edit-form-product/{idProduct}', [ProductController::class, 'editFormProduct'])->name('product.editFormProduct');
        Route::post('/insert-product', [ProductController::class, 'insertProduct'])->name('product.insertProduct');
        Route::post('/edit-product/{idProduct}', [ProductController::class, 'editProduct'])->name('product.editProduct');
    });
});

