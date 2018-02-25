<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Audio;
use App\CategoryAudio;

class EnglishController extends Controller
{
	public function getIndex()
	{
		$categories = $this->getAllCategories();

		$audios = Audio::paginate(10);

		foreach ($audios as $audio) {
			$audio->slug = $this->getSlug($audio->title);
		}

		return view('english.index')->withCategories($categories)->withAudios($audios);
	}

	public function getIndexWithCategory($category)
	{
		$categories = $this->getAllCategories();

		$name = $this->getName($category);

		$id = DB::connection('mysql_2')->table('categories')->where('name', $name)->first()->id;

		$category = CategoryAudio::find($id);

		$audios = $category->audios()->get();

		return view('english.index')->withCategories($categories)->withAudios($audios);
	}

	public function getSingle($slug)
	{
		$title = $this->getName($slug);

		$audio = Audio::where('title', '=', $title)->first();

		$audio->linkOpen = $this->getLinkOpen($audio->link);
		$audio->linkDownload = $this->getLinkDownload($audio->link);

		return view('english.single')->withAudio($audio);
	}

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
		$arrUpper = array();
		foreach ($arr as $word) {
			$word = ucfirst($word);
			array_push($arrUpper, $word);
		}
		$name = implode(' ', $arrUpper);
		return $name;
	}

	public function getLinkOpen($linkShare)
	{
		$arr = explode('/', $linkShare);

		$id = $arr[5];

		$linkOpen = "https://drive.google.com/uc?export=open&id=" . $id;

		return $linkOpen;
	}

	public function getLinkDownload($linkShare)
	{
		$arr = explode('/', $linkShare);

		$id = $arr[5];

		$linkDownload = "https://drive.google.com/uc?export=download&id=" . $id;

		return $linkDownload;
	}
}
