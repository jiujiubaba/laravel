@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">我的账户</h4>
    <ul class="content-nav clearfix">
        <li class="current"><a href="/account">基本信息</a></li>
        <li><a href="/account/messages">我的消息(0)</a></li>
        <li><a href="/account/banks">我的银行卡</a></li>
        <li><a href="/account/edit">资料修改</a></li>
        <li><a href="#">奖金详情</a></li>
    </ul>
</div>
<div class="table-area">
    <form method="POST" action="http://999.niucaivip.com/do.php?mod=safe&amp;code=pass&amp;active=save&amp;pass=nc" name="form3" id="form3">
        <h4 class="ui-form-title mt20">个人资料</h4>
        <div class="ui-content mt20">
            <span class="ui-title inline">登录账户：</span>
            <span class="ui-title-cont inline">{{ $username }}</span>
            <span class="ui-title inline">昵称：</span>
            <span class="ui-title-cont inline">{{ $nickname }}</span>
        </div>
        <div class="ui-content mt20">
            <span class="ui-title inline">VIP等级：</span>
            <span class="ui-title-cont inline">{{ $level }}</span>
            <span class="ui-title inline">积分：</span>
            <span class="ui-title-cont inline">{{ $scores }}</span>
        </div>
        <div class="ui-content mt20">
            <span class="ui-title inline">会员类型：</span>
            <span class="ui-title-cont inline"> @if ($type == 0) 
                    普通会员
                @else
                    代理
                @endif </span>
            <span class="ui-title inline">返点：</span>
            <span class="ui-title-cont inline">{{ $fandian }}</span>
        </div>
        <div class="ui-content mt20">
            <span class="ui-title inline">密码QQ：</span>
            <span class="ui-title-cont inline">{{ $qq }}</span>
            <span class="ui-title inline">资金：</span>
            <span class="ui-title-cont inline">{{ $cash }}</span>
        </div>
    </form>
</div>
<script src="/asset/js/index.js"></script>
@stop


