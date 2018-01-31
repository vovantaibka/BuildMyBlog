<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Category;
use App\Tag;
use Session;
use Image;
use Storage;

class CRUDController extends Controller
{
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

			default:
				# code...
			break;
		}
		return $object;
	}

	public function viewObject($objectType, $id)
	{
		$object = $this->getObject($objectType, $id);
		if($objectType == "post") {
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
