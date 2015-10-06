<?php
namespace App;
use App\Perecdent;

class CashFlow extends Perecdent
{
    public static function add($who, Perecdent $obj, $money = 0)
    {
    	return self::saveData([
    		'whoable_type'  => $who->modelName(),
    		'whoable_id'	=> $who->id,
    		'before'		=> $who->cash,
    		'after'			=> $who->cash - $money,
    		'change'		=> $money,
    		'cashable_type'	=> $obj->modelName(),
    		'cashable_id'	=> $obj->id
    	]);
    }
}
