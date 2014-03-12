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
Route::get('/login', array('uses' => 'AdminIndexController@getLogin'));
Route::get('/admin', array('uses' => 'AdminIndexController@getIndex'));
Route::get('/admin/blog', array('uses' => 'AdminBlogController@getIndex'));
Route::get('/admin/blog/edit/', array('uses' => 'AdminBlogController@getEdit'));
Route::get('/admin/blog/edit/{id}', array('uses' => 'AdminBlogController@getEdit'));

Route::controller('/', 'IndexController');