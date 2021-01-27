<?php

namespace Lasseeee\Multitenancy;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Lasseeee\Multitenancy\Concerns\UsesTenantModel;
use Lasseeee\Multitenancy\Models\Tenant;

class TenantFinder
{
    use UsesTenantModel;

    public function findForRequest(Request $request): ?Tenant
    {
        $subdomain = Str::before($request->getHost(), '.');

        return $this->getTenantModel()
        ::whereSubdomain($subdomain)
        ->first();
    }
}
