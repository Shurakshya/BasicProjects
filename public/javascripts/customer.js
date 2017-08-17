$(document).ready(function() {
	// $('.info').hover(function() {
	// 	$(this).find('.myPopoverContent').toggle();
	// });

	$('.edit').on('click', function(e) {
		$(this).parent().parent().find('.toggle_customer').hide();
		$(this).parent().parent().find('.edit_form').show();
		e.preventDefault();
	});

	// $('.remove').on('click', function(e) {
	// 	$(this).parent().parent().find('.toggle_customer').show();
	// 	$(this).parent().parent().find('.edit_form').hide();
	// 	e.preventDefault();
	// });

	var message = $('.well>h2>span').text();
	if (message) {
		$('.well>h2>a').attr('display','none');
		setTimeout(function() {
			$('.well>h2>span').hide();
			$('.well>h2>a').show();
		}, 4000);
	}

});