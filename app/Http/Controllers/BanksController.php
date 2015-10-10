<?php
namespace App\Http\Controllers;
use Request, Auth, Validator, Hash;
use App\Http\Controllers\Controller;
use App\Bank, App\UserBank, App\UserWithdraw, App\AdminBank;
use App\Traits\AbledTrait;

class BanksController extends Controller
{
    // 账户银行
    public function banks()
    {
        $user = Auth::user();
        $banks = Bank::where('status', 1)->select(['id', 'name'])->get();
        $data['banks'] = $banks;
        $data['userBanks'] = [];
        $userBanks = UserBank::where('user_id', $user->id)
                            ->where('status', 1)
                            ->get();
        // dd($userBanks);
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
    public function store(Request $request)
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

        if (!$bank) {
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
        // $userBank = [];

        $userBank = UserBank::where('user_id', $user->id)
                                ->where('is_lock', 1)
                                ->first();
        $data['userBank'] = $userBank;
        if (!$userBank) {
            $data['banks'] = Bank::where('withdraw_status', 1)
                        ->select(['name', 'alias'])
                        ->get();
        }
        
        $data['cash'] = $user->cash;
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
            return failure('您还没有设置资金密码！');
        }

        if (!Hash::check(Request::input('pay_pass'), $user->payment_password)) {
            return failure('资金密码错误');
        }

        return UserWithdraw::apply($user, $userBank, (float)Request::input('money'));
    }

    /**
     * 申请提现记录
     *  
     * @date   2015-10-07
     * @return [type]     [description]
     */
    public function withdrawRecord()
    {
        return view('banks.withdraw_record');
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
     * 充值页面
     *  
     * @date   2015-10-07
     * @return [type]     [description]
     */
    public function recharge()
    {
        return view('banks.alipay');
    }

    /**
     * 转账
     *  
     * @date   2015-10-08
     * @return [type]     [description]
     */
    public function confirm()
    {
        $money = (int)Request::input('money');
        if ($money > 50000 || $money < 100)
            return redirect('/banks')->with('message', 'Login Failed');

        $bank = Bank::where('banks.alias', Request::input('bank'))
                    ->leftJoin('admin_banks', 'banks.id', '=', 'admin_banks.bank_id')
                    ->first();

        if (!$bank) {
            return redirect('/banks')->with('message', 'Login Failed');
        }
        $data['adminBank'] = $bank;
        $data['money'] = $money;
        $data['rand'] = str_random(5);
        // dd($bank->toJson());
        return view('banks.confirm', $data);

    }

    /**
     * 充值记录
     *  
     * @date   2015-10-07
     * @return [type]     [description]
     */
    public function rechargeRecord()
    {
        return view('banks.recharge_record');
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
