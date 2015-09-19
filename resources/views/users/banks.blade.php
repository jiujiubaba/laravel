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
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>建设银行</td>
                <td><a href="#">********5555</a></td>
                <td>2015-09-14</td>
                <td>审核中</td>
                <td><a href="#" onclick="showlock(30568,'')">锁定</a></td>
            </tr>
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
                                    <option value="|工商银行">工商银行</option>
                                    <option value="|建设银行">建设银行</option>
                                    <option value="|农业银行">农业银行</option>
                                    <option value="|招商银行">招商银行</option>
                                    <option value="|中国银行">中国银行</option>
                                    <option value="|交通银行">交通银行</option>
                                </select>
                            </div>
                            <div class="mt15">
                                <span class="ui-title inline">开户银行省份：</span>
                                <input type="text" class="ui-input input" id="shengfen" name="shengfen">
                            </div>
                            <div class="mt15">
                                <span class="ui-title inline">开户银行城市：</span>
                                <input type="text" class="ui-input input" id="chengshi" name="chengshi">
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
    console.log(a);
});
</script>

<script src="/asset/js/index.js"></script>
@stop


