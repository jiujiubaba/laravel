<?php namespace App\Http\Controllers\Backend;
use Controller, Request;
use App\Bank, App\AdminBank;

class BanksController extends Controller
{
    public function index()
    {
        //
    }

    public function banks()
    {
    	$data['banks'] = Bank::where('status', 1)->get();
    	$data['adminBanks'] = AdminBank::paginate(10);
        return view('backend.systems.banks', $data);
    }

    public function store()
    {
    	if (!Request::has('bank', 'name', 'account')) {
    		return failure('参数错误');
    	}

    	$bank = Bank::find(Request::input('bank'));

    	if (!$bank) {
    		return failure('银行不存在');
    	}

    	$adminBank = AdminBank::add($bank, Request::input('name'), Request::input('account'), Request::input('address'));
    	if (!$adminBank) {
    		return failure('添加银行失败');
    	}

    	return success('添加银行成功');
    }

    public function update()
    {
        $id = Request::input('id');
        $adminBank = AdminBank::find($id);
        if (!$adminBank){
            return failure('不存在该条记录');
        }

        if (!$adminBank->toggleStatus()) {
            return failure('修改状态失败');
        }

        return success('状态变更成功');
    }
}
