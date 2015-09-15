<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::any('/index','IndexController@index' );

Route::group(['prefix' => 'backend', 'namespace' => 'Backend'], function(){
	Route::get('index', 'IndexController@index');
	Route::get('articles', 'ArticlesController@index');
	Route::get('articles/store', 'ArticlesController@store');
});