
	$('.center').slick({
	  centerMode: true,
	  centerPadding: '60px',
	  slidesToShow: 5,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        arrows: true,
	        centerMode: true,
	        centerPadding: '20px',
	        slidesToShow: 3
	      }
	    },
	    {
	      breakpoint: 768,
	      settings: {
	        arrows: true,
	        centerMode: true,
	        centerPadding: '20px',
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        arrows: true,
	        centerMode: true,
	        centerPadding: '20px',
	        slidesToShow: 1
	      }
	    }
	  ]
	});
	$(document).ready(function() {
			$('a[href*=\\#]').bind('click', function(e) {
					e.preventDefault(); // prevent hard jump, the default behavior

					var target = $(this).attr("href"); // Set the target as variable

					// perform animated scrolling by getting top-position of target-element and set it as scroll target
					$('html, body').stop().animate({
							scrollTop: $(target).offset().top
					}, 600, function() {
							location.hash = target; //attach the hash (#jumptarget) to the pageurl
					});

					return false;
			});
	});
	$(document).ready(function(){
		$('#nav-icon1').click(function(){
			$(this).toggleClass('open');
		});
	});
	$(function() {
    var header = $(".nav_section2");
  
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();
        if (scroll >= 50) {
            header.addClass("scrolled");
        } else {
            header.removeClass("scrolled");
        }
    });
  
});
	$(window).resize(function(){
		var height = $('.contentbox.active').height();

		$('.slider_content').css('height', height);
	});
	$(document).ready(function(){
		var height = $('.contentbox.active').height();

		$('.slider_content').css('height', height);
	})

	$(document).ready(function(){
		$('.slick-arrow, .headerv2 .slider .center .col-in').click(function(){
			var hash = $('.slick-center .col-in').attr('href');

			var bgTargetColor = $('.slick-center .col-in').attr('bgTargetColor');

			$('.slider_content .yellowbox').css('background', bgTargetColor);

			$('.slider_content .contentbox, .slider_content .contentbox h3').removeClass('active');
			$(hash).addClass('active');
			$('.slider_content .contentbox h3').addClass('active');

			var height = $('.contentbox.active').height();

			$('.slider_content').css('height', height);
		});
	});