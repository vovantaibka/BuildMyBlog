<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class AdminController extends AccountController
{
	public function show($object) 
	{
		$user = Auth::user();
		return view('admin.show')->withUser($user)->withObject($object);
	}
}
