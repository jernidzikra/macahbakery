<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        // Situs ini memakai Bootstrap 5, jadi tampilan pagination-nya disamakan
        // (sebelumnya default Laravel memakai Tailwind yang tidak dimuat di sini).
        Paginator::useBootstrap();
    }
}
