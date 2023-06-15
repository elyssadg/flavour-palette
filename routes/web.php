<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;

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

Route::get('/', function () { return view('pages.home'); })->name('home');

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
    Route::post('/profile/edit/catering', [SellerController::class, 'editCatering']);
});