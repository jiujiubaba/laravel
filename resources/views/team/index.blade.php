@extends('layouts.base')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">团队管理</h4>
    <ul class="content-nav clearfix">
        <li class="current"><a href="/team">团队总览</a></li>
        <li><a href="/team/record">团队记录</a></li>
        <li><a href="/team/account-change">团队账变</a></li>
        <li><a href="/team/recharge-record">充值记录</a></li>
        <li><a href="/team/withdraw-record">提现记录</a></li>
    </ul>
</div>
<div class="table-area">
    <div class="dashed mt30">
        <h4 class="title">使用提示</h4>
        <p>1、每个游戏帐户最多绑定 5 张银行卡 ， 您已经成功绑定 1 张。</p>
        <p>2、银行卡锁定以后，不能增加新的银行卡绑定，同时也不能解绑已绑定的银行卡。 </p>
        <p>3、新绑定的提款银行卡需要绑定时间超过 6 个小时才能正常取款。</p>
        <p>4、一个账户只能绑定同一个开户人姓名的银行卡。</p>
    </div>

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


