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
    <form name="form3" id="form3">
        <h4 class="ui-form-title mt20">
                账户<span style=" color:#ea6b6c; font-weight:bold">提现</span>
            </h4>
        <div class="ui-content mt20">
            <div>
                <span class="ui-title inline">账户名：</span>
                <input type="text" id="nickname" name="nickname" class="ui-input input" autocomplete="off" value="">
                <span class="ml20">
                    <em class="color-red">sdf</em>
                </span>
            </div>
            <div>
                <span class="ui-title inline">账户余额</span>
                <input type="text" id="nickname" name="nickname" class="ui-input input" autocomplete="off" value="">
                <span class="ml20">
                    <em class="color-red"></em>
                </span>
            </div>
            <div>
                <span class="ui-title inline">资金密码</span>
                <input type="text" id="nickname" name="nickname" class="ui-input input" autocomplete="off" value="">
                <span class="ml20">
                    <em class="color-red"></em>
                </span>
            </div>
            <div>
                <span class="ui-title inline">银行名称</span>
                <input type="text" id="nickname" name="nickname" class="ui-input input" autocomplete="off" value="">
                <span class="ml20">
                    <em class="color-red"></em>
                </span>
            </div>
            <div>
                <span class="ui-title inline">银行开户行地址</span>
                <input type="text" id="nickname" name="nickname" class="ui-input input" autocomplete="off" value="">
                <span class="ml20">
                    <em class="color-red"></em>
                </span>
            </div>
            <div>
                <span class="ui-title inline">提款金额</span>
                <input type="text" id="nickname" name="nickname" class="ui-input input" autocomplete="off" value="">
                <span class="ml20">
                    <em class="color-red"></em>
                </span>
            </div>
            <div class="mt10">
                <span class="ui-title inline"></span>
                <input class="btn edit-button important-thumb btn-important" type="button" id="update_nickname" data-target="update" value="修 改">
            </div>
            
        </div>
    </form>
</div>

<!-- 删除弹出层 -->
<!-- <div id="Dialog" class="dialog">
    <div class="dialog-title">
        <button type="button" class="close closes"><span aria-hidden="true">×</span></button>
        <h5 class="modal-title" id="myModalLabel">温馨提示</h5>
    </div>
    <div class="dialog-body" id="dialog-content">
        确定修改么？
    </div>
    <div class="dialog-footer">
        <button type="button" class="btn btn-danger closes">取消</button>
        <button type="button" class="btn btn-success success">确定</button>
    </div>
</div> -->
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