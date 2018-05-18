<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends AccountController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showHome()
    {
        $user = Auth::user();

        return view('admin.main')->withUser($user);
    }
}
