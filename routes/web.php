<?php
use App\Message;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@getIndex');
Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/messages', 'ChatRoomController@getMessages');

    Route::post('/messages', 'ChatRoomController@storeMessage');
});

Route::group(['namespace' => 'Test'], function () {
    Route::get('test/map', 'TestController@testGoogleMapApi');
    Route::get('test/zoom-image', 'TestController@testZoomImage');
    Route::get('test/jquery', 'TestController@testJQuery');
    Route::get('test/pagerank', 'TestController@getPagerank');
    Route::get('test/vue', 'TestController@getVueComponent');
    Route::get('test/router-vue', 'TestController@getRouterVue');
});

Route::group(['middleware' => ['web']], function () {

    // Authentication Routes
    // Route::get('auth/login', 'AuthController@getLogin');
    // Route::get('auth/register', 'AuthController@getRegister');

    // Categories
    Route::resource('categories', 'CategoryController', ['except' => ['create']]);

    // Tags
    Route::resource('tags', 'TagController', ['except' => ['create']]);

    // Posts
    Route::resource('posts', 'PostController');

    // Account
    Route::resource('account', 'AccountController');
    
    Route::put('account/{id}', ['uses' => 'AccountController@changePassword', 'as' => 'account.changepw']);

    // Admin
    Route::get('admin', ['uses' => 'AdminController@showHome', 'as' => 'admin.main']);

    // Comments
    Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
    Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
    Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
    Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
    Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);
    Route::get('comments/{comments}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

    // Blog
    Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->middleware('check.view.post')->where('slug', '[\w\d\-\_]+');

    Route::get('blog', ['as' => 'blog.index', 'uses' => 'BlogController@getIndex']);

    Route::get('home', 'BlogController@getHomePage');
    Route::get('blog', 'BlogController@getBlogPage');
    Route::get('listen', 'BlogController@getListenPage');

    // Contact
    Route::get('contact', 'PagesController@getContact');
    Route::post('contact', 'PagesController@postContact');

    // English
    Route::resource('audios', 'AudioController');

    Route::resource('categoriesaudio', 'CategoryAudioController');

    Route::get('listenandread', ['as' => 'listenandread.index', 'uses' => 'EnglishController@getIndex']);

    Route::get('listenandread/{slug}', ['as' => 'english.single', 'uses' => 'EnglishController@getSingle']);

    Route::get('/vue/{vue_capture?}', function () {
        return view('vue.index');
    })->where('vue_capture', '[\/\w\.-]*');
});



Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::get('admin/list/{object?}', 'AdminController@getListObject');
    Route::get('admin/{object}/{id}', 'AdminController@viewObject');
    Route::delete('admin/delete/{object}/{id}', 'AdminController@deleteObject');

    Route::get('admin/listenandread/category/{categoryId}', 'EnglishController@getIndexWithCategory');

    //Website Crawler
    Route::post('crawlersite', 'CrawlerController@getUrlData');

    Route::resource('categoriesaudio', 'CategoryAudioController', ['except' => ['create', 'edit']]);

    Route::resource('audio', 'AudioController', ['except' => ['create', 'edit']]);
});

Auth::routes();
