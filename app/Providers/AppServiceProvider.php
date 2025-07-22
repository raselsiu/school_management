<?php

namespace App\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        // Global Initialization
        view()->share('schoolNameBN', 'আল-মাদীনা ইসলামিক ইন্সটিটিউট সিলেট');
        view()->share('schoolNameEN', 'Al-Madina Islamic Institute Sylhet');
        view()->share('addressBN', 'বড়শালা, আবাদানি, এয়ারপোর্ট রোড, সিলেট');
        view()->share('addressEN', 'Madina Village, A/E, 10/1 Boroshala Abadani, Airport Road, Sylhet | 01777-285728');
    }
}
