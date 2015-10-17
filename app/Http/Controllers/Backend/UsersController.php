<?php namespace App\Http\Controllers\Backend;
use Controller, Auth, Request,DB, Hash;
use App\UserBank, App\User;

class UsersController extends Controller
{
    public function index()
    {
        $data['users'] = User::paginate(10);
        return view('backend.users.index', $data);
    }

    /**
     * 添加用户显示页面
     *
     * @date   2015-10-13
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function store(Request $request)
    {
        return view('backend.users.store');
    }

    public function insert()
    {
        $adminUser = Auth::user();
        $username = Request::input('username');
        if (User::where('username', $username)->exists()) {
            return failure('该用户存在');
        }
        $user = User::saveData([
            'username'  => Request::input('username'),
            'password'  => Hash::make(Request::input('password')),
            'nickname'  => Request::input('username'),
            'qq'        => Request::input('qq'),
            'type'      => Request::input('type'),
            'fandian'   => Request::input('fandian'),
            'parent_id' => $adminUser->id,
            'ancestry'  => $adminUser->username.'>'.Request::input('username'),
            'ancestry_depth' => $adminUser->ancestry_depth.','.$adminUser->id,
            'level'     => 1,
            'register_ip' => Request::getClientIp()
        ]);

        if (!$user) {
            return failure('添加会员失败');
        }

        return success('添加会员成功');
    }

    /**
     * 银行信息
     *
     * @date   2015-10-13
     * @return [type]     [description]
     */
    public function banks()
    {
        $data['userBanks'] = UserBank::join('users', 'users.id', '=', 'user_banks.user_id')
            ->join('banks', 'user_banks.bank_id', '=', 'banks.id')
            ->select('users.id', 'users.username', 'banks.name', 'user_banks.account', 'user_banks.address', 'user_banks.name as uname')
            ->paginate(10);
        // dd($data);
        return view('backend.users.banks', $data);
    }
}
