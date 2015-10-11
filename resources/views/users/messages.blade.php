@extends('layouts.base')

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
    <h4 class="info-layout-title mt20">
        <span style="cursor:pointer;" onclick="window.location.href='/account/messages'" class="color-red">已收信息(0)</span>
        <span style="cursor:pointer;" onclick="window.location.href='/account/messages-sent'" class=" ml20">已发信息(0)</span>
        <a href="/account/messages-add" class="f-right"><i class="icon-edit mr5"></i>写信息</a>
    </h4>
    <table class="table text-center">
        <thead>
            <tr>
                <th>序号</th>
                <th>发件人</th>
                <th>标题</th>
                <th>发送时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <tr id="usertr298400" class="table_b_tr_a">
                <td>1</td>
                <td>系统</td>
                <td class="msg_cont"><a href="/?mod=safe&amp;code=msginfo&amp;uid=298400" style="color:#000">关于登陆域名</a></td>
                <td>2015-09-20</td>
                <td width="111" id="del298400"><span onclick="delmsg(298400)" style="cursor:pointer">删除</span></td>
            </tr>
            <tr id="usertr258890" class="table_b_tr_b">
                <td>2</td>
                <td>系统</td>
                <td class="msg_cont"><a href="/?mod=safe&amp;code=msginfo&amp;uid=258890" style="color:#000">关于登陆域名</a></td>
                <td>2015-09-20</td>
                <td width="111" id="del258890"><span onclick="delmsg(258890)" style="cursor:pointer">删除</span></td>
            </tr>
        </tbody>
    </table>
</div>

<script src="/asset/js/index.js"></script>
@stop


