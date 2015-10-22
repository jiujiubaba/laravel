<?php namespace App\Http\Controllers;

use Controller, Auth;

class TeamController extends Controller
{
    /**
     *  团队总览
     *
     * @date   2015-10-11
     * @return [type]
     */
    public function index()
    {
        $user = Auth::user();
        $members = $user->getMembers();
        $data = [];
        $data['count'] = count($members);
        // foreach ($members as $key => $member) {
            
        // }
        return view('team.index');
    }

    /**
     *  团队游戏记录
     *
     * @date   2015-10-11
     * @return [type]
     */
    public function gamesRecord()
    {
        return view('team.games_record');
    }

    /**
     *  团队帐变
     *
     * @date   2015-10-11
     * @return [type]
     */
    public function accountChange()
    {
        return view('team.account_change');
    }   

    /**
     *  团队充值记录
     *
     * @date   2015-10-11
     * @return [type]
     */
    public function rechargeRecord()
    {
        return view('team.recharge_record');
    }

    /**
     *  团队体现记录
     *
     * @date   2015-10-11
     * @return [type]
     */
    public function withdrawRecord()
    {
        return view('team.withdraw_record');
    }
}
