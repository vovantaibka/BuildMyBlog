<?php

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

Route::group(['namespace' => 'Test'], function () {
    Route::get('test/map', 'TestController@testGoogleMapApi');
    Route::get('test/zoom-image', 'TestController@testZoomImage');
    Route::get('test/jquery', 'TestController@testJQuery');
    Route::get('test/pagerank', 'TestController@getPagerank');
    Route::get('test/vue', 'TestController@getVueComponent');
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
    Route::get('admin/{object?}', ['uses' => 'AdminController@show', 'as' => 'admin.show']);

    // Comments
    Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
    Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
    Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
    Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
    Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);
    Route::get('comments/{comments}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

    // Blog
    Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])
    ->where('slug', '[\w\d\-\_]+');

    Route::get('blog', ['as' => 'blog.index', 'uses' => 'BlogController@getIndex']);

    Route::get('about', 'PagesController@getAbout');

    // Contact
    Route::get('contact', 'PagesController@getContact');
    Route::post('contact', 'PagesController@postContact');

    // English
    Route::resource('audios', 'AudioController');

    Route::resource('categoriesaudio', 'CategoryAudioController');

    Route::get('listenandread', ['as' => 'listenandread.index', 'uses' => 'EnglishController@getIndex']);

    Route::get('listenandread/{slug}', ['as' => 'english.single', 'uses' => 'EnglishController@getSingle']);

    //Website Crawler
    Route::post('crawlersite', 'CrawlerController@getUrlData');
});

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::get('admin/list/{object?}', 'AdminController@getListObject');
    Route::get('admin/{object}/{id}', 'AdminController@viewObject');
    Route::delete('admin/delete/{object}/{id}', 'AdminController@deleteObject');

    Route::get('admin/listenandread/category/{categoryId}', 'EnglishController@getIndexWithCategory');
});

Auth::routes();
