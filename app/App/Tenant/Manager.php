<?php
/**
 * Created by PhpStorm.
 * User: CreatyDev
 * Date: 4/28/2018
 * Time: 12:04 AM
 */

namespace CreatyDev\App\Tenant;

class Manager
{
    protected $tenant;

    /**
     * Get tenant.
     *
     * @return mixed
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * Set tenant.
     *
     * @param mixed $tenant
     */
    public function setTenant($tenant)
    {
        $this->tenant = $tenant;
    }
}