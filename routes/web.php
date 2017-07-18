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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'auth'], function () {
	Route::group(['prefix'=>'index','as'=>'index'], function () {
		Route::get('index','Admin\IndexController@index')->name('index');
	});
});