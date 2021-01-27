<?php

namespace Lasseeee\Multitenancy\Concerns;

use Lasseeee\Multitenancy\Concerns\UsesTenantModels;
use Lasseeee\Multitenancy\Models\TenantUser;

trait BelongsToTenants
{
    use UsesTenantModels;

    /**
     * The tenants this user has access to.
     *
     * @return \Illuminate\Support\Collection
     */
    public function tenants()
    {
        return $this->belongsToMany($this->getTenantModel())
        ->using($this->getTenantUserModel())
        ->withTimestamps();
    }
}
