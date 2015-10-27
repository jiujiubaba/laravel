<?php namespace App;
use App\Perecdent;

class CashFlow extends Perecdent
{
    const CASH_OUT = 1;
    const CASH_IN = 0;

    public static function userCashesOut($who, $relateObj, $money = 0, $type= 0, $info = ''){
        return self::saveData([
            'whoable_id'    => $who->id,
            'whoable_type'  => $who->modelName(),
            'before'        => $who->cashes,
            'after'         => $who->cashes - $money,
            'change'        => $money,
            'status'         => self::CASH_OUT,
            'type'          => $type,
            'info'          => $info,
            'cashable_id'   => $relateObj->id,
            'cashable_type' => $relateObj->modelName()
        ]);
    }


    public static function userCashesIn($who, $relateObj, $money = 0, $type = 0, $info = ''){
        return self::saveData([
            'whoable_id'    => $who->id,
            'whoable_type'  => $who->modelName(),
            'before'        => $who->cashes,
            'after'         => $who->cashes + $money,
            'change'        => $money,
            'status'        => self::CASH_IN,
            'type'          => $type,
            'info'          => $info,
            'cashable_id'   => $relateObj->id,
            'cashable_type' => $relateObj->modelName(),
        ]);
    }
}
