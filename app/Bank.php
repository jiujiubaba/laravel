<?php

namespace App;

use App\Perecdent;

class Bank extends Perecdent
{
    public static function test()
    {
    	return 'test';
    }

    public static function getRecharge()
    {
    	return self::where('recharge_status', 1)
    				->where('status', 1)
    				->orderBy('sort', 'desc')
    				->get();
    }
}
