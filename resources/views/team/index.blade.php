@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">团队管理</h4>
    <ul class="content-nav clearfix">
        <li class="current"><a href="/team">团队总览</a></li>
        <li><a href="/team/games-record">团队记录</a></li>
        <li><a href="/team/account-change">团队账变</a></li>
        <li><a href="/team/recharge-record">充值记录</a></li>
        <li><a href="/team/withdraw-record">提现记录</a></li>
    </ul>
</div>
<div class="table-area">
    <form method="POST" action="http://vip03.nnncai.com/?mod=report&amp;code=group" name="form1" id="form1">
        <div class="info-layout-title mt20">
            时间范围：
            <input type="text" class="time-select mr10 input" name="creatdatest" value="2015-10-18" > 至
            <input type="text" class="time-select input ml10 mr10" value="2015-10-18" name="creatdateet"> &nbsp;&nbsp; 项目：
            <select name="item" id="item" class="select input ml10 mr10" style="width:127px; padding-right:0px;">
                <option value="">全部</option>
                <option value="1">彩票</option>
                <option value="2">真人</option>
            </select>
            <script>
            selectSetItem(G('item'), '')
            </script>
            <input type="submit" value="查询" class="btn important-thumb w150 text-center no-bgimg no-padding ml10">
        </div>
    </form>
    <table class="table text-center mt20">
        <thead>
            <tr>
                <th>总团队人数： 2人</th>
                <th>时间范围内注册人数： 0人</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>充值： ¥ 0.00</td>
                <td>提现： ¥ 0.00</td>
            </tr>
            <tr>
                <td>投注： ¥ 0.00
                </td>
                <td>中奖： ¥ 0.00
                </td>
            </tr>
            <tr>
                <td>返点： ¥ 0.00
                </td>
                <td>活动： ¥ 0.00
                </td>
            </tr>
            <tr>
                <td>日收益： ¥ 0.00
                </td>
                <td>其他： ¥ 0.00</td>
            </tr>
            <tr>
                <td>
                    净盈利：
                    <span class="color-red">¥
0.00
                                    </span>
                </td>
                <td>
                    净盈利=中奖+返点+活动+日收益-投注
                </td>
            </tr>
        </tbody>
    </table>
</div>
@stop

@section('scripts')
<script>


</script>
@stop


