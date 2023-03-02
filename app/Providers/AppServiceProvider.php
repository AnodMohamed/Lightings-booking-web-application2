<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

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
        //
        $settings = Setting::checkSettings();
        $categories = Category::with('children')->where('parent' , 0)->orWhere('parent' , null)->get();
        $lastFiveProducts = Product::with('category')->orderBy('id')->limit(5)->get();

        View()->share([
            'setting'=>$settings,
            'categories'=>$categories,
            'lastFiveProducts'=>$lastFiveProducts,

        ]); 
    }
}
