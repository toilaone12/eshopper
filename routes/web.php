<?php

use App\Cart;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WareHouseController;
use App\Model\Product;
use App\Model\WareHouse;
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
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/save-login',[AdminController::class,'saveLogin'])->name('admin.saveLogin');
    //User (Quản lý)
    Route::prefix('user')->group(function(){
        Route::group(['middleware' => 'auth.roles'],function(){
            Route::get('/list-user', [AdminController::class, 'listUser'])->name('admin.listUser');  
            Route::get('/denied-user', [AdminController::class, 'deniedUser'])->name('admin.deniedUser');             
            Route::get('/insert-form-user', [AdminController::class, 'insertFormUser'])->name('admin.insertFormUser');             
            Route::post('/insert-user', [AdminController::class, 'insertUser'])->name('admin.insertUser'); 
            Route::post('/permission-user', [AdminController::class, 'permissionAdmin'])->name('admin.permissionAdmin'); 
        }); //tranh moi nguoi tu ghi duong dan, muon kiem tra thi o trong lop AccessPermission.php
    });
    //Category (Danh mục)
    Route::prefix('category')->group(function(){
        Route::group(['middleware' => 'auth.roles'],function(){ //tranh moi nguoi tu ghi duong dan, muon kiem tra thi o trong lop AccessPermission.php
            Route::get('/insert-form-category', [CategoryController::class, 'formInsertCategory'])->name('category.insertFormCategory');
            Route::get('/edit-form-category/{idCategory}', [CategoryController::class, 'editFormCategory'])->name('category.editFormCategory');
            Route::get('/delete-category/{idCategory}', [CategoryController::class, 'deleteCategory'])->name('category.deleteCategory');
            Route::post('/insert-category', [CategoryController::class, 'insertCategory'])->name('category.insertCategory');
            Route::post('/edit-category/{idCategory}', [CategoryController::class, 'editCategory'])->name('category.editCategory');
        });
        Route::get('/list-category',[CategoryController::class, 'categoryList'])->name('category.listCategory');
    });
    //Product (Sản phẩm)
    // đặt tên cho tất cả các route
    Route::prefix('product')->group(function(){
        Route::group(['middleware' => 'auth.roles'],function(){
            Route::get('/insert-form-product', [ProductController::class, 'formInsertProduct'])->name('product.insertFormProduct');
            Route::get('/delete-product/{idProduct}', [ProductController::class, 'deleteProduct'])->name('product.deleteProduct');
            Route::get('/edit-form-product/{idProduct}', [ProductController::class, 'editFormProduct'])->name('product.editFormProduct');
            Route::get('/create-thumbnails/{idProduct}', [ProductController::class, 'createThumbnails'])->name('product.createThumbnails');
            Route::get('/delete-thumbnails/{idGallery}', [ProductController::class, 'deleteThumbnails'])->name('product.deleteThumbnails');
            Route::get('/list-product-color', [ProductController::class, 'listProductColor'])->name('product.listProductColor');
            Route::get('/form-product-color', [ProductController::class, 'formEditProductColor'])->name('product.formEditProductColor');
            Route::post('/insert-product', [ProductController::class, 'insertProduct'])->name('product.insertProduct');
            Route::post('/edit-product/{idProduct}', [ProductController::class, 'editProduct'])->name('product.editProduct');
            Route::post('/insert-thumbnails', [ProductController::class, 'insertThumbnails'])->name('product.insertThumbnails');
            Route::post('/update-thumbnails', [ProductController::class, 'updateThumbnails'])->name('product.updateThumbnails');
            Route::post('/edit-product-color', [ProductController::class, 'editProductColor'])->name('product.editProductColor');
        });
        Route::get('/list-product', [ProductController::class, 'productList'])->name('product.listFormProduct');
    });
    //Brand (Thương hiệu)
    Route::prefix('brand')->group(function(){
        Route::group(['middleware' => 'auth.roles'],function(){
            Route::get('/insert-form-brand', [BrandController::class, 'formInsertBrand'])->name('brand.insertFormBrand');
            Route::get('/edit-form-brand/{idBrand}', [BrandController::class, 'formEditBrand'])->name('brand.editFormBrand');
            Route::get('/delete-brand/{idBrand}', [BrandController::class, 'deleteBrand'])->name('brand.deleteBrand');
            Route::post('/insert-brand', [BrandController::class, 'insertBrand'])->name('brand.insertBrand');
            Route::post('/edit-brand/{idBrand}', [BrandController::class, 'editBrand'])->name('brand.editBrand');
        });
        Route::get('/list-brand', [BrandController::class, 'brandList'])->name('brand.listBrand');
    });
    //Slide (Quảng cáo)
    Route::prefix('slide')->group(function(){
        Route::group(['middleware' => 'auth.roles'],function(){
            Route::get('/insert-form-slide', [SlideController::class, 'formInsertSlide'])->name('slide.insertFormSlide');
            Route::get('/edit-form-slide/{idSlide}', [SlideController::class, 'formEditSlide'])->name('slide.editFormSlide');
            Route::get('/delete-slide/{idSlide}', [SlideController::class, 'deleteSlide'])->name('slide.deleteSlide');
            Route::post('/insert-slide', [SlideController::class, 'insertSlide'])->name('slide.insertSlide');
            Route::post('/edit-slide/{idSlide}', [SlideController::class, 'editSlide'])->name('slide.editSlide');
        });
        Route::get('/list-slide', [SlideController::class, 'listSlide'])->name('slide.listSlide');
    });
    //Customer 
    Route::prefix('customer')->group(function(){
        Route::get('/list-customer', [CustomerController::class, 'listCustomer'])->name('customer.listCustomer');
        Route::group(['middleware' => 'auth.roles'],function(){
            Route::post('/reply-comment', [CommentController::class, 'replyComment'])->name('comment.replyComment');
        });
    });
    //Comment (Bình luận)
    Route::prefix('comment')->group(function(){
        Route::group(['middleware' => 'auth.roles'],function(){
            Route::get('/list-comment', [CommentController::class, 'listComment'])->name('comment.listComment');
            Route::post('/reply-comment', [CommentController::class, 'replyComment'])->name('comment.replyComment');
        });
    });
    //Coupon(Mã giảm giá)
    Route::prefix('coupon')->group(function(){
        Route::get('/list-coupon', [CouponController::class, 'listCoupon'])->name('coupon.listCoupon');
        Route::get('/insert-form-coupon', [CouponController::class, 'insertFromCoupon'])->name('coupon.insertFromCoupon');
        Route::get('/edit-form-coupon/{idCoupon}', [CouponController::class, 'editFromCoupon'])->name('coupon.editFormCoupon');
        Route::get('/delete-coupon/{idCoupon}', [CouponController::class, 'deleteCoupon'])->name('coupon.deleteCoupon');
        Route::post('/insert-coupon', [CouponController::class, 'insertCoupon'])->name('coupon.insertCoupon');
        Route::post('/edit-coupon/{idCoupon}', [CouponController::class, 'editCoupon'])->name('coupon.editCoupon');
        Route::post('/upload-customer-vip', [CouponController::class, 'uploadCustomerVip'])->name('coupon.uploadCustomerVip');
        Route::post('/upload-customer-normal', [CouponController::class, 'uploadCustomerNormal'])->name('coupon.uploadCustomerNormal');
    });
    //Delivery(Vận chuyển)
    Route::prefix('delivery')->group(function(){
        Route::get('/list-delivery', [DeliveryController::class, 'listDelivery'])->name('delivery.listDelivery');
        Route::get('/delete-delivery/{idDelivery}', [DeliveryController::class, 'deleteDelivery'])->name('delivery.deleteDelivery');
        Route::get('/insert-form-delivery', [DeliveryController::class, 'insertFromDelivery'])->name('delivery.insertFromCoupon');
        Route::post('/insert-delivery', [DeliveryController::class, 'insertDelivery'])->name('delivery.insertDelivery');
        Route::post('/edit-delivery', [DeliveryController::class, 'editDelivery'])->name('delivery.editDelivery');
        Route::post('/select-delivery', [DeliveryController::class, 'selectDelivery'])->name('delivery.selectDelivery');
    });
    //Order(Đơn đặt hàng)
    Route::prefix('order')->group(function(){
        Route::get('/list-order', [OrderController::class, 'listOrder'])->name('order.listOrder');
        Route::get('/print-order/{codeOrder}', [OrderController::class, 'printPDF'])->name('order.printOrder');
        Route::get('/detail-order/{codeOrder}', [OrderController::class, 'detailOrder'])->name('order.detailOrder');
        Route::post('/change-status', [OrderController::class, 'changeStatus'])->name('order.changeStatus');
    });
    //Supplier(Nhà cung cấp)
    Route::prefix('supplier')->group(function(){
        Route::get('/list-supplier', [SupplierController::class, 'listSupplier'])->name('supplier.listSupplier');
        Route::get('/insert-form-supplier', [SupplierController::class, 'insertFormSupplier'])->name('supplier.insertFormSupplier');
        Route::get('/edit-form-supplier', [SupplierController::class, 'editFormSupplier'])->name('supplier.editFormSupplier');
        Route::post('/delete-supplier', [SupplierController::class, 'deleteSupplier'])->name('supplier.deleteSupplier');
        Route::post('/insert-supplier', [SupplierController::class, 'insertSupplier'])->name('supplier.insertSupplier');
        Route::post('/edit-supplier/{idSupplier}', [SupplierController::class, 'editSupplier'])->name('supplier.editSupplier');
    });
    //WareHouse(Kho hàng)
    Route::prefix('warehouse')->group(function(){
        Route::get('/list-warehouse', [WareHouseController::class, 'listWareHouse'])->name('warehouse.listWareHouse');
        Route::post('/export-product', [WareHouseController::class, 'exportProduct'])->name('warehouse.exportProduct');
    });
    //Note(Phiếu)
    Route::prefix('note')->group(function(){
        Route::get('/list-note', [NoteController::class, 'listNote'])->name('note.listNote');
        Route::get('/detail-note', [NoteController::class, 'detailNote'])->name('note.detailNote');
        Route::get('/print-note/{codeNote}', [NoteController::class, 'printPDF'])->name('note.printNote'); 
        Route::get('/import-form-note', [NoteController::class, 'importFormNote'])->name('note.importFormNote');
        Route::group(['middleware' => 'auth.roles'],function(){
            Route::get('/export-warehouse', [NoteController::class, 'exportToWarehouse'])->name('note.exportToWarehouse');
        });
        Route::post('/import-note', [NoteController::class, 'importNote'])->name('note.importNote');
        Route::post('/import-detail-note', [NoteController::class, 'importDetailNote'])->name('note.importDetailNote');
    });
    //Statistic(Thống kê)
    Route::prefix('statistic')->group(function(){
        Route::get('/list-statistic',[StatisticController::class, 'listStatistic'])->name('statistic.listStatistic');
        Route::get('/list-statistic-note',[StatisticController::class, 'listStatisticNote'])->name('statistic.listStatisticNote');
        Route::post('/filter-date',[StatisticController::class, 'filterDate'])->name('statistic.filterDate');
        Route::post('/filter-import',[StatisticController::class, 'filterDateImport'])->name('statistic.filterDateImport');
        Route::post('/filter-export',[StatisticController::class, 'filterDateExport'])->name('statistic.filterDateExport');
        Route::post('/filter-select',[StatisticController::class, 'filterSelect'])->name('statistic.filterSelect');
        Route::post('/filter-select-import',[StatisticController::class, 'filterSelectImport'])->name('statistic.filterSelectImport');
        Route::post('/filter-select-export',[StatisticController::class, 'filterSelectExport'])->name('statistic.filterSelectExport');
        Route::post('/select-statistic',[StatisticController::class, 'showStatistic'])->name('statistic.showStatistic');
        Route::post('/select-statistic-import',[StatisticController::class, 'showStatisticImport'])->name('statistic.showStatisticImport');
        Route::post('/select-statistic-export',[StatisticController::class, 'showStatisticExport'])->name('statistic.showStatisticExport');
    });
    Route::prefix('color')->group(function(){
        Route::get('/list-color',[ColorController::class, 'listColor'])->name('color.listColor');
        Route::get('/delete-color',[ColorController::class, 'deleteColor'])->name('color.deleteColor');
        Route::post('/insert-color',[ColorController::class, 'insertColor'])->name('color.insertColor');
        Route::post('/update-color',[ColorController::class, 'updateColor'])->name('color.updateColor');
    });
    Route::prefix('contact')->group(function(){
        Route::get('/info-contact', [ContactController::class, 'listContact'])->name('contact.listContact');
        Route::get('/edit-contact-form', [ContactController::class, 'editContactForm'])->name('contact.editContactForm');
        Route::get('/delete-contact', [ContactController::class, 'deleteContact'])->name('contact.deleteContact');
        Route::post('/edit-contact', [ContactController::class, 'editContact'])->name('contact.editContact');
        Route::post('/insert-contact', [ContactController::class, 'insertContact'])->name('contact.insertContact');
    });
});
//page
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
        Route::post('/change-color',[ProductController::class,'changeColor'])->name('product.changeColor');
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
        Route::get('/check-delivery', [OrderController::class, 'checkDelivery'])->name('order.checkDelivery');
        Route::post('/cancel-order', [OrderController::class, 'cancelOrder'])->name('order.cancelOrder');
        Route::post('/filter-delivery', [OrderController::class, 'filterDelivery'])->name('order.filterDelivery');
        Route::post('/save-info',[OrderController::class,'saveInfo'])->name('order.saveInfo');
        Route::post('/add-order',[OrderController::class,'order'])->name('order.addOrder');
    });
    Route::prefix('delivery')->group(function(){
        Route::post('/select-delivery', [DeliveryController::class, 'selectDelivery'])->name('delivery.selectDelivery');
        Route::post('/add-delivery', [DeliveryController::class, 'calculatorDelivery'])->name('delivery.addDelivery');
    });
    Route::prefix('contact')->group(function(){
        Route::get('/contact-shop', [ContactController::class, 'contact'])->name('contact.contactShop');
    });
});

