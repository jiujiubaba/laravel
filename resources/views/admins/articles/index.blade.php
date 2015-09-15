@extends('admins.layout')
@section('content')
<div class="table-responsive w1000 cont_table">
    <div class="container conditions">
      <div class="row">
        <div class="col-md-3">
            <dl class="dropmenu">
                <dt value="0"><span class="dropmenu-value">全部</span><span class="caret"></span></dt>
                <ul>
                  <li value="1">选项1</li>
                  <li value="2">选项2</li>
                  <li value="3">选项3</li>
                  <li value="4">选项4</li>
                </ul>
                <input type="hidden" name="select" value="0">
            </dl>
        </div>
        <div class="col-md-3">
            <dl class="dropmenu">
                <dt value="0"><span class="dropmenu-value">全部</span><span class="caret"></span></dt>
                <ul>
                    <li value="1">选项1</li>
                    <li value="2">选项2</li>
                    <li value="3">选项3</li>
                    <li value="4">选项4</li>
                </ul>
                <input type="hidden" name="select" value="0">
            </dl>
        </div>
        <div class="col-md-3">
          asdfa
        </div>
        <div class="col-md-3">
            <a href="/backend/articles/store">写文章</a>
        </div>
    </div>
  </div>
  <table class="table text-center bgcolor">
    <thead>
      <tr>
        <th class="col-md-1  text-center">#</th>
        <th class="col-md-5 text-center">文章标题</th>
        <th class="col-md-1 text-center">作者</th>
        <th class="col-md-1 text-center">分类目录</th>
        <th class="col-md-1 text-center">标签</th>
        <th class="col-md-1 text-center">浏览量</th>
        <th class="col-md-1 text-center">评论数</th>
        <th class="col-md-2 text-center">日期</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
      </tr>
      <tr>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
      </tr>
      <tr>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
        <td>Table cell</td>
      </tr>
    </tbody>
  </table>
</div>

@stop