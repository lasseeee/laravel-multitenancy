<?php

namespace Lasseeee\Multitenancy\Concerns;

use Lasseeee\Multitenancy\Concerns\UsesTenantModels;
use Lasseeee\Multitenancy\Models\Tenant;
use Lasseeee\Multitenancy\Models\TenantUser;
use Lasseeee\Multitenancy\Scopes\TenantsScope;

trait BelongsToTenants
{
    use UsesTenantModels;

    /**
     * Make this trait bootable from the model.
     */
    public static function bootBelongsToTenants(): void
    {
        static::addGlobalScope(new TenantsScope);
    }

    /**
     * The tenants this user has access to.
     */
    public function tenants()
    {
        return $this->belongsToMany($this->getTenantModel())
        ->using($this->getTenantUserModel())
        ->withTimestamps();
    }
}
