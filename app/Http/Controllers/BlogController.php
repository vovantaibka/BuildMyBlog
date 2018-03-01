<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Post;

class BlogController extends Controller
{
    public function getIndex()
    {
        $posts = Post::paginate(10);

        return view('blog.index')->withPosts($posts);
    }

    public function getSingle($slug)    
    {
        $post = Post::where('slug', '=', $slug)->first();
        return view('blog.single')->withPost($post);
    }
}
