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
}
