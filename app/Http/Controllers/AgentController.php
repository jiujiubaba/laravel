<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    /**
     * 代理管理首页
     *  
     * @date   2015-10-09
     * @return [type]     [description]
     */
    public function index()
    {
        return view('agent.index');
    }
    
    public function register()
    {

    }

    public function share()
    {

    }

    public function bonuses()
    {

    }
}
