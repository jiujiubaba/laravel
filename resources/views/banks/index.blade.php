@extends('layouts.base')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">银行充提</h4>
    <ul class="content-nav clearfix">
        <li class="current"><a href="/banks">网银转账</a></li>
        <li ><a href="/banks/withdraw">提现</a></li>
        <li ><a href="/banks/withdraw-record">提现记录</a></li>
        <li ><a href="/banks/recharge-record">充值记录</a></li>
    </ul>
</div>
<div class="table-area">
    <form action="/banks/comfirm" method="post" target="_blank" onsubmit="return req()">
    <div class="mt20 clearfix">
        选择银行：
        <ul class="mt20 bank-icon-list">
            @foreach ($banks as $bank)
            <li class="{{ $bank->logo }} input f-left">
                <label>
                    <input name="bank" class="inline" type="radio" value="{{ $bank->alias }}" onclick="bankxx(this.value)" title="{{ $bank->name }}">
                </label>
            </li>
            @endforeach
        </ul>
    </div>
    <input type="hidden" id="bank" name="bank" value="">
    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
    <h4 class="info-layout-title mt20 fs-16">充值金额</h4>
    <div class="mt20">
        <input type="text" class="input" name="money" id="money" maxlength="7" autocomplete="off" onkeyup="isnum(this.value)" onblur="yzmoney(this.value)"> 元
        <span class="fs-12 ml20"> (单笔最低充值金额为 100 RMB / 最高 50000 RMB)</span>
        <br>
        <span id="dxmoney" class="fs-12" style="color:#F00; margin-top:5px;"></span>
    </div>
    <div>
        <input type="submit" class="btn important-nothumb mt30" value="下一步">
    </div>
</form>

</div>
@stop

@section('scripts')
<script src="/asset/js/plugins.js"></script>
<script>


function bankxx(v){
    $("#bank").val(v);
}
function yzmoney(v){
    
    var t = moneyFormat(v);
    $("#money").val(t);
    $("#dxmoney").html(changeMoneyToChinese(v));
}

function isnum(v){
    var t = formatFloat(v);
    if(t>50000){
        t=50000;
    }
    $("#money").val(t);
    $("#dxmoney").html(changeMoneyToChinese(v));        
}

function req(){
    var bank = $("#bank").val();
    var m = $("#money").val();  

    if(bank==''){
        swal("请选择充值银行", "", "error")
        return false;       
    }
    if(m<100 || m>50000){
        $("#money").focus();
        swal("充值单笔只支持 100~50000 元。", "", "error");
        return false;    
    }
    return true;
}
</script>
@stop