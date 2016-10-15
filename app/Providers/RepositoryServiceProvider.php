<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $config = config('repositories');

        foreach ($config as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
