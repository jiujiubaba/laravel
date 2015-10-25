<?php namespace App;
use App\Perecdent, Request;

class UserRecharge extends Perecdent
{
    public static function add($user, $money, $bank)
    {
    	if (!$user) return false;
    	
		$sn = 'CZ'.date('ymdHis').rand(1000,9999);
		$sn .= strtoupper(baseEncode($sn));
	    return self::saveData([
    		'user_id'		=> $user->id,
    		'username'		=> $user->username,
    		'money'			=> $money,
    		'sn'	=> $sn,
    		'before'		=> $user->cashes,
    		'bank_id'		=> $bank->id,
    		'action_ip'		=> ip2long(Request::getClientIp()),
    		'remark'		=> baseEncode($user->id.$sn),
    		'status'		=> 0
		]);
    }

    public function success()
    {
    	$userRecharge = $this;
    	return DB::transaction(function() use($userRecharge)
		{
			$user = User::find($userRecharge->user_id);
			if (!$user) {
				throw new Exception("用户不存在", 1000);
			}

			$userRecharge->status = 1;
			if (!$userRecharge->save()) {
				throw new Exception("确认失败", 1002);
				
			}
		    $cashFlow = CashFlow::add($user, $userRecharge, $userRecharge->money, $type = 1);
		    if (!$cashFlow) {
		    	throw new Exception("写入流水失败", 1001);
		    }
		    return true;
		});
    }
}
