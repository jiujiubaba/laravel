@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">银行充提</h4>
    <ul class="content-nav clearfix">
        <li ><a href="/banks">网银转账</a></li>
        <li class="current"><a href="/banks/withdraw">提现</a></li>
        <li ><a href="/banks/withdraw-record">提现记录</a></li>
        <li ><a href="/banks/recharge-record">充值记录</a></li>
    </ul>
</div>
<div class="table-area">
    <form id="J-form-withdraw">
        <h4 class="ui-form-title mt20">
            账户<span style=" color:#ea6b6c; font-weight:bold">提现</span>
        </h4>
        @if ($userBank)
        <div class="ui-content mt20">         
            <div class="mt15">
                <span class="ui-title inline">银行名称：</span>
                <span class="ui-input input" style="display:inline-block"> {{ $userBank->bank_name }}</span>
            </div> 
            <div class="mt15">
                <span class="ui-title inline">卡/折号：</span>
                <span class="ui-input input" style="display:inline-block"> {{ $userBank->account }}</span>
            </div>
            <div class="mt15">
                <span class="ui-title inline">银行开户地址：</span>
                <span class="ui-input input" style="display:inline-block"> {{ $userBank->address }}</span>
            </div>
            <div class="mt15">
                <span class="ui-title inline">用户名：</span>
                <span class="ui-input input" style="display:inline-block"> {{ $username }}</span>
            </div>       
            <div class="mt15">
                <span class="ui-title inline">账户余额：</span>
                <span class="ui-input input" style="display:inline-block" id="my-money" data-money="{{ $cashes }}">{{ $cashes }}</span>元
            </div>
            <div class="mt15">
                <span class="ui-title inline">提款金额</span>
                <input type="number" class="ui-input input" id="money" name="money" autocomplete="off">
            </div>
            <div class="mt15">
                <span class="ui-title inline">资金密码：</span>
                <input type="password" class="ui-input input" id="pay-pass" name="pay_pass" autocomplete="off" onkeyup="">
            </div>          
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="mt10">
                <span class="ui-title inline"></span>
                <input class="ui-btn" type="button" id="apply-withdraw" data-target="update" value="提款">
            </div>
        </div>
        @else
        <div class="ui-content mt20">         
            <div class="mt15">
                <span class="ui-title inline">银行名称：</span>
                <select class="ui-input select input" name="bankname" id="idcard">
                    <option value="">选择银行卡</option>
                    @foreach ($banks as $bank)
                        <option value="{{ $bank->alias }}">{{ $bank->name }}</option>
                    @endforeach
                </select>
            </div> 
            <div class="mt15">
                <span class="ui-title inline">卡/折号：</span>
                <input type="number" class="ui-input input" id="money" name="money" autocomplete="off">
            </div>
            <div class="mt15">
                <span class="ui-title inline">银行开户地址：</span>
                <input type="number" class="ui-input input" id="money" name="money" autocomplete="off">
            </div>
            <div class="mt15">
                <span class="ui-title inline">用户名：</span>
                <input type="number" class="ui-input input" id="money" name="money" autocomplete="off">
            </div>       
            <div class="mt15">
                <span class="ui-title inline">账户余额：</span>
                <span class="ui-input input" style="display:inline-block" id="my-money" data-money="{{ $cashes }}">{{ $cashes }}</span>元
            </div>
            <div class="mt15">
                <span class="ui-title inline">提款金额</span>
                <input type="number" class="ui-input input" id="money" name="money" autocomplete="off">
            </div>
            <div class="mt15">
                <span class="ui-title inline">资金密码：</span>
                <input type="password" class="ui-input input" id="pay-pass" name="pay_pass" autocomplete="off" onkeyup="">
            </div>          
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="mt10">
                <span class="ui-title inline"></span>
                <input class="ui-btn" type="button" data-target="update" value="提款" id="apply-withdraw">
            </div>
        </div>
    

        @endif
    </form>
</div>
@stop

@section('scripts')
<script>
var toastr = window.parent.toastr;
@if ($is_payment)
    swal("您还没有设置资金密码", "去 \"我的账号\" - \"资料修改\" 设置资金密码吧");
@endif 

</script>
@stop