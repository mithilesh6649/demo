<?php

namespace App\Providers;

use App\Customservices\GopayService;
use Illuminate\Support\ServiceProvider;

class GoPayProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */ 
    public function register()
    {
        $this->app->bind('gopay',function($app){

            return new GopayService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
