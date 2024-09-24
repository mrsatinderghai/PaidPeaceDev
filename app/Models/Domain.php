<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Domain as BaseDomain;

class Domain extends BaseDomain
{
    // You can add any additional functionality or properties here if needed.
    
    // Example: Custom method to get the full domain URL
    public function getFullDomainUrl()
    {
        return "http://" . $this->domain; // Adjust according to your needs
    }
}
