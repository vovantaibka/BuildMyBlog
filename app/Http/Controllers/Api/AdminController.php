<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Middleware\Authenticate;
use App\User;
use App\Post;
use App\Category;
use App\Tag;
use App\Audio;
use App\CategoryAudio;
use Session;
use Image;
use Storage;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getObject($objectType, $id)
	{
		$object = null;
		switch ($objectType) {
			case 'user':
			$object = User::find($id);
			break;

			case 'post':
			$object = Post::find($id);
			break;

			case 'category':
			$object = Category::find($id);
			break;

			case 'tag':
			$object = Tag::find($id);
			break;

			case 'category_audio':
			$object = CategoryAudio::find($id);
			break;

			default:
				# code...
			break;
		}
		return $object;
	}

	public function viewObject($objectType, $id)
	{
		$object = $this->getObject($objectType, $id);
		
		switch ($objectType) {
			case 'post':
			$tags = array();
			foreach ($object->tags as $tag) {
				$tags[] = $tag->id;
			}
			return response()->json([
				'id' => $object->id,
				'title' => $object->title,
				'slug' => $object->slug,
				'body' => $object->body,
				'category' => $object->category->name,
				'category_id' => $object->category->id,
				'tags' => $object->tags,
				'tags_id' => $tags,
				'featured_image' => $object->image,
				'img_url' => asset('imgs/' . $object->image),
				'action' => redirect()->route('posts.update', $object->id)
			]);
			break;
			
			case 'category':
			return response()->json([
				'id' => $object->id,
				'name' => $object->name
			]);
			break;

			case 'tag':
			return response()->json([
				'id' => $object->id,
				'name' => $object->name
			]);
			break;

			case 'category_audio':
			return response()->json([
				'id' => $object->id,
				'name' => $object->name
			]);
			break;

			default:
				# code...
			break;
		}
	}

	public function getListObject($object)
	{
		switch ($object) {
			case 'home':
			$listObject = User::all();
			$view = view('admin.blog.home');
			break;

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

			case 'vocabulary':
			$view = view('admin.english.vocabulary');
			break;

			case 'category_audio':
			$listObject = CategoryAudio::all();
			$view = view('admin.english.categories')->withCategories($listObject);
			break;

			case 'audio':
			$listObject = Audio::all();
			$categories = CategoryAudio::all();
			$view = view('admin.english.audios')->withAudios($listObject)->withCategories($categories);
			break;
			
			default:
				//
			break;
		}
		
		$content = $view->render();
		return response()->json(array(
			'data' => $content
		));
	}

	public function deleteObject($objectType, $id) {

		$object = null;

		switch ($objectType) {
			case 'user':
			$object = User::find($id);
			break;

			case 'post':
			$object = Post::find($id);
			$object->tags()->detach();

			Storage::delete($object->image);
			break;

			case 'category':
			$object = Category::find($id);
			break;

			case 'tag':
			$object = Tag::find($id);
			break;

			case 'category_audio':
			$object = CategoryAudio::find($id);

			$audios = $object->audios()->where('category_id', $id)->get();

			if ($audios->count()) {
				Session::flash('error', 'Category can not delete');
				return response()->json(['result' => 'error']);
			}
			break;

			default:
				# code...
			break;
		}
		// $object = $this->getObject($objectType, $id);

		$object->delete();

		Session::flash('success', 'The' . $objectType . ' was successfully deleted');
		
		return response()->json(['result' => 'success']);
	}
}
