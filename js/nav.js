$(function() {
	var buttons = $('.wrapper .nav-genre').children(),
		block = $('.wrapper'),
		count;
	buttons.each(function() {
		$(this).click(function(e) {
			e.preventDefault();
			$(this).siblings().each(function() {
				$(this).removeClass('current');
			})
			$(this).addClass('current');

			block.find('.games').removeClass('hidden');
			block.find('.games:not(.' + $(this).attr('id') + ')').addClass('hidden');


		});
	});

	var $hamburger = $(".hamburger");
		$hamburger.on("click", function(e) {
			$hamburger.toggleClass("is-active");
			// Do something else, like open/close menu

			if ($hamburger.hasClass("is-active")) {
				$(".menu-mobile").toggleClass("open");
			}else {
				$(".menu-mobile").removeClass("open");

			}
		});

});
