<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Admin;
use App\Models\Category;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.layout.base', function ($view) {
            $admin = Admin::where('id', session('LoggedAdmin'))->first();
            $view->with('admin', $admin);
        });
        
        View::composer('user.layouts.user_one', function ($view) {
            $categories = Category::with('children')->whereNull('category_id')->get();
            $view->with('categories', $categories);
        });

        View::composer('user.layouts.user_two', function ($view) {
            $categories = Category::with('children')->whereNull('category_id')->get();
            $view->with('categories', $categories);
        });
    }
}
