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
    public static function bootBelongsToTenant(): void
    {
        static::addGlobalScope(new TenantScope);
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
