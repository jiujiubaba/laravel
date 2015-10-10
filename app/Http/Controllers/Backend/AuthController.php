<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Curl, Cache, Request;

class AuthController extends Controller
{
    /**
     * 登录样式
     *
     * @date   2015-10-09
     * @return [type]     [description]
     */
    public function login()
    {

        $data = [];
        $key = 'console_bing_image';
        if (Cache::has($key)) {
            $data['url'] = Cache::get('console_bing_image');
        } else {
            $body = Curl::get('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=1&pid=hp&video=1&format=js');
            $images = json_decode($body,true);
            // dd($images);

            if(isset($images['images'])){
                $images = $images['images'];
                if(is_array($images) && count($images) > 0){
                    $images = $images[0];
                    if(isset($images['url'])){
                        Cache::put($key, $images['url'], 60);
                        $data['url'] = $images['url'];
                    }
                }
            }
        }
        return view('backend.login', $data);
    }

    /**
     * 检查登录是否成功
     *
     * @date   2015-10-09
     * @return [type]     [description]
     */
    public function checkLogin()
    {
        if (!Request::has('username', 'password')) {
            return failure('请输入用户名或密码');
        }

        $admin = Admin::where('username', Request::input('username'))->first();
        if (!$admin) {
            return failure('用户不存在');
        }

        if (!Hash::check(Request::input('password'), $admin->password))
        {
            return failure('用户名或密码错误');
        }

        Auth::loginUsingId($admin->user_id);
        return success('登录成功');
    }
}
