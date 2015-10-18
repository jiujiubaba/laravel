<?php

namespace App;

use App\Perecdent,DB;

class UserWithdraw extends Perecdent
{
    public static function apply(User $user, UserBank $userBank, $money = 0)
    {
    	if (!$money) return false;
    	return DB::transaction(function() use ($user, $userBank, $money)
    	{
    		$userWithdraw = self::saveData([
	            'user_id'       => $user->id,
	            'username'      => $user->username,
	            'money'         => $money,
	            'user_bank_id'  => $userBank->id,
	            'status'        => 1
	        ]);

	        if (!$userWithdraw) {
	        	throw new Exception("申请失败", 1);
	        }

	        $cashFlow = CashFlow::add($user, $userWithdraw, $money);
	        if (!$cashFlow) {
	        	throw new Exception('写入流水失败');
	        }

	        if (!$user->decreaseCash($money)) {
	        	throw new Exception('扣除余额失败');
	        }
	        return true;
    	});
    	
    }
}
