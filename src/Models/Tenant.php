<?php

namespace Lasseeee\Multitenancy\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
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

        app()->instance('currentTenant', $tenant);

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
