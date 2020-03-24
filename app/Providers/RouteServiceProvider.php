<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $auth_namespace = 'App\Http\Controllers\Auth';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapAuthRoutes();
        $this->mapUsersRoutes();
        $this->mapAccountsRoutes();
        $this->mapMikrotikRoutes();
    }

    protected function mapAuthRoutes()
    {
        Route::middleware('api')
            ->prefix('auth')
            ->namespace($this->auth_namespace)
            ->group(base_path('routes/api/auth.php'));
    }

    protected function mapMikrotikRoutes()
    {
        Route::middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/mikrotik.php'));
    }

    protected function mapUsersRoutes()
    {
        Route::middleware(['api', 'auth:api'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/users_routes.php'));
    }

    protected function mapAccountsRoutes()
    {
        Route::middleware(['api', 'auth:accounts_api'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/accounts_routes.php'));
    }
}
