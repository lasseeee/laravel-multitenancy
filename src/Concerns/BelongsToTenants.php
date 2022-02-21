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

        static::creating(function ($model) {
            if (! $model->tenants()->exists()) {
                $model->tenants()->attach(Tenant::current());
            }

            return $model;
        });
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
