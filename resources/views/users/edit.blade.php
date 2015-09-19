@extends('layouts.base')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">我的账户</h4>
    <ul class="content-nav clearfix">
        <li ><a href="/account">基本信息</a></li>
        <li ><a href="#">我的消息(0)</a></li>
        <li ><a href="/account/banks">我的银行卡</a></li>
        <li class="current"><a href="javascript:void(0)">资料修改</a></li>
        <li ><a href="#">奖金详情</a></li>
    </ul>
</div>
<div class="table-area">
    <form action="#" name="form3" id="form3">
        <h4 class="ui-form-title mt20">
                修改<span style=" color:#ea6b6c; font-weight:bold">昵称</span>
            </h4>
        <div class="ui-content mt20">
            <div>
                <span class="ui-title inline">新昵称：</span>
                <input type="text" id="nickname" name="nickname" class="ui-input input" autocomplete="off">
                <span class="ml20">
                    <em class="color-red"></em>
                </span>
            </div>
            <div class="mt10">
                <span class="ui-title inline"></span>
                <input class="btn edit-button important-thumb btn-important" type="button" id="update_nickname" value="修 改">
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
                <input class="btn edit-button important-thumb btn-important" type="button" id="update_passwd" value="修 改">
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        </div>
    </form>
    <form action="#" name="form2" id="form2">
        <h4 class="ui-form-title mt20">
                修改<span style=" color:#ea6b6c; font-weight:bold">资金</span>密码
            </h4>
        <div class="ui-content mt20">
            <div>
                <span class="ui-title inline">旧资金密码：</span>
                <input type="password" name="old_bank" id="old_bank" class="ui-input input" autocomplete="off">
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
                <input type="button" id="update_coin_passwd" class="btn important-thumb btn-important edit-button" value="修 改">
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        </div>
    </form>
</div>
<script src="/asset/js/index.js"></script>
@stop


