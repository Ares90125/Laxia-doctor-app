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
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapClinicRoutes();

        $this->mapDoctorRoutes();

        $this->mapUserRoutes();

        $this->mapSpaRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "spa" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapSpaRoutes()
    {
        Route::middleware('spa')
             ->namespace($this->namespace)
             ->group(base_path('routes/spa.php'));
    }

    /**
     * Define the "clinic" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapClinicRoutes()
    {
        Route::prefix('api/clinic')
            ->middleware('api')
            ->namespace($this->namespace . '\Clinic')
            ->group(base_path('routes/clinic.php'));
    }

    /**
     * Define the "doctor" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapDoctorRoutes()
    {
        Route::prefix('api/doctor')
            ->middleware('api')
            ->namespace($this->namespace . '\Doctor')
            ->group(base_path('routes/doctor.php'));
    }

    /**
     * Define the "user(iOS)" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapUserRoutes()
    {
        Route::prefix('api/user')
            ->middleware('api')
            ->namespace($this->namespace . '\User')
            ->group(base_path('routes/user.php'));
    }
}
