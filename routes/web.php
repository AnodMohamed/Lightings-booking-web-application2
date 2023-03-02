<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\WCategoryController;
use App\Http\Controllers\Website\WProudctController;
use Illuminate\Support\Facades\Route;

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
Route::get('/categories/{category}', [WCategoryController::class, 'show'])->name('category');
Route::get('/product/{product}', [WProudctController::class, 'show'])->name('product');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'adminauth'], function () {
    //Route::get('/settings', function () {
    //     return view('dashboard.settings');
    // })->name('settings');
    // Route::get('/dashboard', function () {
    //     return view('dashboard.index');
    // });
    Route::get('/settings', [ SettingController::class,'index' ])->name('settings');
    Route::post('/settings/update/{setting}', [ SettingController::class,'update' ])->name('settings.update');

    //users
    Route::get('/users/all', [UserController::class, 'getUsersDatatable'])->name('users.all');

    // category
    Route::get('/category/all', [CategoryController::class, 'getCategoriesDatatable'])->name('category.all');
    Route::post('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');

    // product
    Route::get('/product/all', [ProductsController::class, 'getProductsDatatable'])->name('products.all');
    Route::post('/product/delete', [ProductsController::class, 'delete'])->name('products.delete');

    Route::resources([
        'users' => UserController::class,
        'category' => CategoryController::class,
        'product' => ProductsController::class,

    ]);
});