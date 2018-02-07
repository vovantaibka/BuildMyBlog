<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;
use App\User;
use App\Post;

class AdminController extends AccountController
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function show($object) 
	{
		$user = Auth::user();
		return view('admin.show')->withUser($user)->withObject($object);
	}
}
