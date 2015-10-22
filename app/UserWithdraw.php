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

    public static function getTeam($user)
    {
    	
    	// self::leftjoin('user_banks','user_withdraws.user_bank_id', '=', 'user_banks.id')
     //                        ->where('user_withdraws.user_id', $user->id)
     //                        ->whereRaw("find_in_set())
     //                        ->select([
     //                            'user_withdraws.money',
     //                            'user_withdraws.status',
     //                            'user_withdraws.created_at',
     //                            'user_banks.name',
     //                            'user_banks.account',
     //                            'user_banks.bank_name'
     //                        ])
     //                        ->orderBy('created_at', 'desc')
     //                        ->paginate(10);
    }
}
