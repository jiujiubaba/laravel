<?php namespace App\Http\Controllers;

use Controller, Auth, DB;
use App\User;

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
        $user = Auth::user();
        $parentId = $user->parent_id;
        $data['self'] = $user->id;
        $data['recharges'] = DB::table('user_recharges as c')
                ->join('banks as b', 'c.bank_id', '=', 'b.id')
                ->join('users as u', 'c.user_id', '=', 'u.id')
                ->whereRaw("find_in_set($parentId, u.ancestry_depth)")
                ->orderBy('created_at', 'desc')
                ->select('b.name','u.id as user_id', 'u.username' , 'c.money', 'c.created_at', 'c.remark', 'c.status', 'c.sn')
                ->paginate(10);
        // $u = User::whereRaw("find_in_set($parentId, ancestry_depth)")->get();
        // return count($data['recharges']);
        return view('team.recharge_record', $data);
    }

    /**
     *  团队体现记录
     *
     * @date   2015-10-11
     * @return [type]
     */
    public function withdrawRecord()
    {
        $user = Auth::user();
        $parentId = $user->parent_id;
        $data['self'] = $user->id;
        $data['withdraws'] =  DB::table('user_withdraws as w')          
                    ->join('user_banks as b','w.user_bank_id', '=', 'b.id')
                    ->join('users as u', 'w.user_id', '=', 'u.id')
                    ->whereRaw("find_in_set($parentId, u.ancestry_depth)")
                    ->select(['w.money', 'w.sn', 'w.status','w.created_at','b.name','b.account','b.bank_name', 'u.id as user_id' ,'u.username'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10); 
        return view('team.withdraw_record', $data);
    }
}
