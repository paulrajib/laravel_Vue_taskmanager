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

Route::get('/welcome', function () {
    return view('welcome');
});

/*
Route::get('/tasks', function () {
    return view('demos.testtasks');
});
*/
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/tasks', 'HomeController@index')->name('home');


Route::group(
	[
		'as'			=> 'admin',
		'prefix'		=> 'admin',
		'namespace'		=> 'Admin',
		'middleware'	=> ['auth', 'admin'],
	],

	function(){
		Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	}
);


Route::group(
	[
		'as'			=> 'author',
		'prefix'		=> 'author',
		'namespace'		=> 'Author',
		'middleware'	=> ['auth', 'author'],
	],

	function(){
		Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	}
);

/*
Route::get('/tasks','DemoController@showTasks');
Route::patch('/tasks/{id}', 'DemoController@updateTasksStatus');
Route::put('/tasks/updateAll', 'DemoController@updateTasksOrder');
*/

// Route::get('/test-tasks','DemoController@showTasks');

Route::get('/test-tasks', function () {
    return view('demos.test1');
});

Route::get('/all-tasks', function () {
    return view('demos.alltasks');
});

Route::get('/','TaskController@index')->name('home');

Route::get('/create','TaskController@create')->name('create');

Route::post('/create','TaskController@store')->name('store');

Route::get('/edit/{id}','TaskController@edit')->name('edit');

Route::post('/update/{id}','TaskController@update')->name('update');

Route::put('/updateAll','TaskController@updateAll')->name('updateAll');

Route::delete('/delete/{id}','TaskController@delete')->name('delete');



Route::get('form','FormController@create');
Route::post('form','FormController@store');


Route::get('image-view','ImageController@index');
Route::post('image-view','ImageController@store');

