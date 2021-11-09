<?php

namespace Lasseeee\Multitenancy\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'subdomain';
    }

    /**
     * Make this tenant the current one.
     *
     * @return \Lasseeee\Multitenancy\Models\Tenant
     */
    public function makeCurrent(): self
    {
        if ($this->isCurrent()) {
            return $this;
        }

        static::forgetCurrent();

        app()->instance('currentTenant', $this);

        return $this;
    }

    /**
     * Forget the current tenant.
     *
     * @return \Lasseeee\Multitenancy\Models\Tenant
     */
    public static function forgetCurrent(): ?self
    {
        $currentTenant = static::current();

        if (is_null($currentTenant)) {
            return null;
        }

        app()->forgetInstance('currentTenant');

        return $currentTenant;
    }

    /**
     * Return the current tenant.
     *
     * @return \Lasseeee\Multitenancy\Models\Tenant
     */
    public static function current(): ?self
    {
        if (! app()->has('currentTenant')) {
            return null;
        }

        return app('currentTenant');
    }

    /**
     * Return the tenants for the current user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function forCurrentUser()
    {
        if (! config('multitenancy.cache_current_user_tenants')) {
            return auth()->user()->tenants ?? collect([auth()->user()->tenant]);
        }

        $cacheKey = 'tenant_user_' . auth()->id();

        return cache()->rememberForever($cacheKey, function () {
            return auth()->user()->tenants ?? collect([auth()->user()->tenant]);
        });
    }

    /**
     * Check is a current tenant is set.
     *
     * @return boolean
     */
    public static function isSet(): bool
    {
        return static::current() !== null;
    }

    /**
     * Check if this current is the current one.
     *
     * @return boolean
     */
    public function isCurrent(): bool
    {
        return optional(static::current())->id === $this->id;
    }
}
