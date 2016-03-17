$(document).ready(function() {
	var float_div = $("div.float_div");
	var float_div_close = $("a.float_div_close");

	var window_w = $(window).width();
	if(window_w>600){float_div.show();}
	$(window).scroll(function() {
		var scrollTop = $(window).scrollTop();
		float_div.stop().animate({
			top : scrollTop + 148
		});
	});
	float_div_close.click(function() {
		$(this).parent().hide();
		return false;
	});
});