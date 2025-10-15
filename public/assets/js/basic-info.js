$(document).ready(function() {
	$('.que_accordian table tr .value').hover(
	function() {
		$(this).prev('.label').addClass('highlight');
	},
	function() {
		$(this).prev('.label').removeClass('highlight');
	}
	);
});

$(function() { 
    $('.que_accordian li h3.toggle_button').on('click', function() {
        // Check if the next ul element has class 'open'
        var $nextUl = $(this).next('ul');
        if ($nextUl.hasClass('open')) {
            $(this).removeClass("active");    
            $nextUl.slideToggle().removeClass('open');
            $(this).find('span.arrow').removeClass('closed');
        } else {
            // Close other open items
            $('.que_accordian li').removeClass("active");    
            $('.que_accordian li ul.open').slideToggle().removeClass('open');
            $('.que_accordian li h3.toggle_button').removeClass('active');
            $('.que_accordian li h3.toggle_button span.arrow').removeClass('closed');

            // Open current item
            $(this).addClass("active");
            $nextUl.slideToggle().addClass('open');
            $(this).find('span.arrow').addClass('closed');
        }
    });
    // Active class starts one open
    $('.que_accordian li.active ul').slideDown().addClass('open');
});
