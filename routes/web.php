<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    Route::get('/register', [UserController::class, 'registerUser'])->name("register.user");
    Route::post('/register', [UserController::class, 'validateRegister']);
    Route::post('/register/catering', [UserController::class, 'validateCatering'])->name("register.catering");
    Route::get('/login', [UserController::class, 'login'])->name("login");
    Route::post('/login', [UserController::class, 'validateLogin']);
    // Route::post('/login', [UserController::class, 'loginAuth']);
    // Route::post('/register', [UserController::class, 'registerAuthCustomer'])->name("authCustomer");
    // Route::post('/register/catering', [UserController::class, 'registerAuthCatering'])->name("authCatering");
});
