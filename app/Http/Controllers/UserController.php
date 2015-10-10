<?php
namespace App\Http\Controllers;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request, Validator, Auth, App\Bank, Hash;


class UserController extends Controller
{
    /**
     * 我的账户首页
     */
    public function index()
    {
        $user = Auth::user();
        $data = [
            'username'  => $user->username,
            'nickname'  => $user->nickname,
            'level'     => $user->level,
            'scores'    => $user->scores,
            'cash'      => $user->cash,
            'type'      => $user->type,
            'qq'        => $user->qq,
            'fandian'   => $user->fandian 
        ];
        return view('users.index', $data);
    }

    /**
    * 修改资料页面
    *  
    * @date   2015-09-19
    * @return [type]     [description]
    */
    public function edit()
    {
        return view('users.edit');
    }

    /**
     * 修改昵称
     *  
     * @date   2015-09-19
     * @return [type]     [description]
     */
    public function updateNickname()
    {
        $nickname = Request::input('nickname');
        if (!$nickname)
            return $this->failure('昵称不能为空');
        $user = Auth::user();
        $user->nickname = $nickname;
        $user->save();
        return success('修改成功');
    }

    /**
     * 修改密码
     *  
     * @date   2015-09-19
     * @return [type]     [description]
     */
    public function updatePassword()
    {
        $old_pass = Request::input('old_pass');
        $user = Auth::user();
        if ($user->password != Hash::make($old_pass)) {
            return failure('密码错误');
        }
        
        $user->old_password = $user->password;
        $user->password = Hash::make(Request::input('new_pass'));
        if (!$user->save()) {
            return failure('密码修改失败');
        }
        return success('密码修改成功');
    }

    public function updatePayment()
    {
        
    }
}
