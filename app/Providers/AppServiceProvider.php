<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        //
        Paginator::useBootstrap();
        // Validator::extend('admission_number', function ($attribute, $value, $parameters, $validator) {
        //     // Your validation logic for admission number
        //     // For example, check if the admission number follows a specific pattern
        //     return preg_match('/^[A-Za-z0-9]+$/', $value);
        // });

        Validator::extend('roll_number', function ($attribute, $value, $parameters, $validator) {
            // Your validation logic for roll number
            // For example, check if the roll number follows a specific pattern
            return preg_match('/^[A-Za-z0-9]+$/', $value);
        });
    }
}
