<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Theater;
use App\Policies\GenrePolicy;
use App\Policies\MoviePolicy;
use App\Policies\TheaterPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Theater::class => TheaterPolicy::class,
        Genre::class => GenrePolicy::class,
        Movie::class => MoviePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
