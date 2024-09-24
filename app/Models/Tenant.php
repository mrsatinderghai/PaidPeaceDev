<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    public function domains()
    {
        return $this->hasMany(config('tenancy.domain_model'), 'tenant_id');
    }
}