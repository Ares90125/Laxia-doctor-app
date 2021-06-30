<?php

namespace App\Http\Controllers\Clinic\Auth;

use App\Http\Controllers\AuthController as BaseAuthController;

class LoginController extends BaseAuthController
{
    public function __construct()
    {
        $this->guardName = 'clinic';
        
        parent::__construct();
    }
}
