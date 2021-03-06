<?php
namespace App\Http\Controllers;
use Request, Auth, Validator, Hash, DB ,Controller;
use App\Bank, App\UserBank, App\UserWithdraw, App\AdminBank, App\UserRecharge;
use App\Traits\AbledTrait;

class BanksController extends Controller
{
    // 账户银行
    public function banks()
    {
        $user = Auth::user();
        $banks = Bank::where('status', 1)->select(['name', 'alias'])->get();
        $data['banks'] = $banks;
        $data['userBanks'] = [];
        $userBanks = UserBank::where('user_id', $user->id)
                            ->where('status', 1)
                            ->get();
        $i = 0;
        foreach ($userBanks as $userBank) {
            $data['userBanks'][] = [
                'num'           => ++$i,
                'id'            => $userBank->id,
                'bank_name'     => $userBank->bank_name,
                'account'       => $userBank->account,
                'created_at'    => $userBank->created_at->toDateTimeString(),
                'status'        => $userBank->status,
                'is_lock'       => $userBank->is_lock
            ];
        }
        // return $data['userBanks'];
        return view('users.banks', $data);
    }

    /**
     * 添加银行卡
     *  
     * @date   2015-10-07
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function store()
    {
        $input = Request::all();
        // $validator =  Validator::make($input, [
        //     'bankid'    => 'required|integer|max:255',
        //     'address'  => 'required|max:255',
        //     'uname'     => 'required|max:255',
        //     'banknum'   => 'required|integer'
        // ]);

        // if ($validator->fails())
        // {
        //     return $messages = $validator->messages();
        // }
        // 

        $bank = Bank::where('alias', $input['bankname'])->first();
        if (!$bank) {
            return $this->failure('不存在该银行');
        }

        $user = Auth::user();

        $userBank = UserBank::add($user, $bank, $input['address'], $input['uname'], $input['banknum']);

        // return $userBank;
        if (!$userBank) {
            return failure('添加银行失败');
        }
        return success('添加银行成功');
    }

    /**
     * 申请提现页面
     *  
     * @date   2015-10-07
     * @return [type]     [description]
     */
    public function withdraw()
    {
        $data = [];
        $user = Auth::user();
        $data['username'] = $user->username;

        $userBank = UserBank::where('user_id', $user->id)
                                ->where('is_lock', 1)
                                ->first();
        $data['userBank'] = $userBank;
        if (!$userBank) {
            $data['banks'] = Bank::where('withdraw_status', 1)
                        ->select(['name', 'alias'])
                        ->get();
        }
        
        $data['is_payment'] = $user->payment_password == '' ? true : false;
        $data['cashes'] = $user->cashes;
        return view('banks.withdraw', $data);
    }

    /**
     * 申请提现
     *  
     * @date   2015-10-07
     * @return [type]     [description]
     */
    public function applyWithdraw()
    {
        if (!Request::has('money', 'pay_pass')) {
            return failure('参数错误');
        }
        $user = Auth::user();
        $userBank = UserBank::userId($user->id)->where('is_lock', 1)->first();
        if (!$userBank) {
            return failure('您还没有锁定银行卡');
        }
        if ($user->payment_password == '') {
            return failure('您还没有设置资金密码！', 1001);
        }

        if (!Hash::check(Request::input('pay_pass'), $user->payment_password)) {
            return failure('资金密码错误');
        }

        $money = Request::input('money');

        if (UserWithdraw::apply($user, $userBank, (float)$money)) {
            return success('申请成功');
        }

        return failure('申请失败，请联系客服');
    }

    /**
     * 申请提现记录
     *  
     * @date   2015-10-07
     * @return [type]     [description]
     */
    public function withdrawRecord()
    {
        $user = Auth::user();
        // return $user->id;
        $data['withdraws'] =  DB::table('user_withdraws as w')
                    ->select(['w.money', 'w.sn', 'w.status','w.created_at','b.name','b.account','b.bank_name'])
                    ->where('w.user_id', '=', $user->id)
                    ->join('user_banks as b','w.user_bank_id', '=', 'b.id')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10); 
        return view('banks.withdraw_record', $data);
    }

    /**
     * 充值首页
     *  
     * @date   2015-10-07
     * @return [type]     [description]
     */
    public function index()
    {
        $data = [];
        $user = Auth::user();
        $banks = AdminBank::where('admin_banks.status', 1)
                    ->leftJoin('banks', 'admin_banks.bank_id', '=', 'banks.id')
                    ->orderBy('banks.sort', 'desc')
                    ->get();
        $data = ['banks' => $banks]; 
        
        return view('banks.index', $data);
    }

    /**
     * 转账
     *  
     * @date   2015-10-08
     * @return [type]     [description]
     */
    public function confirm()
    {
        $money = Request::input('money');
        $alias = Request::input('bank');
        $user = Auth::user();
        if ($money > 50000 || $money < 100)
            return redirect('/banks');

        $bank =  DB::table('banks as b')
                    ->select(['b.id', 'b.alias', 'b.home_page' ,'a.name','a.account','a.address','a.account'])
                    ->join('admin_banks as a','b.id', '=', 'a.bank_id')
                    ->first(); 
        
        if (!$bank) {
            return redirect('/banks');
        }

        $userRecharge = UserRecharge::add($user, $money, $bank);
        $bank->remark = $userRecharge->remark;
        $bank->money  = $money;

        return view('banks.confirm', ['bank' => $bank]);

    }

    /**
     * 充值记录
     *  
     * @date   2015-10-07
     * @return [type]     [description]
     */
    public function rechargeRecord()
    {
        $user = Auth::user();
        $data['recharges'] = DB::table('user_recharges as c')
                        ->select('b.name','c.money', 'c.created_at', 'c.remark', 'c.status', 'c.sn')
                        ->join('banks as b', 'c.bank_id', '=', 'b.id')
                        ->where('c.user_id', $user->id)
                        ->paginate(10);
        return view('banks.recharge_record', $data);
    }

    public function alipay()
    {
        return view('banks.alipay');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        $id = Request::input('num');
        $r = UserBank::where('id', $id)->delete();
        return success('删除成功');
    }
}
