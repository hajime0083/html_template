<?php

// pictxt
Route::get('/pictxt', array('uses' => 'user.UserPictxtController@getIndex'));
Route::get('/txt/{id}', array('uses' => 'user.UserPictxtController@getTxt'));
Route::get('/pic/{id}', array('uses' => 'user.UserPictxtController@getPic'));

// admin
Route::get('/login', array('as'=>'login','uses' => 'AdminIndexController@getLogin'));
Route::post('/login', array('before' => 'csrf','uses' => 'AdminIndexController@postLogin'));
Route::get('/logout', array('uses' => 'AdminIndexController@getLogout'));

Route::When('admin','auth');
Route::When('admin/*','auth');
Route::get('/admin', array('uses' => 'AdminIndexController@getIndex'));

// admin - blog
Route::get('/admin/blog', array('uses' => 'AdminBlogController@getIndex'));
Route::get('/admin/blog/edit/', array('uses' => 'AdminBlogController@getEdit'));
Route::get('/admin/blog/edit/{id}', array('uses' => 'AdminBlogController@getEdit'));
Route::post('/admin/blog/edit/', array('uses' => 'AdminBlogController@postEdit'));
Route::post('/admin/blog/edit/{id}', array('uses' => 'AdminBlogController@postEdit'));
Route::get('/admin/blog/category/', array('uses' => 'AdminBlogController@getCategory'));
Route::post('/admin/blog/category/', array('uses' => 'AdminBlogController@postCategory'));

// admin - user
Route::get('/admin/user', array('uses' => 'AdminIndexController@getUser'));
Route::post('/admin/user', array('uses' => 'AdminIndexController@postUser'));

// admin - genre
Route::get('/admin/genre', array('uses' => 'AdminGenreController@getIndex','as'=>'genre'));
Route::post('/admin/genre', array('uses' => 'AdminGenreController@postIndex'));

// admin - offline
Route::get('/admin/offline', array('uses' => 'AdminOffController@getIndex'));
Route::get('/admin/offline/edit/', array('uses' => 'AdminOffController@getEdit'));
Route::get('/admin/offline/edit/{id}', array('uses' => 'AdminOffController@getEdit'));
Route::post('/admin/offline/edit/', array('uses' => 'AdminOffController@postEdit'));
Route::post('/admin/offline/edit/{id}', array('uses' => 'AdminOffController@postEdit'));

Route::controller('/', 'UserIndexController');
