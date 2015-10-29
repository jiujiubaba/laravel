function submitNick(){
    var action = "&action=nickname";
    if ($('#nickname').val() == '') {
        return toastr.warning('昵称不能不能为空');
    }
    $$.confirm({
        title: '温馨提示',
        content: '确定修改昵称么?',
        confirm: function() {
            res.post('/account/update', $('#form3').serialize() + action, function(data) {
                if (data.result) {
                    toastr.success(data.message);
                    window.location.href = '/account/edit';
                } else {
                    toastr.warning(data.message);
                }
            });
        },
    });
}
function submitCoinPasswd() {
    var action = "&action=coinpasswd";
    var old_bank = $('#old_bank').val();
    var new_bank = $('#new_bank').val();
    var two_new_bank = $('#two_new_bank').val();

    if (new_bank == '') {
        return toastr.warning('新资金密码不能为空');
    } else if (new_bank.length < 6 || new_bank.length > 20) {
        return toastr.warning('密码应该在6-20位数字字母组成');
    } else if (two_new_bank == '') {
        return toastr.warning('确认资金密码不能为空');
    } else if (new_bank != two_new_bank) {
        return toastr.warning('两次输入密码不一致');
    }


    $$.confirm({
        title: '温馨提示',
        content: '确定修改资金密码么?',
        confirm: function() {
            res.post('/account/update', $('#form2').serialize() + action, function(data) {
                if (data.result) {
                    toastr.success(data.message);
                    window.location.href = '/account/edit';
                } else {
                    toastr.warning(data.message);
                }
            });
        },
    });
}
// 修改密码
function submitPasswd() {
    var action = "&action=passwd";
    var old_value = $('#old_pass').val();
    var new_value = $('#new_pass').val();
    var two_new_pass = $('#two_new_pass').val();
    if (old_value == '') {
        return toastr.warning('旧登录密码不能为空');
    } else if (old_value.length < 6 || old_value.length > 20) {
        return toastr.warning('密码应该在6-20位数字字母组成');
    } else if (new_value == '') {
        return toastr.warning('新登录密码不能为空');
    } else if (two_new_pass == '') {
        return toastr.warning('确认密码不能为空');
    } else if (new_value != two_new_pass) {
        return toastr.warning('两次输入密码不一致');
    }
    $$.confirm({
        title: '温馨提示',
        content: '确定修改密码么?',
        confirm: function() {
            // alert('Confirmed!');
            res.post('/account/update', $('#form1').serialize() + '&_token=' + $('#_token').val() + action, function(data) {
                if (data.result) {
                    toastr.success(data.message);
                    window.location.href = '/account/edit';
                } else {
                    toastr.warning(data.message);
                }
            });
        }
    });
}
