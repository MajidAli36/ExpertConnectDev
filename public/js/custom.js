jQuery(document).ready(function($) {
    $(".banner-slider").slick({
        dots: false,
        arrows: false,
        infinite: true,
        speed: 300,
        autoplay: false,
        autoplaySpeed: 5000,
        fade: true,
        touchMove: false,
        touchThreshold: 0,
        slidesToShow: 1,
        asNavFor: '.banner-thumb',
        responsive: [
            /*{
                breakpoint: 9999,
                settings: "unslick"
            },*/
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 741,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    $('.banner-thumb').slick({
        autoplay: false,
        centerMode: true,
        infinite: true,
        slidesToShow: 3,
        asNavFor: '.banner-slider',
        focusOnSelect: true,
        touchMove: false,
        touchThreshold: 0,
        responsive: [{
                breakpoint: 1150,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });


    $(".step-slider").slick({
        dots: false,
        arrows: false,
        infinite: true,
        speed: 300,
        autoplay: false,
        autoplaySpeed: 5000,
        touchMove: false,
        touchThreshold: 0,
        centerMode: true,
        slidesToShow: 1,
        asNavFor: '.step-nav'
    });
    $('.step-nav').slick({
        dots: false,
        arrows: false,
        infinite: false,
        autoplay: false,
        slidesToShow: 5,
        asNavFor: '.step-slider',
        focusOnSelect: true,
        touchMove: false,
        touchThreshold: 0,
        vertical: true,
    });

    $(".features-slider").slick({
        dots: false,
        arrows: false,
        infinite: false,
        speed: 300,
        autoplay: false,
        autoplaySpeed: 5000,
        fade: true,
        touchMove: false,
        touchThreshold: 0,
        slidesToShow: 1,
        asNavFor: '.features-nav'
    });
    $('.features-nav').slick({
        dots: false,
        arrows: false,
        infinite: false,
        autoplay: false,
        slidesToShow: 7,
        asNavFor: '.features-slider',
        focusOnSelect: true,
        touchMove: false,
        touchThreshold: 0,
        vertical: true,
    });

    var dteNow = new Date();
    var intYear = dteNow.getFullYear();
    $(".coppy-text .year").append(intYear);

    $('nav a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);
        try {
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top - 85
            }, 900, 'swing', function() {
                window.location.hash = target;
            });
        } catch (e) {}
    });

    $('.video-banner').click(function() {
        var a = $(this).attr("data-video");
        $(".video-pop video").attr("src", a);
        $(".video-pop").simplePopup();
        $(".video-pop video").get(0).play();
    });

    $(".mobIcon").click(function() {
        $(".top nav").stop().slideToggle();
    });

    $(".accord-btn").each(function() {
        $(this).click(function() {
            if ($(this).hasClass("active")) {
                $(this).next().slideUp();
                $(this).removeClass("active");
            } else {
                $(".accordian .active").each(function() {
                    $(this).next().slideUp();
                    $(this).removeClass("active");
                });
                $(this).next().slideDown();
                $(this).addClass("active");
            }
            return false;
        });
    });

    function scrollToDiv(element) {
        var offset = element.offset();
        var offsetTop = offset.top - 40;
        //console.log(offsetTop);
        $('body,html').animate({
            scrollTop: offsetTop
        }, 500);
    }

    $('.videolib-one, .videolib-two').slick({
        autoplay: false,
        infinite: true,
        slidesToShow: 5,
        responsive: [{
                breakpoint: 1150,
                settings: {
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 2,
                    touchMove: true,
                    touchThreshold: 5,
                    arrows: false,
                }
            }
        ]
    });

    $('.videolib-slider li').each(function() {
        $(this).click(function() {
            $('.videolib-slider li').removeClass("lib-active");
            $(this).addClass("lib-active");
            var b = $(this).attr("slide-data");
            $(this).parents(".videolib-slider").find('.videolib-detail').each(function() {
                var c = $(this).attr("slide-data");
                if (b == c) {
                    $('.videolib-detail').fadeOut();
                    $(this).fadeIn(function(){ 
                        $('html, body').animate({
                            scrollTop: $(this).offset().top-20
                        }, 1000);
                    });
                }
            });
        });
    });

    $('.video-cat-list li').each(function() {
        $(this).click(function() {
            $(this).parents(".video-cat-list").find("#video-detail-drop").appendTo($(this).parents("ul[class^='sub-list']"));
            $('.video-cat-list li').removeClass("lib-active");
            $(this).addClass("lib-active");
            var b = $(this).attr("slide-data");
            $(this).parents(".video-cat-list").find('.videolib-detail').each(function() {
                var c = $(this).attr("slide-data");
                if (b == c) {
                    $('.videolib-detail').fadeOut();
                    $(this).fadeIn(function(){ 
                        $('html, body').animate({
                            scrollTop: $(this).offset().top-20
                        }, 1000);
                    });
                }
            });
        });
    });

    $(".close-lib-btn").click(function() {
        $('.videolib-detail').fadeOut();
        $('.videolib-slider li, .video-cat-list li').removeClass("lib-active");
    });

    $('.tab-data .clickme a.filter').each(function() {
        $(this).click(function() {
            $(this).parents(".tab-data").find('.clickme').removeClass('active');
            $(this).parent(".clickme").addClass('active');
            var tagid = $(this).data('tag');
            $(this).parents(".tab-data").find('.list').removeClass('show-tab');
            $(this).parents(".tab-data").find('#' + tagid).addClass('show-tab');

            var ab = tagid.split('_')[0];
            // console.log(ab);
            var ab = "inner";
            //console.log(ab);
            var cd = tagid.split('_')[1];
            // console.log(cd);
            var newab = ab + "_" + cd + "_";
            //console.log(newab);

            $(this).parents(".tab-data").find('.list.show-tab').each(function() {
                $(this).find(".video-cat-list li").each(function() {
                    var mn = $(this).attr("slide-data");
                    //console.log(mn);
                    var pq = mn.split('_')[0];
                    //console.log(pq);
                    var rs = mn.split('_')[1];
                    //console.log(rs);
                    var tu = pq + "_" + rs + "_";
                    //console.log(tu);
                    //console.log(newab);
                    if (tu == newab) {
                        $(this).show().addClass("act");
                        var ef = $(this).parents(".show-tab").find(".act").length;
                        //console.log(ef);
                    } else {
                        $(this).hide();
                    }

                });
                var a = $(this).find("#column");
                var totals = $(a).find("li").length;
                //console.log(totals);
                var count = Math.ceil(totals / 4);
                //console.log("count",count);
                var num_cols = count;
                var container = $(this).find("ul");
                var listItem = 'li';
                var listClass = 'sub-list';
                container.each(function() {
                    var items_per_col = new Array();
                    var items = $(this).find(listItem);
                    var min_items_per_col = 4;
                    var difference = items.length - (min_items_per_col * num_cols);
                    //console.log("countmin",min_items_per_col);
                    //console.log("count1",difference);
                    for (var i = 0; i < num_cols; i++) {
                        if (i < difference) {
                            items_per_col[i] = min_items_per_col + 1;
                        } else {
                            items_per_col[i] = min_items_per_col;
                        }
                    }
                    for (var i = 0; i < num_cols; i++) {
                        $(this).append($('<ul></ul>').addClass(listClass));
                        for (var j = 0; j < items_per_col[i]; j++) {
                            var pointer = 0;
                            for (var k = 0; k < i; k++) {
                                pointer += items_per_col[k];
                            }
                            $(this).find('.' + listClass).last().append(items[j + pointer]);
                        }
                    }
                });
            });
            if ($(window).width() < 768) {
                setTimeout(function(){ 
                    sliderInit();
                }, 500);
            }
        });
    });

    function sliderInit(){
        $('ul.sub-list').not('.slick-initialized').slick({
            autoplay: false,
            infinite: true,
            slidesToShow: 4,
            arrows: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    arrows: false
                }
            }]
        });
        };
    

    $(window).on('load', function() {
        $('.tab-data #custom_showalltab a.filter').trigger("click");
        sliderInit();
        if ($(window).width() < 768) {
            $('.category-page .be-select-tab').removeClass("active");

        }
    });

    // Tab navigation into select dropdown for mobile
    $.fn.ulSelect = function() {
        var ul = $(this);

        if (!ul.hasClass('tab-select')) {
            ul.addClass('tab-select');
        }

        // $('li:first-of-type', this).addClass('active');
        $(this).on('click', 'li', function(event) {
            if ($('#selected-ul').length) {
                $('#selected-ul').remove();
            }
            ul.toggleClass('active');
            ul.children().removeClass('active');
            $(this).toggleClass('active');
            $(".myaccount-menu.active a").click(function(e) {
                if (!$(this).hasClass("active")) {
                    var link = $(this).attr("data-href");
                    $(this).attr("href", link);
                }
            });
        });
    };

    if ($(window).width() < 1025) {
        $('.be-select-tab').each(function() {
            $(this).ulSelect();
        });
    } else {
        $('.be-select-tab').removeClass("tab-select");
    }

    $(window).resize(function() {
        $('.be-select-tab').each(function() {
            $(this).ulSelect();
        });
        if ($(window).width() < 1025) {
            $('.be-select-tab').each(function() {
                $(this).ulSelect();
            });
        } else {
            $('.be-select-tab').removeClass("tab-select");
        }
    });

    if ($(window).width() < 768) {
        $('.myaccount-menu').each(function() {
            $(this).ulSelect();
        });
    } else {
        $('.myaccount-menu').removeClass("tab-select");
    }

    $(window).resize(function() {
        $('.myaccount-menu').each(function() {
            $(this).ulSelect();
        });
        if ($(window).width() < 768) {
            $('.myaccount-menu').each(function() {
                $(this).ulSelect();
            });
        } else {
            $('.myaccount-menu').removeClass("tab-select");
        }
    });
    // Tab navigation into select dropdown for mobile

    $(".search-icon").click(function() {
        $(".search-box, .search-icon").addClass("active");
        $(".search-box input").focus().blur(function() {
            $(".search-box, .search-icon").removeClass("active");
        });
    });

    $(".sub-btn button").click(function() {
        $(".payment-popup").removeClass("height-zero").simplePopup();
        $(".step-one").addClass("active");
        var a = $(".payment-img img").height();
        $(".payment-content").css("height", a);
        $(".payment-content").mCustomScrollbar();
    });

    $('.tab-data .clickme span').click(function() {
        $(".tab-data .clickme").removeClass("active");
        $(this).parent().addClass("active");
    });

    if ($(window).width() < 992) {
        $('.top nav .my-account ul').hide();
        $('.my-account span').click(function() {
            $(this).next().toggle();
        });
    }
    $(window).resize(function() {
        if ($(window).width() < 992) {
            $('.top nav .my-account ul').hide();
        }
        if ($(window).width() < 768) {
            var $window = $(window),
                $wrapper = $('.payment-content');
            $wrapper.css({
                height: $window.height() - 100,
            });
        } else {
            var a = $(".payment-img img").height();
            $(".payment-content").css("height", a);
            if ($(".payment-content").length) {
                $(".payment-content").mCustomScrollbar();
            }
        }
    });

    $(".sub-text:first-child").mouseover(function() {
        $(".clickme.month-plan").addClass("active");
        $(".clickme.year-plan").removeClass("active");
    });
    $(".sub-text:nth-child(2)").mouseover(function() {
        $(".clickme.year-plan").addClass("active");
        $(".clickme.month-plan").removeClass("active");
    });
    $(".sub-text").mouseleave(function() {
        $(".clickme").removeClass("active");
    });

    $(".video-fil select").on("change", function() {
        var a = $("option:selected").val();
        var b = $(".sticky-filter").outerHeight() + 15;
        //console.log(b);
        $('.tab-data .title').each(function() {
            var c = $(this).text();
            if (a == c) {
                $('html, body').animate({
                    scrollTop: $(this).parents(".tab-data").offset().top-b
                }, 1000);
            }
        });
    });


    $(window).scroll(function(){
        var stickyHeight = $(".sticky-filter").outerHeight();
        var stickyOffset = $(".videolib-page .tab-div").offset().top;
        //console.log(stickyOffset);
        var scroll = $(window).scrollTop();
        //console.log(scroll);
        if(scroll >= stickyOffset){
           $(".videolib-page .tab-div").addClass('fixed').css("padding-top", stickyHeight);
        }
        else{
            $(".videolib-page .tab-div").removeClass('fixed').css("padding-top", "0");
        }
    });

});