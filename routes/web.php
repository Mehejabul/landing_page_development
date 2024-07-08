<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\FeaturedImageController;
use App\Http\Controllers\InfoContentController;
use App\Http\Controllers\InfoDetailsController;
use App\Http\Controllers\BannerController;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[UserController::class,'homepage'])->name('homepage');
Route::post('/place-order',[OrderController::class,'placeOrder'])->name('place.order');
Route::group(['middleware'=>['guest']],function(){
    Route::match(['get', 'post'], '/login',[UserController::class,'login'])->name('login');
});
    Route::group(['middleware'=>['auth']],function(){

        Route::get('/logout',[UserController::class,'logout'])->name('logout');
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::resource('banner', BannerController::class);
        Route::post('update-banner-status',[BannerController::class,'updateBannerStatus'])->name('updateBannerStatus');
        Route::resource('product', ProductController::class);
        Route::resource('settings', SettingsController::class);
        Route::resource('featured-images', FeaturedImageController::class);
        Route::post('featured-images-status-udpade', [FeaturedImageController::class,'updateFeaturedImageStatus'])->name('updateFeaturedImageStatus');
        Route::resource('content', InfoContentController::class);
        Route::post('content-status-udpade', [InfoContentController::class,'updateContentStatus'])->name('updateContentStatus');
        Route::resource('content-details', InfoDetailsController::class);
        Route::post('content-details-status-udpade', [InfoDetailsController::class,'updateContentDetailsStatus'])->name('updateContentDetailsStatus');
        Route::resource('content-details', InfoDetailsController::class);
        Route::get('order-list/{status?}', [OrderController::class,'list'])->name('order.index');
        Route::get('order-itemlist/{id}', [OrderController::class,'orderDetails'])->name('order.itemlist');
        Route::get('order-status-edit/{id}', [OrderController::class,'editStatus'])->name('order.statusedit');
        Route::put('order-status-update/{id}', [OrderController::class,'updateStatus'])->name('order.statusUpdate');
        Route::get('trackorder/{id}', [OrderController::class,'orderTrack'])->name('trackOrder');
    });
