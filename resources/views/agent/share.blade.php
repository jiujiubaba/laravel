@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">代理管理</h4>
    <ul class="content-nav clearfix">
        <li><a href="/agent">会员列表</a></li>
        <li><a href="/agent/register">会员注册</a></li>
        <li class="current"><a href="/agent/link">注册推广</a></li>
        <li><a href="/agent/bonuses">代理分红</a></li>
    </ul>
</div>
<div class="table-area">
    <div class="dashed mt30">
        <h4 class="title">使用提示</h4>
        <p>1、每个会员最多可以添加 3 个注册推广网址。</p>
        <p> 2、新建自动推广注册网址后，点击【网址】，打开的网页地址栏中显示推广网址。</p>
        <p>3、自动推广注册会员最大返点为： 7.0，不需要开户配额。</p>
        <p>4、您已经拥有了1个推广网址,【编辑】可以调整返点。</p>
    </div>
    <table class="table text-center mt30">
        <thead>
            <tr>
                <th>序号</th>
                <th>会员类型</th>
                <th>游戏返点</th>
                <th>短域名</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($links as $key => $link) 
            <tr>
                <td>{{ $key+1 }}</td>
                <td>@if ($link->type) 代理 @else 会员 @endif</td>
                <td>{{ $link->fandian }}</td>
                <td>{{ $link->url }}</td>
                <td>
                    <a onclick="openModal('edit', {ok:check, data:{{ $link->id }},loading:load })">编辑</a>
                    <a class="ml5" target="_blank" href="/joyin.php?id=MzcxOThfMjcxNTMyOQ==">网址</a>
                    <a class="ml5" onclick="delreg(2715329)" href="javascript:void(0)">删除</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center"><input type="button" class="mt20 ml10 ui-btn important-nothumb btn-important" value="添加推广链接" id="bt" onclick="openModal('new',{ok: checkLinks});"></div>
</div>

<!-- 添加银行卡 -->
<div class="ui-modal" id="new">
    <div class="ui-modal-backdrop"></div>
    <div class="modal-content">
        <div class="modal-header">
            <span class="tt">添加推广链接</span>
            <i class="icon-remove close-icon cancel"></i>
        </div>
        <div class="modal-body">
            <form id="J-form-links">
                <div class="table-area">
                    <div class="ui-content mt20">
                        <div class="dashed">
                            <h4 class="title">返点提示</h4>
                            <p>1、上级设置了返点，其下级才能设置返点，上下级返点差为[0.1]</p>
                            <p>2、修改下级返点时，所改的返点值不能小于已设的返点值。</p>
                            <p>3、按要求正确填写好返点值后，请点击"提交"按钮。</p>
                        </div>
                        <div class="mt15">
                            <span class="ui-title inline">会员类型</span>
                            <select class="ui-input select" name="type" id="type">
                                <option value="">请选择会员类型</option>
                                <option value="1">代理</option>
                                <option value="0">会员</option>
                            </select>
                        </div>
                        <div class="mt15">
                            <span class="ui-title inline">返点</span>
                            <input type="text" class="ui-input input" id="fandian" name="fandian">
                        </div>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer mt30">
            <div class="btnGroup">
                <button  type="button" class="ui-btn ok" >确定</button>
                <button type="button" class="ui-btn cancel">取消</button>
            </div>
        </div>
    </div>
</div>

<!-- 添加银行卡 -->
<div class="ui-modal" id="edit">
    <div class="ui-modal-backdrop"></div>
    <div class="modal-content">
        <div class="modal-header">
            <span class="tt">修改推广链接</span>
            <i class="icon-remove close-icon cancel"></i>
        </div>
        <div class="modal-body">
            <form id="J-form-links">
                <div class="table-area">
                    <div class="ui-content mt20">
                        <div class="dashed">
                            <h4 class="title">返点提示</h4>
                            <p>1、上级设置了返点，其下级才能设置返点，上下级返点差为[0.1]</p>
                            <p>2、修改下级返点时，所改的返点值不能小于已设的返点值。</p>
                            <p>3、按要求正确填写好返点值后，请点击"提交"按钮。</p>
                        </div>
                        <div class="mt15">
                            <span class="ui-title inline">会员类型</span>
                            <select class="ui-input select" name="type" id="type">
                                <option value="">请选择会员类型</option>
                                <option value="1">代理</option>
                                <option value="0">会员</option>
                            </select>
                        </div>
                        <div class="mt15">
                            <span class="ui-title inline">返点</span>
                            <input type="text" class="ui-input input" id="fandian" name="fandian">
                        </div>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer mt30">
            <div class="btnGroup">
                <button  type="button" class="ui-btn ok" >确定</button>
                <button type="button" class="ui-btn cancel">取消</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>

function openModal(target, options)
{
    console.log('sdfadf');
    var selector = '#' + target;
    var parentBody = $('body', window.parent.document);
    parentBody.append($(selector).clone());
    var _this = $('body', window.parent.document).find(selector);
    var config = $.extend(true, {
        type: 1,
        data: '',
        ok: $.noop, //点击确定的按钮回调
        cancel: $.noop, //点击取消的按钮回调
        loading: $.noop
    }, options);

     _this.show();
    var $ok = _this.find('.ok');
    var $cancel = _this.find('.cancel');
    bind();
    function bind() {
        config.loading(_this, config.data);
        //点击确认按钮
        $ok.click(doOk);

        //回车键触发确认按钮事件
        _this.bind("keydown", function(e) {
            if (e.keyCode == 13) {
                doOk();
            }
        });

        //点击取消按钮
        $cancel.click(doCancel);
    }

    //确认按钮事件
    function doOk() {
        
        _this.unbind("keydown");
        console.log('sadfasdf');

        if (config.ok(_this, config.data) === true) {
            _this.hide();
            _this.remove();
        }
    }

    //取消按钮事件
    function doCancel() {
        _this.hide();
        _this.remove();
        _this.unbind("keydown");
        config.cancel();           
    }
}
var toastr = window.parent.toastr;

function load(ele, datas)
{
    console.log(datas);
    window.parent.R('/agent/link',{
        type: 'show',
        id: datas,
        ok: function(data){
            console.log(data);
        }
    });
}


function checkLinks(ele)
{
    if (ele.find('#type').val() == '') {
        return toastr.warning('请选择会员类型');
    }else if (ele.find('#fandian').val() == '') {
        return toastr.warning('请填写返点');
    }
    window.parent.R('/agent/link',{
        type: 'show',
        reload: true,
        data: ele.find('#J-form-links').serialize(),
        ok: function(data){
            console.log(data);
        }
    });

    return true;  
}

function check(ele, data){
    window.parent.R('/agent/link',{
        type: 'show',
        id: data,
        ok: function(data){
            console.log(data);
        }
    });
}

</script>

@stop


