<?php

namespace Lasseeee\Multitenancy\Scopes;

use Lasseeee\Multitenancy\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (Tenant::isSet()) {
            $builder->where(function (Builder $builder) use ($model) {
                $builder->where($model->getTable() . '.tenant_id', '=', Tenant::current()->id)
                    ->orWhereNull($model->getTable() . '.tenant_id');
            });
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
