<?php

namespace App\Providers;

use App\Repositories\AccountRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\GuestRepository;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\GuestRepositoryInterface;
use App\Repositories\Interfaces\SessionRepositoryInterface;
use App\Repositories\Interfaces\SpotRepositoryInterface;
use App\Repositories\Interfaces\StatMonthRepositoryInterface;
use App\Repositories\Interfaces\StatRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\SessionRepository;
use App\Repositories\SpotRepository;
use App\Repositories\StatMonthRepository;
use App\Repositories\StatRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SpotRepositoryInterface::class, SpotRepository::class,
            );
        $this->app->bind(
            UserRepositoryInterface::class, UserRepository::class,
            );
        $this->app->bind(
            CompanyRepositoryInterface::class, CompanyRepository::class,
            );
        $this->app->bind(
            StatRepositoryInterface::class, StatRepository::class,
            );
        $this->app->bind(
            StatMonthRepositoryInterface::class, StatMonthRepository::class,
            );
        $this->app->bind(
            GuestRepositoryInterface::class, GuestRepository::class,
            );
        $this->app->bind(
            SessionRepositoryInterface::class, SessionRepository::class,
            );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
