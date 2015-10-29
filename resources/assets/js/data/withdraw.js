
// 申请提现
$('#apply-withdraw').click(function(){
	var money = $('#money').val();
	console.log(money);
    if (money <= 0) {
        return toastr.warning('提款金额不能为0');
    }

    var myMoney = parseFloat($('#my-money').attr('data-money'));

    if (money > myMoney) {
        return toastr.warning('余额不足');
    }

    if ($('#pay-pass').val() == '') {
        return toastr.warning('资金密码不能为空');
    }

    $$.confirm({
	    title: '温馨提示',
	    content: '确定提现么？',
	    confirm: function(){
	        res.post('/banks/apply-withdraw', $('#J-form-withdraw').serialize() , function(data) {
                    location.href = '/banks/withdraw';
                
            });
	    }
	});
});
