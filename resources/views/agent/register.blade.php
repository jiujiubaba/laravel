@extends('layouts.base')

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
            </tbody>
        </table>
        <div class="text-center">
            <input type="submit" id="user-login-button" class="mt20 ml10 btn important-nothumb btn-important" value="立即开户">
        </div>
    </form>
</div>

@stop

@section('scripts')
<script src="/asset/js/plugins.js"></script>
<script>

$(function(){
    var _token = "<?php echo csrf_token(); ?>";
    $('#bt').modal(function(){
    // if ($('#idcard').)
    if ($('#idcard').val() == '') {
        return swal('error', '请选择银行卡');
    }else if ($('#shengfen').val() == '') {
        return swal('error', '请填写开户行地址');
    }else if ($('#uname').val() == '') {
        return swal('error', '请填写开户人姓名');
    }else if ($('#banknum').val() == '') {
        return swal('error', '请填写银行卡号');
    }else if ($('#pass').val() == '') {
        return swal('error', '请填写资金密码');
    }

    var a= $('#J-form-banks').serialize();
    $.post('/banks/add', a, function(data){
        console.log(a);
    });
});
    $('.J-delete-bank').modal(function(arg){
        console.log(arg);
        console.log(arg.attr('data-num'));
        $('body').showLoading();
        var num = arg.attr('data-num');
        $.post('/banks/delete',{'num':num,'_token':_token}, function(data){
            $('body').hideLoading();
            if (data.result) {
                location.reload();
                swal('success', data.message);
            } else {
                swal('error', '删除失败');
            }
        });
        return true;
    });
    $('#test').click(function(){
        console.log('sdf');
        $('body').hideLoading();
    });
// $('body').hideLoading();

    // $('body').showLoading();
})
</script>

@stop


