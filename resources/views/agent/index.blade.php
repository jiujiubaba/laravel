@extends('layouts.base')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">代理管理</h4>
    <ul class="content-nav clearfix">
        <li class="current"><a href="/agent">会员列表</a></li>
        <li><a href="/agent/register">会员注册</a></li>
        <li><a href="/agent/share">注册推广</a></li>
        <li><a href="/agent/bonuses">代理分红</a></li>
    </ul>
</div>
<div class="table-area">
    <form method="get" action="/" name="form1" id="form1">
        <input type="hidden" name="mod" value="user">
        <input type="hidden" name="code" value="list">
        <div class="info-layout-title mt20">
            账户余额：
            <input type="text" class="mr10 w100 input" id="moneymin" name="moneymin" value=""> 至
            <input type="text" class="input w100 ml10 mr10" id="moneymax" name="moneymax" value=""> 时时彩返点：
            <input type="text" class="mr10 w100 input" name="rebatesmin" value="">% 至
            <input type="text" class="input w100 ml10 mr10" name="rebatesmax" value="">%
        </div>
        <div class="info-layout-title mt5">
            排序：
            <select class="select ml10 mr20 w200" name="order" id="order">
                <option value="1">注册时间排序</option>
                <option value="2">最后登录排序</option>
                <option value="3">用户余额排序</option>
                <option value="4">会员返点排序</option>
            </select>
            <script>
            selectSetItem(G('order'), '')
            </script>
            范围：
            <select class="select ml10 mr20 w200" name="usertype" id="usertype">
                <option value="1">直属</option>
                <option value="2">全部</option>
            </select>
            <script>
            selectSetItem(G('usertype'), '1')
            </script>
            用户名：
            <input type="text" class="mr10 w100 input" name="pername" value="">
            <input type="submit" value="查询" class="btn important-thumb w150 ml10 text-center no-bgimg no-padding">
        </div>
    </form>
    <table class="table text-center table-list mt20">
        <thead>
            <tr>
                <th>用户名</th>
                <th>余额</th>
                <th>返点</th>
                <th>注册时间</th>
                <th>最近登录时间</th>
                <th>登录次数</th>
                <th>登录状态</th>
                <th>代理</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="background:#ffe2ec"><a style="color:#00C" title="查看下级" href="/?mod=user&amp;code=list&amp;seachid=37198&amp;usertype=1" class="blue">iisiis [自己]</a></td>
                <td style="background:#ffe2ec">0.0000</td>
                <td style="background:#ffe2ec">6.5000</td>
                <td style="background:#ffe2ec">2015-09-12</td>
                <td style="background:#ffe2ec">2015-10-08</td>
                <td style="background:#ffe2ec">17</td>
                <td style="background:#ffe2ec">
                    <font color="#22de0e">在线</font>
                </td>
                <td style="background:#ffe2ec">是</td>
                <td style="background:#ffe2ec">正常</td>
                <td style="background:#ffe2ec">
                    <a href="javascript:void(0)" onclick="openbj('团队余额','/?mod=user&amp;code=team&amp;perid=37198&amp;flag=yes',480,350,true);" class="blue">[团队]</a>
                    <a href="javascript:void(0)" onclick="openbj('下级投注','/?mod=records&amp;code=list&amp;perids=37198&amp;flag=yes',950,450,true);" style="cursor: hand">[投注]</a>
                    <a href="javascript:void(0)" onclick="openbj('下级帐变','/?mod=report&amp;code=orders&amp;perids=37198&amp;flag=yes',950,450,true);" style="cursor: hand">[帐变]</a>
                </td>
            </tr>
            <tr>
                <td>tom123</td>
                <td>0.0000</td>
                <td>1.8000</td>
                <td>2015-10-09</td>
                <td></td>
                <td>0</td>
                <td>离线</td>
                <td>是</td>
                <td>正常</td>
                <td>
                    <a href="javascript:void(0)" onclick="openbj('团队余额','/?mod=user&amp;code=team&amp;perid=45997&amp;flag=yes',480,350,true);" class="blue">[团队]</a>
                    <a href="javascript:void(0)" onclick="openbj('下级投注','/?mod=records&amp;code=list&amp;perids=45997&amp;flag=yes',950,450,true);" style="cursor: hand">[投注]</a>
                    <a href="javascript:void(0)" onclick="openbj('下级帐变','/?mod=report&amp;code=orders&amp;perids=45997&amp;flag=yes',950,450,true);" style="cursor: hand">[帐变]</a>
                    <a href="javascript:void(0)" onclick="openbj('下级编辑','/do.php?mod=user&amp;code=rebate&amp;perid=45997&amp;flag=yes',680,500,false);" style="cursor: hand">[编辑]</a>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="page text-center mt10">
    </div>
    <div class="dashed mt30">
        <h4 class="title">注意</h4>
        <p>只能 编辑 或者 充值您的直属会员</p>
    </div>
                     
               
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


