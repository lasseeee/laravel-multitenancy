<?php

namespace Lasseeee\Multitenant\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Lasseeee\Multitenant\Services\TenantService;

class ValidateTenant
{
    public function handle($request, Closure $next)
    {
        $sessionKey = 'ensure_valid_tenant_session_tenant_id';
        if (! $request->session()->has($sessionKey)) {
            $request->session()->put($sessionKey, app(TenantService::class)->getTenant()->id);
            return $next($request);
        }

        if ($request->session()->get($sessionKey) !== app(TenantService::class)->getTenant()->id) {
            return $this->handleInvalidTenantSession($request);
        }

        return $next($request);
    }

    protected function handleInvalidTenantSession($request)
    {
        abort(Response::HTTP_UNAUTHORIZED);
    }
}
