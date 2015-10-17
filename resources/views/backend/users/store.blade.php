@extends('layouts.backend')

@section('content')
<!-- 面包屑导航 -->
<section class="content-header">
    <ol class="breadcrumb" style="float:left;">
        <li><a href="#"><i class="fa fa-home"></i>首页</a></li>
        <li class="active">管理员列表</li>
    </ol>
</section>
<!-- 主体内容 -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">添加会员</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="alert alert-success" style="margin:0px 20px;" id="user-alert">
                        <h4>添加成功</h4>
                        <p>This is a green callout.</p>
                    </div>
                    <form class="form-horizontal" id="j-add-user">
                        <div class="box-body"> 
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">会员类型</label>
                                <div class="col-sm-6 radio">
                                    <label>
                                        <input type="radio" name="type" value="1" checked=""> 代理
                                    </label>
                                    <label style="margin-left:30px;">
                                        <input type="radio" name="type" value="0"> 会员
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label">用户名：</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="请输入用户名">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">密码：</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control"  name="password" id="password" placeholder="请输入密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="two_password" class="col-sm-3 control-label">确认密码：</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control"  name="two_password" id="confirm-password" placeholder="请确认密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="qq" class="col-sm-3 control-label">联系QQ：</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="qq" id="qq" placeholder="请输入联系QQ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fandian" class="col-sm-3 control-label">返点(%)：</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="fandian" id="fandian" placeholder="请输入返点">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <div class="col-sm-offset-3 col-sm-10">
                       <button type="submit" class="btn btn-sx btn-success" id="add">添加会员</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
<script type="text/javascript">
$(function(){
    $('#user-alert').hide();
    $('#add').click(function(){
        var username = $('#username').val();
        var password = $('#password').val();
        var two_password = $('#confirm-password').val();
        var qq = $('#qq').val();
        var fandian = $('#fandian').val();

        if (username == '') {
            return toastr.warning('请输入用户名');
        }

        if (password == '') {
            return toastr.warning('请输入密码');
        }
        if (two_password == '') {
            return toastr.warning('请输入确认密码');
        }

        if (qq == '') {
            return toastr.warning('请输入联系QQ');
        }
        if (fandian == '') {
            return toastr.warning('请输入返点');
        }

        if (password.length < 6 || password.length > 20) {
            return toastr.warning('密码长度应为6-20位');
        }

        if (password != two_password) {
            return toastr.warning('两次密码不一致');
        }
        
        swal({
            title: "确定添加用户么？",
            text: "用户名: " +　username + "，" + "返点：" + fandian,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            confirmButtonText: '确定',
            closeOnConfirm: false,
            cancelButtonText: "取消",
            //closeOnCancel: false
        },
        function(){
            window.parent.NProgress.start();
            $.post('/account/update-nickname',$('#form3').serialize()+'&_token=' +token, function(data){
                window.parent.NProgress.done();
                if (data.result) {
                    toastr.success("昵称修改成功！");
                } else {
                    toastr.error(data.message);
                }
            });
        });
    });
});
</script>
@stop
