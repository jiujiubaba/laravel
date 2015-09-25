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

Route::group(['middleware' => 'auth'], function(){
	Route::get('/', 'IndexController@index');
	Route::get('/account', 'UserController@index');
	Route::get('/account/edit', 'UserController@edit');
	Route::get('/account/banks', 'BankController@index');
	Route::get('/recharge', 'UserBankController@index');
	Route::post('/banks/add', 'BankController@store');
	Route::post('/update-nickname', 'UserController@updateNickname');
});

Route::get('/tt', function(){
	return view('backend.index');
});

// 后台路由
Route::group(['prefix' => 'backend', 'namespace' => 'Backend'], function(){
	Route::get('index', 'IndexController@index');
	Route::get('articles', 'ArticlesController@index');
	Route::get('articles/store', 'ArticlesController@store');
});
Route::get('/login', 'AuthController@login');
Route::get('/getCode', 'AuthController@getCode');
Route::post('/loginTo','AuthController@loginTo');
Route::get('/r', 'AuthController@register');