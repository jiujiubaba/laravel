<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perecdent extends Model
{
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
}
