<?php

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
	// IndexController
	Route::group(['prefix' => 'index', 'as' => 'index.'], function () {
		Route::get('index', 'Admin\IndexController@index')->name('index');
	});
	// UserController
	Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
		Route::match(['get', 'post'], 'user-list', 'Admin\UserController@userList')->name('user-list');
		Route::post('add-user', 'Admin\UserController@addUser')->name('add-user');
		Route::match(['get', 'post'], 'edit-user/{uid}', 'Admin\UserController@editUser')->name('edit-user');
		Route::post('del-user', 'Admin\UserController@delUser')->name('del-user');
	});
	// RoleController
	Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
		Route::match(['get', 'post'], 'role-list', 'Admin\RoleController@roleList')->name('role-list');
		Route::post('del-role', 'Admin\RoleController@delRole')->name('del-role');
		Route::match(['get', 'post'], 'edit-role/{rid}', 'Admin\RoleController@editRole')->name('edit-role');
	});
	// PermissionController
	Route::group(['prefix' => 'permission', 'as' => 'permission.'], function () {
		Route::match(['get', 'post'], 'permission-list', 'Admin\PermissionController@permissionList')->name('permission-list');
		Route::post('del-permission', 'Admin\PermissionController@delPermission')->name('del-permission');
		Route::match(['get', 'post'], 'edit-permission/{pmid}', 'Admin\PermissionController@editPermission')->name('edit-permission');
		
	});
	// MenuController
	Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {
		Route::get('admin-menu-index', 'Admin\MenuController@adminMenuIndex')->name('admin-menu-index');
		Route::post('add-admin-menu', 'Admin\MenuController@addAdminMenu')->name('add-admin-menu');
		Route::post('del-admin-menu', 'Admin\MenuController@delAdminMenu')->name('del-admin-menu');
		Route::match(['get', 'post'], 'alter-admin-menu/{mid}', 'Admin\MenuController@alterAdminMenu')->name('alter-admin-menu');
	});
});