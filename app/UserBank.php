<?php
namespace App;

use App\Perecdent;
class UserBank extends Perecdent
{
    public static function scopeUserId($user_id)
    {
    	return self::where('user_id', $user_id);
    }

    public function add(User $user, Bank $bank, $address, $name, $account)
    {
    	if (UserBank::userId($user->id)->exists()) {
            $is_lock = 0;
        }else{
            $is_lock = 1;
        }

        return UserBank::saveData([
            'bank_id'       => $bank->id,
            'user_id'       => $user->id,
            'address'       => $address,
            'name'          => $name,
            'bank_name'     => $bank->name,
            'account'       => $account,
            'status'        => 1,
            'is_lock'       => $is_lock
        ]);
    }
}
