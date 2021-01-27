<?php

namespace Lasseeee\Multitenancy;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Lasseeee\Multitenancy\Http\Middleware\EnsureUserBelongsToTenant;
use Lasseeee\Multitenancy\Http\Middleware\ShareCurrentTenantWithViews;
use Lasseeee\Multitenancy\TenantFinder;

class MultitenancyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this
            ->registerPublishables();
        }

        $this
        ->pushMiddlewaresToGroup()
        ->determineCurrentTenant();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/multitenancy.php', 'multitenancy');
    }

    protected function registerPublishables(): self
    {
        $this->publishes([
            __DIR__ . '/../config/multitenancy.php' => config_path('multitenancy.php'),
        ], 'config');

        if (! class_exists('CreateTenantsTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_tenants_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_tenants_table.php'),
            ], 'migrations');
        }

        return $this;
    }

    protected function pushMiddlewaresToGroup(): self
    {
        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('tenant', EnsureUserBelongsToTenant::class);
        $router->pushMiddlewareToGroup('tenant', ShareCurrentTenantWithViews::class);

        return $this;
    }

    protected function determineCurrentTenant(): void
    {
        if (! $this->app->runningInConsole()) {
            $tenant = TenantFinder::findForRequest(request());

            optional($tenant)->makeCurrent();
        }
    }
}
