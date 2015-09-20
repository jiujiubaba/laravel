@extends('layouts.base')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">我的银行卡</h4>
    <ul class="content-nav clearfix">
        <li><a href="/account">基本信息</a></li>
        <li><a href="/account/messages">我的消息(0)</a></li>
        <li class="current"><a href="/account/banks">我的银行卡</a></li>
        <li><a href="/account/edit">资料修改</a></li>
        <li><a href="#">奖金详情</a></li>
    </ul>
</div>
<div class="table-area">
    <div class="dashed mt30">
        <h4 class="title">使用提示</h4>
        <p>1、每个游戏帐户最多绑定 5 张银行卡 ， 您已经成功绑定 1 张。</p>
        <p>2、银行卡锁定以后，不能增加新的银行卡绑定，同时也不能解绑已绑定的银行卡。 </p>
        <p>3、新绑定的提款银行卡需要绑定时间超过 6 个小时才能正常取款。</p>
        <p>4、一个账户只能绑定同一个开户人姓名的银行卡。</p>
    </div>
    <table class="table-list text-center mt30">
        <thead>
            <tr>
                <th>序号</th>
                <th>银行名称</th>
                <th>卡号</th>
                <th>绑定时间</th>
                <th>状态</th>
                <th>默认</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @if ($userBanks) 
                @foreach ($userBanks as $userBank)
                <tr>
                    <td>{{ $userBank['num'] }}</td>
                    <td>{{ $userBank['bank_name'] }}</td>
                    <td><a href="#">{{ $userBank['account'] }}</a></td>
                    <td>{{ $userBank['created_at'] }}</td>
                    <td>@if($userBank['status'] == 0) 
                            关闭                    
                        @else
                            开启
                        @endif
                    </td>
                    <td>@if($userBank['is_default'] == 0) 
                            否                    
                        @else
                            是
                        @endif</td>
                    <td><a href="#" onclick="showlock(30568,'')">开启</a> | <a href="">关闭</a></td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="7" align="center">暂无数据</td></tr>
            @endif
        </tbody>
    </table>
    <div class="add-banks text-center">
        <button class="ui-btn" id="bt" data-target="myModal">
            <span class="icon-credit-card"></span> 添加银行卡
        </button>
    </div>

</div>

<div class="modal" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closes" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">绑定银行卡</h4>
            </div>
            <div class="modal-body">
                <form id="J-form-banks">
                    <div class="table-area">
                        <div class="ui-content mt20">
                            <div>
                                <span class="ui-title inline">开户银行：</span>
                                <select class="ui-input select" name="bankid">
                                    <option value="">选择银行卡</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt15">
                                <span class="ui-title inline">开户银行地址：</span>
                                <input type="text" class="ui-input input" id="shengfen" name="address">
                            </div>
                            <div class="mt15">
                                <span class="ui-title inline">开户人姓名：</span>
                                <input type="text" class="ui-input input" id="uname" name="uname" value="帐篷" readonly="">
                            </div>
                            <div class="mt15">
                                <span class="ui-title inline">银行卡号：</span>
                                <input type="text" class="ui-input input" id="banknum" name="banknum" autocomplete="off" onkeyup="clearNoNum(this);">
                            </div>
                            <div class="mt15">
                                <span class="ui-title inline">资金密码：</span>
                                <input type="password" class="ui-input input" id="pass" name="pass" autocomplete="off">
                            </div>
                            <div class="mt10">
                                <span class="ui-title inline"></span>
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <button class="btn important-thumb btn-important edit-button" id="user-login-button" type="button" disabled="" style="background-color:#CCC" >立即绑定</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger closes">取消</button>
                <button type="button" class="btn btn-success success">确定</button>
            </div>
        </div>
    </div>
</div>
<script src="/asset/js/plugins.js"></script>
<script>
$('#bt').modal(function(){
    var a= $('#J-form-banks').serialize();
    $.post('/banks/add', a, function(data){
        console.log(a);
    });    
});
</script>

<script src="/asset/js/index.js"></script>
@stop


