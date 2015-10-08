@extends('layouts.base')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">银行充提</h4>
    <ul class="content-nav clearfix">
        <li class="current"><a href="/banks">网银转账</a></li>
        <li ><a href="/banks/alipay">支付宝转账</a></li>
        <li ><a href="/banks/withdraw">提现</a></li>
        <li ><a href="/banks/withdraw-record">提现记录</a></li>
        <li ><a href="/banks/recharge-record">充值记录</a></li>
    </ul>
</div>
<div class="table-area">
    <form method="post" onsubmit="return req()">
    <div class="mt20 clearfix">
        选择银行：
        <ul class="mt20 bank-icon-list">
            @foreach ($banks as $bank)
            <li class="{{ $bank->logo }} input f-left">
                <label>
                    <input name="bank" class="inline" type="radio" value="{{ $bank->alias }}" onclick="" title="{{ $bank->name }}">
                </label>
            </li>
            @endforeach
        </ul>
    </div>
    <input type="hidden" id="bankid" name="bankid" value="">
    <input type="hidden" id="pay" name="pay" value="f90819a365775b72303d0e9317550993|d85a58b0783926a9c5ea2b616d978cd6">
    <input type="hidden" id="isproxy" value="0">
    <h4 class="info-layout-title mt20 fs-16">充值金额</h4>
    <div class="mt20">
        <input type="text" class="input" name="money" id="money" maxlength="7" autocomplete="off" onkeyup="isnum(this.value)" onblur="yzmoney(this.value)"> 元
        <span class="fs-12 ml20"> (单笔最低充值金额为 100 RMB / 最高 50000 RMB)</span>
        <br>
        <span id="dxmoney" class="fs-12" style="margin-top:5px;"></span>
    </div>
    <div>
        <div id="tsmsg" style="color:#F00; padding-top:10px;"></div>
        <input type="submit" class="btn important-nothumb mt30" value="下一步">
    </div>
</form>

</div>
@stop

@section('scripts')
<script src="/asset/js/plugins.js"></script>
<script>
$(function(){
    var token = $('#_token').val();
    $('#update_nickname').click(function(){
        var _this = $(this);
        if ($('#nickname').val() == '') {
            return swal('error', '昵称不能为空');
        }
        
        $('body').showDialog('温馨提示', '确定修改昵称么？', function(){
            $('body').showLoading();
            $.post('/account/update-nickname',$('#form3').serialize()+'&_token=' +token, function(data){
                $('body').hideLoading();
                if (data.result) {
                    location.reload();
                    swal('success', data.message);
                } else {
                    swal('error', '删除失败');
                }
            });
        });
    });

    $('#update_passwd').click(function(){
        console.log('sdf');
        if ($('#old_pass').val() == '') {
            return swal('error', '旧登录密码不能为空');
        } else if ($('#new_pass').val() == '') {
            return swal('error', '新登录密码不能为空');
        } else if ($('#two_new_pass').val() == '') {
            return swal('error', '确认密码不能为空');
        } else if ($('#new_pass').val() != $('#two_new_pass').val()) {
            return swal('error', '两次输入密码不一致');
        }

        $('body').showDialog('温馨提示', '确定修改密码么？', function(){
            $('body').showLoading();
            $.post('/account/update-password',$('#form1').serialize()+'&_token=' +token, function(data){
                $('body').hideLoading();
                if (data.result) {
                    location.reload();
                    swal('success', data.message);
                } else {
                    swal('error', data.message);
                }
            });
        });
        
    });
});
</script>
@stop