<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('isbn', function ($attribute, $value, $parameters) {
            // check if the isbn is valid, ISBN-10, as per examples
            
            if (preg_match('/^978-(\d{10})$/', $value, $matches)) {
                return true;
            } else {
                return false;
            }            
        });
    }
}
