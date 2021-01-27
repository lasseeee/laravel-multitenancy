<?php

namespace Lasseeee\Multitenancy\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TenantUser extends Pivot
{
    public static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            cache()->flush();
        });

        static::deleting(function ($item) {
            cache()->flush();
        });
    }
}
