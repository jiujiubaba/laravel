@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">我的银行卡</h4>
    <ul class="content-nav clearfix">
        <li><a href="/account">基本信息</a></li>
        <li><a href="/account/messages">我的消息(0)</a></li>
        <li class="current"><a href="/account/banks">我的银行卡</a></li>
        <li><a href="/account/edit">资料修改</a></li>
        <li><a href="#">奖金详情</a></li>
    </ul>
</div>
<div class="table-area">
    <div class="dashed mt30">
        <h4 class="title">使用提示</h4>
        <p>1、每个游戏帐户最多绑定 5 张银行卡 ， 您已经成功绑定 1 张。</p>
        <p>2、银行卡锁定以后，不能增加新的银行卡绑定，同时也不能解绑已绑定的银行卡。 </p>
        <p>3、新绑定的提款银行卡需要绑定时间超过 6 个小时才能正常取款。</p>
        <p>4、一个账户只能绑定同一个开户人姓名的银行卡。</p>
    </div>
    <table class="table-list text-center mt30">
        <thead>
            <tr>
                <th>序号</th>
                <th>银行名称</th>
                <th>卡号</th>
                <th>绑定时间</th>
                <th>是否锁定</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @if ($userBanks) 
                @foreach ($userBanks as $userBank)
                <tr>
                    <td>{{ $userBank['num'] }}</td>
                    <td>{{ $userBank['bank_name'] }}</td>
                    <td><a href="#">{{ $userBank['account'] }}</a></td>
                    <td>{{ $userBank['created_at'] }}</td>
                    <td>@if($userBank['is_lock'] == 0) 
                            否                    
                        @else
                            是
                        @endif</td>
                    <td><a class="J-delete-bank" data-num="{{ $userBank['id'] }}" data-target="delete">
                        @if ($userBank['is_lock'] == 1)
                            解锁
                        @else 
                            锁定
                        @endif
                    </a></td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="7" align="center">暂无数据</td></tr>
            @endif
        </tbody>
    </table>
    <div class="add-banks text-center">
        <button class="ui-btn" id="bt" data-target="myModal">
            <span class="icon-credit-card"></span> 添加银行卡
        </button>
    </div>

</div>

<!-- 添加银行卡 -->
<div class="ui-modal" id="new">
    <div class="ui-modal-backdrop"></div>
    <div class="modal-content">
        <div class="modal-header">
            <span class="tt">添加银行卡</span>
            <i class="icon-remove close-icon cancel"></i>
        </div>
        <div class="modal-body">
            <form id="J-form-banks">
                    <div class="table-area">
                        <div class="ui-content mt20">
                            <div>
                                <span class="ui-title inline">开户银行：</span>
                                <select class="ui-input select" name="bankname" id="idcard">
                                    <option value="">选择银行卡</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->alias }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt15">
                                <span class="ui-title inline">开户银行地址：</span>
                                <input type="text" class="ui-input input" id="shengfen" name="address">
                            </div>
                            <div class="mt15">
                                <span class="ui-title inline">开户人姓名：</span>
                                <input type="text" class="ui-input input" id="uname" name="uname" value="">
                            </div>
                            <div class="mt15">
                                <span class="ui-title inline">银行卡号：</span>
                                <input type="number" class="ui-input input" id="banknum" name="banknum" autocomplete="off" onkeyup="">
                            </div>
                            <div class="mt15">
                                <span class="ui-title inline">资金密码：</span>
                                <input type="password" class="ui-input input" id="pass" name="pass" autocomplete="off">
                            </div>
                            <div class="mt10">
                                <span class="ui-title inline"></span>
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            </div>
                        </div>
                    </div>
                </form>
        </div>
        <div class="modal-footer">
            <div class="btnGroup">
                <button  type="button" class="ui-btn ok" >确定</button>
                <button type="button" class="ui-btn cancel">取消</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<!-- <script src="/asset/js/plugins.js"></script> -->
<script>
+ (function($, window, document) {
    $.fn.extend({
        "modal": function(options) {
            var _this = $(this);

            var config = $.extend(true, {
                type: 1,
                ok: $.noop, //点击确定的按钮回调
                cancel: $.noop, //点击取消的按钮回调
            }, options);


            _this.show();
            

            var $ok = _this.find('.ok');
            var $cancel = _this.find('.cancel');
            bind();
            function bind() {
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
                if (config.ok() === true) {
                    _this.hide();
                }
            }

            //取消按钮事件
            function doCancel() {
                _this.hide();
                _this.unbind("keydown");
                config.cancel();           
            }
        }
    });
})(jQuery, window, document);

var toastr = window.parent.toastr;
$(function(){
    $('#bt').click(function(event) {
        $('#new').modal({ok:function(){
            if ($('#idcard').val() == '') {
                return toastr.warning('请选择银行卡');
            }else if ($('#shengfen').val() == '') {
                return toastr.warning('请填写开户行地址');
            }else if ($('#uname').val() == '') {
                return toastr.warning('请填写开户人姓名');
            }else if ($('#banknum').val() == '') {
                return toastr.warning('请填写银行卡号');
            }
            
            $.post('/banks/add', $('#J-form-banks').serialize(), function(data){
                if (data.result) {
                    location.reload();
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            });
        }});
    });;
})
</script>

@stop


