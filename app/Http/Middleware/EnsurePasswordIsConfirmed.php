<?php

namespace App\Http\Middleware;

// Import built-in password confirmation middleware
use Illuminate\Auth\Middleware\EnsurePasswordIsConfirmed as BaseEnsurePasswordIsConfirmed;

// Create custom middleware
class EnsurePasswordIsConfirmed extends BaseEnsurePasswordIsConfirmed
{
    // This class is empty because the base class is extended to use alias
    // The password confirmation logic is handled by Fortify
}