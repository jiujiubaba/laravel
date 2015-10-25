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
                                <th>用户编号</th>
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
                                        <td>{{ $withdraw->user_id }}</td>
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
                                              <button type="button" class="btn btn-sm btn-success " data-toggle="modal" data-target="#M-recharge">到账处理</button>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">暂无提现记录</td>
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

@stop
