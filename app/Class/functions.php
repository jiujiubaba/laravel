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
    return [
		'result' => false,
		'message' => $message,
		'error_code' => $code
	];

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
	return $res;
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


function baseEncode($string){
	$charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	$key = "alexis";
	$hash = md5($key . $string);
	$len = strlen($hash);
	$short_url_list = '';

	#将加密后的串分成4段，每段4字节，对每段进行计算，一共可以生成四组短连接
	for ($i = 0; $i < 4; $i++) {
	    $urlhash_piece = substr($hash, $i * $len / 4, $len / 4);
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
}
