<?php
namespace Lasseeee\Multitenant\Services;

use Lasseeee\Multitenant\Models\Tenant;

class TenantService
{
    /*
    * @var null|App\Tenant
    */
    private $tenant;

    public function setTenant(?Tenant $tenant)
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function getTenant() : ?Tenant
    {
        return $this->tenant;
    }
}
