<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bank;

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
        $banks = Bank::where('status', 1)->select(['id', 'name'])->get();
        $data['banks'] = $banks;
        return view('users.banks', $data);
    }
}
