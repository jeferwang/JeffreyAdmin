<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'auth'], function () {
	Route::group(['prefix'=>'index','as'=>'index.'], function () {
		Route::get('index','Admin\IndexController@index')->name('index');
	});
});