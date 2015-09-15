$('.nav-list li').click(function() {
	$(this).addClass('current').siblings().removeClass('current');
});