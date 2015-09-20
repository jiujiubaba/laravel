<?php
namespace App\Http\Controllers;

use Request, Auth, Validator;
use App\Http\Controllers\Controller;
use App\Bank, App\UserBank;
use App\Traits\AbledTrait;

class BankController extends Controller
{
    
    /**
     * 我的银行卡页面
     *  
     * @date   2015-09-19
     * @return [type]     [description]
     */
    public function index()
    {
        $user = Auth::user();
        $banks = Bank::where('status', 1)->select(['id', 'name'])->get();
        $data['banks'] = $banks;
        $userBanks = UserBank::where('whoable_type', $user->modelName())
                            ->where('whoable_id', $user->id)
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
                'is_default'    => $userBank->is_default
            ];
        }
        // return $data['userBanks'];
        return view('users.banks', $data);
    }

    /**
     * 添加银行页面
     *  
     * @date   2015-09-20
     * @return [type]     [description]
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

        $user = Auth::user();
        $modelName = $user->modelName();

        $bank = UserBank::saveData([
            'bank_id'       => $input['bankid'],
            'whoable_type'  => $user->modelName(),
            'whoable_id'    => $user->id,
            'address'       => $input['address'],
            'name'          => $input['uname'],
            'bank_name'     => Bank::find($input['bankid'])->name,
            'account'       => $user->nickname,
            'status'        => 1
        ]);
        if (!$bank) {
            return $this->failure('添加银行失败');
        }
        return $this->success('添加银行成功');
    }
}
