@extends('layouts.base')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">银行充提</h4>
    <ul class="content-nav clearfix">
        <li ><a href="/banks">网银转账</a></li>
        <li class="current"><a href="/banks/alipay">支付宝转账</a></li>
        <li ><a href="/banks/withdraw">提现</a></li>
        <li ><a href="/banks/withdraw-record">提现记录</a></li>
        <li ><a href="/banks/recharge-record">充值记录</a></li>
    </ul>
</div>
<div class="table-area">
    <form action="http://999.niucaivip.com/?mod=safe&amp;code=transfer&amp;type=alipay" id="form1" name="form1" method="post" onsubmit="return req()">
    <div class="content-info bank-card-info clearfix">
        <div class="table-area">
            <div class="clearfix">
                <!--<div class="f-left mt30">
              <img src="http://999.niucaivip.com/tpl/black/images/newtpl/zhifubao.jpg">
            </div>-->
                <div class="f-left">
                    <div class="mt30">
                        <span class="ui-titlex inline">充值银行：</span>
                        <span class="inline ml10 fs-14">
                        <div class="bank-more" style="min-height: 50px;">
                            <div class="bank-label"><span title="支付宝充值限额：最低1,最高500" min="2" max="300" name="alipay" class="ico-bank alipay"></span></div></div>
                </span>
            </div>
            <div class="mt10">
                <span class="ui-titlex inline" style=" vertical-align:top">充值金额：</span>
                <span class="inline ml10 fs-14"><input type="text" class="input" name="money" id="money" maxlength="5" autocomplete="off" onkeyup="isnum(this.value)" onblur="yzmoney(this.value)"> 元 (单笔最低充值金额为 50 RMB / 最高 500 RMB)<p><font id="dxmoney" class="fs-12" style=" color:#666"></font>                                </p></span></div>
        </div>
    </div>
    <div id="tsmsg" style="color:#F00; padding-top:10px; padding-left:130px;"></div>
    <div class="mt10">
        <span class="ui-title inline"></span>
        <input type="hidden" id="pay" name="pay" value="flash">
        <input type="hidden" id="isproxy" value="0">
        <input type="submit" class="btn important-nothumb fs-14" value="下一步">
    </div>
    <!--<div class="dashed mt30">
            <h4 class="title">注意事项</h4>
                        <p>单笔最低充值金额为 50 RMB / 最高 500 RMB)；           
          </div>-->
    </div>
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