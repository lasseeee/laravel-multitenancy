<?php

namespace Lasseeee\Multitenancy;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Lasseeee\Multitenancy\Models\Tenant;

class TenantFinder
{
    public static function findForRequest(Request $request): ?Tenant
    {
        $subdomain = Str::before($request->getHost(), '.');

        return Tenant::whereSubdomain($subdomain)->first();
    }
}
