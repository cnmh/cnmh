<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Artisan::call('migrate');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        // TODO à ajouter dans laravel starter aprés savoir ce qu'il fait
        Schema::defaultStringLength(191);

       
    }
}
