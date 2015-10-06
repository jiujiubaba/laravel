<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perecdent extends Model
{
	/**
	 * 保存数据
	 *  
	 * @date   2015-09-19
	 * @param  [type]     $attributes [description]
	 * @return [type]                 [description]
	 */
    public static function saveData($attributes)
    {
    	if (!is_array($attributes)) return false;

    	$obj = new static;
		foreach ($attributes as $key => $value) {
			$obj->$key = $value;
		}
		$obj->save();
		return static::find($obj->id);
    }

    /**
     * 获取模型名称
     *  
     * @date   2015-09-19
     * @return [type]     [description]
     */
    public function modelName()
    {
		return get_class($this);
    }

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
