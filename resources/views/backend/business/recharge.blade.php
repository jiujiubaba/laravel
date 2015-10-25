@extends('layouts.backend')

@section('content')
<!-- 面包屑导航 -->
<section class="content-header">
  <ol class="breadcrumb" style="float:left;">
    <li><a href="#"><i class="fa fa-home"></i>首页</a></li>
    <li class="active">用户列表</li>
  </ol>
</section>

<!-- 主体内容 -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">充值记录</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped ">
                        <tbody>
                            <tr>
                                <th>用户编号</th>
                                <th>用户名</th>
                                <th>上级关系</th>
                                <th>充值金额</th>
                                <th>实际到账</th>
                                <th>充值前资金</th>
                                <th>充值编号</th>
                                <th>充值银行</th>
                                <th>状态</th>
                                <th>备注</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            @if (count($recharges))
                                @foreach ($recharges as $recharge)
                                    <tr>
                                        <td>{{ $recharge->user_id }}</td>
                                        <td>{{ $recharge->username }}</td>
                                        <td>{{ $recharge->ancestry }}</td>
                                        <td>{{ $recharge->money }}</td>
                                        <td>{{ $recharge->money }}</td>
                                        <td>{{ $recharge->cashes }}</td>
                                        <td>{{ $recharge->sn }}</td>
                                        <td>{{ $recharge->name }}</td>
                                        <td>
                                            @if ($recharge->status == 1)
                                                <span class="text-green">充值成功</span>
                                            @elseif ($recharge->status == 2)
                                                <span class="text-red">充值失败</span>
                                            @else
                                                <span class="text-light-blue">正在充值</span>
                                            @endif
                                        </td>
                                        <td>{{ $recharge->remark }}</td>
                                        <td>{{ $recharge->created_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                              <button type="button" class="btn btn-sm btn-success " data-toggle="modal" data-target="#M-recharge" onclick="confirmRecharge({{ $recharge->id }})" @if ($recharge->status > 0) disabled @endif>到账处理</button>
                                              <button type="button" onclick="disRecharge({{$recharge->id}})" class="btn btn-sm btn-danger" @if ($recharge->status > 0) disabled @endif>未到账</button>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="12">暂无充值记录</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="box-tools">
                        <?php echo $recharges->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 确认到账 -->
<div class="modal fade" id="M-recharge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">处理会员充值</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="f-recharge">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">用户名:</label>
                            <div class="col-sm-9">
                                <span class="form-control" style="border:0" id="username">加载中....</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">充值银行:</label>
                            <div class="col-sm-9">
                                <span class="form-control" style="border:0" id="name">加载中....</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">充值前金额:</label>
                            <div class="col-sm-9">
                                <span class="form-control" style="border:0" id="cashes">加载中....</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">充值金额:</label>
                            <div class="col-sm-9">
                                <span class="form-control" style="border:0" id="money">加载中....</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="account" class="col-sm-3 control-label">实际到账:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="arrival" id="arrival" placeholder="请输入实际到账金额">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">备注:</label>
                            <div class="col-sm-9">
                                <span class="form-control" style="border:0" id="remark">加载中....</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">充值时间:</label>
                            <div class="col-sm-9">
                                <span class="form-control" style="border:0" id="created">加载中....</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="_id" id="_id" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary modal-confirm">确定充值</button>
            </div>
        </div>
    </div>
</div>

@stop


@section('scripts')
<script type="text/javascript">
var rechargeId;
var _token = $('#_token').val();
console.log(_token);
function confirmRecharge(id)
{
    rechargeId = id;
}

function disRecharge(id)
{
    NProgress.start();
    $.get('/backend/business/recharge/' + id + '/edit', {_token: _token}, function(data){
        NProgress.done();
        if (data.result) {
            window.location.reload();
            return toastr.success(data.message);
            
        } else {
            return toastr.error(data.message);
        }
    });
}

$(function(){
    $('#M-recharge').on('shown.bs.modal', function (e) {
        var $username = $('#username'),
            $name = $('#name'),
            $cashes = $('#cashes'),
            $money = $('#money'),
            $arrival = $('#arrival'),
            $remark = $('#remark'),
            $id = $('#_id'),
            $created = $('#created');

        console.log('sdf');
        $.get('/backend/business/recharge/' + rechargeId, {_token: _token}, function(data){
            var recharge = data.recharge;
            $username.html(recharge.username);
            $name.html(recharge.name);
            $cashes.html(recharge.cashes);
            $arrival.val(recharge.money);
            $money.html(recharge.money);
            $remark.html(recharge.remark);
            $created.html(recharge.created_at);
            $id.val(recharge.id);
        });
    });

    $('.modal-confirm').click(function(){
        console.log($('#f-recharge').serialize());

        if ($('#_id').val() == '') {
            return toastr.warning('数据错误,请刷新网页');
        }

        if ($('#arrival').val() <= 0) {
            return toastr.warning('实际到账金额不能小于0');
        }

        NProgress.start();
        $.post('/backend/business/recharge', $('#f-recharge').serialize(), function(data){
            NProgress.done();
            if (data.result) {
                window.location.reload();
                return toastr.success(data.message);
                
            } else {
                return toastr.error(data.message);
            }
        });
    });
});
    
</script>
@stop
