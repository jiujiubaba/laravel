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
                <input class="ui-btn" type="button" id="apply-withdraw" data-target="update" value="提款">
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
$(function(){
    $('#apply-withdraw').click(function(){
        var _this = $(this);
        var money = $('#money').val();
        console.log(money);
        if (money <= 0) {
            return toastr.warning('提款金额不能为0');
        }

        var myMoney = parseFloat($('#my-money').attr('data-money'));

        if (money > myMoney) {
            return toastr.warning('余额不足');
        }

        if ($('#pay-pass').val() == '') {
            return toastr.warning('资金密码不能为空');
        } 
          
        window.parent.swal({
            title: "确定提现么?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            confirmButtonText: '确定',
            closeOnConfirm: false,
            cancelButtonText: "取消",
            //closeOnCancel: false
        },
        function(){
            window.parent.NProgress.start();
            $.post('/banks/apply-withdraw',$('#J-form-withdraw').serialize(), function(data){
                window.parent.NProgress.done();
                if (data.result) {
                    location.href = '/withdraw';
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message, '', 'error');
                    if (data.code == 1001) {
                        location.href = '/user/edit'
                    }
                }
            });
            R('/banks/apply-withdraw', {
            method: "post",
            data: $('#J-form-withdraw').serialize(),
                ok:function(data){
                    location.href = '/banks/withdraw';
                }
            });
        });

        
    });
});
</script>
@stop