@extends('layouts.backend')

@section('content')
<!-- 面包屑导航 -->
<section class="content-header">
  <ol class="breadcrumb" style="float:left;">
    <li><a href="#"><i class="fa fa-home"></i>首页</a></li>
    <li class="active">业务流水</li>
    <li class="active">提现请求</li>
  </ol>
</section>

<!-- 主体内容 -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">提现请求</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped ">
                        <tbody>
                            <tr>
                                <th>用户名</th>
                                <th>上级关系</th>
                                <th>提现金额</th>
                                <th>银行类型</th>
                                <th>开户姓名</th>
                                <th>银行账户</th>
                                <th>开户行</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            @if (count($withdraws))
                                @foreach ($withdraws as $withdraw)
                                    <tr>
                                        <td>{{ $withdraw->username }}</td>
                                        <td>{{ $withdraw->ancestry }}</td>
                                        <td>{{ $withdraw->money }}</td>
                                        <td>{{ $withdraw->bank_name }}</td>
                                        <td>{{ $withdraw->name }}</td>
                                        <td>{{ $withdraw->account }}</td>
                                        <td>{{ $withdraw->address }}</td>
                                        <td>{{ $withdraw->created_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                              <button type="button" class="btn btn-sm btn-success " data-toggle="modal" data-target="#M-withdraw" onclick="confirmWithdraw({{$withdraw->id}})">到账处理</button>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10" class="text-center">暂无提现记录</td>
                                </tr>
                            @endif 
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="box-tools">
                        <?php echo $withdraws->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- 确认到账 -->
<div class="modal fade" id="M-withdraw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">提款处理</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="f-withdraw">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">银行类型:</label>
                            <div class="col-sm-9">
                                <span class="form-control" style="border:0" ><span id="bank">加载中....</span> <a href="" id="home_page" target="_blank">进入银行>></a></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">开户姓名:</label>
                            <div class="col-sm-9">
                                <span class="form-control" style="border:0" id="name">加载中....</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">银行账号:</label>
                            <div class="col-sm-9">
                                <span class="form-control" style="border:0" id="account">加载中....</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">提取金额:</label>
                            <div class="col-sm-9">
                                <span class="form-control" style="border:0" id="money">加载中....</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">提现结果:</label>
                            <div class="col-sm-9 radio">
                                <label>
                                <input type="radio" name="type" value="1" checked="">提现成功(扣除冻结款)
                                </label>
                                <label style="margin-left:30px;">
                                    <input type="radio" name="type" value="0">提现失败(返还冻结款)
                                </label>
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
var withdrawId;
var _token = $('#_token').val();
console.log(_token);
function confirmWithdraw(id)
{
    withdrawId = id;
    console.log(id);
}


$(function(){
    $('#M-withdraw').on('shown.bs.modal', function (e) {
        var $bank = $('#bank'),
            $name = $('#name'),
            $account = $('#account'),
            $money = $('#money'),
            $arrival = $('#arrival'),
            $home_page = $('#home_page'),
            $id = $('#_id');


        console.log('sdf');
        $.get('/backend/business/withdraw/' + withdrawId, {_token: _token}, function(data){
            var withdraw = data.withdraw;
            $bank.html(withdraw.bank_name);
            $name.html(withdraw.name);
            $account.html(withdraw.account);
            $money.html(withdraw.money);
            $home_page.attr('href', withdraw.home_page);
            $id.val(withdraw.id);
        });
    });

    $('.modal-confirm').click(function(){
        console.log($('#f-withdraw').serialize());

        if ($('#_id').val() == '') {
            return toastr.warning('数据错误,请刷新网页');
        }

        // if ($('#arrival').val() <= 0) {
        //     return toastr.warning('实际到账金额不能小于0');
        // }

        NProgress.start();
        $.post('/backend/business/withdraw', $('#f-withdraw').serialize(), function(data){
            NProgress.done();
            if (data.result) {
                // window.location.reload();
                return toastr.success(data.message);
                
            } else {
                return toastr.error(data.message);
            }
        });
    });
});
    
</script>
@stop