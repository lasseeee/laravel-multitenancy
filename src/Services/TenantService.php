<?php
namespace Lasseeee\Multitenant\Services;

use Lasseeee\Multitenant\Models\Tenant;

class TenantService
{
    /*
    * @var null|App\Tenant
    */
    private $tenant;

    public function setTenant($tenant)
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function getTenant()
    {
        return $this->tenant;
    }
}
