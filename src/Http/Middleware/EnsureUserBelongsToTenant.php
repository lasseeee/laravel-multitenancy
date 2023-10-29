<?php

namespace Lasseeee\Multitenancy\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Lasseeee\Multitenancy\Models\Tenant;

class EnsureUserBelongsToTenant
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Tenant::forCurrentUser()->contains(Tenant::current())) {
            return abort(403);
        }

        return $next($request);
    }
}
