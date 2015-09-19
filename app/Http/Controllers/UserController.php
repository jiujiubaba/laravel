<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Auth;


class UserController extends Controller
{
    /**
     * 我的账户首页
     */
    public function index()
    {
        
        return '';
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
        return $this->success('修改成功');
    }

    /**
     * 我的银行卡页面
     *  
     * @date   2015-09-19
     * @return [type]     [description]
     */
    public function banks()
    {
        return view('users.banks');
    }
}
