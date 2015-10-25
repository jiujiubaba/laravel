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
                    <h3 class="box-title">申请充值列表</h3>
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
                                <th>状态</th>
                                <th>最后登录</th>
                                <th>操作</th>
                            </tr>
                            @if (count($recharges))


                            @else 
                                <tr>
                                    <td colspan=""></td>
                                </tr>


                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="box-tools">
                        <!-- <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="#">«</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">»</a></li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
