@extends('layouts.base')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">代理管理</h4>
    <ul class="content-nav clearfix">
        <li><a href="/agent">会员列表</a></li>
        <li><a href="/agent/register">会员注册</a></li>
        <li class="current"><a href="/agent/share">注册推广</a></li>
        <li><a href="/agent/bonuses">代理分红</a></li>
    </ul>
</div>
<div class="table-area">
    <div class="dashed mt30">
        <h4 class="title">使用提示</h4>
        <p>1、每个会员最多可以添加 3 个注册推广网址。</p>
        <p> 2、新建自动推广注册网址后，点击【网址】，打开的网页地址栏中显示推广网址。</p>
        <p>3、自动推广注册会员最大返点为： 7.0，不需要开户配额。</p>
        <p>4、您已经拥有了1个推广网址,【编辑】可以调整返点。</p>
    </div>
    <table class="table text-center mt30">
        <thead>
            <tr>
                <th>序号</th>
                <th>模式</th>
                <th>时时彩</th>
                <th>11选5</th>
                <th>低频</th>
                <th>基诺</th>
                <th>快乐十分</th>
                <th>快3</th>
                <th>幸运赛车</th>
                <th>短域名</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>1800</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>http://t.im/k4bede</td>
                <td>
                    <a href="javascript:viod(0)" onclick="openbj('修改推广链接','/do.php?mod=user&amp;code=rebate&amp;flag=yes&amp;perid=37198&amp;comes=demo&amp;reb_no=2715329&amp;nexgo=edit',680,520)">编辑</a>
                    <a class="ml5" target="_blank" href="/joyin.php?id=MzcxOThfMjcxNTMyOQ==">网址</a>
                    <a class="ml5" onclick="delreg(2715329)" href="javascript:void(0)">删除</a>
                </td>
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


