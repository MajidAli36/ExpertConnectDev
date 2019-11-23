
	$('.center').slick({
	  centerMode: true,
	  centerPadding: '0px',
	  slidesToShow: 5,
	  autoplay: true,
	  responsive: [
	    {
	      breakpoint: 768,
	      settings: {
	        arrows: true,
	        centerMode: true,
	        centerPadding: '00px',
	        slidesToShow: 3
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        arrows: true,
	        centerMode: true,
	        centerPadding: '0px',
	        slidesToShow: 1
	      }
	    }
	  ]
	});
	$('.center1').slick({
	  centerMode: true,
	  centerPadding: '0px',
	  slidesToShow: 3,
	  autoplay: true,
	  responsive: [
	    {
	      breakpoint: 768,
	      settings: {
	        arrows: true,
	        centerMode: true,
	        centerPadding: '0px',
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
	$(".nav-search").click(function(){
	    $(".nav-item input").addClass("show");
	    $(".nav-item input").focus();
	});
	$(".nav-item input").blur(function(){
		$(".nav-item input").removeClass("show");
	});
	$(".nav-search").click(function(){
	    $(".navbar .search_box input").addClass("show");
	    $(".navbar .search_box input").focus();
	});
	$(".navbar .search_box input").blur(function(){
		$(".navbar .search_box input").removeClass("show");
	});
	$(document).ready(function() {
			$('a[href*=#]').bind('click', function(e) {
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

	$(document).ready(function(){
		$('.video_section .video_box .play img').click(function(){
			var videoSrc = $(this).attr('video-src');
			$('body').append('<div class="slider-iframe"><iframe allowfullscreen autoplay src='+ videoSrc +'?autoplay=1></iframe><div class="video-close">X</div></div>').css('overflow', 'hidden');

			jQuery('.video-close').click(function(){
				jQuery(".slider-iframe").remove();
				$('body').css('overflow', 'auto');
			});
		});
	});
	$( window ).resize(function() {
		var width = $(window).width();
		$('#myVideo').css('width', width);
	});
	$( window ).ready(function() {
		var width = $(window).width();
		$('#myVideo').css('width', width);
	});