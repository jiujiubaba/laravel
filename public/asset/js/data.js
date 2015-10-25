var toastr = window.parent.toastr;

function E(id)
{
	return document.getElementById(id);
}

// // 会员注册页面
// function register()
// {
// 	var username = E('username').value;
// 	var pass = E('pass').value;
// 	var pass2 = E('pass2').value;
// 	var fandian = E('fandian').value;
// 	var type = E('type').value;

// 	var reg = /^[A-Za-z0-9]+$/;
// 	console.log(fandian);
// 	if (username == '') {
// 		toastr.warning('请输入用户名');
// 		return false;
// 	}
// 	if (!username.test(reg)) {
// 		toastr.warning('请输入字母或数字用户名');
// 		return false;
// 	}

// 	if (pass == '') {
// 		toastr.warning('请输入密码');
// 		return false;
// 	}

// 	if (pass2 == '') {
// 		toastr.warning('请输入确认密码');
// 		return false;
// 	}

// 	if (pass != pass2) {
// 		toastr.warning('两次密码不一致');
// 		return false;
// 	}

// 	if (pass.length < 6 || pass.length > 16) {
// 		toastr.warning('密码由6~16位数字或字母组成');
// 		return false;
// 	}

// 	if (type == '') {
// 		toastr.warning('请选择用户类型');
// 		return false;
// 	}

// 	if (fandian == '' || fandian == '0') {
// 		toastr.warning('请选择返点');
// 		return false;
// 	}


// 	return false;
// }

// 代理 - 会员注册 - 表单处理
(function($, window, toastr) {
    var $userName = $('#username'),
        $pass = $('#pass'),
        $pass2 = $('#pass2'),
        $fandian = $('#fandian'),
        $type = $('#type'),
        $qq = $('#qq'),
        $registerForm = $('#J-form-register'),
        $submit = $('#J-btn-register'),
        formData = '';

    $submit.on('click', function(e) {
        formData = $registerForm.serialize();
        var u = $userName.val();
        var reg = new RegExp("and", "g");
        u = u.replace(reg, 'a^n^d');
        reg = new RegExp("or", "g");
        u = u.replace(reg, 'o^r');

        var p = $pass.val();
        reg = new RegExp("and", "g");
        p = p.replace(reg, 'a^n^d');
        reg = new RegExp("or", "g");
        p = p.replace(reg, 'o^r');

        formData = formData + '&u2=' + u + '&p2=' + p;
        if (!checkEmpty()) {
        	return false;
        }

        console.log(formData);
        e.preventDefault();
    });

    var checkEmpty = function() {
        var name = $userName.val();
        pass = $pass.val(), pass2 = $pass2.val(), type = $type.val(), fandian = $fandian.val();

        var regexp = /^([a-zA-Z0-9]){6,20}$/gi;
        var rs = regexp.test(name);
        if (rs == false) {
            toastr.warning('用户名格式错误');
            return false;
        }

        var regexp1 = /^([a-zA-Z0-9]){6,20}$/gi;
        var rs1 = regexp1.test(pass);
        if (rs1 == false && pass != '') {
            toastr.warning('密码格式错误');
            return false;
        }
        if (pass != pass2 || pass2 == '') {
            toastr.warning('两次密码不一致');
            return false;
        }

        if (fandian <= 0) {
        	toastr.warning('请选择会员返点');
        	return false;
        }
        window.parent.R('/agent/store', {
        	method: 'post',
        	data: formData,
        	ok: function(data){
        		setTimeout(function() {
		            window.location.href = "/agent";
		        }, 1000);
      		}
        });
        return true;
    };

    $('#username').on("keyup", function() {
        if ($userName.val() == '') {
            return;
        }
        var name = $userName.val();
        var regexp = /^([a-zA-Z0-9]){6,20}$/gi;
        var rs = regexp.test(name);
        if (rs == false) {
            return $("#tsmsg").html("(用户名必须是6-20个数据和字母组成)").css('color', 'red');
            ;
        } else {
            $("#tsmsg").html('');
        }
    });
    $('#pass').on("keyup", function() {
        if ($pass.val() == '') {
            return;
        }
        var pass = $pass.val();
        var regexp = /^([a-zA-Z0-9]){6,20}$/gi;
        var rs = regexp.test(pass);
        if (rs == false) {
            return $("#tsmsg1").html("(密码必须是6-20个数据和字母组成)").css('color', 'red');
            ;
        } else {
            $("#tsmsg1").html('');
        }
    });

    $('#qq').on("keyup", function() {
        if ($qq.val() == '') {
            return;
        }
        var qq = $qq.val();
        var regexp = /^\d{5,12}$/gi;
        var rs = regexp.test(qq);
        if (rs == false) {
            return $("#tsmsgqq").html("(QQ必须是5-12数字组成)").css('color', 'red');
            ;
        } else {
            $("#tsmsgqq").html('');
        }
    });

    $('#pass2').on("keyup", function() {
        var pass = $pass.val(), pass2 = $pass2.val();
        if (pass != pass2 || pass2 == '') {
            return $("#tsmsg2").html("(密码必须是6-20个数据和字母组成)").css('color', 'red');
            ;
        } else {
            $("#tsmsg2").html('');
        }
    });

    var checkUserName = function() {
        $.post("/do.php?mod=ajax&code=adduser&list=username&flag=yes&username=" + $userName.val(), function(db) {
            if (db == 1) {
                $("#tsmsg").html("(用户名可用)").css('color', '#888');
            } else {
                $("#tsmsg").html("(<font color=red>用户名已存在</font>)");
            }
        });
    }
})(jQuery, window, toastr);