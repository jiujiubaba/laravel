<?php namespace App\Http\Controllers\Backend;
use Controller, Auth, Request,DB;
use App\UserBank;

class UsersController extends Controller
{
    public function index()
    {
        $data = [];
        return view('backend.users.index', $data);
    }

    /**
     * 添加用户
     *
     * @date   2015-10-13
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function store(Request $request)
    {
        return view('backend.users.store');
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
