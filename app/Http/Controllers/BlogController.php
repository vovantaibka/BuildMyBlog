<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Post;
use App\Events\ViewPost;

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

        event(new ViewPost($post));

        return view('blog.single')->withPost($post);
    }
}
