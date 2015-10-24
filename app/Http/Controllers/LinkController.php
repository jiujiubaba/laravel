<?php namespace App\Http\Controllers;

use Controller, Request, Curl, Auth, Config;
use App\Link;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $links = Link::where('user_id', $user->id)->get();
        return view('agent.share', ['links' => $links]);
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
        $user = Auth::user();
        if (!Request::has('fandian', 'type')) {
            return failure('参数错误');
        }
        $code = baseEncode('uid='.$user->id.'&rand='.time().rand(1, 10000));
        $url = Config::get('web.host').'/r?code='.$code;

        $response = Curl::post('dwz.cn/create.php', array(),  array('url' => $url));
        if (!$response) {
            return failure('生成短网址失败');
        }
        // return $response;
        $type = Request::input('type', 0);
        $fandian = Request::input('fandian', 0);
        if (!in_array($type, [0,1])) {
            return failure('非法参数');
        }
        // if ($user->fandian < (float)$fandian) {
        //     return failure('不能超过上级返点');
        // }
        
        $Link = Link::saveData([
            'user_id'   => $user->id,
            'status'    => 1,
            'type'      => $type,
            'code'      => $code,
            'fandian'   => $fandian,
            'regiter_ip'   => ip2long(Request::getClientIp()),
            'url'       => json_decode($response)->tinyurl,
        ]);
        if ($Link) {
            return success('短网址添加成功');
        }

        return failure('短网址添加失败');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $link = Link::where('user_id', $user->id)->where('id', $id)->first();
        return success(['link' => $link]);
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
