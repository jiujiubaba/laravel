<?php
namespace App\Http\Controllers;
use Request, Auth, Validator, Hash;
use App\Http\Controllers\Controller;
use App\Bank, App\UserBank, App\UserWithdraw;
use App\Traits\AbledTrait;

class BanksController extends Controller
{
    // 银行充提首页
    public function index()
    {
        // $data = [];
        // $user = Auth::user();
        // $data['username'] = $user->username;
        // $data['banks'] = UserBank::where('user_id', $user->id)->get();
        // $data['cash'] = $user->cash;
        // $data
        return view('banks.index');
    }

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
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
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

        $user = Auth::user();

        if (UserBank::who($user)->exists()) {
            $is_lock = 0;
        }else{
            $is_lock = 1;
        }

        $bank = UserBank::saveData([
            'bank_id'       => $input['bankid'],
            'whoable_type'  => $user->modelName(),
            'whoable_id'    => $user->id,
            'address'       => $input['address'],
            'name'          => $input['uname'],
            'bank_name'     => Bank::find($input['bankid'])->name,
            'account'       => $input['banknum'],
            'status'        => 1,
            'is_lock'       => $is_lock
        ]);
        if (!$bank) {
            return $this->failure('添加银行失败');
        }
        return $this->success('添加银行成功');
    }

    public function withdraw()
    {
        $data = [];
        $user = Auth::user();
        $data['username'] = $user->username;
        $data['userBank'] = UserBank::who($user)
                                ->where('is_lock', 1)
                                ->first();
        $data['cash'] = $user->cash;
        return view('banks.withdraw', $data);
    }

    public function applyWithdraw()
    {
        if (!Request::has('money', 'pay_pass')) {
            return $this->failure('参数错误');
        }
        $user = Auth::user();
        $userBank = UserBank::who($user)->where('is_lock', 1)->first();
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

    public function withdrawRecord()
    {
        return view('banks.withdraw_record');
    }

    public function recharge()
    {
        return view('banks.alipay');
    }

    public function rechargeRecord()
    {
        return view('banks.recharge_record');
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
