<?php namespace App;
use App\Perecdent,DB;

class UserWithdraw extends Perecdent
{
    public static function apply(User $user, UserBank $userBank, $money = 0)
    {
    	if (!$money) return false;
    	return DB::transaction(function() use ($user, $userBank, $money)
    	{
    		$sn = 'TX'.date('ymdHis').rand(1000,9999);
			$sn .= strtoupper(baseEncode($sn));
    		$userWithdraw = self::saveData([
	            'user_id'       => $user->id,
	            'username'      => $user->username,
	            'money'         => $money,
	            'user_bank_id'  => $userBank->id,
	            'bank_id'		=> $userBank->bank_id,
	            'sn'			=> $sn,
	            'status'        => 1
	        ]);

	        if (!$userWithdraw) {
	        	throw new Exception("申请失败", 1);
	        }

	        $cashFlow = CashFlow::userCashesOut($user, $userWithdraw, $money, '提现');
	        if (!$cashFlow) {
	        	throw new Exception('写入流水失败');
	        }

	        if (!$user->decreaseCash($money)) {
	        	throw new Exception('扣除余额失败');
	        }
	        return true;
    	});
    }

    public function setSuccess($user)
    {
    	$withdraw = $this;

    	return DB::transaction(function() use ($withdraw, $user) {
    		$withdraw->status = 3;
    		if (!$withdraw->save()) {
    			throw new Exception("状态错误", 1);
    		}	
    		return true;
    	});
    }

    public function setFailure($user)
    {
    	$withdraw = $this;

    	return DB::transaction(function() use ($withdraw, $user) {
    		
    		$cashflow = CashFlow::userCashesIn($user, $withdraw, $withdraw->money, '提现失败');
    		if (!$cashflow) {
    			throw new Exception("写入流水失败", 1);
    		}

	        if (!$user->addCash($withdraw->money)) {
	        	throw new Exception("增加余额失败", 1);
	        }
    		$withdraw->status = 4;
    		if (!$withdraw->save()) {
    			throw new Exception("状态错误", 1);
    			
    		}
    		return true;
    	});
    }

}
