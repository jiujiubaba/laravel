<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Curl, Cache, Request;

class AuthController extends Controller
{
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

    public function checkLogin()
    {
        //下边两个设置很重要
        // Config::set('auth.model', 'App\Admin');
        // Config::set('auth.table', 'admins');

        return Request::all();
        //
        // $username = Input::get('username');
        // $password = Input::get('password');
        $rememberme = true;
        if (Input::get('rememberme')){
            $rememberme = true;
        }
        else{
            $rememberme = false;
        }
        if(Auth::attempt([
            'username' => $username,'password' => $password
        ],$rememberme))             
        {
            //登录成功
            return redirect(action('admin\AdminController@index'));
        }
        else {
            //登录失败
            return redirect(action('admin\AdminController@login'))
            ->withErrors("用户名或者密码不正确");
        }
    }
}
