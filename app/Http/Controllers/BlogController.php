<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
// use Illuminate\Support\Facades\Log;
use App\Post;
use App\Category;
use App\Audio;
use App\CategoryAudio;
use App\Events\ViewPost;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function getHomePage()
    {
        $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();

        foreach ($posts as $post) {
            $post["url_single_post"] = '/blog/' . $post->slug;
            $post["url_image_post"] = '/imgs/' . $post->image;
            $post["user_name"] = $post->user->name;
            $post["updated_at"] = Carbon::createFromFormat('Y-m-d H:i:s', $post->updated_at);

            $post["title"] = substr($post->title, 0, 70) . (strlen($post->title) >= 70 ? "..." : "");
        }

        $categories = Category::all();

        return $posts;
    }

    public function getBlogPage()
    {
        $posts = Post::paginate(10);

        foreach ($posts as $post) {
            $post['url_single_post'] = '/blog/' . $post->slug;
            $post['url_image_post'] = '/imgs/' . $post->image;
            $post['user_name'] = $post->user->name;
            $post['updated_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $post->updated_at);
        }

        return $posts;
    }

    public function getListenPage()
    {
        $categories = CategoryAudio::all();

        foreach ($categories as $category) {
            $category->slug = $this->getSlug($category->name);
        }

        $audios = Audio::paginate(10);

        foreach ($audios as $audio) {
            $audio->slug = $this->getSlug($audio->title);
        }

        $response = array(
            'audios' => $audios,
            'categories' => $categories
        );

        return $response;
    }

    public function getSlug($name)
    {
        $name = strtolower($name);
        $arr = explode(' ', $name);
        $slug = implode('-', $arr);
        return $slug;
    }

    public function getSingle($slug)    
    {
        $post = Post::where('slug', '=', $slug)->first();

        event(new ViewPost($post));

        return view('blog.single')->withPost($post);
    }
}
