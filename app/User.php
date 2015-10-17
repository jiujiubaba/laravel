<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use App\Perecdent;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Perecdent implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * 扣除用户余额
     *
     * @date    2015-10-17
     * @version [version]
     * @param   integer    $money [description]
     * @return  [type]            [description]
     */
    public function decreaseCash($money = 0)
    {
        if (!$money) return false;
        $this->cash = $this->cash - $money;
        return $this->save();
    }

    /**
     * 获取管理员
     *
     * @date    2015-10-17
     * @version [version]
     * @return  [type]     [description]
     */
    public function admin()
    {
        if ($this->category == 1) {
            return Admin::where('user_id', $this->id)->first();
        }
        return null;
    }
}
