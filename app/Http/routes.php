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
	Route::get('/account/banks', 'UserController@banks');
	Route::post('/update-nickname', 'UserController@updateNickname');
	Route::get('/a', 'IndexController@a');
	Route::get('/account', 'UserController@index');
});

Route::get('/bank', function(){
	 $json = '[{"id":1,"name":"\u4e2d\u56fd\u5de5\u5546\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank-gh.jpg","home":"http:\/\/www.icbc.com.cn","sort":5},{"id":2,"name":"\u652f\u4ed8\u5b9d","status":1,"logo":"upload\/bank-icons\/bank-zfb.jpg","home":"https:\/\/auth.alipay.com","sort":18},{"id":3,"name":"\u8d22\u4ed8\u901a","status":1,"logo":"upload\/bank-icons\/bank-cft.jpg","home":"http:\/\/www.tenpay.com\/","sort":19},{"id":4,"name":"\u4e2d\u56fd\u519c\u4e1a\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank-nh.jpg","home":"http:\/\/www.abchina.com","sort":6},{"id":5,"name":"\u4e2d\u56fd\u4ea4\u901a\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank-jt.jpg","home":"http:\/\/www.bankcomm.com","sort":7},{"id":6,"name":"\u4e2d\u56fd\u5efa\u8bbe\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank-jh.jpg","home":"http:\/\/www.ccb.com","sort":8},{"id":7,"name":"\u62db\u5546\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank-zh.jpg","home":"http:\/\/www.cmbchina.com\/","sort":14},{"id":8,"name":"\u4e2d\u56fd\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank_25.png","home":"http:\/\/www.boc.cn\/","sort":15},{"id":9,"name":"\u4e2d\u4fe1\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank_23.png","home":"http:\/\/bank.ecitic.com\/","sort":16},{"id":10,"name":"\u6d66\u53d1\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank_24.png","home":"http:\/\/www.bankcomm.com","sort":17},{"id":11,"name":"\u5e7f\u4e1c\u53d1\u5c55\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank_16.png","home":"http:\/\/www.cgbchina.com.cn","sort":13},{"id":12,"name":"\u94f6\u8054\u5728\u7ebf\u652f\u4ed8","status":1,"logo":"upload\/bank-icons\/logo_unionpay.gif","home":"","sort":0},{"id":15,"name":"\u4e2d\u56fd\u6c11\u751f\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/CMBC.png","home":"http:\/\/www.cmbc.com.cn","sort":9},{"id":16,"name":"\u6613\u5b9d\u652f\u4ed8","status":1,"logo":"upload\/bank-icons\/yb.jpg","home":"http:\/\/www.yeepay.com","sort":0},{"id":17,"name":"\u73af\u8fc5\u652f\u4ed8","status":1,"logo":"upload\/bank-icons\/hxzf.jpg","home":"http:\/\/www.ips.com.cn","sort":0},{"id":13,"name":"\u534e\u590f\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank_33.png","home":"http:\/\/www.hxb.com.cn\/","sort":0},{"id":14,"name":"\u4e2d\u56fd\u5e73\u5b89\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank_26.png","home":"http:\/\/www.bank.pingan.com","sort":12},{"id":18,"name":"\u82b1\u65d7\u652f\u4ed8","status":1,"logo":"upload\/bank-icons\/huaqi.png","home":"http:\/\/www.010sms.com\/","sort":0},{"id":19,"name":"\u5feb\u6c47\u5b9d","status":1,"logo":"upload\/bank-icons\/bank-khb.jpg","home":"http:\/\/www.dinpay.com","sort":0},{"id":20,"name":"\u5b9d\u4ed8\u652f\u4ed8","status":1,"logo":"upload\/bank-icons\/baofoo.jpg","home":"http:\/\/www.baofoo.com\/","sort":0},{"id":21,"name":"\u4e2d\u56fd\u5149\u5927\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank-gd.jpg","home":"http:\/\/www.cebbank.com","sort":10},{"id":22,"name":"\u4e2d\u56fd\u90ae\u653f\u94f6\u884c","status":1,"logo":"upload\/bank-icons\/bank_yz.png","home":"http:\/\/www.psbc.com","sort":11},{"id":23,"name":"\u6d3b\u52a8","status":1,"logo":"upload\/bank-icons\/bank_hd.png","home":"","sort":0}]';
	
	$j = json_decode($json);

	// foreach ($ as $key => $value) {
	// 	Bank::saveData([

	// 	]);
	// }
	$j = Bank::test();
	return $j;
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