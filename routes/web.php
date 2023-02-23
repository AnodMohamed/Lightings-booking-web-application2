<?php

use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
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

Route::get('/', function () {
    return view('dashboard.index');
});

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'checkLogin']], function () {
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
    

    Route::resources([
        'users' => UserController::class,

    ]);
});