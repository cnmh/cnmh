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
        // https://stackoverflow.com/questions/42244541/laravel-migration-error-syntax-error-or-access-violation-1071-specified-key-wa
        // TODO à ajouter dans laravel starter aprés savoir ce qu'il fait
        Schema::defaultStringLength(191);

       
    }
}
