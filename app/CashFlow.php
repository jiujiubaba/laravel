<?php namespace App;
use App\Perecdent;

class CashFlow extends Perecdent
{
    public static function add($who, Perecdent $obj, $money = 0, $type = 0, $remark=  '')
    {
    	return self::saveData([
    		'whoable_type'  => $who->modelName(),
    		'whoable_id'	=> $who->id,
    		'before'		=> $who->cashes,
    		'after'			=> $who->cashes - $money,
    		'change'		=> $money,
            'type'          => $type,
    		'cashable_type'	=> $obj->modelName(),
    		'cashable_id'	=> $obj->id
    	]);
    }
}
