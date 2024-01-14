<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
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
        $this->registerValidationTranslations();
    }

    /**
     * Register the validation error messages.
     *
     * @return void
     */
    protected function registerValidationTranslations()
    {

        // get the path of our lang folder
        $customLangPath = base_path('lang');
    
        // Load translations from the custom language file , 'validation' is the namespace of messages.php
        $this->loadTranslationsFrom($customLangPath . '/fr/messages.php', 'validation');
        // Override the 'unique' validation message using a custom replacer
        Validator::replacer('unique', function ($message, $attribute, $rule, $parameters) {
            // dd($message , $attribute,$rule,$parameters);
            // Replace ':model' in the message with the attribute (the default is to replace it using parameters) of the unique rule
            return str_replace(':model', 'Le ' . $attribute, ':model a déjà été pris');
        });
    }
}
