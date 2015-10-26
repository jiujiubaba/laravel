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
                                <th>状态</th>
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
                                            @if ($withdraw->status == 1) 
                                                <span class="text-warning">用户申请</span>
                                            @elseif ($withdraw->status == 2)
                                                 <span class="text-red">已取消</span>
                                            @elseif ($withdraw->status == 3) 
                                                 <span class="text-green">已支付</span>
                                            @elseif ($withdraw->status == 4)
                                                 <span class="text-red">提现失败</span>
                                            @elseif ($withdraw->status == 5)
                                                 <span class="text-">后台删除</span>    
                                            @else
                                                 <span class="text-">确认到帐</span>
                                            @endif
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
@stop

@section('scripts')
<script type="text/javascript">

    
</script>
@stop