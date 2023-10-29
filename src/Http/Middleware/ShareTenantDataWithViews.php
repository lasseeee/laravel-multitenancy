<?php

namespace Lasseeee\Multitenancy\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Lasseeee\Multitenancy\Models\Tenant;

class ShareTenantDataWithViews
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        View::share('currentTenant', Tenant::current());
        View::share('currentUserTenants', Tenant::forCurrentUser());

        return $next($request);
    }
}
