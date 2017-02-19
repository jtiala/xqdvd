$(document).ready(function() {

	$('[data-toggle="tooltip"]').tooltip();

	$('.open-video').click(function(e) {
		e.preventDefault();
		var article = $(this).parent().parent().parent();
		var videoWrapper = $(article).find('.video-wrapper');
		var videoCaret = $(article).find('.video-caret');
		var video = $(videoWrapper).data('video');

		$(article).toggleClass('open');
		
		if ($(article).hasClass('open') === true) {
			videoWrapper.toggleClass('hidden');
			if (! videoWrapper.has('iframe').length > 0) {
				videoWrapper.append('<iframe width="560" height="315" src="//www.youtube.com/embed/' + video + '" frameborder="0" allowfullscreen></iframe>');
			}
			videoCaret.removeClass('fa-caret-down').addClass('fa-caret-up');
		} else {
			videoWrapper.toggleClass('hidden');
			videoCaret.removeClass('fa-caret-up').addClass('fa-caret-down');
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
