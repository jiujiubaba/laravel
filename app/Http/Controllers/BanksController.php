<?php
namespace App\Http\Controllers;
use Request, Auth, Validator, Hash;
use App\Http\Controllers\Controller;
use App\Bank, App\UserBank, App\UserWithdraw;
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
        $userBanks = UserBank::who($user)
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
            return $this->failure('添加银行失败');
        }
        return $this->success('添加银行成功');
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

        $userBank = UserBank::userId($user->id)
                                ->where('is_lock', 1)
                                ->first();

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
            return $this->failure('参数错误');
        }
        $user = Auth::user();
        $userBank = UserBank::userId($user->id)->where('is_lock', 1)->first();
        if (!$userBank) {
            return $this->failure('您还没有锁定银行卡');
        }
        if ($user->payment_password == '') {
            return $this->failure('您还没有设置资金密码！');
        }

        if (!Hash::check(Request::input('pay_pass'), $user->payment_password)) {
            return $this->failure('资金密码错误');
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
        $banks = Bank::getRecharge();
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
        return $this->success('删除成功');
    }
}
