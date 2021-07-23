<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthCheck;
use App\Http\Middleware\AdminAuthenticated;
use App\Http\Controllers\Admin\AdminAuthController;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware([AdminAuthenticated::class])->group(function () {
    Route::get('admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin-login');
    Route::post('admin/login', [AdminAuthController::class, 'check'])->name('admin-check');
    // Route::get('admin/register', [AdminAuthController::class, 'adminRegister'])->name('admin-register');
    // Route::post('admin/register', [AdminAuthController::class, 'create'])->name('admin-create');
    
});

Route::get('admin/logout', [AdminAuthController::class, 'logOut'])->name('admin-logout');

Route::middleware([AdminAuthCheck::class])->group(function () {
    Route::get('admin/home', \App\Http\Livewire\Admin\Home::class)->name('admin-home');
    Route::get('admin/categories', \App\Http\Livewire\Admin\Categories::class)->name('category');
    Route::get('admin/attributes', \App\Http\Livewire\Admin\AttributeList::class)->name('attributes');
    Route::get('admin/variations', \App\Http\Livewire\Admin\Variations::class)->name('variations');
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
    Route::post('admin/product/variation/store', [App\Http\Controllers\Admin\ProductController::class, 'storeVariation'])->name('admin.product.variation.store');
    Route::get('admin/product/variation//{id}/delete',  [App\Http\Controllers\Admin\ProductController::class, 'deleteVariation'])->name('admin.product.variation.delete');
    Route::get('admin/settings', [App\Http\Controllers\Admin\Settings::class, 'index'])->name('admin.settings');
    Route::post('admin/settings', [App\Http\Controllers\Admin\Settings::class, 'update'])->name('admin.settings.update');

    // Route::get('/profile', function () {
    //     //
    // })->withoutMiddleware([EnsureTokenIsValid::class]);
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::get('/', \App\Http\Livewire\User\Home::class)->name('home');

Auth::routes();

Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

Route::get('/category/{slug}', \App\Http\Livewire\User\Category::class)->name('category.show');

Route::get('/product/{slug}', \App\Http\Livewire\User\Product::class)->name('product.show');
Route::get('/shoping-cart', \App\Http\Livewire\User\ShopingCart::class)->name('shoping-cart');

