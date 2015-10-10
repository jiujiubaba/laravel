<?php namespace App\Http\Controllers\Backend;

use Controller;

class IndexController extends Controller
{
    /**
     * 后台首页
     *
     * @date   2015-10-10
     * @return [type]     [description]
     */
    public function index()
    {
        return view('backend.index');
    }

    
}
