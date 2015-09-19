<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    /**
	 * 成功时返回数据
	 */
	function success(){
	    $res = ['result' => true];
	    $data = [];
	    foreach(func_get_args() as $key => $value){
	        if(is_string($value)){
	            $res['message'] = $value;
	        }
	        else if(is_array($value) || is_object($value)){
	            $data = $value;
	        }
	    }
	    return array_merge($res, $data);
	}

	/**
	 * 失败时抛出异常
	 * @param  [type]  $message [description]
	 * @param  integer $code    [description]
	 * @return [type]           [description]
	 */
	function failure(){
	    $res = ['result' => false];
	    $data = [];
	    foreach(func_get_args() as $key => $value){
	        if(is_string($value)){
	            $res['message'] = $value;
	        }
	        else if(is_array($value) || is_object($value)){
	            $data = $value;
	        }
	    }
	    return array_merge($res, $data);
	}
}

