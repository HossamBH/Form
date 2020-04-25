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
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Web'], function(){
	Route::resource('create/content', 'CreateContentController');

});

Auth::routes();
Route::group(['middleware' => ['auth']], function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
	Route::resource('content', 'ContentController');
	Route::post('/delete/{id}', 'ContentController@remove')->name('content.remove');
});


Route::group(['prefix' => 'ajax'], function(){
	Route::get('create', 'AjaxController@create');
	Route::post('store', 'AjaxController@store')->name('ajax.store');
	
});