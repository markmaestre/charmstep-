<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Auth\WishlistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::apiResource('customers', CustomerController::class);
Route::apiResource('items', ItemController::class);
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/check-email', [RegisterController::class, 'checkEmail']);




Route::group(['middleware' => 'web'], function () {
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
});

//Route::apiResource('customers', CustomerController::class);




Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('wishlists', WishlistController::class);
    Route::post('/cart/add', [CartController::class, 'addToCart']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'store']);
   // Route::apiResource('reviews', ReviewController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    //Route::apiResource('reviews', ReviewController::class);
    Route::get('/checkouts/completed', [CheckoutController::class, 'completed']);

});