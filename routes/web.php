<?php

use App\Http\Controllers\Dashboard\BookingController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\ShoppingCartController;
use App\Http\Controllers\Website\WCategoryController;
use App\Http\Controllers\Website\WOrederController;
use App\Http\Controllers\Website\WProudctController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Models\User;

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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/product/cart/shopping', [ShoppingCartController::class, 'cart'])->name('product.cart.shopping');
Route::get('/categories/{category}', [WCategoryController::class, 'show'])->name('category');
Route::get('/product/{product}', [WProudctController::class, 'show'])->name('product');
Route::get('/product/cart/{booking}', [ShoppingCartController::class, 'store'])->name('product.cart');
Route::get('/product/cart/delete/{id}', [ShoppingCartController::class, 'delete'])->name('product.cart.delete');

Route::get('/login', function () { return view('auth.login');} );
Route::get('/register', function () { return view('auth.login');} );
Route::get('/forgot-password', function () { return view('auth.forgot-password');} );
Route::get('/user/profile', function () { return view('profile.show');} );

    



Route::group(['prefix' => 'website', 'as' => 'website.', 'middleware' => 'customerauth'], function () {

    Route::get('/product/cart/checkout', [ShoppingCartController::class, 'checkout'])->name('product.cart.checkout');
    Route::post('/product/cart/checkout/store', [ShoppingCartController::class, 'checkoutstore'])->name('product.cart.checkout.store');

    //orders
    Route::get('/orders/all', [WOrederController::class, 'geOrdersDatatable'])->name('orders.all');

    Route::resources([
        'orders' => WOrederController::class,

    ]);
});


Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'adminauth'], function () {
    //Route::get('/settings', function () {
    //     return view('dashboard.settings');
    // })->name('settings');
    // Route::get('/dashboard', function () {
    //     return view('dashboard.index');
    // });
    Route::get('/settings', [ SettingController::class,'index' ])->name('settings');
    Route::post('/settings/update/{setting}', [ SettingController::class,'update' ])->name('settings.update');
    Route::get('/index', [ SettingController::class,'dashboard' ])->name('index');

    //users
    Route::get('/users/all', [UserController::class, 'getUsersDatatable'])->name('users.all');

    // category
    Route::get('/category/all', [CategoryController::class, 'getCategoriesDatatable'])->name('category.all');
    Route::post('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');

    // product
    Route::get('/product/all', [ProductsController::class, 'getProductsDatatable'])->name('products.all');
    Route::post('/product/delete', [ProductsController::class, 'delete'])->name('products.delete');

    //booking
    Route::get('/booking/add/{booking}', [ BookingController::class,'add' ])->name('booking.add');
    Route::get('/booking/dashboard/{booking}', [ BookingController::class,'dashboard' ])->name('booking.dashboard');
    Route::post('/booking/delete', [BookingController::class, 'delete'])->name('booking.delete');

    //order
    Route::get('/order/delivered/{id}', [OrderController::class, 'delivered'])->name('order.delivered');
    Route::get('/order/returned/{id}', [OrderController::class, 'returned'])->name('order.returned');

    Route::resources([
        'users' => UserController::class,
        'category' => CategoryController::class,
        'product' => ProductsController::class,
        'booking' => BookingController::class,
        'order' => OrderController::class,

    ]);
});