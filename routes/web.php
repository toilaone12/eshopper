<?php

use App\Cart;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SlideController;
use App\Model\Product;
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
    //User
    Route::prefix('user')->group(function(){
        Route::get('/list-user', [AdminController::class, 'listUser'])->name('admin.listUser');  
    });
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
    //Brand
    Route::prefix('brand')->group(function(){
        Route::get('/list-brand', [BrandController::class, 'brandList'])->name('brand.listBrand');
        Route::get('/insert-form-brand', [BrandController::class, 'formInsertBrand'])->name('brand.insertFormBrand');
        Route::get('/edit-form-brand/{idBrand}', [BrandController::class, 'formEditBrand'])->name('brand.editFormBrand');
        Route::get('/delete-brand/{idBrand}', [BrandController::class, 'deleteBrand'])->name('brand.deleteBrand');
        Route::post('/insert-brand', [BrandController::class, 'insertBrand'])->name('brand.insertBrand');
        Route::post('/edit-brand/{idBrand}', [BrandController::class, 'editBrand'])->name('brand.editBrand');
    });
    //Slide
    Route::prefix('slide')->group(function(){
        Route::get('/list-slide', [SlideController::class, 'listSlide'])->name('slide.listSlide');
        Route::get('/insert-form-slide', [SlideController::class, 'formInsertSlide'])->name('slide.insertFormSlide');
        Route::get('/edit-form-slide/{idSlide}', [SlideController::class, 'formEditSlide'])->name('slide.editFormSlide');
        Route::get('/delete-slide/{idSlide}', [SlideController::class, 'deleteSlide'])->name('slide.deleteSlide');
        Route::post('/insert-slide', [SlideController::class, 'insertSlide'])->name('slide.insertSlide');
        Route::post('/edit-slide/{idSlide}', [SlideController::class, 'editSlide'])->name('slide.editSlide');
    });
    //Comment 
    Route::prefix('comment')->group(function(){
        Route::get('/list-comment', [CommentController::class, 'listComment'])->name('comment.listComment');
        Route::post('/reply-comment', [CommentController::class, 'replyComment'])->name('comment.replyComment');
    });
    //Coupon
    Route::prefix('coupon')->group(function(){
        Route::get('/list-coupon', [CouponController::class, 'listCoupon'])->name('coupon.listCoupon');
        Route::get('/insert-form-coupon', [CouponController::class, 'insertFromCoupon'])->name('coupon.insertFromCoupon');
        Route::get('/edit-form-coupon/{idCoupon}', [CouponController::class, 'editFromCoupon'])->name('coupon.editFormCoupon');
        Route::get('/delete-coupon/{idCoupon}', [CouponController::class, 'deleteCoupon'])->name('coupon.deleteCoupon');
        Route::post('/insert-coupon', [CouponController::class, 'insertCoupon'])->name('coupon.insertCoupon');
        Route::post('/edit-coupon/{idCoupon}', [CouponController::class, 'editCoupon'])->name('coupon.editCoupon');
    });
    //Delivery
    Route::prefix('delivery')->group(function(){
        Route::get('/list-delivery', [DeliveryController::class, 'listDelivery'])->name('delivery.listDelivery');
        Route::get('/delete-delivery/{idDelivery}', [DeliveryController::class, 'deleteDelivery'])->name('delivery.deleteDelivery');
        Route::get('/insert-form-delivery', [DeliveryController::class, 'insertFromDelivery'])->name('delivery.insertFromCoupon');
        Route::post('/insert-delivery', [DeliveryController::class, 'insertDelivery'])->name('delivery.insertDelivery');
        Route::post('/edit-delivery', [DeliveryController::class, 'editDelivery'])->name('delivery.editDelivery');
        Route::post('/select-delivery', [DeliveryController::class, 'selectDelivery'])->name('delivery.selectDelivery');
    });
    Route::prefix('order')->group(function(){
        Route::get('/list-order', [OrderController::class, 'listOrder'])->name('order.listOrder');
        Route::get('/print-order/{codeOrder}', [OrderController::class, 'printPDF'])->name('order.printOrder');
        Route::get('/detail-order/{codeOrder}', [OrderController::class, 'detailOrder'])->name('order.detailOrder');
        Route::post('/change-status', [OrderController::class, 'changeStatus'])->name('order.changeStatus');
    });
});
Route::prefix('page')->group(function(){
    Route::get('/home-page',[HomeController::class,'homePage'])->name('home.page');   
    Route::get('/login',[HomeController::class, 'loginForm'])->name('home.loginForm');
    Route::post('/register',[HomeController::class,'register'])->name('home.register');
    Route::post('/login',[HomeController::class,'login'])->name('home.login');
    Route::get('/log-out',[HomeController::class,'logout'])->name('home.logout');
    Route::get('/check-mail',[HomeController::class,'checkEmail'])->name('home.checkEmail');
    Route::post('/send-mail',[HomeController::class,'sendEmail'])->name('home.sendEmail');
    Route::get('/mail-notification',[HomeController::class,'emailNotification'])->name('home.emailNotification');
    Route::get('/change-pass',[HomeController::class,'changePassword'])->name('home.changePass');
    Route::post('/save-password',[HomeController::class,'savePassword'])->name('home.savePass');
    
    Route::prefix('category')->group(function(){
        Route::get('/{nameCategory}',[CategoryController::class,'productByCategory'])->name('category.productByCategory');
    });
    Route::prefix('brand')->group(function(){
        Route::get('/{nameBrand}',[BrandController::class,'productByBrand'])->name('brand.productByBrand');
    });
    Route::prefix('product')->group(function(){
        Route::get('/detail-product/{idProduct}',[ProductController::class,'detailProduct'])->name('product.detailProduct');
    });
    Route::prefix('review')->group(function(){
        Route::post('/insert-review',[ReviewController::class,'review'])->name('review.insertReview');
    });
    Route::prefix('comment')->group(function(){
        Route::post('/insert-comment',[CommentController::class,'comment'])->name('comment.insertComment');
    });
    Route::prefix('customer')->group(function(){
        Route::get('/profile',[CustomerController::class,'profile'])->name('customer.profile');
        Route::get('/edit-profile',[CustomerController::class,'formEditProfile'])->name('customer.formEditProfile');
        Route::post('/save-profile',[CustomerController::class,'editProfile'])->name('customer.editProfile');
    });
    Route::prefix('network')->group(function(){
        Route::get('/login-fb',[NetworkController::class,'loginFacebook'])->name('network.loginFacebook');
        Route::get('/callback',[NetworkController::class,'callBackFacebook'])->name('network.callBackFacebook');
    });
    Route::prefix('cart')->group(function(){
        Route::post('/add-cart',[CartController::class,'addCart'])->name('cart.addCart');
        Route::get('/check-cart',[CartController::class,'checkCart'])->name('cart.checkCart');
        Route::get('/remove-cart',[CartController::class,'removeCart'])->name('cart.removeCart');
        Route::get('/update-cart',[CartController::class,'updateCart'])->name('cart.updateCart');
        Route::post('/check-coupon',[CartController::class,'checkCoupon'])->name('cart.checkCoupon');
    });
    Route::prefix('order')->group(function(){
        Route::get('/check-out',[OrderController::class,'checkOut'])->name('order.checkOut');
        Route::get('/check-info',[OrderController::class,'checkInfo'])->name('order.checkInfo');
        Route::post('/save-info',[OrderController::class,'saveInfo'])->name('order.saveInfo');
        Route::post('/add-order',[OrderController::class,'order'])->name('order.addOrder');
    });
    Route::prefix('delivery')->group(function(){
        Route::post('/select-delivery', [DeliveryController::class, 'selectDelivery'])->name('delivery.selectDelivery');
        Route::post('/add-delivery', [DeliveryController::class, 'calculatorDelivery'])->name('delivery.addDelivery');
    });
});

