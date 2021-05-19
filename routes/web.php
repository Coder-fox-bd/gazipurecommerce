<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthCheck;
use App\Http\Middleware\AdminAuthenticated;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.home');
});

Route::middleware([AdminAuthenticated::class])->group(function () {
    Route::get('admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin-login');
    Route::post('admin/login', [AdminAuthController::class, 'check'])->name('admin-check');
    Route::get('admin/register', [AdminAuthController::class, 'adminRegister'])->name('admin-register');
    Route::post('admin/register', [AdminAuthController::class, 'create'])->name('admin-create');
    
});

Route::get('admin/logout', [AdminAuthController::class, 'logOut'])->name('admin-logout');

Route::middleware([AdminAuthCheck::class])->group(function () {
    Route::get('admin/home', [AdminController::class, 'home'])->name('admin-home');
    Route::get('admin/add-produtc', [AdminController::class, 'addProduct'])->name('add-product');
    Route::view('admin/categories', 'admin.categories')->name('add-product');
    Route::view('admin/attributes', 'admin.attributes')->name('attributes');

    // Route::get('/profile', function () {
    //     //
    // })->withoutMiddleware([EnsureTokenIsValid::class]);
});