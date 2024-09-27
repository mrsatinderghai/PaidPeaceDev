<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Tenant as BaseTenant; // Use the Spatie Tenant model
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection; 

class Tenant extends BaseTenant
{
    use HasFactory;

    use UsesTenantConnection;

    protected $fillable = [
        'name',        // Add 'name' to allow mass assignment
        'domain',      // Add other relevant fields
        'database',    // If your model has this field
        'user_id',     // If the tenant is linked to a user
    ];
}
