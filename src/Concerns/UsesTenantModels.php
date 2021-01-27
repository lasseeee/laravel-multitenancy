<?php

namespace Lasseeee\Multitenancy\Concerns;

use Lasseeee\Multitenancy\Models\Tenant;
use Lasseeee\Multitenancy\Models\TenantUser;

trait UsesTenantModels
{
    public function getTenantModel(): Tenant
    {
        $tenantModelClass = config('multitenancy.tenant_model');

        return new $tenantModelClass;
    }

    public function getTenantUserModel(): TenantUser
    {
        $tenantModelClass = config('multitenancy.tenant_user_model');

        return new $tenantModelClass;
    }
}
