$(document).ready(function() {

	$('[data-toggle="tooltip"]').tooltip();

	$('.open-video').click(function(e) {
		e.preventDefault();
		var article = $(this).parent().parent().parent();

		$(article).toggleClass('open');
		
		if ($(article).hasClass('open') === true) {
			$(article).find('.video-wrapper').toggleClass('hidden');
			$(article).find('.video-caret').removeClass('fa-caret-down').addClass('fa-caret-up');
		} else {
			$(article).find('.video-wrapper').toggleClass('hidden');
			$(article).find('.video-caret').removeClass('fa-caret-up').addClass('fa-caret-down');
		}
	});
	
	$('.thumbs a').click(function(e) {
		e.preventDefault();
		
		var active = $(this).parent().find('.active');
		
		if ($(this).hasClass('active') === true) {
			//if up -1 if down +1
			$(this).removeClass('active');
		} else if (active.length > 0) {
			//if up +2 if down -2
			$(active).removeClass('active');
			$(this).addClass('active');
		} else {
			//if up +1 if down -1
			$(this).addClass('active');
		}
	});
	
});
