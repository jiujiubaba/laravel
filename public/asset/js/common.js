// 封装ajax 请求
;(function(window, $, NProgress){
    window.R = function (url, options){
        var c = {
            type: "index",
            method: "get",
            data: "", 
            reload: false,
            ok: $.noop,
            error: $.noop,
            id: 0,
        }

        var config = $.extend(true, c, options);

        if (config.type == 'show') {
            url = url + '/' + id;
        }

        if (config.type == 'store') {
            config.method = "POST";
        }

        if (config.type == 'edit') {
            url = url + '/' + id + '/edit'
        }

        if (config.type == 'update') {
            url = url + '/' + id;
            config.method = 'PUT';
        }

        if (config.type == 'delete') {
            url = url + '/' + id;
            config.method = 'DELETE';
        }


        NProgress.start();
        $.ajax({
            type: config.method,
            data: config.data,
            url: url,
            success: function(returnData){        
                if (returnData.result) {
                    config.reload ? window.location.reload() : "";
                    toastr.success(returnData.message);
                    config.ok(returnData);
                } else {
                    toastr.error(returnData.message);
                    config.error(returnData);
                }
            },
            complete: function(XMLHttpRequest, textStatus){
                NProgress.done();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }
})(window, jQuery, window.parent.NProgress);