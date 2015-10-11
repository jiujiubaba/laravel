// 插件
function swals(type, tips) {
    var tip = '';
    tips = tips !== 'undefined' ? tips : '成功啦！';
    if (type == 'success') {
        tip += '<div class="HTooltip slideInDown animated" style="width:280px;padding:10px;text-align:center;background-color:#5BB75B;color:#fff;position:fixed;top:10px;left:50%;z-index:100001;margin-left:-150px;box-shadow:1px 1px 5px #333;-webkit-box-shadow:1px 1px 5px #333;">' + tips + '</div>';
    }

    if (type == 'error') {
        tip += '<div class="HTooltip shake animated" style="width:280px;padding:10px;text-align:center;background-color:#D84C31;color:#fff;position:fixed;top:10px;left:50%;z-index:100001;margin-left:-150px;box-shadow:1px 1px 5px #333;-webkit-box-shadow:1px 1px 5px #333;">' + tips + '</div>';
    }

    $('body').append(tip);
    setTimeout(function() {
        $('.HTooltip').remove();
    }, 2500);
}

/**
 * @decription 加载框插件
 * @param content : string 加载文字
 * @param w : string 加载框宽度
 * @param h : string 加载框高度
 */
function showLoading(content, w, h) { //显示加载
    content = content != undefined ? content : '正在处理中, 请稍后...';
    w = w != undefined ? parseInt(w) : '240';
    h = h != undefined ? parseInt(h) : '120';
    var margin = "" + (-(h / 2)) + 'px 0 0 ' + (-(w / 2)) + "px";
    // $body.stop().append('<div class="ll" style="height:600px;  width:100%; position:fixed;top:0px;left:0px;"><div id="HLoading" style="width:160px;height:100px;line-height:100px;background:rgba(0,0,0,0.6);color:#fff;textalign:center;position:fixed;top:50%;left:50%;margin:'+margin+';">加载中</div></div>');
    $('body').stop().append('<div id="HLoading" class="ui-loading" style="width:' + w + 'px;height:' + h + 'px;margin:' + margin + ';"><div><i class="icon-spinner icon-spin" style="font-size:60px;margin-top:10px; margin-bottom:20px;"></i></div>' + content + '</div>');
}

/**
 * @decription 隐藏加载框
 */
function hideLoading() { //移除加载
    $('#HLoading').remove();
}

+ (function($, window, document) {
    $.fn.extend({
        "modal": function(options) {
            var _this = $(this);

            var config = $.extend(true, {
                type: 1,
                ok: $.noop, //点击确定的按钮回调
                cancel: $.noop, //点击取消的按钮回调
            }, options);

            console.log(config.type);

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
                _this.hide();
                _this.unbind("keydown");
                config.ok();
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
