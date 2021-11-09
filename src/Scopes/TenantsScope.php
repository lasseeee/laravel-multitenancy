<?php

namespace Lasseeee\Multitenancy\Scopes;

use Lasseeee\Multitenancy\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantsScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model)
    {
        if (Tenant::isSet()) {
            $builder->whereRelation('tenants', 'id', Tenant::current()->id);
        }
    }

    public function extend(Builder $builder)
    {
        $this->addWithoutTenancy($builder);
    }

    protected function addWithoutTenancy(Builder $builder)
    {
        $builder->macro('withoutTenancy', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }
}
