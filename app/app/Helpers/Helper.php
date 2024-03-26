<?php


use Illuminate\Support\Facades\Auth;

if (!function_exists('is_male_localisation')) {
    function is_male_localisation($key)
    {
        $isMale = filter_var(trans($key), FILTER_VALIDATE_BOOLEAN);
        // dd($isMale);
        if ($isMale) {
            return 'un';
        } else {
            return 'une';
        }
    }
}

if (!function_exists('app_menu')) {
    function app_menu()
    {
        if (Auth::check()) {
            return App\Models\MenuItem::where("description", Auth::user()->name)
                ->orWhere("description", null)
                ->get()
                ->groupBy('menu_group.nom');
        } else {
            return App\Models\MenuItem::where("description", Auth::user()->name)
                ->get()
                ->groupBy('menu_group.nom');
        }
    }
}
