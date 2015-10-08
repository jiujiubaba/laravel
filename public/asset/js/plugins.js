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
    content = contont != undefined ? contont : '正在处理中, 请稍后...';
    w = w != undefined ? parseInt(w) : '220';
    h = h != undefined ? parseInt(h) : '60';
    var margin = "" + (-(h / 2)) + 'px 0 0 ' + (-(w / 2)) + "px";
    // $body.stop().append('<div class="ll" style="height:600px;  width:100%; position:fixed;top:0px;left:0px;"><div id="HLoading" style="width:160px;height:100px;line-height:100px;background:rgba(0,0,0,0.6);color:#fff;textalign:center;position:fixed;top:50%;left:50%;margin:'+margin+';">加载中</div></div>');
    $('body').stop().append('<div id="HLoading" style="width:' + w + 'px;height:' + h + 'px;line-height:' + h + 'px;background:rgba(0,0,0,0.6);color:#fff;text-align:center;position:fixed;top:50%;left:50%;margin:' + margin + ';">' + contont + '</div>');
}

/**
 * @decription 隐藏加载框
 */
function hideLoading() { //移除加载
    $('#HLoading').remove();
}

+ (function($, window, document) {
    var $body = $('body');

    $.fn.extend({
        "modal": function(callback) {
            $('body').append('<div class="modal-backdrop"></div>');
            var _this = $(this);
            var target = _this.attr('data-target');
            var modal = $('#' + target);
            var k;
            _this.click(function(event) {
                k = $(this);
                if (modal.css('display') == 'none') {
                    modal.show();
                    $('.modal-backdrop').show();
                } else {
                    modal.hide();
                    $('.modal-backdrop').hide();
                }
            });

            modal.find('.closes').click(function(event) {
                modal.hide();
                $('.modal-backdrop').hide();
            });

            modal.find('.success').click(function() {
                var b = callback(k);
                if (b) {
                    modal.hide();
                    $('.modal-backdrop').hide();
                }
            });
        },
        "showDialog": function(title, content, callback) {
            $('body').append('<div class="modal-backdrop"></div>');
            var width = $body.width() / 2 - 180;

            var dialog = '<div id="Dialog" class="dialog" style="left:'+ width +'px"><div class="dialog-title"><button type="button" class="close closes"><span aria-hidden="true">×</span></button><h5 class="modal-title" id="myModalLabel">'+ title +'</h5></div><div class="dialog-body">'+ content +'</div><div class="dialog-footer"><button type="button" class="btn btn-danger closes">取消</button><button type="button" class="btn btn-success success">确定</button></div></div>';
            $('body').append(dialog);
            $('.modal-backdrop').show();
            $('#Dialog').show();

            $('#Dialog').find('.closes').click(function(){
                $('body').hideDialog();
            });

            $('#Dialog').find('.success').click(function() {
                callback();
                $('body').hideDialog();
            });
        },
        "hideDialog": function(){
            $('#Dialog').remove();
            $('.modal-backdrop').remove();
        },
        /**
         * @decription 给方法添加加载函数
         * @param content : string 加载文字
         * @param w : string 加载框宽度
         * @param h : string 加载框高度
         */
        "showLoading": function(contont, w, h) { //显示加载
            contont = contont != undefined ? contont : '正在处理中, 请稍后...';
            w = w != undefined ? parseInt(w) : '220';
            h = h != undefined ? parseInt(h) : '60';
            var margin = "" + (-(h / 2)) + 'px 0 0 ' + (-(w / 2)) + "px";
            // $body.stop().append('<div class="ll" style="height:600px;  width:100%; position:fixed;top:0px;left:0px;"><div id="HLoading" style="width:160px;height:100px;line-height:100px;background:rgba(0,0,0,0.6);color:#fff;textalign:center;position:fixed;top:50%;left:50%;margin:'+margin+';">加载中</div></div>');
            $body.stop().append('<div id="HLoading" style="width:' + w + 'px;height:' + h + 'px;line-height:' + h + 'px;background:rgba(0,0,0,0.6);color:#fff;text-align:center;position:fixed;top:50%;left:50%;margin:' + margin + ';">' + contont + '</div>');
        },
        "hideLoading": function() { //移除加载
            $('#HLoading').remove();
        },
    });
})(jQuery, window, document);
