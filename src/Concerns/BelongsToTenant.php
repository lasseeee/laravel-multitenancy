<?php

namespace Lasseeee\Multitenancy\Concerns;

use Lasseeee\Multitenancy\Concerns\UsesTenantModels;
use Lasseeee\Multitenancy\Models\Tenant;
use Lasseeee\Multitenancy\Scopes\TenantScope;

trait BelongsToTenant
{
    use UsesTenantModels;

    /**
     * Make this trait bootable from the model.
     */
    public static function bootBelongsToTenant()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            if (!$model->tenant_id) {
                $model->tenant()->associate(Tenant::current());
            }

            return $model;
        });
    }

    /**
     * The tenant the model belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
        return $this->belongsTo($this->getTenantModel());
    }
}
