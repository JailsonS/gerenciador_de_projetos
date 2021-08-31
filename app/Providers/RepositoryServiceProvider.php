<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\RepositoryAuth;
use App\Repositories\Elloquent\RepositoryBase;
use App\Repositories\Auth\RepositoryAuthInterface;
use App\Repositories\Elloquent\RepositoryElloquentInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryElloquentInterface::class, RepositoryBase::class);
        $this->app->bind(RepositoryAuthInterface::class, RepositoryAuth::class);
    }

}
