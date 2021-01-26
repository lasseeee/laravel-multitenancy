<?php

namespace Lasseeee\Multitenancy\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Lasseeee\Multitenancy\Models\Tenant;

class ShareCurrentTenantWithViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        View::share('currentTenant', Tenant::current());

        return $next($request);
    }
}
