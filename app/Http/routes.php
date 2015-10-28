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

// 前台用户相关
Route::group(['middleware' => 'auth'], function(){
	// 首页
	Route::get('/', 'IndexController@index');
	Route::get('/index', function(){return view('index');});	
	// 我的账户相关路由
	Route::post('/account/refresh', 'UserController@refresh');
	Route::get('/account', 'UserController@index');
	Route::get('/account/edit', 'UserController@edit');
	Route::post('/account/update', 'UserController@update');

	Route::get('/account/messages', 'UserController@messages');
	Route::get('/account/messages-add', 'UserController@messagesAdd');
	Route::get('/account/messages-sent', 'UserController@messagesSent');
	Route::get('/account/banks', 'BanksController@banks');

	// 游戏路由

	// 游戏记录相关路由
	Route::get('/games-record/bond', 'GamesRecordController@bond');

	// 银行相关路由
	Route::get('/banks', 'BanksController@index');
	Route::post('/banks/add', 'BanksController@store');
	Route::post('/banks/delete', 'BanksController@destroy');
	Route::get('/banks/withdraw', 'BanksController@withdraw');
	Route::post('/banks/apply-withdraw', 'BanksController@applyWithdraw');
	Route::get('/banks/withdraw-record', 'BanksController@withdrawRecord');
	Route::get('/banks/recharge', 'BanksController@recharge');
	Route::post('/banks/comfirm', 'BanksController@confirm');
	Route::get('/banks/recharge-record', 'BanksController@rechargeRecord');
	Route::get('/banks/alipay', 'BanksController@alipay');

	// 代理管理路由
	Route::get('/agent', 'AgentController@index');
	Route::get('/agent/register', 'AgentController@register');
	Route::post('/agent/store', 'AgentController@store');
	// Route::get('/agent/share', 'AgentController@share');
	Route::get('/agent/bonuses', 'AgentController@bonuses');
	Route::resource('/agent/link', 'LinkController');

	// 团队管理
	Route::get('/team', 'TeamController@index');
	Route::get('/team/games-record', 'TeamController@gamesRecord');
	Route::get('/team/account-change', 'TeamController@accountChange');
	Route::get('/team/recharge-record', 'TeamController@rechargeRecord');
	Route::get('/team/withdraw-record', 'TeamController@withdrawRecord');

	// 积分商城
	Route::get('/integral', 'IntegralController@index');

});
Route::get('/logout', 'AuthController@logout');
Route::get('/login', 'AuthController@login');
Route::post('/loginTo','AuthController@loginTo');
Route::get('/getCode', 'AuthController@getCode');
Route::get('/r', 'AuthController@register');

/*
	================  后台相关路由  ===============
 */
Route::get('/backend/login', 'Backend\AuthController@login');
Route::post('/backend/check', 'Backend\AuthController@checkLogin');

// 后台路由
Route::group(['prefix' => 'backend', 'namespace' => 'Backend','middleware' => 'admin_auth'], function(){
	Route::get('/', 'IndexController@index');
	// 业务流水
	Route::get('/business/recharge', 'BusinessController@recharge');
	Route::resource('/business/recharge', 'UserRechargeController');
	Route::get('/business/withdraw-record', 'UserWithdrawController@record');
	Route::resource('/business/withdraw', 'UserWithdrawController');
	// Route::get('/business/withdraw', 'BusinessController@withdraw');

	// 系统设置相关路由
	Route::get('/systems/banks', 'BanksController@banks');
	Route::post('/systems/bank-store', 'BanksController@store');
	Route::post('/systems/bank-update', 'BanksController@update');
	Route::post('/systems/notices-update', 'NoticesController@update');
	Route::resource('/systems/notices', 'NoticesController');

	// 用户管理路由
	Route::get('/users/stroe', 'UsersController@store');
	Route::post('/users/user-insert', 'UsersController@insert');
	Route::get('/users', 'UsersController@index');
	Route::get('/users/banks', 'UsersController@banks');

	// 管理员管理路由
	Route::get('/admins', 'AdminController@index');
});


/**
 * =================== 测试相关路由 =================
 */

Route::get('/test', function(){
	return view('test.test');
});

Route::get('/base', function(){
	
});


Route::get('/rrr', 'AuthController@rrr');

Route::get('/tt', function(){
	return view('test.index');
});


Route::get('/logout', function(){
	return Auth::logout();
});


Route::get('/ttt', function(){
	return view('test.test1');
});

Route::get('/tttt', function(){
	// // throw new Exception("Error Processing Request", 1);
	// s
	// return failure('错误1');
	// {
	return view('test.test2');
});

// Route::get('/rrr', 'AuthController@register');

