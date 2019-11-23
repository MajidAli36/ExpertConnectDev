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
		$('#paypal').click(function(){
			if($(this).prop("checked") == true){
				$('.paypal').css('display', 'block');
				$('.credit').css('display', 'none');
			}
		});

		$('#credit').click(function(){
			if($(this).prop("checked") == true){
				$('.credit').css('display', 'block');
				$('.paypal').css('display', 'none');
			}
		});

		$('#billing').click(function(){
			if($(this).prop("checked") == true){
				$('.billing_info').css('display', 'none');
				makeSameAddress();
			}else{
				$('.billing_info').css('display', 'block');
			}
		});