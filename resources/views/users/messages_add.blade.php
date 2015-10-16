@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">我的账户</h4>
    <ul class="content-nav clearfix">
        <li><a href="/account">基本信息</a></li>
        <li class="current"><a href="/account/messages">我的消息(0)</a></li>
        <li><a href="/account/banks">我的银行卡</a></li>
        <li><a href="/account/edit">资料修改</a></li>
        <li><a href="#">奖金详情</a></li>
    </ul>
</div>
<div class="table-area">
    <h4 class="ui-form-title mt20">写信息</h4>
    <form class="message-area" id="J-form-login">
        <div class="clearfix">
            <div class="input person f-left">
                <span>接收人：</span>
                <input type="text" class="" style="color:#000" id="username" name="username">
            </div>
            <div class="f-left proxy">
                <label for="sjname">
                    <input type="checkbox" style="color:#000" name="sjname" id="sjname" value="1"> 上级代理
                </label>
            </div>
        </div>
        <div class="input subject">
            <span>主&nbsp;&nbsp;&nbsp;题：</span>
            <input type="text" class="" style="color:#000" id="title" name="title">
        </div>
        <div class="input inner">
            <span>内&nbsp;&nbsp;&nbsp;容：</span>
            <textarea class="" id="content" style="color:#000" name="content"></textarea>
        </div>
        <input type="submit" id="ui-btn" disabled="" class="ui-btn input f-right btn-important important-thumb mt20 mr20" value="发 送">
    </form>
</div>


<script src="/asset/js/index.js"></script>
@stop