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
	// 我的账户相关路由
	Route::get('/account', 'UserController@index');
	Route::get('/account/edit', 'UserController@edit');
	Route::post('/account/update-nickname', 'UserController@updateNickname');
	Route::post('/account/update-password', 'UserController@updatePassword');
	Route::post('/account/update-payment', 'UserController@updatePayment');
	Route::get('/account/messages', 'UserController@messages');
	Route::get('/account/messages-add', 'UserController@messagesAdd');
	Route::get('/account/messages-sent', 'UserController@messagesSent');

	Route::get('/account/banks', 'BanksController@banks');

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
	Route::get('/agent/share', 'AgentController@share');
	Route::get('/agent/bonuses', 'AgentController@bonuses');

	// 团队管理
	Route::get('/team', 'TeamController@index');
	Route::get('/team/games-record', 'TeamController@gamesRecord');
	Route::get('/team/account-change', 'TeamController@accountChange');
	Route::get('/team/recharge-record', 'TeamController@rechargeRecord');
	Route::get('/team/withdraw-record', 'TeamController@withdrawRecord');

	// 积分商城
	Route::get('/integral', 'IntegralController@index');
});

Route::get('/login', 'AuthController@login');
Route::post('/loginTo','AuthController@loginTo');
Route::get('/getCode', 'AuthController@getCode');

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
	Route::get('/business/withdraw', 'BusinessController@withdraw');

	// 系统设置相关路由
	Route::get('/systems/banks', 'SystemController@banks');
	Route::get('/systems/notices', 'SystemController@notices');

	// 用户管理路由
	Route::get('/user/stroe', 'UserController@stroe');
	Route::get('/users', 'UsersController@index');
	Route::get('/users/banks', 'UserController@banks');

	// 管理员管理路由
	Route::get('/admins', 'AdminController@index');
});


/**
 * =================== 测试相关路由 =================
 */

Route::get('/tt', function(){
	return view('backend.index');
});

Route::get('/logout', function(){
	return Auth::logout();
});

Route::get('/test', function(){
	// $hash = md5('asdfasdf');
	// return base62Encode(111, $hash);
	$token = md5('123123');
	return  Session::setName(Config::get('session.admin_cookie'));
});
Route::get('/r', 'AuthController@register');

Route::get('/rr', function(){
	return ['m' => Hash::make('123456'), 'u' => Hash::make('123456')];
});
