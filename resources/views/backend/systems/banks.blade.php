@extends('layouts.backend')

@section('content')
<!-- 面包屑导航 -->
<section class="content-header">
  <ol class="breadcrumb" style="float:left;">
    <li><a href="#"><i class="fa fa-home"></i>首页</a></li>
    <li class="active">系统设置</li>
    <li class="active">收款设置</li>
  </ol>
</section>

<!-- 主体内容 -->
<section class="content" >
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">银行设置</h3>
                    <button type="button" class="btn btn-sx btn-info fr store-bank" data-toggle="modal" data-target="#add_bank">添加银行</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>银行logo</th>
                                <th>银行名称</th>
                                <th>持卡人</th>
                                <th>账户</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            @foreach ($adminBanks as $adminBank)
                            <tr class="admin-bank">
                            	<td></td>
                            	<td>{{ $adminBank->bank_name }}</td>
                            	<td>{{ $adminBank->name }}</td>
                            	<td>{{ $adminBank->account }}</td>
                            	<td >@if ($adminBank->status) 开启 @else 关闭 @endif</td>
                            	<td>
                                    <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_bank">修改</button>
                                          <button type="button" class="btn btn-sm btn-success j-toggle-status" data-id="{{ $adminBank->id }}">@if (!$adminBank->status) 开启 @else 关闭 @endif</button>
                                          <button type="button" class="btn btn-sm btn-success">删除</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="box-tools">
                        <?php echo $adminBanks->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 天津管理员弹出层 -->
<div class="modal fade" id="add_bank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">添加收款银行</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="f-add-bank">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">银行名称:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="bank" id="bank">
                                    <option value="">请选择开户行</option>
                                    @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">开户姓名:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="name" placeholder="请填写开户姓名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="account" class="col-sm-3 control-label">账号:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="account" id="account" placeholder="请填写银行账号">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">开户行地址:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address" id="address" placeholder="请填写开户行地址">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" id="token" value="<?php echo csrf_token(); ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary modal-confirm">添加</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
$(function(){
    var token = $('#token').val();
    $('#add_bank').on('shown.bs.modal', function (e) {

    });

    $('.modal-confirm').click(function(){
        var bank = $('#bank').val();
        var name = $('#name').val();
        var account = $('#account').val();
        var address = $('#address').val();
        if (bank == '') {
            return toastr.warning('请填写银行');
        }
        if (name == '') {
            return toastr.warning('请填写姓名');
        }

        if (account == '') {
            return toastr.warning('请填写银行账号');
        }
        if (address == '') {
            return toastr.warning('请填写开户行地址');
        }
        $('#add_bank').modal('hide');

        NProgress.start();
        $.post('/backend/systems/bank-store', $('#f-add-bank').serialize() + '&_token=' + token, function(data){
            NProgress.done();
            if (data.result) {
                return toastr.success('添加成功');
                window.location.reload();
            } else {
                return toastr.error(data.message);
            }
        });
    });

    // 变更状态
    $('.j-toggle-status').click(function(){
        var _this = $(this);
        var id = _this.attr('data-id');
        NProgress.start();
        $.post('/backend/systems/bank-update', {id: id,_token:token}, function(data){
            NProgress.done();
            if (data.result) {
                toastr.success(data.message);
                window.location.reload();
            } else {
                toastr.error(data.message);
            }
        });
    });
});
    
</script>
@stop