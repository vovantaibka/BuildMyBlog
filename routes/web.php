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

//
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

    Route::get('admin/list/{object?}', 'Ajax\CRUDController@getListObject');
    Route::get('admin/{object}/{id}', 'Ajax\CRUDController@viewObject');
    Route::delete('admin/delete/{object}/{id}', 'Ajax\CRUDController@deleteObject');

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

    Route::get('/', 'PagesController@getIndex');
    Route::get('about', 'PagesController@getAbout');

    // Contact
    Route::get('contact', 'PagesController@getContact');
    Route::post('contact', 'PagesController@postContact');

    // English 
    Route::resource('audios', 'AudioController');

    Route::get('/listenandread', 'PagesController@getListenAndRead');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

// Test 
Route::get('test/map', 'Test\TestController@testGoogleMapApi');
Route::get('test/zoom-image', 'Test\TestController@testZoomImage');
Route::get('test/jquery', 'Test\TestController@testJQuery');
