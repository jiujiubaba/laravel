// $('.nav-list li').click(function() {
// 	$(this).addClass('current').siblings().removeClass('current');
// });
// 
// 
$('#update_nickname').click(function(event) {
	
	var val = $('#nickname').val();
	console.log(val);
	if (val == '') {
		$('#form3').find('.color-red').html('昵称不能为空');
		// alert('昵称不能为空');
	}else{
		$('#form3').find('.color-red').html('');
	}
	$.post('/update-nickname', $('#form3').serialize(), function(data){
		console.log(data);
	});
});
$('#update_passwd').click(function(event) {
	// $.post('/loginTo', $('#form3').serialize(), function(data){
	// 	console.log(data);
	// });
	console.log($('#form1').serialize());
});
$('#update_coin_passwd').click(function(event) {
	// $.post('/loginTo', $('#form3').serialize(), function(data){
	// 	console.log(data);
	// });
	console.log($('#form2').serialize());
});

