<?php namespace App\Http\Controllers;

use Request, Controller, Auth, Hash;
use App\User;

class AgentController extends Controller
{
    /**
     * 代理管理首页
     *  
     * @date   2015-10-09
     * @return [type]     [description]
     */
    public function index()
    {
        $user = Auth::user();
        $data['agents'] = User::whereRaw('find_in_set(?, ancestry_depth)', [$user->ancestry_depth])->paginate(10);
        $data['user'] = $user;

        return view('agent.index', $data);
    }

    public function store()
    {
        $user = Auth::user();
        if (!Request::has('username', 'pass', 'fandian', 'type')) {
            return failure('参数错误');
        }
        $username = Request::input('username');
        if (User::where('username', $username)->exists()) {
            return failure('该用户已存在，请换一个');
        }

        $u = User::saveData([
            'username'  => Request::input('username'),
            'password'  => Hash::make(Request::input('pass')),
            'nickname'  => Request::input('username'),
            'qq'        => Request::input('qq'),
            'type'      => Request::input('type'),
            'fandian'   => (float)Request::input('fandian'),
            'parent_id' => $user->id,
            'ancestry'  => $user->username.'>'.Request::input('username'),
            'ancestry_depth' => $user->ancestry_depth.','.$user->id,
            'level'     => 1,
            'register_ip' => ip2long(Request::getClientIp())
        ]);

        if (!$u) {
            return failure('添加会员失败');
        }

        return success('添加会员成功');
    }
    
    public function register()
    {
        return view('agent.register');
    }

    public function share()
    {
        return view('agent.share');
    }

    public function bonuses()
    {

    }
}
