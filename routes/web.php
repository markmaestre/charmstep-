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
use App\Http\Controllers\AdminCheckoutController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\AdminWishlistController;


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
Route::get('/home', [HomeController::class, 'index']);

Route::get('/search', [SearchController::class, 'search']);
//customer
Route::middleware('auth')->group(function () {
    Route::view('/seller/product', 'seller.product');
    Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
    Route::get('/seller/checkouts', [AdminCheckoutController::class, 'index'])->name('seller.checkouts');
    
    Route::get('/shop', [ShopController::class, 'index']);
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/user/wishlist', 'user.wishlist')->name('wishlist.index');
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::delete('/cart/delete-all', [CartController::class, 'deleteAll'])->name('cart.deleteAll');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/reviews', 'reviews.index');
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
    Route::get('/cart/checkout', [CartController::class, 'showCheckout'])->name('cart.checkout.form');
    Route::put('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');

    Route::view('/checkout/success', 'cart.checkout_success')->name('checkout.success');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/history', [CheckoutController::class, 'history'])->name('checkout.history');
    Route::get('/checkout/{checkout_id}', [CheckoutController::class, 'details'])->name('checkout.details'); 
});

Route::post('wishlists/importExcel', [WishlistController::class, 'importExcel'])->name('wishlists.importExcel');


Route::resource('reviews', ReviewController::class);




//admin

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

    });
});



    Route::get('/admin/checkouts', [AdminCheckoutController::class, 'index'])->name('admin.checkouts');
    Route::get('/admin/checkout/{id}', [AdminCheckoutController::class, 'show'])->name('admin.checkout.show');
    Route::put('/admin/checkout/{id}', [AdminCheckoutController::class, 'updateStatus'])->name('admin.updateCheckoutStatus');
    Route::get('/admin/products', [CartController::class, 'index'])->name('admin.carts.index');
   // Route::view('/customers', 'customer.index');
   Route::get('/customers', [CustomerController::class, 'index']);
   Route::post('/customers', [CustomerController::class, 'store']);
   Route::get('/customers/{id}', [CustomerController::class, 'show']);
   Route::put('/customers/{id}', [CustomerController::class, 'update']);
   Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

   Route::get('/dashboard', function () {
    return view('dashboard'); 
});



Route::get('/', [HomeController::class, 'index']);

Route::get('/admin/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
Route::get('/admin/wishlists', [AdminWishlistController::class, 'index'])->name('admin.wishlists.index');
