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
                    <a href="#" class="fr">添加银行</a>
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
                            <tr>
                            	<td>adf</td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
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
