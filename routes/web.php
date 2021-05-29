<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthCheck;
use App\Http\Middleware\AdminAuthenticated;
use App\Http\Controllers\Admin\AdminAuthController;
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
    Route::get('admin/home', \App\Http\Livewire\Admin\Home::class)->name('admin-home');
    Route::get('admin/categories', \App\Http\Livewire\Admin\Categories::class)->name('category');
    Route::get('admin/attributes', \App\Http\Livewire\Admin\AttributeList::class)->name('attributes');
    Route::get('admin/brands', \App\Http\Livewire\Admin\Brands::class)->name('brands');
    Route::get('admin/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.list');
    Route::get('admin/product/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
    Route::post('admin/product/create', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
    Route::get('admin/product/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('admin/product/update', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
    Route::post('admin/product/images/upload', [App\Http\Controllers\Admin\ProductController::class, 'uploadImage'])->name('admin.product.images.upload');
    Route::get('admin/product/images/{id}/delete', [App\Http\Controllers\Admin\ProductController::class, 'deleteImage'])->name('admin.product.images.delete');
    Route::post('admin/product/attribut/store', [App\Http\Controllers\Admin\ProductController::class, 'storeAttribute'])->name('admin.product.attribut.store');
    Route::get('admin/product/attributes//{id}/delete',  [App\Http\Controllers\Admin\ProductController::class, 'deleteAttribute'])->name('admin.product.attribut.delete');

    // Route::get('/profile', function () {
    //     //
    // })->withoutMiddleware([EnsureTokenIsValid::class]);
});