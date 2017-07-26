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
	Route::group(['prefix'=>'menu','as'=>'menu.'], function () {
       Route::get('admin-menu-index','Admin\MenuController@adminMewnuIndex')->name('admin-menu-index');
        Route::post('add-admin-menu','Admin\MenuController@addAdminMenu')->name('add-admin-menu');
        Route::post('del-admin-menu','Admin\MenuController@delAdminMenu')->name('del-admin-menu');
    });
});