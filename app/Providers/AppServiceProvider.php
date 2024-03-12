<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Post;
use App\Models\Customer;
use App\Models\Order;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*',function($view){
            // $visitor = Visitors::all();
            $products = Product::all()->count();
            $posts = Post::all()->count();
            $orders = Order::all()->count();
            $customers = Customer::all()->count();
            $product_view = Product::orderBy('product_view','DESC')->take(20)->get();
            $post_views = Post::orderby('post_view','DESC')->take(20)->get();
            $view->with(compact('products','posts','orders','customers','post_views','product_view'));
        });
    }
}
