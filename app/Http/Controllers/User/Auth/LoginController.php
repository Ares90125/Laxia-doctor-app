<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\AuthController as BaseAuthController;

class LoginController extends BaseAuthController
{
    public function __construct()
    {
        $this->guardName = 'patient';
        
        parent::__construct();
    }
}
