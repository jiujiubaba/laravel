<?php namespace App\Http\Controllers\Backend;

use Controller, DB;

class UserWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $withdraws = DB::table('user_withdraws as w')
                    ->join('users as u', 'w.user_id', '=', 'u.id')
                    ->join('user_banks as b', 'w.user_bank_id', '=', 'b.id')
                    ->select('u.id as user_id', 'u.username', 'u.ancestry', 'w.money', 'b.bank_name', 'b.name', 'b.account', 'b.address', 'w.created_at', 'w.status', 'w.id')
                    ->paginate();

        return view('backend.business.withdraw', ['withdraws' => $withdraws]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
