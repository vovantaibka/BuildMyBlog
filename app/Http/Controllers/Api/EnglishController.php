<?php

namespace App\Http\Controllers\Api;

use App\CategoryAudio;
use App\Http\Controllers\Controller;

class EnglishController extends Controller
{
    public function getAllCategories()
    {
        $categories = CategoryAudio::all();

        foreach ($categories as $category) {
            $category->slug = $this->getSlug($category->name);
        }

        return $categories;
    }

    public function getSlug($name)
    {
        $name = strtolower($name);
        $arr = explode(' ', $name);
        $slug = implode('-', $arr);

        return $slug;
    }

    public function getName($slug)
    {
        $arr = explode('-', $slug);
        $arrUpper = [];
        foreach ($arr as $word) {
            $word = ucfirst($word);
            array_push($arrUpper, $word);
        }
        $name = implode(' ', $arrUpper);

        return $name;
    }

    public function getIndexWithCategory($categoryId)
    {
        $category = CategoryAudio::find($categoryId);

        $audios = $category->audios()->get();

        $view = view('english.medialist')->withAudios($audios);

        $content = $view->render();

        return response()->json([
            'data' => $content,
        ]);
    }
}
