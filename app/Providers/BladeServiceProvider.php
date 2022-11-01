<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Model\Admin;
class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::if('role',function($e){
            if(Auth::admin()){ // xac nhan co dang nhap hay k
                if(Auth::admin()->hasRole($e)){
                    return true;
                }
            } //
            return false;
        });
    }
}
