<?php

namespace Lasseeee\Multitenant;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Lasseeee\Multitenant\Http\Middleware\IdentifyTenant;
use Lasseeee\Multitenant\Http\Middleware\ValidateTenant;
use Lasseeee\Multitenant\Middleware\Multitenant;
use Lasseeee\Multitenant\Services\TenantService;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $tenantService = new TenantService;

        $this->app->instance(TenantService::class, $tenantService);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/multitenant.php' => config_path('multitenant.php'),
            ], 'config');

            if (! class_exists('CreateTenantsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_tenants_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_tenants_table.php'),
                ], 'migrations');
            }
        }

        $router = $this->app->make(Router::class);

        $router->aliasMiddleware('tenant.identify', IdentifyTenant::class);

        $router->aliasMiddleware('tenant.validate', ValidateTenant::class);

        Route::model('tenant', config('multitenant.tenant_model'));
    }
}
