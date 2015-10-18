@extends('layouts.backend')

@section('content')
<!-- 面包屑导航 -->
<section class="content-header">
  <ol class="breadcrumb" style="float:left;">
    <li><a href="#"><i class="fa fa-home"></i>首页</a></li>
    <li class="active">系统设置</li>
    <li class="active">公告中心</li>
  </ol>
</section>

<!-- 主体内容 -->
<section class="content" >
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">公告中心</h3>
                    <button type="button" class="btn btn-sx btn-info fr store-bank" data-toggle="modal" data-target="#store">添加公告</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>公告标题</th>
                                <th>发布人</th>
                                <th>是否显示</th>
                                <th>日期</th>
                                <th>操作</th>
                            </tr>
                            @if (count($notices))
                                @foreach ($notices as $notice)
                                <tr>
                                    <td>{{ $notice->title }}</td>
                                    <td>{{ $notice->admin_name }}</td>
                                    <td>@if ($notice->status) 显示  @else 隐藏 @endif</td>
                                    <td>{{ $notice->created_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-sm btn-success edit" data-toggle="modal" data-target="#edit" data-id="{{ $notice->id }}">修改</button>
                                          <button type="button" class="btn btn-sm btn-success delete" data-id="{{ $notice->id }}">删除</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center">暂无公告</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @if (count($notices))
                <div class="box-footer">
                    <div class="box-tools">
                        <?php echo $notices->render(); ?>
                    </div>
                </div>
                @endif             
            </div>
        </div>
    </div>
</section>

<!-- 添加公告弹出层 -->
<div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">添加公告</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="f-store">
                    <div class="box-body" style="margin:0px 10px;">
                        <div class="form-group">
                            <label>公告标题</label>
                            <input type="text" class="form-control" name="title" placeholder="请输入标题...">
                        </div>
                        <div class="form-group">
                            <label>公告内容</label>
                            <textarea class="form-control" rows="10" name="content" placeholder="请输入内容..."></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary modal-confirm">添加</button>
            </div>
        </div>
    </div>
</div>

<!-- 修改公告弹出层 -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">修改公告</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="f-edit">
                    <div class="box-body" style="margin:0px 10px;">
                        <div class="form-group">
                            <label>公告标题</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="请输入标题...">
                        </div>
                        <div class="form-group">
                            <label>公告内容</label>
                            <textarea class="form-control" rows="10" name="content" id="content" placeholder="请输入内容..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class=" control-label">是否显示：</label>
                            <div class=" radio">
                                <label>
                                    <input type="radio" name="status" value="1" checked=""> 显示
                                </label>
                                <label style="margin-left:30px;">
                                    <input type="radio" name="status" value="0"> 隐藏
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="_id" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-success" id="confirm-update">修改</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
$(function(){
    var token = '<?php echo csrf_token(); ?>';
    $('#store').on('shown.bs.modal', function (e) {});

    $('.modal-confirm').click(function(){
        var title = $('input[name=title]').val();
        var content = $('textarea[name=content]').val();
        if (title == '') {
            return toastr.warning('请填写标题');
        }
        if (content == '') {
            return toastr.warning('请填写内容');
        }
        $('#store').modal('hide');

        NProgress.start();
        $.post('/backend/systems/notices', $('#f-store').serialize() + '&_token='+token, function(data){
            NProgress.done();
            if (data.result) {
                window.location.reload();
                return toastr.success(data.message);
            } else {
                return toastr.error(data.message);
            }
        });
    });

    $('.edit').click(function(){
        var id = $(this).attr('data-id');
        $('input[name=_id]').val(id);
        NProgress.start();
        $.get('/backend/systems/notices/'+id, '', function(data){
            NProgress.done();
            $('#title').val(data.notice.title);
            $('#content').val(data.notice.content);
            $("input[value="+data.notice.status+"]").prop("checked", true);
        });
        
    });
    $('.delete').click(function(){
        var id = $(this).attr('data-id');
        NProgress.start();
        $.get('/backend/systems/notices/'+id +'/edit', '', function(data){
            NProgress.done();
            if (data.result) {
                window.location.reload();
                return toastr.success(data.message);
            } else {
                return toastr.error(data.message);
            }
        });
    });
    $('#confirm-update').click(function(){
        NProgress.start();
        $.post('/backend/systems/notices-update', $('#f-edit').serialize() + '&_token='+token, function(data){
            NProgress.done();
            if (data.result) {
                window.location.reload();
                return toastr.success(data.message);
            } else {
                return toastr.error(data.message);
            }
        });
    });
    $('#edit').on('shown.bs.modal', function (e) {});
    
    
});
    
</script>
@stop