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
                    <h3 class="box-title">管理员列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped ">
                        <tbody>
                            <tr>
                                <th>用户编号</th>
                                <th>用户名</th>
                                <th>上级关系</th>
                                <th>体现金额</th>
                                <th>银行类型</th>
                                <th>开户姓名</th>
                                <th>银行账户</th>
                                <th>开户行</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            
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
