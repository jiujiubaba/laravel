@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">我的账户</h4>
    <ul class="content-nav clearfix">
        <li ><a href="/account">基本信息</a></li>
        <li ><a href="/account/messages">我的消息(0)</a></li>
        <li ><a href="/account/banks">我的银行卡</a></li>
        <li class="current"><a href="javascript:void(0)">资料修改</a></li>
        <li ><a href="#">奖金详情</a></li>
    </ul>
</div>
<div class="table-area">
    <form name="form3" id="form3">
        <h4 class="ui-form-title mt20">
                修改<span style=" color:#ea6b6c; font-weight:bold">昵称</span>
            </h4>
        <div class="ui-content mt20">
            <div>
                <span class="ui-title inline">新昵称：</span>
                <input type="text" id="nickname" name="nickname" class="ui-input input" autocomplete="off" value="" onblur="checkIsNull(this.value, '昵称不能为空')">
                <span class="ml20">
                    <em class="color-red"></em>
                </span>
            </div>
            <div class="mt10">
                <span class="ui-title inline"></span>
                <input class="ui-btn edit-button important-thumb btn-important" type="button" id="update_nickname" data-target="update" value="修 改">
            </div>
            
        </div>
    </form>
    <form method="" action="#" name="form1" id="form1">
        <h4 class="ui-form-title mt20">
                修改<span style=" color:#ea6b6c; font-weight:bold">登陆</span>密码
            </h4>
        <div class="ui-content mt20">
            <div>
                <span class="ui-title inline">旧登陆密码：</span>
                <input type="password" id="old_pass" name="old_pass" class="ui-input input" autocomplete="off">
                <span class="ml20">
                        <em class="color-red"></em>
                    </span>
            </div>
            <div class="mt15">
                <span class="ui-title inline">新登陆密码：</span>
                <input type="password" id="new_pass" name="new_pass" class="ui-input input">
                <span class="ml20">
                        不能和资金密码一样
                    </span>
            </div>
            <div class="mt15">
                <span class="ui-title inline">确认登陆密码：</span>
                <input type="password" id="two_new_pass" name="two_new_pass" class="ui-input input">
            </div>
            <div class="mt10">
                <span class="ui-title inline"></span>
                <input class="ui-btn edit-button important-thumb btn-important" type="button" id="update_passwd" value="修 改">
            </div>
        </div>
    </form>
    <form action="#" name="form2" id="form2">
        <h4 class="ui-form-title mt20">
                修改<span style=" color:#ea6b6c; font-weight:bold">资金</span>密码
            </h4>
        <div class="ui-content mt20">
            <div>
                <span class="ui-title inline">旧资金密码：</span>
                <input type="password" name="old_bank" id="old_bank" class="ui-input input" autocomplete="off" onblur="checkPasswd(this.value)">
                <span class="ml20"><em class="color-red"></em></span>
            </div>
            <div class="mt15">
                <span class="ui-title inline">新资金密码：</span>
                <input type="password" name="new_bank" id="new_bank" class="ui-input input">
                <span class="ml20">
                        不能和登录密码一样
                    </span>
            </div>
            <div class="mt15">
                <span class="ui-title inline">确认资金密码：</span>
                <input type="password" name="two_new_bank" id="two_new_bank" class="ui-input input">
            </div>
            <div class="mt10">
                <span class="ui-title inline"></span>
                <input type="button" id="update_coin_passwd" class="ui-btn important-thumb btn-important edit-button" value="修 改">
            </div>
        </div>
        <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
    </form>
</div>

@stop

@section('scripts')
<script src="/asset/js/plugins.js"></script>
<script>
var toastr = window.parent.toastr;
$(function(){
    
    var token = $('#_token').val();

    // 修改昵称
    $('#update_nickname').click(function(){
        var _this = $(this);
        var val = $('#nickname').val();
        
        if (val == '') {
            return toastr.warning('昵称不能不能为空');
        }


        window.parent.swal({
            title: "确定修改昵称么?",
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
            $.post('/account/update-nickname',$('#form3').serialize()+'&_token=' +token, function(data){
                window.parent.NProgress.done();
                if (data.result) {
                    toastr.success("昵称修改成功！");
                } else {
                    toastr.error(data.message);
                }
            });
        });
    });

    $('#update_passwd').click(function(){
        var old_value = $('#old_pass').val();
        var new_value = $('#new_pass').val();
        var two_new_pass = $('#two_new_pass').val();

        if (old_value == '') {
            return toastr.warning('旧登录密码不能为空');
        } else if (old_value.length < 6 || old_value.length > 20) {
            return toastr.warning('密码应该在6-20位数字字母组成');
        } else if (new_value == '') {
            return toastr.warning('新登录密码不能为空');
        } else if (two_new_pass == '') {
            return toastr.warning('确认密码不能为空');
        } else if (old_value != two_new_pass) {
            return toastr.warning('两次输入密码不一致');
        }

        window.parent.swal({
            title: "确定修改密码么?",
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
            $.post('/account/update-password',$('#form1').serialize()+'&_token=' +token, function(data){
                window.parent.NProgress.done();
                if (data.result) {
                    return toastr.success(data.message);
                } else {
                    return toastr.error(data.message);
                }
            });
        });
    });

    $('#update_coin_passwd').click(function(){
        var old_value = $('#old_bank').val();
        var new_value = $('#new_bank').val();
        var two_new_pass = $('#two_new_bank').val();

        if (new_value == '') {
            return toastr.warning('新资金密码不能为空');
        } else if (new_value.length < 6 || old_value.length > 20) {
            return toastr.warning('密码应该在6-20位数字字母组成');
        } else if (two_new_pass == '') {
            return toastr.warning('确认资金密码不能为空');
        } else if (old_value != two_new_pass) {
            return toastr.warning('两次输入密码不一致');
        }

        window.parent.swal({
            title: "确定修改资金密码么?",
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
            $.post('/account/update-password',$('#form1').serialize()+'&_token=' +token, function(data){
                window.parent.NProgress.done();
                if (data.result) {
                    return toastr.success(data.message);
                } else {
                    return toastr.error(data.message);
                }
            });
        });
    });
});
</script>
@stop

