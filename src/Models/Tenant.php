<?php

namespace Lasseeee\Multitenant\Models;

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
        return 'slug';
    }
}
