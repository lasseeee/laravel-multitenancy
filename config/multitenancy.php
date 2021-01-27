<?php

use Spatie\Multitenancy\Models\Tenant;

return [
    /*
     * This class is the model used for storing configuration on tenants.
     *
     * It must be or extend `Spatie\Multitenancy\Models\Tenant::class`
     */
    'tenant_model' => Tenant::class,
];
