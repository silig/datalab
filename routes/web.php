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

// Route::get('/', function () {
//     //return redirect()->route('login');
//     return view('dashboard');
// });

Route::get('/', 'DashboardController@index');
Route::get('/files/{id}', 'DashboardController@files');

Auth::routes();

Route::get('/product/{slug}', 'Site\ProductController@index');


Route::group(['prefix' => config('adminlte.dashboard_url'), 'middleware' => 'auth'], function () {
	
	Route::get('/', 'Admin\DashboardController@index')->name('dashboard');

	Route::get('/profile', 'Auth\ProfileController@index');
	Route::any('/change-password', 'Auth\ProfileController@changePassword');

	Route::group(['prefix' => 'users'], function () {
		Route::get('/', 'Admin\UsersController@index')->middleware('can:view-users');
		Route::any('/create', 'Admin\UsersController@create')->middleware('can:create-users');
	    Route::any('/{id}/edit', 'Admin\UsersController@edit')->middleware('can:edit-users');
	    Route::get('/{id}/delete', 'Admin\UsersController@delete')->middleware('can:delete-users');
	});

	Route::group(['prefix' => 'roles'], function () {
		Route::get('/', 'Admin\RolesController@index')->middleware('can:view-roles');
		Route::any('/create', 'Admin\RolesController@create')->middleware('can:create-roles');
	    Route::any('/{id}/edit', 'Admin\RolesController@edit')->middleware('can:edit-roles');
	    Route::get('/{id}/delete', 'Admin\RolesController@delete')->middleware('can:delete-roles');
	});

	Route::group(['prefix' => 'permissions'], function () {
		Route::get('/', 'Admin\PermissionsController@index')->middleware('can:view-permissions');
		Route::any('/create', 'Admin\PermissionsController@create')->middleware('can:create-permissions');
	    Route::any('/{id}/edit', 'Admin\PermissionsController@edit')->middleware('can:edit-permissions');
	    Route::get('/{id}/delete', 'Admin\PermissionsController@delete')->middleware('can:delete-permissions');
	});

	Route::group(['prefix' => 'menus'], function () {
		Route::get('/', 'Admin\MenusController@index')->middleware('can:view-menus');
		Route::any('/create', 'Admin\MenusController@create')->middleware('can:create-menus');
	    Route::any('/{id}/edit', 'Admin\MenusController@edit')->middleware('can:edit-menus');
	    Route::get('/{id}/delete', 'Admin\MenusController@delete')->middleware('can:delete-menus');
	});

	Route::group(['prefix' => 'data'], function () {
		Route::get('/', 'Admin\DataController@index')->middleware('can:view-data');
		Route::post('/create', 'Admin\DataController@create')->middleware('can:create-data')->name('input_data');
	    Route::post('/{id}/edit', 'Admin\DataController@edit')->middleware('can:edit-data')->name('edit_data');
	    Route::get('/{id}/delete', 'Admin\DataController@delete')->middleware('can:delete-data');
	    Route::get('/{id}/files', 'Admin\DataController@files');
	    Route::post('/create/files', 'Admin\DataController@createFiles')->name('input_file');
	    Route::get('{folder}/files/{id}/delete', 'Admin\DataController@deleteFiles')->name('delete_file');
	});
});
