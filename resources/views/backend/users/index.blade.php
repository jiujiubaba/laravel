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
                    <h3 class="box-title">用户列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped ">
                        <tbody>
                            <tr>
                                <th>用户名</th>
                                <th>ID</th>
                                <th>类型</th>
                                <th>可用余额</th>
                                <th>积分|等级</th>
                                <th>中奖|返点</th>
                                <th>投注|盈亏</th>
                                <th>返点</th>
                                <th>状态</th>
                                <th>最后登录</th>
                                <th>操作</th>
                            </tr>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->id }}</td>
                                <td>@if ($user->type) 代理 @else 会员 @endif</td>
                                <td>{{ $user->cash }}</td>
                                <td>{{ $user->score }} | {{ $user->level }}</td>
                                <td>0|0</td>
                                <td>0|0</td>
                                <td>{{ $user->fandian }}%</td>
                                <td>@if ($user->status) 开启 @else 关闭 @endif</td>
                                <td></td>
                                <td>统计|帐变|编辑|下级|删</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="box-tools">
                        <?php echo $users->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
