

$(function(){
	
	$('.dropmenu').find('dt').click(function(){
		var ul = $(this).siblings('ul');
		ul.css('display') == 'none' ? ul.show(): ul.hide();
		

		// dt.parent('.dropmenu').bind('mouseout', function(){
		// 	ul.hide();
		// });
	});

	$('.dropmenu').find('li').click(function(){
		var li = $(this);
		var ul = li.parent('ul');
		var content = li.html();
		var value = li.attr('value');
		var input = ul.siblings('input');
		ul.siblings('dt').find('.dropmenu-value').html(content);
		ul.hide();
		input.val(value);
	});
});
