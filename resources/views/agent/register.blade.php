@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">代理管理</h4>
    <ul class="content-nav clearfix">
        <li><a href="/agent">会员列表</a></li>
        <li class="current"><a href="/agent/register">会员注册</a></li>
        <li><a href="/agent/share">注册推广</a></li>
        <li><a href="/agent/bonuses">代理分红</a></li>
    </ul>
</div>
<div class="table-area">
    <form class="message-area" id="J-form-login">
        <h4 class="ui-form-title mt20">会员<span style=" color:#ea6b6c; font-weight:bold">注册</span></h4>
        <table class="table mt30">
            <thead>
                <tr>
                    <th>填写基本信息</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        登陆帐号：
                        <input type="text" class="input bg-fff" id="username" name="username" autocomplete="off">
                        <span id="tsmsg">(不少于6个字符)</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        登陆密码：
                        <input type="password" class="input bg-fff" id="pass" name="pass" autocomplete="off">
                        <span id="tsmsg1">(由6~16位数字或字母组成)</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        重复密码：
                        <input type="password" class="input bg-fff" id="pass2" name="pass2" autocomplete="off">
                        <span id="tsmsg2"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        所 &nbsp;属&nbsp; 组：
                        <select class="" id="isproxy" name="isproxy">
                            <option value="1">普通会员</option>
                            <option selected="" value="0">代理用户</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        游戏返点：
                        <select class="" name="bankname" id="idcard">
                            <option value="0">0</option>
                            <option value="0.1">0.1</option>
                            <option value="0.2">0.2</option>
                            <option value="0.3">0.3</option>
                            <option value="0.4">0.4</option>
                            <option value="0.5">0.5</option>
                            <option value="0.6">0.6</option>
                            <option value="0.7">0.7</option>
                            <option value="0.8">0.8</option>
                            <option value="0.9">0.9</option>
                            <option value="1">1</option>
                            <option value="1.1">1.1</option>
                            <option value="1.2">1.2</option>
                            <option value="1.3">1.3</option>
                            <option value="1.4">1.4</option>
                            <option value="1.5">1.5</option>
                            <option value="1.6">1.6</option>
                            <option value="1.7">1.7</option>
                            <option value="1.8">1.8</option>
                            <option value="1.9">1.9</option>
                            <option value="2">2</option>
                            <option value="2.1">2.1</option>
                            <option value="2.2">2.2</option>
                            <option value="2.3">2.3</option>
                            <option value="2.4">2.4</option>
                            <option value="2.5">2.5</option>
                            <option value="2.6">2.6</option>
                            <option value="2.7">2.7</option>
                            <option value="2.8">2.8</option>
                            <option value="2.9">2.9</option>
                            <option value="3">3</option>
                            <option value="3.1">3.1</option>
                            <option value="3.2">3.2</option>
                            <option value="3.3">3.3</option>
                            <option value="3.4">3.4</option>
                            <option value="3.5">3.5</option>
                            <option value="3.6">3.6</option>
                            <option value="3.7">3.7</option>
                            <option value="3.8">3.8</option>
                            <option value="3.9">3.9</option>
                            <option value="4">4</option>
                            <option value="4.1">4.1</option>
                            <option value="4.2">4.2</option>
                            <option value="4.3">4.3</option>
                            <option value="4.4">4.4</option>
                            <option value="4.5">4.5</option>
                            <option value="4.6">4.6</option>
                            <option value="4.7">4.7</option>
                            <option value="4.8">4.8</option>
                            <option value="4.9">4.9</option>
                            <option value="5">5</option>
                            <option value="5.1">5.1</option>
                            <option value="5.2">5.2</option>
                            <option value="5.3">5.3</option>
                            <option value="5.4">5.4</option>
                            <option value="5.5">5.5</option>
                            <option value="5.6">5.6</option>
                            <option value="5.7">5.7</option>
                            <option value="5.8">5.8</option>
                            <option value="5.9">5.9</option>
                            <option value="6">6</option>
                            <option value="6.1">6.1</option>
                            <option value="6.2">6.2</option>
                            <option value="6.3">6.3</option>
                            <option value="6.4">6.4</option>     
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <input type="submit" id="user-login-button" class="ui-btn mt20 ml10 btn important-nothumb btn-important" value="立即开户">
        </div>
    </form>
</div>
@stop

@section('scripts')
<script>
$(function(){
    var _token = "<?php echo csrf_token(); ?>";
    
})
</script>
@stop


