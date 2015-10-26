<?php namespace App\Http\Controllers\Backend;

use Controller, DB,Request;
use App\UserWithdraw, App\User;

class UserWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $withdraws = DB::table('user_withdraws as w')
                    ->join('users as u', 'w.user_id', '=', 'u.id')
                    ->join('user_banks as b', 'w.user_bank_id', '=', 'b.id')
                    ->where('w.status', 1)
                    ->select('u.id as user_id', 'u.username', 'u.ancestry', 'w.money', 'b.bank_name', 'b.name', 'b.account', 'b.address', 'w.created_at', 'w.status', 'w.id')
                    ->orderBy('w.created_at', 'desc')
                    ->paginate();

        return view('backend.business.withdraw', ['withdraws' => $withdraws]);
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
    public function store()
    {
        if (!Request::has('_id', 'type')) {
            return failure('参数错误');
        }
        $type = Request::input('type', 1);
        $id = Request::input('_id');

        $withdraw = UserWithdraw::find($id);

        if (!$withdraw) {
            return failure('该条数据不存在');
        }

        $user = User::find($withdraw->user_id);

        if (!$user) {
            return failure('该用户不存在');
        }
        
        if ($type) {
            $r = $withdraw->setSuccess($user);
        } else {
            $r = $withdraw->setFailure($user);
        }
    
        if ($r) {
            return success('提现成功');
        }
        return failure('提现失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $withdraw = DB::table('user_withdraws as w')
                    ->join('banks as b', 'w.bank_id', '=', 'b.id')
                    ->join('user_banks as ub', 'w.user_bank_id', '=', 'ub.id')
                    ->where('w.id', $id)
                    ->select('w.money', 'b.home_page', 'ub.name', 'ub.account', 'ub.address', 'w.created_at', 'w.id','b.name as bank_name')
                    ->first();
        return success(['withdraw' => $withdraw]);
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

    public function record()
    {
        $withdraws = DB::table('user_withdraws as w')
                    ->join('users as u', 'w.user_id', '=', 'u.id')
                    ->join('user_banks as b', 'w.user_bank_id', '=', 'b.id')
                    ->select('u.id as user_id', 'u.username', 'u.ancestry', 'w.money', 'b.bank_name', 'b.name', 'b.account', 'b.address', 'w.created_at', 'w.status', 'w.id')
                    ->orderBy('w.created_at', 'desc')
                    ->paginate();

        return view('backend.business.withdraw_record', ['withdraws' => $withdraws]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
