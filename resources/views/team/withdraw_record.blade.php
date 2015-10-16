@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">团队管理</h4>
    <ul class="content-nav clearfix">
        <li><a href="/team">团队总览</a></li>
        <li><a href="/team/games-record">团队记录</a></li>
        <li><a href="/team/account-change">团队账变</a></li>
        <li><a href="/team/recharge-record">充值记录</a></li>
        <li class="current"><a href="/team/withdraw-record">提现记录</a></li>
    </ul>
</div>
<div class="table-area">
    <div class="info-layout-title mt20">
        <form action="/" method="get">
            <input type="hidden" value="safe" name="mod">
            <input type="hidden" value="rechargelist" name="code">
            <input type="hidden" value="recharge" name="type"> 充提时间：
            <input type="text" name="st" value="2015-10-11" class="time-select mr10 input" onclick="WdatePicker({isShowClear:false,readOnly:false,dateFmt:'yyyy-MM-dd',onpicked:function(){$dp.$('et').focus();}})"> 至
            <input type="text" name="et" id="et" value="2015-10-11" class="time-select input ml10 mr10" onclick="WdatePicker({isShowClear:false,readOnly:false,dateFmt:'yyyy-MM-dd'})"> 编号：
            <input type="text" class="input" name="bh">
            <input type="submit" value="查询" class="btn important-thumb w150 text-center no-bgimg no-padding ml10">
        </form>
    </div>
    <table class="table text-center mt20">
        <thead>
            <tr>
                <th>序号</th>
                <th>类型</th>
                <th>编号</th>
                <th>金额（元）</th>
                <th>时间</th>
                <th>备注</th>
                <th>状态</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" align="center">暂无数据</td>
            </tr>
        </tbody>
    </table>
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


