@extends('layouts.ucenter')

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
        <div class="info-layout-title mt20">
            账户余额：
            <input type="text" class="mr10 w100 input" id="moneymin" name="money_gt" value=""> 至
            <input type="text" class="input w100 ml10 mr10" id="moneymax" name="moneylt" value=""> 时时彩返点：
            <input type="text" class="mr10 w100 input" name="rebates_gt" value="">% 至
            <input type="text" class="input w100 ml10 mr10" name="rebates_lt" value="">%
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
            用户名：
            <input type="text" class="mr10 w100 input" name="pername" value="">
            <input type="submit" value="查询" class="btn ui-btn important-thumb w150 ml10 text-center no-bgimg no-padding">
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
            @foreach ($agents as $agent)
            <tr>
                <td style="background:#ffe2ec">{{ $agent->username}}@if ($agent->id == $user->id)[自己] @endif</td>
                <td style="background:#ffe2ec">{{ $agent->cashes }}</td>
                <td style="background:#ffe2ec">{{ $agent->fandian }}</td>
                <td style="background:#ffe2ec">{{ $agent->created_at->format('Y-m-d') }}</td>
                <td style="background:#ffe2ec"></td>
                <td style="background:#ffe2ec">{{ $agent->sign_in_cnt }}</td>
                <td style="background:#ffe2ec">
                    <font color="#22de0e">在线</font>
                
                </td>
                <td style="background:#ffe2ec">@if($agent->type) 是 @else 否 @endif</td>
                <td style="background:#ffe2ec">@if($agent->status==0) 正常 @else 停用 @endif</td>
                <td style="background:#ffe2ec">
                    <a href="javascript:void(0)" onclick="openbj('团队余额','/?mod=user&amp;code=team&amp;perid=37198&amp;flag=yes',480,350,true);" class="blue">[团队]</a>
                    <a href="javascript:void(0)" onclick="openbj('下级投注','/?mod=records&amp;code=list&amp;perids=37198&amp;flag=yes',950,450,true);" style="cursor: hand">[投注]</a>
                    <a href="javascript:void(0)" onclick="openbj('下级帐变','/?mod=report&amp;code=orders&amp;perids=37198&amp;flag=yes',950,450,true);" style="cursor: hand">[帐变]</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="page text-center mt10">
        <?php echo $agents->render(); ?>
    </div>
    <div class="dashed mt30">
        <h4 class="title">注意</h4>
        <p>只能 编辑 或者 充值您的直属会员</p>
    </div>              
</div>
@stop

@section('scripts')
<script>
$(function(){
    var _token = "<?php echo csrf_token(); ?>";
})
</script>

@stop


