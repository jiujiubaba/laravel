<?php
namespace App\Http\Controllers\Backend;

use Controller, Curl, Cache, Request, Hash, Validator, Auth;
use App\Admin;
use Carbon\Carbon;

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

        // $rules = [
        //     'captcha' => 'required|captcha',
        // ];
        // $validator = Validator::make(Request::all(), $rules);
        // if ($validator->fails()) {
        //     return $this->failure('验证码错误');
        // }

        $admin = Admin::where('username', Request::input('username'))->first();
        if (!$admin) {
            return failure('用户不存在');
        }

        if (!Hash::check(Request::input('password'), $admin->password))
        {
            return failure('用户名或密码错误');
        }

        $admin->increment('sign_in_cnt');
        $admin->last_sign_in_at = Carbon::now();
        $admin->last_sign_in_ip = Request::getClientIp();
        $admin->save();

        Auth::loginUsingId($admin->user_id);
        return success('登录成功');
    }
}
