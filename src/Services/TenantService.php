<?php
namespace Lasseeee\Multitenancy\Services;

use Lasseeee\Multitenancy\Models\Tenant;

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
