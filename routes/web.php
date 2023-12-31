<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderHeaderController;
use App\Http\Controllers\OrderDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MenuController::class, 'home'])->name('home');
Route::get('/menu', [MenuController::class, 'menu'])->name("menu");
Route::get('/menu/{id}', [MenuController::class, 'menuDetail']);
Route::get('/search', [MenuController::class, 'search']);

Route::group(['middleware' => 'guest'], function(){
    Route::get('/register', [UserController::class, 'register'])->name("register");
    Route::post('/register', [UserController::class, 'validateRegister']);
    Route::get('/login', [UserController::class, 'login'])->name("login");
    Route::post('/login', [UserController::class, 'validateLogin']);
});

Route::group(['middleware' => 'auth'], function(){
    Route::group(['middleware' => 'active'], function(){
        Route::post('/order/status', [OrderDetailController::class, 'changeStatus']);
    });

    Route::group(['middleware' => 'seller'], function(){
        Route::group(['middleware' => 'active'], function(){
            Route::post('/menu/add', [MenuController::class, 'addMenu']);
            Route::post('/menu/edit', [MenuController::class, 'editMenu']);
            Route::get('/menu/{id}/delete', [MenuController::class, 'deleteMenu']);
        });
        Route::get('/order/manage', [OrderHeaderController::class, 'manageOrders']);
        Route::post('/profile/edit/catering', [SellerController::class, 'editCatering']);
        Route::post('/withdraw', [SellerController::class, 'withdrawPocket']);
    });

    Route::group(['middleware' => 'customer'], function(){
        Route::group(['middleware' => 'active'], function(){
            Route::get('/cart', [CartController::class, 'cart']);
            Route::post('/cart/add', [CartController::class, 'addCart']);
            Route::post('/cart/edit', [CartController::class, 'updateQuantity']);
            Route::get('/checkout', [CartController::class, 'checkout']);
            Route::post('/order/create', [OrderHeaderController::class, 'createOrder']);
        });
        Route::get('/order', [OrderHeaderController::class, 'orders']);
        Route::get('/wishlist', [WishlistController::class, 'wishlist']);
        Route::get('/wishlist/add/{id}', [WishlistController::class, 'addWishlist']);
        Route::get('/wishlist/remove/{id}', [WishlistController::class, 'removeWishlist']);
        Route::post('/wishlist/update', [WishlistController::class, 'updateWishlist']);
    });

    Route::get('/logout', [UserController::class, 'logout']);
    Route::post('/profile/status', [UserController::class, 'updateStatus']);
    Route::get('/profile/edit', [UserController::class, 'editProfile']);
    Route::post('/profile/edit/account', [UserController::class, 'editAccount']);
    Route::post('/profile/edit/password', [UserController::class, 'editPassword']);
    Route::get('/order/{id}', [OrderDetailController::class, 'orderDetail']);
});