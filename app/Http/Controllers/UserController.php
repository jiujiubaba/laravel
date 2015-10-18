<?php
namespace App\Http\Controllers;
use App\User;
use Request,Controller, Validator, Auth, App\Bank, Hash;

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
            'cash'      => $user->cashes,
            'type'      => $user->type,
            'qq'        => $user->qq,
            'fandian'   => $user->fandian 
        ];
        return view('users.index', $data);
    }

    public function refresh()
    {
        $user = Auth::user();
        return success('刷新成功',['cashes' => $user->cashes]);
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
    public function update()
    {
        if (!Request::has('action')) {
            return failure('非法操作');
        }
        $user = Auth::user();
        if (Request::input('action') == 'nickname') {
            $nickname = Request::input('nickname');
            if (!$nickname)
                return $this->failure('昵称不能为空');         
            $user->nickname = $nickname;
            $user->save();
            return success('修改成功');
        }

        if (Request::input('action') == 'passwd') {
            $old_pass = Request::input('old_pass');
            $new_pass = Request::input('new_pass');
            if (!Hash::check($old_pass, $user->password)){
                return failure('密码错误');
            }
            if (Hash::check($new_pass, $user->payment_password)) {
                return failure('登陆密码不能和支付密码一样');
            }
            $user->password = Hash::make($new_pass);
            if (!$user->save()) {
                return failure('密码修改失败');
            }
            return success('密码修改成功');
        }

        if (Request::input('action') == 'coinpasswd') {
            $old_bank = Request::input('old_bank');
            $new_bank = Request::input('new_bank');
            if (!$user->payment_password == '') {
                if (!Hash::check($old_bank, $user->payment_password)){
                    return failure('资金密码错误');
                }
            }
            
            if (Hash::check($new_bank, $user->password)) {
                return failure('支付密码不能和登陆密码一样');
            }      
            $user->payment_password = Hash::make($new_bank);
            if (!$user->save()) {
                return failure('支付密码修改失败');
            }
            return success('支付密码修改成功');
        }
        
    }

    /**
     *  我的消息首页
     *
     * @date   2015-10-11
     * @return [type]
     */
    public function messages()
    {
        return view('users.messages');
    }

    /**
     *  发送消息页面
     *
     * @date   2015-10-11
     * @return [type]
     */
    public function messagesAdd()
    {
        return view('users.messages_add');
    }

    /**
     *  已发送消息
     *
     * @date   2015-10-11
     * @return [type]
     */
    public function messagesSent()
    {
        return view('users.messages_sent');
    }
}
