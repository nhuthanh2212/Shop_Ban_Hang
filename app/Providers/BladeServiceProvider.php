<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;


class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::if('hasrole', function($expression){
            if(Auth::user()){
                if(Auth::user()->hasRole($expression)){
                    return true;
                }
            }
            return false;
        });
        Blade::if('impersonate', function(){
            if (session()->get('impersonate')) {
                return true;
            }
            return false;
        });
    }
}
