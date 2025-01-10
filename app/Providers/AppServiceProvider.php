<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registrasi layanan lainnya (jika diperlukan)
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    // Mendaftarkan komponen appUser-layout
    Blade::component('layouts.appUser-layout', 'appUser-layout');
}
}

