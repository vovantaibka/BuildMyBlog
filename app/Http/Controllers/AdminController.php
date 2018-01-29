<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class AdminController extends AccountController
{
	public function show($id) 
	{
		$user = Auth::user();
		return view('admin.show')->withUser($user);
	}

	// public function getUsers()
	// {
	// 	$users = User::all();
	// 	return view('admin.blog.users')->withUsers($users);
	// }

	// public function getPosts()
	// {
	// 	$posts = Post::all();
	// 	return view('admin.blog.posts')->withPosts($posts);
	// }
}
