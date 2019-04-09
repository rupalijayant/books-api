<?php

namespace App\Providers;

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
        Validator::extend('isbn', function ($attribute, $value, $parameters) {
            // check if the isbn is valid.
            $value = str_replace('-', '', $value);
            $value = str_replace(' ', '', $value);
            return is_numeric($value) && strlen($value) > 9 && strlen($value) < 14;
        });
    }
}
