<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;

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
    Route::get('/logout', [UserController::class, 'logout']);
    Route::post('/profile/status', [UserController::class, 'updateStatus']);
    Route::get('/profile/edit', [UserController::class, 'editProfile']);
    Route::post('/profile/edit/account', [UserController::class, 'editAccount']);
    Route::post('/profile/edit/password', [UserController::class, 'editPassword']);

    Route::group(['middleware' => 'seller'], function(){
        Route::post('/profile/edit/catering', [SellerController::class, 'editCatering']);
        Route::get('/menu/{id}/delete', [MenuController::class, 'deleteMenu']);
        Route::post('/menu/edit', [MenuController::class, 'editMenu']);
    });

    Route::group(['middleware' => 'customer'], function(){
        Route::get('/wishlist', [WishlistController::class, 'wishlist']);
        Route::get('/wishlist/add/{id}', [WishlistController::class, 'addWishlist']);
        Route::get('/wishlist/remove/{id}', [WishlistController::class, 'removeWishlist']);
        Route::post('/cart/add', [CartController::class, 'addCart']);
    });
});