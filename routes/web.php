<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;


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

Route::get('/register', function () {
    return view('register');
});

Route::view('/login', 'auth.login');

Route::get('/home', function () {
    return view('home');
});


Route::get('/shop', [ShopController::class, 'index']);
//customer
Route::middleware('auth')->group(function () {
    Route::view('/seller/product', 'seller.product');
    Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
    
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/user/wishlist', 'user.wishlist');
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');


    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::delete('/cart/delete-all', [CartController::class, 'deleteAll'])->name('cart.deleteAll');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
    Route::get('/cart/checkout', [CartController::class, 'showCheckout'])->name('cart.checkout.form');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::view('/checkout/success', 'cart.checkout_success')->name('checkout.success');
});


//admin

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

    });
});

    Route::view('/admin/customer', 'customer.index');
