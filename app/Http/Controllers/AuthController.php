<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    //
    public function getLogin()
    {
        return view('authentication.login');
    }

    public function getRegister()
    {
        return view('authentication.register');
    }
}
