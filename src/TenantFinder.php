<?php

namespace Lasseeee\Multitenancy;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Lasseeee\Multitenancy\Concerns\UsesTenantModels;
use Lasseeee\Multitenancy\Models\Tenant;

class TenantFinder
{
    use UsesTenantModels;

    public function findForRequest(Request $request): ?Tenant
    {
        $subdomain = Str::before($request->getHost(), '.');

        return $this->getTenantModel()
        ::whereSubdomain($subdomain)
        ->first();
    }
}
