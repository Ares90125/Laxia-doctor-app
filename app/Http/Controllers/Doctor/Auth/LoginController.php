<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\AuthController as BaseAuthController;
use App\Http\Requests\Doctor\DoctorLoginRequest;

use Illuminate\Http\Request;

class LoginController extends BaseAuthController
{
    public function __construct()
    {
        $this->guardName = 'doctor';
      
        parent::__construct();
    }
}
