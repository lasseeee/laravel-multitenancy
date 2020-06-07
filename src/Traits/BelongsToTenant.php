<?php

namespace Lasseeee\Multitenant\Traits;

use Lasseeee\Multitenant\Scopes\TenantScope;

trait BelongsToTenant
{
    /**
     * Make this trait bootable from the model.
     *
     * @return void
     */
    public static function bootBelongsToTenant() {
        static::addGlobalScope(new TenantScope);
    }

    /**
     * The tenant the model belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
        return $this->belongsTo(config('multitenant.tenant_model'));
    }
}
