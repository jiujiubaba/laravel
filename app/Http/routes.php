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
Route::get('/logout', 'AuthController@logout');
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
	 $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	 $key = "alexis";
	 $url = "11";
	 $short_url_list = '';
            $urlhash = md5($key . $url);
            $len = strlen($urlhash);

            #将加密后的串分成4段，每段4字节，对每段进行计算，一共可以生成四组短连接
            for ($i = 0; $i < 4; $i++) {
                $urlhash_piece = substr($urlhash, $i * $len / 4, $len / 4);
                #将分段的位与0x3fffffff做位与，0x3fffffff表示二进制数的30个1，即30位以后的加密串都归零
                $hex = hexdec($urlhash_piece) & 0x3fffffff; #此处需要用到hexdec()将16进制字符串转为10进制数值型，否则运算会不正常

                $short_url = "";
                #生成6位短连接
                for ($j = 0; $j < 6; $j++) {
                    #将得到的值与0x0000003d,3d为61，即charset的坐标最大值
                    $short_url .= $charset[$hex & 0x0000003d];
                    #循环完以后将hex右移5位
                    $hex = $hex >> 5;
                }

                $short_url_list .= $short_url;
            }

            return substr($short_url_list,0,6);
});


Route::get('/tt', function(){
	return view('test.index');
});


Route::get('/logout', function(){
	return Auth::logout();
});

Route::get('/r', 'AuthController@register');

Route::get('/rr', function(){
	return ['m' => Hash::make('123456'), 'u' => Hash::make('123456')];
});
