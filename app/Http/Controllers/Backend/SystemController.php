<?php namespace App\Http\Controllers\Backend;
use Controller, Request;
use App\Bank, App\AdminBank;

class SystemController extends Controller
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

    public function addBank()
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
}
