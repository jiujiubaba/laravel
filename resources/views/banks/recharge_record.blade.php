@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">银行充提</h4>
    <ul class="content-nav clearfix">
        <li ><a href="/banks">网银转账</a></li>
        <li><a href="/banks/withdraw">提现</a></li>
        <li ><a href="/banks/withdraw-record">提现记录</a></li>
        <li  class="current"><a href="/banks/recharge-record">充值记录</a></li>
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
    $('#apply-withdraw').click(function(){
        var _this = $(this);
        var money = parseFloat($('#money').val());
        if (money < 0) {
            return swal('error', '提款金额不能为0');
        }else if ($('#pay-pass').val() == '') {
            return swal('error', '资金密码不能为空');
        } 
        var myMoney = parseFloat($('#my-money').attr('data-money'));

        if (money > myMoney) {
            return swal('error', '余额不足');
        }
        
        $('body').showDialog('温馨提示', '确定提现么？', function(){
            $('body').showLoading();
            $.post('/banks/apply-withdraw',$('#J-form-withdraw').serialize(), function(data){
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