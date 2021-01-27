<?php

namespace Lasseeee\Multitenancy\Concerns;

use Lasseeee\Multitenancy\Models\Tenant;

trait UsesTenantModel
{
    public function getTenantModel(): Tenant
    {
        $tenantModelClass = config('multitenancy.tenant_model');

        return new $tenantModelClass;
    }
}
