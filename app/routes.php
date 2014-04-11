<?php

// pictxt
Route::get('/pictxt', array('uses' => 'UserPictxtController@getIndex'));
Route::get('/txt/{id}', array('uses' => 'UserPictxtController@getTxt'));
Route::get('/pic/{id}', array('uses' => 'UserPictxtController@getPic'));

// offline
Route::get('/off', array('uses' => 'UserOfflineController@getIndex'));

// admin
Route::get('/login', array('as'=>'login','uses' => 'AdminIndexController@getLogin'));
Route::post('/login', array('before' => 'csrf','uses' => 'AdminIndexController@postLogin'));
Route::get('/logout', array('uses' => 'AdminIndexController@getLogout'));

Route::When('admin','auth');
Route::When('admin/*','auth');
Route::get('/admin', array('uses' => 'AdminIndexController@getIndex'));

// admin - topcont
Route::get('/admin/top', array('uses' => 'AdminTopcontController@getIndex'));
Route::post('/admin/top', array('uses' => 'AdminTopcontController@postIndex'));

// admin - blog
Route::get('/admin/blog', array('uses' => 'AdminBlogController@getIndex'));
Route::get('/admin/blog/edit/', array('uses' => 'AdminBlogController@getEdit'));
Route::get('/admin/blog/edit/{id}', array('uses' => 'AdminBlogController@getEdit'));
Route::post('/admin/blog/edit/', array('uses' => 'AdminBlogController@postEdit'));
Route::post('/admin/blog/edit/{id}', array('uses' => 'AdminBlogController@postEdit'));
Route::get('/admin/blog/category/', array('uses' => 'AdminBlogController@getCategory'));
Route::post('/admin/blog/category/', array('uses' => 'AdminBlogController@postCategory'));
Route::get('/admin/blog/list', array('uses' => 'AdminBlogController@getList'));
Route::get('/admin/blog/draftlist', array('uses' => 'AdminBlogController@getDraftList'));

// admin - user
Route::get('/admin/user', array('uses' => 'AdminIndexController@getUser'));
Route::post('/admin/user', array('uses' => 'AdminIndexController@postUser'));

// admin - genre
Route::get('/admin/genre', array('uses' => 'AdminGenreController@getIndex','as'=>'genre'));
Route::post('/admin/genre', array('uses' => 'AdminGenreController@postIndex'));

// admin - group
Route::get('/admin/group', array('uses' => 'AdminGroupController@getIndex','as'=>'group'));
Route::post('/admin/group', array('uses' => 'AdminGroupController@postIndex'));

// admin - offline
Route::get('/admin/offline', array('uses' => 'AdminOffController@getIndex'));
Route::post('/admin/offline', array('uses' => 'AdminOffController@postIndex'));
Route::get('/admin/offline/edit/', array('uses' => 'AdminOffController@getEdit'));
Route::get('/admin/offline/edit/{id}', array('uses' => 'AdminOffController@getEdit'));
Route::post('/admin/offline/edit/', array('uses' => 'AdminOffController@postEdit'));
Route::post('/admin/offline/edit/{id}', array('uses' => 'AdminOffController@postEdit'));

// admin - text
Route::get('/admin/txt', array('uses' => 'AdminTxtController@getIndex'));
Route::get('/admin/txt/edit', array('uses' => 'AdminTxtController@getEdit'));
Route::get('/admin/txt/edit/{id}', array('uses' => 'AdminTxtController@getEdit'));
Route::post('/admin/txt/edit', array('uses' => 'AdminTxtController@postEdit'));
Route::post('/admin/txt/edit/{id}', array('uses' => 'AdminTxtController@postEdit'));

// admin - pic
Route::get('/admin/pic', array('uses' => 'AdminPicController@getIndex'));
Route::get('/admin/pic/edit', array('uses' => 'AdminPicController@getEdit'));
Route::get('/admin/pic/edit/{id}', array('uses' => 'AdminPicController@getEdit'));
Route::post('/admin/pic/edit', array('uses' => 'AdminPicController@postEdit'));
Route::post('/admin/pic/edit/{id}', array('uses' => 'AdminPicController@postEdit'));

Route::controller('/', 'UserIndexController');
