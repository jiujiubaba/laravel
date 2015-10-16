@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">团队管理</h4>
    <ul class="content-nav clearfix">
        <li><a href="/team">团队总览</a></li>
        <li><a href="/team/games-record">团队记录</a></li>
        <li  class="current"><a href="/team/account-change">团队账变</a></li>
        <li><a href="/team/recharge-record">充值记录</a></li>
        <li><a href="/team/withdraw-record">提现记录</a></li>
    </ul>
</div>
<div class="table-area">
    <form method="POST" action="http://nc.niucaivip.com/?mod=report&amp;code=orders" name="form1" id="form1">
        <input type="hidden" name="perids" value="">
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
            &nbsp;&nbsp;
            <select id="type" class="select ml10 mr20 w200" name="type">
                <option value="0">编号查询</option>
                <option value="1">注单编号</option>
                <option value="2">追号编号</option>
                <option value="3">帐变编号</option>
            </select>：
            <input type="text" id="code_s" name="code_s" class="mr10 input" value="" style="width:150px;">
            <script>
            selectSetItem(G('type'), '')
            </script>
        </div>
        <div class="info-layout-title mt5">
            帐变类型：
            <select name="ordertype" id="ordertype" class="select ml10 mr20 w200">
                <option value="">全部</option>
                <option value="hd_money">活动彩金</option>
                <option value="yongjin">佣金</option>
                <option value="fenhong|fenhong_to_lower">分红</option>
                <option value="rigongzi|rigongzi_to_lower">日收益</option>
                <option value="hig_to_bank">频道转出</option>
                <option value="bank_to_hig">频道转入</option>
                <option value="hig_buy|hig_chase">加入游戏</option>
                <option value="hig_rebate">销售返点</option>
                <option value="hig_rebate_cas">真人返点</option>
                <option value="hig_prize">奖金派送</option>
                <option value="hig_chase_back|hig_buy_back">撤单返款</option>
                <option value="hig_buy_back_fee">撤单手续费</option>
                <option value="hig_rebate_back">撤销返点</option>
                <option value="hig_prize_back">撤销派奖</option>
                <option value="hig_add_admin|higerid_del_user">特殊金额整理</option>
                <option value="hig_lost_admin">特殊金额清理</option>
                <option value="mention_from_Lowerid">给下级提现</option>
                <option value="mention_to_higherid">向上级提现</option>
                <option value="Recharge_from_Lowerid">向下级充值</option>
                <option value="Recharge_to_higherid">上级充值</option>
                <option value="Recharge_to_system">平台充值</option>
                <option value="mention_from_system">平台提现</option>
                <option value="mention_from_back">提现取消</option>
                <option value="Recharge_online">在线充值</option>
            </select>
            <script>
            selectSetItem(G('ordertype'), '')
            </script>
            <input type="submit" value="查询" class="ui-btn important-thumb w150 text-center no-bgimg no-padding">
        </div>
    </form>
    <table class="table text-center mt20">
        <thead>
            <tr style="height:25px; line-height:25px;">
                <th>帐变编号</th>
                <th>会员</th>
                <th>时间</th>
                <th>类型</th>
                <th>收入</th>
                <th>支出</th>
                <th>之前余额</th>
                <th>之后余额</th>
                <th>备注</th>
            </tr>
        </thead>
        <tbody>
            <tr height="35" align="center">
                <td colspan="9">未找到数据，请更改查询条件之后进行查询！</td>
            </tr>
        </tbody>
    </table>
</div>
@stop

@section('scripts')
<script src="/asset/js/plugins.js"></script>
<script>

$(function(){
    var _token = "<?php echo csrf_token(); ?>";
    $('#bt').modal(function(){
    // if ($('#idcard').)
    if ($('#idcard').val() == '') {
        return swal('error', '请选择银行卡');
    }else if ($('#shengfen').val() == '') {
        return swal('error', '请填写开户行地址');
    }else if ($('#uname').val() == '') {
        return swal('error', '请填写开户人姓名');
    }else if ($('#banknum').val() == '') {
        return swal('error', '请填写银行卡号');
    }else if ($('#pass').val() == '') {
        return swal('error', '请填写资金密码');
    }

    var a= $('#J-form-banks').serialize();
    $.post('/banks/add', a, function(data){
        console.log(a);
    });
});
    $('.J-delete-bank').modal(function(arg){
        console.log(arg);
        console.log(arg.attr('data-num'));
        $('body').showLoading();
        var num = arg.attr('data-num');
        $.post('/banks/delete',{'num':num,'_token':_token}, function(data){
            $('body').hideLoading();
            if (data.result) {
                location.reload();
                swal('success', data.message);
            } else {
                swal('error', '删除失败');
            }
        });
        return true;
    });
    $('#test').click(function(){
        console.log('sdf');
        $('body').hideLoading();
    });
// $('body').hideLoading();

    // $('body').showLoading();
})
</script>

@stop


