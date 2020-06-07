<?php

namespace Lasseeee\Multitenant\Traits;

use Lasseeee\Multitenant\Scopes\TenantScope;
use Lasseeee\Multitenant\Services\TenantService;

trait BelongsToTenant
{
    /**
     * Make this trait bootable from the model.
     *
     * @return void
     */
    public static function bootBelongsToTenant() {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            if (!$model->tenant_id) {
                $model->tenant()->associate(app(TenantService::class)->getTenant());
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
        return $this->belongsTo(config('multitenant.tenant_model'));
    }
}
