<?php namespace App\Http\Controllers\Backend;

use App\UserRecharge, App\User;
use Controller, Request, DB;


class UserRechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $recharges = DB::table('user_recharges as c')
                    ->join('banks as b', 'c.bank_id', '=', 'b.id')
                    ->join('users as u', 'c.user_id', '=', 'u.id')
                    ->select('u.id as user_id', 'u.username', 'u.ancestry','c.money','u.cashes', 'c.sn','b.name','c.status','c.remark','c.created_at', 'c.id')
                    ->orderBy('c.created_at', 'desc')
                    ->paginate(10);
        // return $recharges;
        return view('backend.business.recharge', ['recharges' => $recharges]);
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
        if (!Request::has('_id', 'arrival')) {
            return failure('参数错误');
        }
        $arrival = Request::input('arrival');
        $id = Request::input('_id');

        $recharge = UserRecharge::find($id);

        if (!$recharge) {
            return failure('该条数据不存在');
        }
        
        $r = $recharge->success($arrival);

        if ($r) {
            return success('充值成功');
        }
        return failure('充值失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $recharge = DB::table('user_recharges as c')
                    ->join('banks as b', 'c.bank_id', '=', 'b.id')
                    ->join('users as u', 'c.user_id', '=', 'u.id')
                    ->where('c.id', $id)
                    ->select('u.id as user_id', 'u.username', 'u.ancestry','c.money','u.cashes', 'c.sn','b.name','c.status','c.remark','c.created_at', 'c.id')
                    ->orderBy('c.created_at', 'desc')
                    ->first();
        if ($recharge) {
            return success(['recharge' => $recharge]);
        }

        return failure('失败');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $recharge = UserRecharge::find($id);

        if (!$recharge) {
            return failure('数据不存在');
        }

        if ($recharge->fail()) {
            return success('处理成功');
        }
        return failure('处理失败');
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
        //
    }
}
