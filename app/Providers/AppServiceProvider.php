<?php

namespace App\Providers;

use App\Gateways\Crawler;
use App\Gateways\GoutteCrawler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->instance(Crawler::class, new GoutteCrawler);
    }
}
