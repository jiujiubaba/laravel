<?php
const BASE = '8X1ntRHhJrIOQumxLKfCl7WY2ZgsMiFSBwkvU6G95aejcTNPDpAyd34EzV0bqo';
const HEX = 62;
const PREFIX = '/s/';


/**
 * 成功时返回
 *
 * @date   2015-10-08
 * @return [type]     [description]
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
 * 失败时抛异常
 *
 * @date   2015-10-08
 * @param  [type]     $message [description]
 * @param  integer    $code    [description]
 * @return [type]              [description]
 */
function failure($message, $code = 1){
    if(is_null($code)){
        throw new ResultException($message);
    }
    throw new ResultException($message, $code);
}

/**
 * base62 加密
 *
 * @date   2015-10-08
 * @param  [type]     $num  [description]
 * @param  [type]     $hash [description]
 * @return [type]           [description]
 */
function base62Encode($num, $hash) {
	$r = $num % HEX;
	$base = BASE;
	$res = $base{$r};
	$q = floor($num / HEX);
	while ($q) {
		$r = $q % HEX;
		$q = floor($q / HEX);
		$res = $base{$r} . $res;
	}
	// dd(substr($hash,0,4));
	return $res
}

/**
 * base62 解密
 *
 * @author wu.xu
 * @date   2015-10-08
 * @param  [type]     $num [description]
 * @return [type]          [description]
 */
function decode($num) {
	$num = substr($num,0,strlen($num)-4);
	$limit = strlen($num);
	$res = strpos(BASE, $num{0});
	for ($i = 1; $i < $limit; $i++) {
		$res = HEX * $res + strpos(BASE, $num{$i});
	}
	return $res;
}