<?php

namespace Lasseeee\Multitenant\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Lasseeee\Multitenant\Services\TenantService;

class IdentifyTenant
{
    protected $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function handle($request, Closure $next)
    {
        $this->tenantService->setTenant($request->tenant);

        View::share('currentTenant', $request->tenant);

        return $next($request);
    }
}
