<?php

namespace App\Http\Controllers;
<<<<<<< HEAD
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth,Request;
=======

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Auth;
>>>>>>> b6d34d0029aa8401c62fb035a01880d0d1ae0ccd

class UserController extends Controller
{
    /**
<<<<<<< HEAD
     * 我的账户首页
     */
    public function index()
    {
        // Auth::logout();
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
=======
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
    }

    public function resetPassword()
    {
        $validator = Validator::make($data, [
            'old_passwd'    => 'required|max:255',            
            'passwd'      => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {

        }
>>>>>>> b6d34d0029aa8401c62fb035a01880d0d1ae0ccd
    }
}
