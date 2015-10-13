<?php namespace App\Http\Controllers\Backend;
use Controller, Auth;
use Request;

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
        return view('backend.users.banks');
    }
}
