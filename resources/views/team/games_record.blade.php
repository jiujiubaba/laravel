@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">团队管理</h4>
    <ul class="content-nav clearfix">
        <li><a href="/team">团队总览</a></li>
        <li class="current"><a href="/team/games-record">团队记录</a></li>
        <li><a href="/team/account-change">团队账变</a></li>
        <li><a href="/team/recharge-record">充值记录</a></li>
        <li><a href="/team/withdraw-record">提现记录</a></li>
    </ul>
</div>
<div class="table-area">
    <form method="POST" action="http://nc.niucaivip.com/?mod=records&amp;code=list" name="form1" id="form1">
        <input type="hidden" value="" name="perids">
        <input name="isgetdata" id="isgetdata" value="yes" style="display:none">
        <div class="info-layout-title mt20">
            游戏用户：
            <input type="text" name="pername" class="mr10 input" id="pername" value="" size="15">&nbsp;
            <label>
                <input type="checkbox" name="includes" id="includes" value="1">包含下级</label>
            <script>
            chkcheckboxNew('includes', '')
            </script>
            &nbsp;&nbsp;查找日期：
            <select name="begindate" id="begindate" class="select ml10 mr20 w200">
                <option value="2015-10-11">2015-10-11</option>
                <option value="2015-10-10">2015-10-10</option>
                <option value="2015-10-09">2015-10-09</option>
                <option value="2015-10-08">2015-10-08</option>
                <option value="2015-10-07">2015-10-07</option>
                <option value="2015-10-06">2015-10-06</option>
                <option value="2015-10-05">2015-10-05</option>
            </select>
            <script>
            selectSetItem(G('begindate'), '2015-10-11')
            </script>
            &nbsp;&nbsp;注单编号：
            <input type="text" id="projectno" name="projectno" class="mr10 input" value="" style="width:120px;"> &nbsp;&nbsp;
            <label>
                <input type="checkbox" name="is_zh" id="is_zh" value="1">包含追号</label>
            <script>
            chkcheckboxNew('is_zh', '')
            </script>
        </div>
        <div class="info-layout-title mt5">
            游戏种类：
            <select class="select ml10 mr20 w200" name="lotteryid" id="lotteryid">
                <option value="">全部</option>
                <option value="NYMMC">纽约秒秒彩</option>
                <option value="NYYFC">纽约一分彩</option>
                <option value="NYSFC">纽约三分彩</option>
                <option value="NYWFC">纽约五分彩</option>
                <option value="NY3D">纽约3D</option>
                <option value="CQSSC">重庆时时彩</option>
                <option value="JXSSC">江西时时彩</option>
                <option value="XJSSC">新疆时时彩</option>
                <option value="TJSSC">天津时时彩</option>
                <option value="JSK3">江苏快3</option>
                <option value="BJPK10">北京赛车</option>
                <option value="BJKL8">北京快乐8</option>
                <option value="GDKLSF">广东快乐十分</option>
                <option value="NY11-5">纽约11选5</option>
                <option value="SD11-5">山东11选5</option>
                <option value="GD11-5">广东11选5</option>
                <option value="JX11-5">江西11选5</option>
                <option value="3D">福彩3D</option>
                <option value="P5(P3)">P5(P3)</option>
            </select>
            <script>
            selectSetItem(G('lotteryid'), '')
            </script>
            状态：
            <select name="is_prize" id="is_prize" class="select ml10 mr20 w200">
                <option value="">所有</option>
                <option value="3">已中奖</option>
                <option value="2">未中奖</option>
                <option value="1">未开奖</option>
                <option value="9">已撤单</option>
            </select>
            <script>
            selectSetItem(G('is_prize'), '')
            </script>
            <input type="submit" value="查询" class="ui-btn important-thumb w150 text-center no-bgimg no-padding">
        </div>
    </form>
    <table class="table text-center mt20">
        <thead>
            <tr>
                <th>会员</th>
                <th>游戏名称</th>
                <th>游戏玩法</th>
                <th>投注时间</th>
                <th>游戏期号</th>
                <th>追号</th>
                <th>投注额</th>
                <th>奖金</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div class="data-view mt10 text-center">
        总投注额：
        <span class="color-red"></span> 元，中奖：
        <span class="color-red"></span> 元
    </div>
</div>
@stop

@section('scripts')
<script>

</script>
@stop


