<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
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
        Http::macro('tmdb', function () {
            return Http::withToken(config('services.tmdb.token'))
            ->withOptions(['verify' => false])
            ->baseUrl('https://api.themoviedb.org/3');
        });
    }
}
