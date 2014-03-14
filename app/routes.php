<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// pictxt
Route::get('/pictxt', array('uses' => 'PictxtController@getIndex'));
Route::get('/txt/{id}', array('uses' => 'PictxtController@getTxt'));
Route::get('/pic/{id}', array('uses' => 'PictxtController@getPic'));

// admin
Route::get('/login', array('as'=>'login','uses' => 'AdminIndexController@getLogin'));
Route::post('/login', array('before' => 'csrf','uses' => 'AdminIndexController@postLogin'));
Route::get('/logout', array('uses' => 'AdminIndexController@getLogout'));

Route::When('admin','auth');
Route::When('admin/*','auth');
Route::get('/admin', array('uses' => 'AdminIndexController@getIndex'));

Route::get('/admin/blog', array('uses' => 'AdminBlogController@getIndex'));
Route::get('/admin/blog/edit/', array('uses' => 'AdminBlogController@getEdit'));
Route::get('/admin/blog/edit/{id}', array('uses' => 'AdminBlogController@getEdit'));
Route::post('/admin/blog/edit/', array('uses' => 'AdminBlogController@postEdit'));
Route::post('/admin/blog/edit/{id}', array('uses' => 'AdminBlogController@postEdit'));
Route::get('/admin/blog/category/', array('uses' => 'AdminBlogController@getCategory'));
Route::post('/admin/blog/category/', array('uses' => 'AdminBlogController@postCategory'));

Route::get('/admin/user', array('uses' => 'AdminIndexController@getUser'));
Route::post('/admin/user', array('uses' => 'AdminIndexController@postUser'));

Route::controller('/', 'IndexController');
