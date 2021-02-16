<?php

use Lasseeee\Multitenancy\Models\Tenant;
use Lasseeee\Multitenancy\Models\TenantUser;

return [
    /*
     * This class is the model used for storing configuration on tenants.
     *
     * It must be or extend `Lasseeee\Multitenancy\Models\Tenant::class`
     */
    'tenant_model' => Tenant::class,

    /*
     * This class is the model used for storing configuration on the tenants pivot table.
     *
     * It must be or extend `Lasseeee\Multitenancy\Models\TenantUser::class`
     */
    'tenant_user_model' => TenantUser::class,

    /*
     * Whether the current user’s tenants should be cached.
     */
    'cache_current_user_tenants' => false,
];
