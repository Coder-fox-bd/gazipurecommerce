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
        View::composer('user.layouts.user_one', function ($view) {
            $categories =  cache()->remember('categories', 60*60*24*365, function () {
                            return Category::with('children')->whereNull('category_id')->where('menu', 1)->get();
                        });
            $view->with('categories', $categories);
        });

        View::composer('user.layouts.user_two', function ($view) {
            $categories =  cache()->remember('categories_two', 60*60*24*365, function () {
                            return Category::with('children')->whereNull('category_id')->where('menu', 1)->get();
                        });
            $view->with('categories', $categories);
        });
    }
}
