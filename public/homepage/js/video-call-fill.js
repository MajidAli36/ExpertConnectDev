
	$('.center').slick({
	  centerMode: true,
	  centerPadding: '60px',
	  slidesToShow: 3,
	  responsive: [
	    {
	      breakpoint: 768,
	      settings: {
	        arrows: true,
	        centerMode: true,
	        centerPadding: '20px',
	        slidesToShow: 3
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
	$('.center1').slick({
	  centerMode: true,
	  centerPadding: '0px',
	  slidesToShow: 3,
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
	$('[data-toggle="datepicker"]').datepicker({
	  format: 'mm-dd-yyyy',
	  autoClose: true
	});
	$('.booking_section .dropdown .dropdown-menu a').removeAttr('href');
	$('.booking_section .dropdown .dropdown-menu a').click(function(){
		var time1 = $(this).find('.time2').html();
		$('.time1').val(time1).css('text-align','center');
	});
function myFunction(){
    var x = document.getElementById("myFile");
    var txt = "";
    if ('files' in x) {
        if (x.files.length == 0) {
            txt = "Select one or more files.";
        } else {
            for (var i = 0; i < x.files.length; i++) {
                var file = x.files[i];
                if ('name' in file) {
                    txt +=  file.name + "<br>";
                }
            }
        }
    } 
    else {
        if (x.value == "") {
            txt += "Select one or more files.";
        } else {
            txt += "The files property is not supported by your browser!";
            txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
        }
    }
    document.getElementById("demo").innerHTML = txt;
    $('.booking_section .input_form.uploaded').css('display', 'block');
    $('.close').click(function(){
    	$('.booking_section .input_form.uploaded').css('display', 'none');
    });
}