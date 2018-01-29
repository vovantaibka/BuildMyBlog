<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Category;
use App\Tag;

class CRUDController extends Controller
{
	public function getListObject($object)
	{
		switch ($object) {
			case 'user':
				$listObject = User::all();
				$view = view('admin.blog.users')->withUsers($listObject);
				break;
			case 'post':
				$listObject = Post::all();
				$categories = Category::all();
				$tags = Tag::all();
				$view = view('admin.blog.posts')->withPosts($listObject)->withCategories($categories)->withTags($tags);
				break;
			case 'category':
				$listObject = Category::all();
				$view = view('admin.blog.categories')->withCategories($listObject);
				break;
			case 'tag':
				$listObject = Tag::all();
				$view = view('admin.blog.tags')->withTags($listObject);
				break;
			
			default:
				//
				break;
		}
		
		$content = $view->render();

		return response()->json(['response' => $content]);
	}
}
