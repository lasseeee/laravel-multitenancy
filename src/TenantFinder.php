<?php

namespace Lasseeee\Multitenancy\TenantFinder;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Lasseeee\Multitenancy\Models\Tenant;

class TenantFinder extends TenantFinder
{
    public function findForRequest(Request $request): ?Tenant
    {
        $subdomain = Str::before($request->getHost(), '.');

        return Tenant::whereSubdomain($subdomain)->first();
    }
}
