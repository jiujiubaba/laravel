<?php namespace App\Http\Controllers;

use Request, Controller, Auth;
use App\User;

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
        $user = Auth::user();
        $data['agents'] = User::whereRaw('find_in_set(?, ancestry_depth)', [$user->ancestry_depth])->paginate(10);
        $data['user'] = $user;

        return view('agent.index', $data);
    }
    
    public function register()
    {
        return view('agent.register');
    }

    public function share()
    {
        return view('agent.share');
    }

    public function bonuses()
    {

    }
}
