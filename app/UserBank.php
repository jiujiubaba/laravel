<?php
namespace App;

use App\Perecdent;
class UserBank extends Perecdent
{
    public static function who(Perecdent $obj)
    {
    	return self::where('whoable_type', $obj->modelName())->where('whoable_id', $obj->id);
    }

    public function add()
    {
    	
    }
}
