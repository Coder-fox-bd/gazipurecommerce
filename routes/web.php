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
Route::get('admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin-login');
Route::post('admin/login', [AdminAuthController::class, 'check'])->name('admin-check');
Route::get('admin/register', [AdminAuthController::class, 'adminRegister'])->name('admin-register');
Route::post('admin/register', [AdminAuthController::class, 'create'])->name('admin-create');

// Route::get('admin/logout', [AdminAuthController::class, 'logOut'])->name('admin-logout');
Route::get('admin/logout', function()
{
    Auth::guard("admin")->logout();
    Session::flush();
    return Redirect::to('/admin/login');
})->name('admin-logout');

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('admin/home', \App\Http\Livewire\Admin\Home::class)->name('admin-home');
    Route::post('/save-token', [App\Http\Controllers\Admin\FireBaseNotification::class, 'saveToken'])->name('admin.save-token');
    Route::post('/mark-as-read', [App\Http\Controllers\Admin\MarkNotificationController::class, 'markAsRead'])->name('admin.markNotification');
    Route::get('admin/categories', \App\Http\Livewire\Admin\Categories::class)->name('category');
    Route::get('admin/attributes', \App\Http\Livewire\Admin\AttributeList::class)->name('attributes');
    Route::get('admin/variations', \App\Http\Livewire\Admin\Variations::class)->name('variations');
    Route::get('admin/brands', \App\Http\Livewire\Admin\Brands::class)->name('brands');
    Route::get('admin/collection', \App\Http\Livewire\Admin\Collections\Collections::class)->name('collections');
    Route::get('admin/add-to-collection', \App\Http\Livewire\Admin\Collections\AddToCollection::class)->name('add-to-collection');
    Route::get('admin/collection-products', \App\Http\Livewire\Admin\Collections\CollectionProducts::class)->name('collection-products');
    Route::get('admin/image-slider', [App\Http\Controllers\Admin\CarouselController::class, 'index'])->name('admin.image-slider');
    Route::post('admin/image-slider', [App\Http\Controllers\Admin\CarouselController::class, 'uploadImage'])->name('admin.slider-image-upload');
    Route::get('admin/image-slider/{id}', [App\Http\Controllers\Admin\CarouselController::class, 'delete'])->name('admin.slider-image-delete');
    Route::get('admin/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.list');
    Route::get('admin/product/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
    Route::post('admin/product/create', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
    Route::get('admin/product/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('admin/product/update', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
    Route::get('admin/{product}/delete', [App\Http\Controllers\Admin\ProductController::class, 'deleteProduct'])->name('admin.product.delete');
    Route::post('admin/product/store-description', [App\Http\Controllers\Admin\ProductController::class, 'storeDescription'])->name('admin.product.store-description');
    Route::post('admin/product/store-description-img-upload', [App\Http\Controllers\Admin\ProductController::class, 'storeDescriptionImg'])->name('admin.product.description-img-upload');
    Route::post('admin/product/images/upload', [App\Http\Controllers\Admin\ProductController::class, 'uploadImage'])->name('admin.product.images.upload');
    Route::get('admin/{product}/images/{id}/delete', [App\Http\Controllers\Admin\ProductController::class, 'deleteImage'])->name('admin.product.images.delete');
    Route::post('admin/product/attribut/store', [App\Http\Controllers\Admin\ProductController::class, 'storeAttribute'])->name('admin.product.attribut.store');
    Route::get('admin/product/attributes//{id}/delete',  [App\Http\Controllers\Admin\ProductController::class, 'deleteAttribute'])->name('admin.product.attribut.delete');
    Route::post('admin/product/variation/store', [App\Http\Controllers\Admin\ProductController::class, 'storeVariation'])->name('admin.product.variation.store');
    Route::get('admin/product/variation//{id}/delete',  [App\Http\Controllers\Admin\ProductController::class, 'deleteVariation'])->name('admin.product.variation.delete');
    Route::get('admin/settings', [App\Http\Controllers\Admin\Settings::class, 'index'])->name('admin.settings');
    Route::post('admin/settings', [App\Http\Controllers\Admin\Settings::class, 'update'])->name('admin.settings.update');
    Route::get('admin/orders', \App\Http\Livewire\Admin\Orders\Orders::class)->name('admin.orders.index');
    Route::get('admin/{order}/show', \App\Http\Livewire\Admin\Orders\ShowOrder::class)->name('admin.orders.show');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::get('/', \App\Http\Livewire\User\Home::class)->name('home');

// Route::get('carousel-pc', [App\Http\Controllers\User\Carousel::class, 'carouselPc'])->name('carousel-pc');
// Route::get('carousel-mobile', [App\Http\Controllers\User\Carousel::class, 'carouselMobile'])->name('carousel-mobile');

Auth::routes();

Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
// Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

// Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
// Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

Route::get('/shop', \App\Http\Livewire\User\Shop::class)->name('shop');
Route::get('/search/{name}', \App\Http\Livewire\User\SearchResult::class)->name('search-results')->where('name', '.*');
Route::get('/category/{slug}', \App\Http\Livewire\User\Category::class)->name('category.show');

Route::get('/offers/{slug}', \App\Http\Livewire\User\Offer::class)->name('offers');

Route::get('/brand/{slug}', \App\Http\Livewire\User\Brand::class)->name('brand');

Route::get('/product/{slug}', \App\Http\Livewire\User\Product::class)->name('product.show');
Route::get('/shoping-cart', \App\Http\Livewire\User\ShopingCart::class)->name('shoping-cart');

Route::get('/checkout', \App\Http\Livewire\User\Checkout::class)->name('checkout')->middleware('auth');

Route::get('/account', \App\Http\Livewire\User\Profile\Account::class)->name('account');
Route::get('account/orders', \App\Http\Livewire\User\Orders::class)->name('account.orders');
Route::get('account/login-and-security', \App\Http\Livewire\User\Profile\LoginAndSecurity::class)->name('account.security');

