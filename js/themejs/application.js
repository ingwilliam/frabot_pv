/* -------------------------------------------------------------------------------- /
	
	Magentech jQuery 
	Created by Magentech
	v1.0 - 20.9.2016
	All rights reserved.

	+----------------------------------------------------+
		TABLE OF CONTENTS
	+----------------------------------------------------+
	
	[1]		Page all
	[2]		Mod all
	[3]		Module Categories Slider
	[4]		Module Listing Tabs 9
	[5]		Listing Tabs Home 9 V2
	[6]		Page Quickview
	[7]		Page Category Listing

/ -------------------------------------------------------------------------------- */

/* ---------------------------------------------------
	Page all
-------------------------------------------------- */
$(document).ready(function(){
	"use strict";
	/* ---------------------------------------------------
		Social Widgets Accounts
	-------------------------------------------------- */
	    var socialItems = $('.social-widgets .items .item');
	    var counter = 0;
	    socialItems.each(function () {
	        counter++;
	        var itemclass = "item-0" + counter;
	        $(this).addClass(itemclass)
	    });

	    $(".social-widgets .item").each(function () {
	        var $this = $(this),
	            timer;
	        $this.on("mouseenter", function () {
	            var $this = $(this);
	            if (timer) clearTimeout(timer);
	            timer = setTimeout(function () {
	                $this.addClass("active")
	            }, 200)
	        }).on("mouseleave", function () {
	            var $this = $(this);
	            if (timer) clearTimeout(timer);
	            timer = setTimeout(function () {
	                $this.removeClass("active")
	            }, 100)
	        }).on("click", function (e) {
	            e.preventDefault()
	        })
	    })

	    var loadmap = $(".social-widgets .item a");
	    loadmap.on("click", function (e) {
	        e.preventDefault()
	    });
	    loadmap.on("mouseenter", function (e) {
			
	        if (!$(this).parent().hasClass("load")) {
	            var loadcontainer = $(this).parent().find(".loading");
	            $.ajax({
	                url: $(this).attr("href"),
	                cache: false,
	                success: function (data) {
						
	                    setTimeout(function () {
	                        loadcontainer.html(data)
	                    }, 1000)
	                }
				
	            });
	            $(this).parent().addClass("load")
	        }
	    })
	/* ---------------------------------------------------
		Header Top link
	-------------------------------------------------- */
		$(".header-top-right .top-link > li").mouseenter(function(){
			$(".header-top-right .top-link > li.account").addClass('inactive');
		});
		$(".header-top-right .top-link > li").mouseleave(function(){
			$(".header-top-right .top-link > li.account").removeClass('inactive');
		});
		$(".header-top-right .top-link > li.account").mouseenter(function(){
			$(".header-top-right .top-link > li.account").removeClass('inactive');
		});
	/* ---------------------------------------------------
		Resonsive Header Top
	-------------------------------------------------- */
	    // Resonsive Header Top
	    $(".collapsed-block .expander").on('click', function (e) {
	    	setTimeout (function(){
		        var collapse_content_selector = $(this).attr("href");
		        var expander = $(this);
				
		        if (!$(collapse_content_selector).hasClass("open")) {
					expander.addClass("open").html("<i class='fa fa-angle-up'></i>") ;
				}
				else expander.removeClass("open").html("<i class='fa fa-angle-down'></i>");
			},2000);
	    })
	/* ---------------------------------------------------
		Language and Currency Dropdowns
	-------------------------------------------------- */

		if ($(window).width() > 991) {
			$('#currency, #bt-language, #my_account').on('mouseenter',function() {
				$(this).find('ul').stop(true, true).slideDown('fast');
			  }).on('mouseleave',function() {
				 $(this).find('ul').stop(true, true).css('display', 'none');
			 });
		}
	/* ---------------------------------------------------
		Accordion to Bonus page
	-------------------------------------------------- */
		$("ul.yt-accordion li").each(function() {
			if($(this).index() > 0) {
				$(this).children(".accordion-inner").css('display', 'none');
			}
			else {
				$(this).find(".accordion-heading").addClass('active');
			}
			
			var ua = navigator.userAgent,
			event = (ua.match(/iPad/i)) ? "touchstart" : "click";
			$(this).children(".accordion-heading").on(event, function() {
				$(this).addClass(function() {
					if($(this).hasClass("active")) return "";
					return "active";
				});
		
				$(this).siblings(".accordion-inner").slideDown(350);
				$(this).parent().siblings("li").children(".accordion-inner").slideUp(350);
				$(this).parent().siblings("li").find(".active").removeClass("active");
			});
		});
	/* ---------------------------------------------------
		Magnific Popup
	-------------------------------------------------- */
	    $('.image-popup').magnificPopup({
		  type: 'image',
		  closeOnContentClick: true,
		  image: {
			verticalFit: false
		  }
		});
		$('.blog-listitem').magnificPopup({
		  delegate: '.popup-gallery',
		  type: 'image',
		  tLoading: 'Loading image #%curr%...',
		  mainClass: 'mfp-img-mobile',
		  gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		  },
		  image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
			  return item.el.attr('title') ;
			}
		  }
		});	
	/* ---------------------------------------------------
		Quick View
	-------------------------------------------------- */
		$('.iframe-link').magnificPopup({
			type:'iframe',
		    fixedContentPos: true,
	        fixedBgPos: true,
	        overflowY: 'auto',
	        closeBtnInside: true,
			closeOnContentClick: true,
	        preloader: true,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in',
			gallery: {  enabled: true }
	    });
		
		
	/* ---------------------------------------------------
		Preloading Screen
	-------------------------------------------------- */
		$(window).on("mouseenter", function () {
			"use strict";
			// Animate loader off screen
			$('body').addClass('loaded');
		});
		$(window).on("mouseenter", function () {
			jQuery(".loader").fadeOut("slow");
		})			
	/* ---------------------------------------------------
		Back to Top
	-------------------------------------------------- */
		$(".back-to-top").addClass("hidden-top");
			$(window).scroll(function () {
			if ($(this).scrollTop() === 0) {
				$(".back-to-top").addClass("hidden-top")
			} else {
				$(".back-to-top").removeClass("hidden-top")
			}
		});

		$('.back-to-top').on("click", function () {
			$('body,html').animate({scrollTop:0}, 1200);
			return false;
		});	 
	/* ---------------------------------------------------
		Quantity minus and plus
	-------------------------------------------------- */
	    $.initQuantity = function ($control) {
	        $control.each(function () {
	            var $this = $(this),
	                data = $this.data("inited-control"),
	                $plus = $(".input-group-addon:last", $this),
	                $minus = $(".input-group-addon:first", $this),
	                $value = $(".form-control", $this);
	            if (!data) {
	                $control.attr("unselectable", "on").css({
	                    "-moz-user-select": "none",
	                    "-o-user-select": "none",
	                    "-khtml-user-select": "none",
	                    "-webkit-user-select": "none",
	                    "-ms-user-select": "none",
	                    "user-select": "none"
	                }).on("selectstart", function () {
	                    return false
	                });
	                $plus.on("click", function () {
	                    var val = parseInt($value.val(), 10) + 1;
	                    $value.val(val);
	                    return false
	                });
	                $minus.on("click", function () {
	                    var val = parseInt($value.val(), 10) - 1;
	                    $value.val(val > 0 ? val : 1);
	                    return false
	                });
	                $value.blur(function () {
	                    var val = parseInt($value.val(), 10);
	                    $value.val(val > 0 ? val : 1)
	                })
	            }
	        })
	    };
	    $.initQuantity($(".quantity-control"));
	    $.initSelect = function ($select) {
	        $select.each(function () {
	            var $this = $(this),
	                data = $this.data("inited-select"),
	                $value = $(".value", $this),
	                $hidden = $(".input-hidden", $this),
	                $items = $(".dropdown-menu li > a", $this);
	            if (!data) {
	                $items.on("click", function (e) {
	                    if ($(this).closest(".sort-isotope").length >
	                        0) e.preventDefault();
	                    var data = $(this).attr("data-value"),
	                        dataHTML = $(this).html();
	                    $this.trigger("change", {
	                        value: data,
	                        html: dataHTML
	                    });
	                    $value.html(dataHTML);
	                    if ($hidden.length) $hidden.val(data)
	                });
	                $this.data("inited-select", true)
	            }
	        })
	    };
	    $.initSelect($(".btn-select"));
		
		if(!window.startRangeValues) return;
		var startValues = window.startRangeValues,
			min = startValues[0].toFixed(2),
			max = startValues[1].toFixed(2);

		$('.filter_reset').on('click', function(){

			var form = $(this).closest('form'),
				range = form.find('.range');

				console.log(startValues);

			// form.find('#slider').slider('option','values', startValues);

			form.find('#slider').slider('values', 0, min);
			form.find('#slider').slider('values', 1, max);

			form.find('.options_list').children().eq(0).children().trigger('click');

			range.children('.min_value').val(min).next().val(max);

			range.children('.min_val').text('$' + min).next().text('$' + max);

		});
	
	/* ---------------------------------------------------
		Posmotion  Home 9
	-------------------------------------------------- */
		$( "#close-posmotion-header" ).on("click", function() {
			"use strict";
			$('.promotion-top').toggleClass('hidden-promotion');
			$('body').toggleClass('hidden-promotion-body');

			if($(".promotion-top").hasClass("hidden-promotion")){
				$.cookie("open", 0);
				
			} else{
				$.cookie("open", 1);
			}	
		});

		if($.cookie("open") == 0){
			$('.promotion-top').addClass('hidden-promotion');
			$('body').addClass('hidden-promotion-body');
		}	
	
	/* ---------------------------------------------------
		Range slider && Filter  Reset
	-------------------------------------------------- */
		if($('#slider').length){
			window.startRangeValues = [28.00, 562.00];
			$('#slider').slider({

				range : true,
				min : 10.00,
				max : 580.00,
				values : window.startRangeValues,
				step : 0.01,
				slide : function(event, ui){
					var min = ui.values[0].toFixed(2),
						max = ui.values[1].toFixed(2),
						range = $(this).siblings('.range');
					range.children('.min_value').val(min).next().val(max);
					range.children('.min_val').text('$' + min).next().text('$' + max);
				},

				create : function(event, ui){

					var $this = $(this),
						min = $this.slider("values", 0).toFixed(2),
						max = $this.slider("values", 1).toFixed(2),
						range = $this.siblings('.range');
					range.children('.min_value').val(min).next().val(max);
					range.children('.min_val').text('$' + min).next().text('$' + max);
				}
			});
		}

		if(!window.startRangeValues) return;
		var startValues = window.startRangeValues,
			min = startValues[0].toFixed(2),
			max = startValues[1].toFixed(2);
		$('.filter_reset').on('click', function(){

			var form = $(this).closest('form'),
				range = form.find('.range');

				console.log(startValues);

			// form.find('#slider').slider('option','values', startValues);

			form.find('#slider').slider('values', 0, min);
			form.find('#slider').slider('values', 1, max);

			form.find('.options_list').children().eq(0).children().trigger('click');

			range.children('.min_value').val(min).next().val(max);

			range.children('.min_val').text('$' + min).next().text('$' + max);

		});
});

/* ---------------------------------------------------
	Mod all
-------------------------------------------------- */
$(document).ready(function($) {
	/* ---------------------------------------------------
		Owl carousel - Slider
	-------------------------------------------------- */
		$('.slideshow').owlCarousel2({
			loop:true,
			margin:0,
			responsiveClass:true,
			nav: true,
			dots: true,
			autoplayTimeout: 5000,
			autoplaySpeed:  1000,
			autoplay : true,
			smartSpeed: 500,
			responsive:{
				0:{
					items:1,
				},
				600:{
					items:1,
				},
				1000:{
					items:1,
				}
			}
		});	
	/* ---------------------------------------------------
		Super Cate Banner h2- Slider
	-------------------------------------------------- */
		$('.slider-img-cate').owlCarousel2({
			loop:true,
			margin:0,
			responsiveClass:true,
			nav: false,
			dots: true,
			autoplayTimeout: 5000,
			autoplaySpeed:  1000,
			autoplay : true,
			smartSpeed: 500,
			responsive:{
				0:{
					items:1,
				},
				600:{
					items:1,
				},
				1000:{
					items:1,
				}
			}
		});	
	/* ---------------------------------------------------
		Blog  Slider
	-------------------------------------------------- */
		$('.blog-external').owlCarousel2({
			loop:true,
			margin:0,
			responsiveClass:true,
			nav: true,
			dots: false,
			autoplayTimeout: 5000,
			autoplaySpeed:  1000,
			autoplay : false,
			smartSpeed: 500,
			responsive:{
				0:{
					items:1,
				},
				600:{
					items:1,
				},
				1000:{
					items:1,
				}
			}
		});
	/* ---------------------------------------------------
		Testiminol Slider Home 9
	-------------------------------------------------- */
		$('.slider-clients-say').owlCarousel2({
			pagination: false,
			center: false,
			nav: false,
			dots: false,
			loop: true,
			margin: 0,
			navText: [ '', '' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				768:{
					items:1
				},
				1024:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});
		
	/* ---------------------------------------------------
		Deal Slider Home 7
	-------------------------------------------------- */
		$('.deal-slider-home7').owlCarousel2({
			pagination: false,
			center: false,
			nav: true,
			dots: false,
			loop: true,
			margin: 25,
			navText: [ '', '' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:2
				},
				768:{
					items:3
				},
				1024:{
					items:4
				},
				1200:{
					items:5
				}
			}
		});	
	
	/* ---------------------------------------------------
		Extra Slider Home 8
	-------------------------------------------------- */
		$('.extra-slider').owlCarousel2({
			pagination: false,
			center: false,
			nav: true,
			dots: false,
			loop: true,
			margin: 30,
			navText: [ '', '' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:2
				},
				768:{
					items:3
				},
				1024:{
					items:4
				},
				1200:{
					items:4
				}
			}
		});
	/* ---------------------------------------------------
		Category Slider Home7 - Slider
	-------------------------------------------------- */
		$('.slider-h7').owlCarousel2({
			loop:true,
			margin:0,
			responsiveClass:true,
			nav: true,
			dots: false,
			autoplayTimeout: 5000,
			autoplaySpeed:  1000,
			autoplay : false,
			smartSpeed: 500,
			responsive:{
				0:{
					items:1,
				},
				480:{
					items:2,
				},
				768:{
					items:4,
				},
				992:{
					items:3,
				},
				1200:{
					items:4,
				}
			}
		});
	/* ---------------------------------------------------
		Category Slider Home3- Slider
	-------------------------------------------------- */
		$('.so-category-slider').owlCarousel2({
			loop:true,
			margin:0,
			responsiveClass:true,
			nav: true,
			dots: false,
			autoplayTimeout: 5000,
			autoplaySpeed:  1000,
			autoplay : false,
			smartSpeed: 500,
			responsive:{
				0:{
					items:1,
				},
				480:{
					items:2,
				},
				768:{
					items:2,
				},
				992:{
					items:3,
				},
				1200:{
					items:4,
				}
			}
		});

	/* ---------------------------------------------------
		 Testimonial Home2
	-------------------------------------------------- */
		$('.slider-clients-say').owlCarousel2({
			loop:true,
			margin:0,
			responsiveClass:true,
			nav: true,
			dots: true,
			autoplayTimeout: 5000,
			autoplaySpeed:  1000,
			autoplay : true,
			navText: ["", ""],
			smartSpeed: 500,
			responsive:{
				0:{
					items:1,
				},
				600:{
					items:1,
				},
				1000:{
					items:1,
				}
			}
		});
	
	/* ---------------------------------------------------
		Other Query
	-------------------------------------------------- */	
	$('.date').datetimepicker({
		pickTime: false
	});
	/* ---------------------------------------------------
		About Page
	-------------------------------------------------- */
	$('#ytcs579bfc965e489183711469840534').each(function() {
			var slider = $(this),
				data = slider.data();
			// Remove unwanted br's
			slider.children(':not(.yt-content-slide)').remove();
			// Apply Owl Carousel
			slider.owlCarousel2({
				mouseDrag: true,
				video: true,
				lazyLoad: (data.lazyload == 'yes') ? true : false,
				autoplay: (data.autoplay == 'yes') ? true : false,
				autoHeight: (data.autoheight == 'yes') ? true : false,
				autoplayTimeout: data.delay * 1000,
				smartSpeed: data.speed * 1000,
				autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,
				center: (data.center == 'yes') ? true : false,
				loop: (data.loop == 'yes') ? true : false,
				dots: (data.pagination == 'yes') ? true : false,
				nav: (data.arrows == 'yes') ? true : false,
				margin: data.margin,
				navText: ['next', 'prev'],
				responsive: {
					0: {
						items: data.item_xs
					},
					768: {
						items: data.item_sm
					},
					992: {
						items: data.item_lg
					}
				},
			});

		});
		$('#ytcs579bfc965e78d103041469840534').each(function() {
			var slider = $(this),
				panels = slider.children('div'),
				data = slider.data();

			// Remove unwanted br's
			slider.children(':not(.yt-content-slide)').remove();
			// Apply Owl Carousel
			slider.owlCarousel2({
				
				mouseDrag: true,
				video: true,
				lazyLoad: (data.lazyload == 'yes') ? true : false,
				autoplay: (data.autoplay == 'yes') ? true : false,
				autoHeight: (data.autoheight == 'yes') ? true : false,
				autoplayTimeout: data.delay * 1000,
				smartSpeed: data.speed * 1000,
				autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,
				center: (data.center == 'yes') ? true : false,
				loop: (data.loop == 'yes') ? true : false,
				dots: (data.pagination == 'yes') ? true : false,
				nav: (data.arrows == 'yes') ? true : false,
				margin: data.margin,
				navText: ['next', 'prev'],
				responsive: {
					0: {
						items: data.item_xs
					},
					768: {
						items: data.item_sm
					},
					992: {
						items: data.item_lg
					}
				},
			});

		});
		$('#ytcs579c07146430563341469843220').each(function() {
			var slider = $(this),
				panels = slider.children('div'),
				data = slider.data();

			// Remove unwanted br's
			slider.children(':not(.yt-content-slide)').remove();
			// Apply Owl Carousel
			slider.owlCarousel2({

				mouseDrag: true,
				video: true,
				lazyLoad: (data.lazyload == 'yes') ? true : false,
				autoplay: (data.autoplay == 'yes') ? true : false,
				autoHeight: (data.autoheight == 'yes') ? true : false,
				autoplayTimeout: data.delay * 1000,
				smartSpeed: data.speed * 1000,
				autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,
				center: (data.center == 'yes') ? true : false,
				loop: (data.loop == 'yes') ? true : false,
				dots: (data.pagination == 'yes') ? true : false,
				nav: (data.arrows == 'yes') ? true : false,
				margin: data.margin,
				navText: ['next', 'prev'],
				responsive: {
					0: {
						items: data.item_xs
					},
					768: {
						items: data.item_sm
					},
					992: {
						items: data.item_lg
					}
				},
			});

		});
		
		$('#ytcs579c07146456674551469843220').each(function() {
			var slider = $(this),
				panels = slider.children('div'),
				data = slider.data();

			// Remove unwanted br's
			slider.children(':not(.yt-content-slide)').remove();
			// Apply Owl Carousel
			slider.owlCarousel2({

				mouseDrag: true,
				video: true,
				lazyLoad: (data.lazyload == 'yes') ? true : false,
				autoplay: (data.autoplay == 'yes') ? true : false,
				autoHeight: (data.autoheight == 'yes') ? true : false,
				autoplayTimeout: data.delay * 1000,
				smartSpeed: data.speed * 1000,
				autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,
				center: (data.center == 'yes') ? true : false,
				loop: (data.loop == 'yes') ? true : false,
				dots: (data.pagination == 'yes') ? true : false,
				nav: (data.arrows == 'yes') ? true : false,
				margin: data.margin,
				navText: ['next', 'prev'],
				responsive: {
					0: {
						items: data.item_xs
					},
					768: {
						items: data.item_sm
					},
					992: {
						items: data.item_lg
					}
				},
			});

		});
		$('#ytcs579c0714641b9213691469843220').each(function() {
			var slider = $(this),
				panels = slider.children('div'),
				data = slider.data();

			// Remove unwanted br's
			slider.children(':not(.yt-content-slide)').remove();
			// Apply Owl Carousel
			slider.owlCarousel2({

				mouseDrag: true,
				video: true,
				lazyLoad: (data.lazyload == 'yes') ? true : false,
				autoplay: (data.autoplay == 'yes') ? true : false,
				autoHeight: (data.autoheight == 'yes') ? true : false,
				autoplayTimeout: data.delay * 1000,
				smartSpeed: data.speed * 1000,
				autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,
				center: (data.center == 'yes') ? true : false,
				loop: (data.loop == 'yes') ? true : false,
				dots: (data.pagination == 'yes') ? true : false,
				nav: (data.arrows == 'yes') ? true : false,
				margin: data.margin,
				navText: ['next', 'prev'],
				responsive: {
					0: {
						items: data.item_xs
					},
					768: {
						items: data.item_sm
					},
					992: {
						items: data.item_lg
					}
				},
			});

		});
	/* ---------------------------------------------------
		Brand Slide
	-------------------------------------------------- */
		$('.brand-slider').owlCarousel2({
			pagination: false,
			center: false,
			nav: true,
			dots: false,
			loop: true,
			margin: 0,
			navText: [ '', '' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:2
				},
				480:{
					items:2
				},
				768:{
					items:3
				},
				1024:{
					items:4
				},
				1200:{
					items:5
				}
			}
		});
	/* ---------------------------------------------------
		Testalminol  Slider
	-------------------------------------------------- */
	$(document).ready(function($) {
		"use strict";
		$('.slider-clients-say').owlCarousel2({
			pagination: false,
			center: false,
			nav: true,
			dots: false,
			loop: true,
			margin: 25,
			navText: [ '', '' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				768:{
					items:1
				},
				1024:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});	
	});	
	/* ---------------------------------------------------
		BestSeler Slider
	-------------------------------------------------- */
	$(document).ready(function($) {
		"use strict";
		$('.best-seller-slider').owlCarousel2({
			pagination: false,
			center: false,
			nav: true,
			dots: false,
			loop: true,
			margin: 0,
			navText: [ '', '' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				768:{
					items:1
				},
				1024:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});	
	});	

	
	/* ---------------------------------------------------
		Deal Slider
	-------------------------------------------------- */
	$(document).ready(function($) {
		"use strict";
		$('.deal-slider').owlCarousel2({
			pagination: false,
			center: false,
			nav: true,
			dots: false,
			loop: true,
			margin: 25,
			navText: [ '', '' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:2
				},
				768:{
					items:2
				},
				1024:{
					items:3
				},
				1200:{
					items:4
				}
			}
		});	
	});	
	/* ---------------------------------------------------
		Page Product Detail
	-------------------------------------------------- */
		$('.releate-products').owlCarousel2({
			pagination: false,
			center: false,
			nav: true,
			dots: false,
			loop: true,
			margin: 2,
			navText: [ '', '' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				768:{
					items:2
				},
				1024:{
					items:3
				},
				1200:{
					items:4
				}
			}
		});	 

		$('.upsell-products').owlCarousel2({
			pagination: false,
			center: false,
			nav: true,
			dots: false,
			loop: true,
			margin: 2,
			navText: [ '', '' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				768:{
					items:2
				},
				1024:{
					items:3
				},
				1200:{
					items:4
				}
			}
		});	 
		//Client Say
		$('.slider-clients-say').owlCarousel2({
			pagination: false,
			center: false,
			nav: true,
			loop: false,
			margin: 25,
			navText: [ 'prev', 'next' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				768:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});
	/* ---------------------------------------------------
		Well Come
	-------------------------------------------------- */
		$('.list-msg').owlCarousel2({
		   pagination: false,
		   center: false,
		   nav: false,
		   loop: true,
		   slideBy: 1,
		   autoplay: true,
		   margin: 30,
		   autoplayTimeout: 4500,
		   autoplayHoverPause: true,
		   autoplaySpeed: 1200,
		   startPosition: 0, 
		   responsive:{
		    0:{
		     items:1
		    },
		    480:{
		     items:1
		    },
		    768:{
		     items:1
		    },
		    1200:{
		     items:1
		    }
		   }
		});	
});		

	
/* ---------------------------------------------------
	Module Categories Slider
-------------------------------------------------- */
$(document).ready(function($) {
	// So_super_category_1
	(function (element) {
		 var type_show = 'slider';
		  var rows = '1';
			var $element = $(element),
			$tab = $('.spcat-tab', $element),
			$tab_label = $('.spcat-tab-label', $tab),
			$tabs = $('.spcat-tabs', $element),
			ajax_url = $tabs.parents('.spcat-tabs-container').attr('data-ajaxurl'),
			effect = $tabs.parents('.spcat-tabs-container').attr('data-effect'),
			delay = $tabs.parents('.spcat-tabs-container').attr('data-delay'),
			duration = $tabs.parents('.spcat-tabs-container').attr('data-duration'),
			rl_moduleid = $tabs.parents('.spcat-tabs-container').attr('data-modid'),
			$items_content = $('.spcat-items', $element),
			$items_inner = $('.spcat-items-inner', $items_content),
			$items_first_active = $('.spcat-items-selected', $element),
			$load_more = $('.spcat-loadmore', $element),
			$btn_loadmore = $('.spcat-loadmore-btn', $load_more),
			$select_box = $('.spcat-selectbox', $element),
			$id_cate = $('.spcat-tab', $element).attr('data-id-cate'),
			$tab_label_select = $('.spcat-tab-selected', $element),
			setting = 'a:80:{s:6:"action";s:9:"save_edit";s:4:"name";s:27:"Electronics - Home Layout 1";s:18:"module_description";a:2:{i:1;a:1:{s:9:"head_name";s:11:"Electronics";}i:2;a:1:{s:9:"head_name";s:11:"Electronics";}}s:9:"head_name";s:11:"Electronics";s:17:"disp_title_module";s:1:"1";s:6:"status";s:1:"1";s:25:"advanced_mod_class_suffix";s:40:"cus-style-supper-cate  fa-empire #009688";s:16:"item_link_target";s:6:"_blank";s:8:"category";s:2:"17";s:14:"category_depth";s:1:"1";s:17:"field_product_tab";a:5:{i:0;s:7:"p_price";i:1;s:10:"p_quantity";i:2;s:6:"rating";i:3;s:12:"p_sort_order";i:4;s:5:"sales";}s:13:"field_preload";s:5:"sales";s:10:"limitation";s:1:"6";s:16:"product_ordering";s:4:"DESC";s:16:"category_column0";s:1:"4";s:16:"category_column1";s:1:"4";s:16:"category_column2";s:1:"3";s:16:"category_column3";s:1:"2";s:16:"category_column4";s:1:"1";s:24:"category_title_maxlength";s:2:"25";s:26:"display_title_sub_category";s:1:"1";s:22:"display_slide_category";s:1:"1";s:18:"show_category_type";s:1:"0";s:28:"sub_category_title_maxlength";s:2:"25";s:14:"category_width";s:3:"200";s:15:"category_height";s:3:"100";s:25:"category_placeholder_path";s:11:"nophoto.png";s:15:"product_column0";s:1:"4";s:15:"product_column1";s:1:"4";s:15:"product_column2";s:1:"3";s:15:"product_column3";s:1:"2";s:15:"product_column4";s:1:"1";s:9:"type_show";s:6:"slider";s:4:"rows";s:1:"1";s:21:"product_display_title";s:1:"1";s:23:"product_title_maxlength";s:2:"15";s:27:"product_display_description";s:1:"1";s:29:"product_description_maxlength";s:3:"200";s:21:"product_display_price";s:1:"1";s:27:"product_display_add_to_cart";s:1:"1";s:16:"display_wishlist";s:1:"1";s:15:"display_compare";s:1:"1";s:14:"display_rating";s:1:"1";s:12:"display_sale";s:1:"1";s:11:"display_new";s:1:"1";s:8:"date_day";s:1:"7";s:17:"product_image_num";s:1:"2";s:13:"product_image";s:1:"1";s:22:"product_get_image_data";s:1:"1";s:23:"product_get_image_image";s:1:"1";s:13:"product_width";s:3:"183";s:14:"product_height";s:3:"183";s:24:"product_placeholder_path";s:11:"nophoto.png";s:6:"effect";s:4:"none";s:16:"product_duration";s:3:"600";s:13:"product_delay";s:3:"300";s:18:"subcategory_center";s:1:"0";s:30:"subcategory_display_navigation";s:1:"1";s:24:"subcategory_display_loop";s:1:"1";s:24:"subcategory_margin_right";s:1:"5";s:19:"subcategory_slideby";s:1:"1";s:21:"subcategory_auto_play";s:1:"0";s:33:"subcategory_auto_interval_timeout";s:3:"300";s:28:"subcategory_auto_hover_pause";s:1:"1";s:27:"subcategory_auto_play_speed";s:3:"300";s:28:"subcategory_navigation_speed";s:4:"3000";s:26:"subcategory_start_position";s:1:"0";s:22:"subcategory_mouse_drag";s:1:"1";s:22:"subcategory_touch_drag";s:1:"1";s:16:"slider_auto_play";s:1:"1";s:25:"slider_display_navigation";s:1:"0";s:19:"slider_display_loop";s:1:"1";s:17:"slider_mouse_drag";s:1:"1";s:17:"slider_touch_drag";s:1:"1";s:23:"slider_auto_hover_pause";s:1:"1";s:28:"slider_auto_interval_timeout";s:4:"5000";s:22:"slider_auto_play_speed";s:4:"2000";s:8:"pre_text";s:170:"  &lt;a href=&quot;#&quot; title=&quot;banner&quot;&gt;   &lt;img src=&quot;image/catalog/banner/t22.jpg&quot; alt=&quot;banner&quot;&gt;            &lt;/a&gt;           ";s:9:"post_text";s:167:"   &lt;a href=&quot;#&quot; title=&quot;banner&quot;&gt;   &lt;img src=&quot;image/catalog/banner/s22.jpg&quot; alt=&quot;banner&quot;&gt;   &lt;/a&gt;                ";s:8:"moduleid";s:3:"154";}'
			category_id = $('.sp-cat-title-parent', $element).attr('data-catids');
			

		enableSelectBoxes();
		function enableSelectBoxes() {
			$tab_wrap = $('.spcat-tabs-wrap', $element);
				$tab_label_select.html($('.spcat-tab', $element).filter('.tab-sel').children('.spcat-tab-label').html());
			if ($(window).innerWidth() <= 479) {
				$tab_wrap.addClass('spcat-selectbox');
			} else {
				$tab_wrap.removeClass('spcat-selectbox');
			}
		}

		$('span.spcat-tab-selected, span.spcat-tab-arrow', $element).on("click", function () {
			if ($('.spcat-tabs', $element).hasClass('spcat-open')) {
				$('.spcat-tabs', $element).removeClass('spcat-open');
			} else {
				$('.spcat-tabs', $element).addClass('spcat-open');
			}
		});

		$(window).resize(function () {
			if ($(window).innerWidth() <= 479) {
				$('.spcat-tabs-wrap', $element).addClass('spcat-selectbox');
			} else {
				$('.spcat-tabs-wrap', $element).removeClass('spcat-selectbox');
			}
		});

		function showAnimateItems(el) {
			var $_items = $('.new-spcat-item', el), nub = 0;
			$('.spcat-loadmore-btn', el).fadeOut('fast');
			$_items.each(function (i) {
				nub++;
				switch(effect) {
					case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;
					default: animatesItems($(this),nub*delay,i,el);
				}
				if (i == $_items.length - 1) {
					$('.spcat-loadmore-btn', el).fadeIn(delay);
				}
				$(this).removeClass('new-spcat-item');
			});
		}

		function animatesItems($this,fdelay,i,el) {
			var $_items = $('.spcat-item', el);
			$this.attr("style",
				"-webkit-animation:" + effect +" "+ duration +"ms;"
				+ "-moz-animation:" + effect +" "+ duration +"ms;"
				+ "-o-animation:" + effect +" "+ duration +"ms;"
				+ "-moz-animation-delay:" + fdelay + "ms;"
				+ "-webkit-animation-delay:" + fdelay + "ms;"
				+ "-o-animation-delay:" + fdelay + "ms;"
				+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({
					opacity: 1,
					filter: 'alpha(opacity = 100)'
				}, {
					delay: 100
				});
			if (i == ($_items.length - 1)) {
				$(".spcat-items-inner").addClass("play");
			}
		}

		showAnimateItems($items_first_active);
		$tab.on('click.spcat-tab', function () {
			var $this = $(this);
			if ($this.hasClass('tab-sel')) return false;
			if ($this.parents('.spcat-tabs').hasClass('spcat-open')) {
				$this.parents('.spcat-tabs').removeClass('spcat-open');
			}
			$tab.removeClass('tab-sel');
			$this.addClass('tab-sel');
			var items_active = $this.attr('data-active-content');

			var _items_active = $(items_active,$element);
			$items_content.removeClass('spcat-items-selected');
			_items_active.addClass('spcat-items-selected');
			$tab_label_select.html($tab.filter('.tab-sel').children('.spcat-tab-label').html());
			var $loading = $('.spcat-loading', _items_active);
			var loaded = _items_active.hasClass('spcat-items-loaded');
			if (!loaded && !_items_active.hasClass('spcat-process')) {
				_items_active.addClass('spcat-process');
				var field_order = $this.attr('data-field_order');
				$loading.show();
				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: {
						spcat_module_id: rl_moduleid,
						is_ajax_super_category: 1,
						ajax_limit_start: 0,
						categoryid: category_id,
						fieldorder:field_order,
						setting : setting,
						ajax_reslisting_start: 0,
						lbmoduleid: '154'
					},
					success: function (data) {
						if (data.items_markup != '') {
							$('.spcat-items-inner', _items_active).html(data.items_markup);
							_items_active.addClass('spcat-items-loaded').removeClass('spcat-process');
							$loading.remove();
							showAnimateItems(_items_active);
							updateStatus(_items_active);
							
							if(type_show == 'slider' && rows != 1){
									var $tag_id = $('#so_super_category_1'),
									parent_active = 	$('.spcat-items-selected', $tag_id),
									total_product = parent_active.data('total'),
									tab_active = $('.ltabs-items-inner',parent_active),
									nb_column0 = 4,
									nb_column1 = 4,
									nb_column2 = 3,
									nb_column3 = 2,
									nb_column4 = 1;
									tab_active.owlCarousel2({
									nav: false,
									dots: false,
									margin: 10,
									loop:  true,
									autoplay: true,
									autoplayHoverPause: true,
									autoplayTimeout: 5000,
									autoplaySpeed: 2000,
									mouseDrag: true,
									touchDrag: true,
									navRewind: true,
									navText: [ '', '' ],
									responsive: {
										0: {
											items: nb_column4,
											nav: (total_product/1) >= nb_column4  ? true: false,
										},
										480: {
											items: nb_column3,
											nav: (total_product/1) >= nb_column3 ? false : ((false) ? true: false),
										},
										768: {
											items: nb_column2,
											nav: (total_product/1) >= nb_column2 ? false : ((false) ? true: false),
										},
										992: { 
											items: nb_column1,
											nav: (total_product/1) >= nb_column1 ? false : ((false) ? true: false),
											},
										1200: {
											items: nb_column0,
											nav: (total_product/1) >= nb_column0  ? true: false,
										},
									}
								});
                             }
						}
					},
					dataType: 'json'
				});

			} else {
				$('.spcat-item', $items_content).removeAttr('style').addClass('new-spcat-item').css('opacity',0);
				showAnimateItems(_items_active);
			}
		});
	})('#so_super_category_1');

	// So_super_category_2
	(function (element) {
		 var type_show = 'slider';
		  var rows = '1';
		var $element = $(element),
			$tab = $('.spcat-tab', $element),
			$tab_label = $('.spcat-tab-label', $tab),
			$tabs = $('.spcat-tabs', $element),
			ajax_url = $tabs.parents('.spcat-tabs-container').attr('data-ajaxurl'),
			effect = $tabs.parents('.spcat-tabs-container').attr('data-effect'),
			delay = $tabs.parents('.spcat-tabs-container').attr('data-delay'),
			duration = $tabs.parents('.spcat-tabs-container').attr('data-duration'),
			rl_moduleid = $tabs.parents('.spcat-tabs-container').attr('data-modid'),
			$items_content = $('.spcat-items', $element),
			$items_inner = $('.spcat-items-inner', $items_content),
			$items_first_active = $('.spcat-items-selected', $element),
			$load_more = $('.spcat-loadmore', $element),
			$btn_loadmore = $('.spcat-loadmore-btn', $load_more),
			$select_box = $('.spcat-selectbox', $element),
			$id_cate = $('.spcat-tab', $element).attr('data-id-cate'),
			$tab_label_select = $('.spcat-tab-selected', $element),
			setting = 'a:80:{s:6:"action";s:9:"save_edit";s:4:"name";s:27:"Electronics - Home Layout 1";s:18:"module_description";a:2:{i:1;a:1:{s:9:"head_name";s:11:"Electronics";}i:2;a:1:{s:9:"head_name";s:11:"Electronics";}}s:9:"head_name";s:11:"Electronics";s:17:"disp_title_module";s:1:"1";s:6:"status";s:1:"1";s:25:"advanced_mod_class_suffix";s:40:"cus-style-supper-cate  fa-empire #009688";s:16:"item_link_target";s:6:"_blank";s:8:"category";s:2:"17";s:14:"category_depth";s:1:"1";s:17:"field_product_tab";a:5:{i:0;s:7:"p_price";i:1;s:10:"p_quantity";i:2;s:6:"rating";i:3;s:12:"p_sort_order";i:4;s:5:"sales";}s:13:"field_preload";s:5:"sales";s:10:"limitation";s:1:"6";s:16:"product_ordering";s:4:"DESC";s:16:"category_column0";s:1:"4";s:16:"category_column1";s:1:"4";s:16:"category_column2";s:1:"3";s:16:"category_column3";s:1:"2";s:16:"category_column4";s:1:"1";s:24:"category_title_maxlength";s:2:"25";s:26:"display_title_sub_category";s:1:"1";s:22:"display_slide_category";s:1:"1";s:18:"show_category_type";s:1:"0";s:28:"sub_category_title_maxlength";s:2:"25";s:14:"category_width";s:3:"200";s:15:"category_height";s:3:"100";s:25:"category_placeholder_path";s:11:"nophoto.png";s:15:"product_column0";s:1:"4";s:15:"product_column1";s:1:"4";s:15:"product_column2";s:1:"3";s:15:"product_column3";s:1:"2";s:15:"product_column4";s:1:"1";s:9:"type_show";s:6:"slider";s:4:"rows";s:1:"1";s:21:"product_display_title";s:1:"1";s:23:"product_title_maxlength";s:2:"15";s:27:"product_display_description";s:1:"1";s:29:"product_description_maxlength";s:3:"200";s:21:"product_display_price";s:1:"1";s:27:"product_display_add_to_cart";s:1:"1";s:16:"display_wishlist";s:1:"1";s:15:"display_compare";s:1:"1";s:14:"display_rating";s:1:"1";s:12:"display_sale";s:1:"1";s:11:"display_new";s:1:"1";s:8:"date_day";s:1:"7";s:17:"product_image_num";s:1:"2";s:13:"product_image";s:1:"1";s:22:"product_get_image_data";s:1:"1";s:23:"product_get_image_image";s:1:"1";s:13:"product_width";s:3:"183";s:14:"product_height";s:3:"183";s:24:"product_placeholder_path";s:11:"nophoto.png";s:6:"effect";s:4:"none";s:16:"product_duration";s:3:"600";s:13:"product_delay";s:3:"300";s:18:"subcategory_center";s:1:"0";s:30:"subcategory_display_navigation";s:1:"1";s:24:"subcategory_display_loop";s:1:"1";s:24:"subcategory_margin_right";s:1:"5";s:19:"subcategory_slideby";s:1:"1";s:21:"subcategory_auto_play";s:1:"0";s:33:"subcategory_auto_interval_timeout";s:3:"300";s:28:"subcategory_auto_hover_pause";s:1:"1";s:27:"subcategory_auto_play_speed";s:3:"300";s:28:"subcategory_navigation_speed";s:4:"3000";s:26:"subcategory_start_position";s:1:"0";s:22:"subcategory_mouse_drag";s:1:"1";s:22:"subcategory_touch_drag";s:1:"1";s:16:"slider_auto_play";s:1:"1";s:25:"slider_display_navigation";s:1:"0";s:19:"slider_display_loop";s:1:"1";s:17:"slider_mouse_drag";s:1:"1";s:17:"slider_touch_drag";s:1:"1";s:23:"slider_auto_hover_pause";s:1:"1";s:28:"slider_auto_interval_timeout";s:4:"5000";s:22:"slider_auto_play_speed";s:4:"2000";s:8:"pre_text";s:170:"  &lt;a href=&quot;#&quot; title=&quot;banner&quot;&gt;   &lt;img src=&quot;image/catalog/banner/t22.jpg&quot; alt=&quot;banner&quot;&gt;            &lt;/a&gt;           ";s:9:"post_text";s:167:"   &lt;a href=&quot;#&quot; title=&quot;banner&quot;&gt;   &lt;img src=&quot;image/catalog/banner/s22.jpg&quot; alt=&quot;banner&quot;&gt;   &lt;/a&gt;                ";s:8:"moduleid";s:3:"154";}'
			category_id = $('.sp-cat-title-parent', $element).attr('data-catids');
			

		enableSelectBoxes();
		function enableSelectBoxes() {
			$tab_wrap = $('.spcat-tabs-wrap', $element);
				$tab_label_select.html($('.spcat-tab', $element).filter('.tab-sel').children('.spcat-tab-label').html());
			if ($(window).innerWidth() <= 479) {
				$tab_wrap.addClass('spcat-selectbox');
			} else {
				$tab_wrap.removeClass('spcat-selectbox');
			}
		}

		$('span.spcat-tab-selected, span.spcat-tab-arrow', $element).on("click", function () {
			if ($('.spcat-tabs', $element).hasClass('spcat-open')) {
				$('.spcat-tabs', $element).removeClass('spcat-open');
			} else {
				$('.spcat-tabs', $element).addClass('spcat-open');
			}
		});

		$(window).resize(function () {
			if ($(window).innerWidth() <= 479) {
				$('.spcat-tabs-wrap', $element).addClass('spcat-selectbox');
			} else {
				$('.spcat-tabs-wrap', $element).removeClass('spcat-selectbox');
			}
		});

		function showAnimateItems(el) {
			var $_items = $('.new-spcat-item', el), nub = 0;
			$('.spcat-loadmore-btn', el).fadeOut('fast');
			$_items.each(function (i) {
				nub++;
				switch(effect) {
					case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;
					default: animatesItems($(this),nub*delay,i,el);
				}
				if (i == $_items.length - 1) {
					$('.spcat-loadmore-btn', el).fadeIn(delay);
				}
				$(this).removeClass('new-spcat-item');
			});
		}

		function animatesItems($this,fdelay,i,el) {
			var $_items = $('.spcat-item', el);
			$this.attr("style",
				"-webkit-animation:" + effect +" "+ duration +"ms;"
				+ "-moz-animation:" + effect +" "+ duration +"ms;"
				+ "-o-animation:" + effect +" "+ duration +"ms;"
				+ "-moz-animation-delay:" + fdelay + "ms;"
				+ "-webkit-animation-delay:" + fdelay + "ms;"
				+ "-o-animation-delay:" + fdelay + "ms;"
				+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({
					opacity: 1,
					filter: 'alpha(opacity = 100)'
				}, {
					delay: 100
				});
			if (i == ($_items.length - 1)) {
				$(".spcat-items-inner").addClass("play");
			}
		}

		showAnimateItems($items_first_active);
		$tab.on('click.spcat-tab', function () {
			var $this = $(this);
			if ($this.hasClass('tab-sel')) return false;
			if ($this.parents('.spcat-tabs').hasClass('spcat-open')) {
				$this.parents('.spcat-tabs').removeClass('spcat-open');
			}
			$tab.removeClass('tab-sel');
			$this.addClass('tab-sel');
			var items_active = $this.attr('data-active-content');

			var _items_active = $(items_active,$element);
			$items_content.removeClass('spcat-items-selected');
			_items_active.addClass('spcat-items-selected');
			$tab_label_select.html($tab.filter('.tab-sel').children('.spcat-tab-label').html());
			var $loading = $('.spcat-loading', _items_active);
			var loaded = _items_active.hasClass('spcat-items-loaded');
			if (!loaded && !_items_active.hasClass('spcat-process')) {
				_items_active.addClass('spcat-process');
				var field_order = $this.attr('data-field_order');
				$loading.show();
				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: {
						spcat_module_id: rl_moduleid,
						is_ajax_super_category: 1,
						ajax_limit_start: 0,
						categoryid: category_id,
						fieldorder:field_order,
						setting : setting,
						ajax_reslisting_start: 0,
						lbmoduleid: '154'
					},
					success: function (data) {
						if (data.items_markup != '') {
							$('.spcat-items-inner', _items_active).html(data.items_markup);
							_items_active.addClass('spcat-items-loaded').removeClass('spcat-process');
							$loading.remove();
							showAnimateItems(_items_active);
							updateStatus(_items_active);
							
							if(type_show == 'slider' && rows != 1){
									var $tag_id = $('#so_super_category_2'),
									parent_active = 	$('.spcat-items-selected', $tag_id),
									total_product = parent_active.data('total'),
									tab_active = $('.ltabs-items-inner',parent_active),
									nb_column0 = 4,
									nb_column1 = 4,
									nb_column2 = 3,
									nb_column3 = 2,
									nb_column4 = 1;
									tab_active.owlCarousel2({
									nav: false,
									dots: false,
									margin: 10,
									loop:  true,
									autoplay: true,
									autoplayHoverPause: true,
									autoplayTimeout: 5000,
									autoplaySpeed: 2000,
									mouseDrag: true,
									touchDrag: true,
									navRewind: true,
									navText: [ '', '' ],
									responsive: {
										0: {
											items: nb_column4,
											nav: (total_product/1) >= nb_column4  ? true: false,
										},
										480: {
											items: nb_column3,
											nav: (total_product/1) >= nb_column3 ? false : ((false) ? true: false),
										},
										768: {
											items: nb_column2,
											nav: (total_product/1) >= nb_column2 ? false : ((false) ? true: false),
										},
										992: { 
											items: nb_column1,
											nav: (total_product/1) >= nb_column1 ? false : ((false) ? true: false),
											},
										1200: {
											items: nb_column0,
											nav: (total_product/1) >= nb_column0  ? true: false,
										},
									}
								});
                             }
						}
					},
					dataType: 'json'
				});

			} else {
				$('.spcat-item', $items_content).removeAttr('style').addClass('new-spcat-item').css('opacity',0);
				showAnimateItems(_items_active);
			}
		});
	})('#so_super_category_2');

	// so_super_category_3
	(function (element) {
		 var type_show = 'slider';
		  var rows = '1';
		var $element = $(element),
			$tab = $('.spcat-tab', $element),
			$tab_label = $('.spcat-tab-label', $tab),
			$tabs = $('.spcat-tabs', $element),
			ajax_url = $tabs.parents('.spcat-tabs-container').attr('data-ajaxurl'),
			effect = $tabs.parents('.spcat-tabs-container').attr('data-effect'),
			delay = $tabs.parents('.spcat-tabs-container').attr('data-delay'),
			duration = $tabs.parents('.spcat-tabs-container').attr('data-duration'),
			rl_moduleid = $tabs.parents('.spcat-tabs-container').attr('data-modid'),
			$items_content = $('.spcat-items', $element),
			$items_inner = $('.spcat-items-inner', $items_content),
			$items_first_active = $('.spcat-items-selected', $element),
			$load_more = $('.spcat-loadmore', $element),
			$btn_loadmore = $('.spcat-loadmore-btn', $load_more),
			$select_box = $('.spcat-selectbox', $element),
			$id_cate = $('.spcat-tab', $element).attr('data-id-cate'),
			$tab_label_select = $('.spcat-tab-selected', $element),
			setting = 'a:80:{s:6:"action";s:9:"save_edit";s:4:"name";s:27:"Electronics - Home Layout 1";s:18:"module_description";a:2:{i:1;a:1:{s:9:"head_name";s:11:"Electronics";}i:2;a:1:{s:9:"head_name";s:11:"Electronics";}}s:9:"head_name";s:11:"Electronics";s:17:"disp_title_module";s:1:"1";s:6:"status";s:1:"1";s:25:"advanced_mod_class_suffix";s:40:"cus-style-supper-cate  fa-empire #009688";s:16:"item_link_target";s:6:"_blank";s:8:"category";s:2:"17";s:14:"category_depth";s:1:"1";s:17:"field_product_tab";a:5:{i:0;s:7:"p_price";i:1;s:10:"p_quantity";i:2;s:6:"rating";i:3;s:12:"p_sort_order";i:4;s:5:"sales";}s:13:"field_preload";s:5:"sales";s:10:"limitation";s:1:"6";s:16:"product_ordering";s:4:"DESC";s:16:"category_column0";s:1:"4";s:16:"category_column1";s:1:"4";s:16:"category_column2";s:1:"3";s:16:"category_column3";s:1:"2";s:16:"category_column4";s:1:"1";s:24:"category_title_maxlength";s:2:"25";s:26:"display_title_sub_category";s:1:"1";s:22:"display_slide_category";s:1:"1";s:18:"show_category_type";s:1:"0";s:28:"sub_category_title_maxlength";s:2:"25";s:14:"category_width";s:3:"200";s:15:"category_height";s:3:"100";s:25:"category_placeholder_path";s:11:"nophoto.png";s:15:"product_column0";s:1:"4";s:15:"product_column1";s:1:"4";s:15:"product_column2";s:1:"3";s:15:"product_column3";s:1:"2";s:15:"product_column4";s:1:"1";s:9:"type_show";s:6:"slider";s:4:"rows";s:1:"1";s:21:"product_display_title";s:1:"1";s:23:"product_title_maxlength";s:2:"15";s:27:"product_display_description";s:1:"1";s:29:"product_description_maxlength";s:3:"200";s:21:"product_display_price";s:1:"1";s:27:"product_display_add_to_cart";s:1:"1";s:16:"display_wishlist";s:1:"1";s:15:"display_compare";s:1:"1";s:14:"display_rating";s:1:"1";s:12:"display_sale";s:1:"1";s:11:"display_new";s:1:"1";s:8:"date_day";s:1:"7";s:17:"product_image_num";s:1:"2";s:13:"product_image";s:1:"1";s:22:"product_get_image_data";s:1:"1";s:23:"product_get_image_image";s:1:"1";s:13:"product_width";s:3:"183";s:14:"product_height";s:3:"183";s:24:"product_placeholder_path";s:11:"nophoto.png";s:6:"effect";s:4:"none";s:16:"product_duration";s:3:"600";s:13:"product_delay";s:3:"300";s:18:"subcategory_center";s:1:"0";s:30:"subcategory_display_navigation";s:1:"1";s:24:"subcategory_display_loop";s:1:"1";s:24:"subcategory_margin_right";s:1:"5";s:19:"subcategory_slideby";s:1:"1";s:21:"subcategory_auto_play";s:1:"0";s:33:"subcategory_auto_interval_timeout";s:3:"300";s:28:"subcategory_auto_hover_pause";s:1:"1";s:27:"subcategory_auto_play_speed";s:3:"300";s:28:"subcategory_navigation_speed";s:4:"3000";s:26:"subcategory_start_position";s:1:"0";s:22:"subcategory_mouse_drag";s:1:"1";s:22:"subcategory_touch_drag";s:1:"1";s:16:"slider_auto_play";s:1:"1";s:25:"slider_display_navigation";s:1:"0";s:19:"slider_display_loop";s:1:"1";s:17:"slider_mouse_drag";s:1:"1";s:17:"slider_touch_drag";s:1:"1";s:23:"slider_auto_hover_pause";s:1:"1";s:28:"slider_auto_interval_timeout";s:4:"5000";s:22:"slider_auto_play_speed";s:4:"2000";s:8:"pre_text";s:170:"  &lt;a href=&quot;#&quot; title=&quot;banner&quot;&gt;   &lt;img src=&quot;image/catalog/banner/t22.jpg&quot; alt=&quot;banner&quot;&gt;            &lt;/a&gt;           ";s:9:"post_text";s:167:"   &lt;a href=&quot;#&quot; title=&quot;banner&quot;&gt;   &lt;img src=&quot;image/catalog/banner/s22.jpg&quot; alt=&quot;banner&quot;&gt;   &lt;/a&gt;                ";s:8:"moduleid";s:3:"154";}'
			category_id = $('.sp-cat-title-parent', $element).attr('data-catids');
			

		enableSelectBoxes();
		function enableSelectBoxes() {
			$tab_wrap = $('.spcat-tabs-wrap', $element);
				$tab_label_select.html($('.spcat-tab', $element).filter('.tab-sel').children('.spcat-tab-label').html());
			if ($(window).innerWidth() <= 479) {
				$tab_wrap.addClass('spcat-selectbox');
			} else {
				$tab_wrap.removeClass('spcat-selectbox');
			}
		}

		$('span.spcat-tab-selected, span.spcat-tab-arrow', $element).on("click", function () {
			if ($('.spcat-tabs', $element).hasClass('spcat-open')) {
				$('.spcat-tabs', $element).removeClass('spcat-open');
			} else {
				$('.spcat-tabs', $element).addClass('spcat-open');
			}
		});

		$(window).resize(function () {
			if ($(window).innerWidth() <= 479) {
				$('.spcat-tabs-wrap', $element).addClass('spcat-selectbox');
			} else {
				$('.spcat-tabs-wrap', $element).removeClass('spcat-selectbox');
			}
		});

		function showAnimateItems(el) {
			var $_items = $('.new-spcat-item', el), nub = 0;
			$('.spcat-loadmore-btn', el).fadeOut('fast');
			$_items.each(function (i) {
				nub++;
				switch(effect) {
					case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;
					default: animatesItems($(this),nub*delay,i,el);
				}
				if (i == $_items.length - 1) {
					$('.spcat-loadmore-btn', el).fadeIn(delay);
				}
				$(this).removeClass('new-spcat-item');
			});
		}

		function animatesItems($this,fdelay,i,el) {
			var $_items = $('.spcat-item', el);
			$this.attr("style",
				"-webkit-animation:" + effect +" "+ duration +"ms;"
				+ "-moz-animation:" + effect +" "+ duration +"ms;"
				+ "-o-animation:" + effect +" "+ duration +"ms;"
				+ "-moz-animation-delay:" + fdelay + "ms;"
				+ "-webkit-animation-delay:" + fdelay + "ms;"
				+ "-o-animation-delay:" + fdelay + "ms;"
				+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({
					opacity: 1,
					filter: 'alpha(opacity = 100)'
				}, {
					delay: 100
				});
			if (i == ($_items.length - 1)) {
				$(".spcat-items-inner").addClass("play");
			}
		}

		showAnimateItems($items_first_active);
		$tab.on('click.spcat-tab', function () {
			var $this = $(this);
			if ($this.hasClass('tab-sel')) return false;
			if ($this.parents('.spcat-tabs').hasClass('spcat-open')) {
				$this.parents('.spcat-tabs').removeClass('spcat-open');
			}
			$tab.removeClass('tab-sel');
			$this.addClass('tab-sel');
			var items_active = $this.attr('data-active-content');

			var _items_active = $(items_active,$element);
			$items_content.removeClass('spcat-items-selected');
			_items_active.addClass('spcat-items-selected');
			$tab_label_select.html($tab.filter('.tab-sel').children('.spcat-tab-label').html());
			var $loading = $('.spcat-loading', _items_active);
			var loaded = _items_active.hasClass('spcat-items-loaded');
			if (!loaded && !_items_active.hasClass('spcat-process')) {
				_items_active.addClass('spcat-process');
				var field_order = $this.attr('data-field_order');
				$loading.show();
				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: {
						spcat_module_id: rl_moduleid,
						is_ajax_super_category: 1,
						ajax_limit_start: 0,
						categoryid: category_id,
						fieldorder:field_order,
						setting : setting,
						ajax_reslisting_start: 0,
						lbmoduleid: '154'
					},
					success: function (data) {
						if (data.items_markup != '') {
							$('.spcat-items-inner', _items_active).html(data.items_markup);
							_items_active.addClass('spcat-items-loaded').removeClass('spcat-process');
							$loading.remove();
							showAnimateItems(_items_active);
							updateStatus(_items_active);
							
							if(type_show == 'slider' && rows != 1){
									var $tag_id = $('#so_super_category_3'),
									parent_active = 	$('.spcat-items-selected', $tag_id),
									total_product = parent_active.data('total'),
									tab_active = $('.ltabs-items-inner',parent_active),
									nb_column0 = 4,
									nb_column1 = 4,
									nb_column2 = 3,
									nb_column3 = 2,
									nb_column4 = 1;
									tab_active.owlCarousel2({
									nav: false,
									dots: false,
									margin: 10,
									loop:  true,
									autoplay: true,
									autoplayHoverPause: true,
									autoplayTimeout: 5000,
									autoplaySpeed: 2000,
									mouseDrag: true,
									touchDrag: true,
									navRewind: true,
									navText: [ '', '' ],
									responsive: {
										0: {
											items: nb_column4,
											nav: (total_product/1) >= nb_column4  ? true: false,
										},
										480: {
											items: nb_column3,
											nav: (total_product/1) >= nb_column3 ? false : ((false) ? true: false),
										},
										768: {
											items: nb_column2,
											nav: (total_product/1) >= nb_column2 ? false : ((false) ? true: false),
										},
										992: { 
											items: nb_column1,
											nav: (total_product/1) >= nb_column1 ? false : ((false) ? true: false),
											},
										1200: {
											items: nb_column0,
											nav: (total_product/1) >= nb_column0  ? true: false,
										},
									}
								});
                             }
						}
					},
					dataType: 'json'
				});

			} else {
				$('.spcat-item', $items_content).removeAttr('style').addClass('new-spcat-item').css('opacity',0);
				showAnimateItems(_items_active);
			}
		});
	})('#so_super_category_3');
});


/* ---------------------------------------------------
	Listing Tabs 9
-------------------------------------------------- */
$(document).ready(function($) {
	"use strict";
	var $tag_id = $('#so_listing_tabs_1'),
		parent_active = $('.items-category-20', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 5,
		nb_column1 = 4,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 30,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
	var $tag_id = $('#so_listing_tabs_1'),
		parent_active = $('.items-category-18', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 5,
		nb_column1 = 4,
		nb_column2 = 3,
		nb_column3 = 12,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 30,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
	var $tag_id = $('#so_listing_tabs_1'),
		parent_active = $('.items-category-25', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 5,
		nb_column1 = 4,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
								tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 30,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
});

$(document).ready(function($) {
	"use strict";
	(function(element) {
		var $element = $(element),
			$tab = $('.ltabs-tab', $element),
			$tab_label = $('.ltabs-tab-label', $tab),
			$tabs = $('.ltabs-tabs', $element),
			//ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),
			effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),
			delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),
			duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),
			type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),
			$items_content = $('.ltabs-items', $element),
			$items_inner = $('.ltabs-items-inner', $items_content),
			$items_first_active = $('.ltabs-items-selected', $element),
			$select_box = $('.ltabs-selectbox', $element),
			$tab_label_select = $('.ltabs-tab-selected', $element),
			type_show = 'slider';
			enableSelectBoxes();

		function enableSelectBoxes() {
			$tab_wrap = $('.ltabs-tabs-wrap', $element),
				$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());
			if ($(window).innerWidth() <= 767) {
				$tab_wrap.addClass('ltabs-selectbox');
			} else {
				$tab_wrap.removeClass('ltabs-selectbox');
			}
		}
		$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).on("click", function() {
			if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {
				$('.ltabs-tabs', $element).removeClass('ltabs-open');
			} else {
				$('.ltabs-tabs', $element).addClass('ltabs-open');
			}
		});
		$(window).resize(function() {
			if ($(window).innerWidth() <= 767) {
				$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');
			} else {
				$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');
			}
		});
		
		$tab.on('shown.bs.tab', function (e) {
		
			$($(e.target).attr('href'))
				.find('.owl2-carousel')
				.owlCarousel2('invalidate', 'width')
				.owlCarousel2('update')
		})
		
		$tab.on('click.tab', function() {
			var $this = $(this);
			
			if ($this.hasClass('tab-sel')) return false;
			if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {
				$this.parents('.ltabs-tabs').removeClass('ltabs-open');
			}
			$tab.removeClass('tab-sel');
			$this.addClass('tab-sel');
			var items_active = $this.attr('data-active-content');
			var _items_active = $(items_active, $element);
			$items_content.removeClass('ltabs-items-selected');
			_items_active.addClass('ltabs-items-selected');
			$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());
			var $loading = $('.ltabs-loading', _items_active);
			var loaded = _items_active.hasClass('ltabs-items-loaded');
			if (!loaded && !_items_active.hasClass('ltabs-process')) {
				_items_active.addClass('ltabs-process');
				var category_id = $this.attr('data-category-id');
				$loading.show();
				
			} 
		});

	})('#so_listing_tabs_1');
});


/* ---------------------------------------------------
	Listing Tabs 9 V2
-------------------------------------------------- */
$(document).ready(function($) {
	"use strict";
	var $tag_id = $('#so_listing_tabs_2'),
		parent_active = $('.items-category-1', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 6,
		nb_column1 = 5,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 0,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
	var $tag_id = $('#so_listing_tabs_2'),
		parent_active = $('.items-category-2', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 6,
		nb_column1 = 5,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 0,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
	var $tag_id = $('#so_listing_tabs_2'),
		parent_active = $('.items-category-3', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 6,
		nb_column1 = 5,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 0,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});	
	var $tag_id = $('#so_listing_tabs_2'),
		parent_active = $('.items-category-4', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 6,
		nb_column1 = 5,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 0,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
	var $tag_id = $('#so_listing_tabs_2'),
		parent_active = $('.items-category-5', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 6,
		nb_column1 = 5,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 0,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
	var $tag_id = $('#so_listing_tabs_2'),
		parent_active = $('.items-category-6', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 6,
		nb_column1 = 5,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 0,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
	var $tag_id = $('#so_listing_tabs_2'),
		parent_active = $('.items-category-7', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 6,
		nb_column1 = 5,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 0,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
	var $tag_id = $('#so_listing_tabs_2'),
		parent_active = $('.items-category-8', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 6,
		nb_column1 = 5,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 0,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
	var $tag_id = $('#so_listing_tabs_2'),
		parent_active = $('.items-category-9', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 6,
		nb_column1 = 5,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 0,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
	var $tag_id = $('#so_listing_tabs_2'),
		parent_active = $('.items-category-10', $tag_id),
		total_product = parent_active.data('total'),
		tab_active = $('.ltabs-items-inner', parent_active),
		nb_column0 = 6,
		nb_column1 = 5,
		nb_column2 = 3,
		nb_column3 = 2,
		nb_column4 = 1;
		tab_active.owlCarousel2({
		nav: true,
		dots: false,
		margin: 0,
		loop: false,
		autoplay: false,
		autoplayHoverPause: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 5000,
		navRewind: true,
		navText: ['', ''],
		responsive: {
			0: {
				items: nb_column4,
				nav: total_product <= nb_column4 ? false : ((true) ? true : false),
			},
			480: {
				items: nb_column3,
				nav: total_product <= nb_column3 ? false : ((true) ? true : false),
			},
			768: {
				items: nb_column2,
				nav: total_product <= nb_column2 ? false : ((true) ? true : false),
			},
			992: {
				items: nb_column1,
				nav: total_product <= nb_column1 ? false : ((true) ? true : false),
			},
			1200: {
				items: nb_column0,
				nav: total_product <= nb_column0 ? false : ((true) ? true : false),
			},
		}
	});
});

$(document).ready(function($) {;
	"use strict";
	(function(element) {
		var $element = $(element),
			$tab = $('.ltabs-tab', $element),
			$tab_label = $('.ltabs-tab-label', $tab),
			$tabs = $('.ltabs-tabs', $element),
			//ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),
			effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),
			delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),
			duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),
			type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),
			$items_content = $('.ltabs-items', $element),
			$items_inner = $('.ltabs-items-inner', $items_content),
			$items_first_active = $('.ltabs-items-selected', $element),
			$select_box = $('.ltabs-selectbox', $element),
			$tab_label_select = $('.ltabs-tab-selected', $element),
			type_show = 'slider';
			enableSelectBoxes();

		function enableSelectBoxes() {
			$tab_wrap = $('.ltabs-tabs-wrap', $element),
				$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());
			if ($(window).innerWidth() <= 767) {
				$tab_wrap.addClass('ltabs-selectbox');
			} else {
				$tab_wrap.removeClass('ltabs-selectbox');
			}
		}
		$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).on("click", function() {
			if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {
				$('.ltabs-tabs', $element).removeClass('ltabs-open');
			} else {
				$('.ltabs-tabs', $element).addClass('ltabs-open');
			}
		});
		$(window).resize(function() {
			if ($(window).innerWidth() <= 767) {
				$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');
			} else {
				$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');
			}
		});
		
		
		$tab.on('click.tab', function() {
			var $this = $(this);
			console.log('tabs');
			if ($this.hasClass('tab-sel')) return false;
			if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {
				$this.parents('.ltabs-tabs').removeClass('ltabs-open');
			}
			$tab.removeClass('tab-sel');
			$this.addClass('tab-sel');
			var items_active = $this.attr('data-active-content');
			var _items_active = $(items_active, $element);
			$items_content.removeClass('ltabs-items-selected');
			_items_active.addClass('ltabs-items-selected');
			$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());
			var $loading = $('.ltabs-loading', _items_active);
			var loaded = _items_active.hasClass('ltabs-items-loaded');
			if (!loaded && !_items_active.hasClass('ltabs-process')) {
				_items_active.addClass('ltabs-process');
				var category_id = $this.attr('data-category-id');
				$loading.show();
				
			} 
		});

	})('#so_listing_tabs_2');
});

		
/* ---------------------------------------------------
	Page Quickview
-------------------------------------------------- */
$(document).ready(function() {
	"use strict";
	var $nav = $("#thumb-slider");
	$nav.each(function() {
		$(this).owlCarousel2({
			nav: true,
			dots: false,
			slideBy: 1,
			margin: 10,
			responsive: {
				0: {
					items: 2
				},
				600: {
					items: 3
				},
				1000: {
					items: 3
				}
			}
		});
	})
	
	var zoomCollection = '.large-image img';
	$( zoomCollection ).elevateZoom({
		zoomType    : "inner",
		lensSize    :"200",
		easing:true,
		gallery:'thumb-slider',
		cursor: 'pointer',
		galleryActiveClass: "active"
	});
	$('.product-options li.radio').on("click", function(){
		$(this).addClass(function() {
			if($(this).hasClass("active")) return "";
			return "active";
		});
		
		$(this).siblings("li").removeClass("active");
		$(this).parent().find('.selected-option').html('<span class="label label-success">'+ $(this).find('img').data('original-title') +'</span>');
	})
});


/* ---------------------------------------------------
	Page Category Listing
-------------------------------------------------- */
$(document).ready(function(){
	"use strict";
	$('#cat_accordion').cutomAccordion ({
		eventType: 'click',
		autoClose: true,
		saveState: true,
		disableLink: true,
		speed: 'slow',
		showCount: false,
		autoExpand: true,
		cookie	: 'dcjq-accordion-1',
		classExpand	 : 'button-view'
	});

	var austDay = new Date(2018, 3 - 1, 28);
	$('.defaultCountdown-30').countdown(austDay, function(event) {
		var $this = $(this).html(event.strftime(''
		   + '<div class="time-item time-day"><div class="num-time">%D</div><div class="name-time">Day </div></div>'
		   + '<div class="time-item time-hour"><div class="num-time">%H</div><div class="name-time">Hour </div></div>'
		   + '<div class="time-item time-min"><div class="num-time">%M</div><div class="name-time">Min </div></div>'
		   + '<div class="time-item time-sec"><div class="num-time">%S</div><div class="name-time">Sec </div></div>'));
	});  
});

function display(view) {
	"use strict";
	$('.products-category .products-list').removeClass('list grid').addClass(view);
	$('.list-view .btn').removeClass('active');
	if(view == 'list') {
		$('.products-category .products-list .product-layout').addClass('col-lg-12');
		$('.products-category .products-list .product-layout .left-block').addClass('col-md-4');
		$('.products-category .products-list .product-layout .right-block').addClass('col-md-8');
		$('.products-category .products-list .product-layout .item-desc').removeClass('hidden')
		$('.list-view .' + view).addClass('active');
		$.cookie('display', 'list'); 
	}else{
		$('.products-category .products-list .product-layout').removeClass('col-lg-12');
		$('.products-category .products-list .product-layout .left-block').removeClass('col-md-4');
		$('.products-category .products-list .product-layout .right-block').removeClass('col-md-8');
		$('.products-category .products-list .product-layout .item-desc').addClass('hidden');
		$('.list-view .' + view).addClass('active');
		$.cookie('display', 'grid');
	}
}
	
$(document).ready(function () {
	// Check if Cookie exists
	if($.cookie('display')){
		view = $.cookie('display');
	}else{
		view = 'grid' ;
	}
	if(view) display(view);
	
	// Click Button
	$('.list-view .btn').each(function() {
		var ua = navigator.userAgent,
		event = (ua.match(/iPad/i)) ? 'touchstart' : 'click';
		$(this).on(event, function() {
			$(this).addClass(function() {
				if($(this).hasClass('active')) return ''; 
				return 'active';
			});
			$(this).siblings('.btn').removeClass('active');
			$catalog_mode = $(this).data('view');
			display($catalog_mode);
		});
		
	});
});

$(document).ready(function() {
	"use strict";
	var zoomCollection = '.large-image img';
	$( zoomCollection ).elevateZoom({
		zoomType    : "inner",
		lensSize    :"200",
		easing:true,
		gallery:'thumb-slider',
		cursor: 'pointer',
		galleryActiveClass: "active"
	});
	$('.large-image').magnificPopup({
		items: [
			{src: 'image/demo/shop/product/j9.jpg' },
			{src: 'image/demo/shop/product/j6.jpg' },
			{src: 'image/demo/shop/product/j5.jpg' },
			{src: 'image/demo/shop/product/j4.jpg' },
		],
		gallery: { enabled: true, preload: [0,2] },
		type: 'image',
		mainClass: 'mfp-fade',
		callbacks: {
			open: function() {
				var activeIndex = parseInt($('#thumb-slider .img.active').attr('data-index'), 10);
				var magnificPopup = $.magnificPopup.instance;
				magnificPopup.goTo(activeIndex);
			}
		}
	});
	$("#thumb-slider .owl2-item").each(function() {
		$(this).find("[data-index='0']").addClass('active');
	});
	
	$('.thumb-video').magnificPopup({
	  type: 'iframe',
	  iframe: {
		patterns: {
		   youtube: {
			  index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
			  id: 'v=', // String that splits URL in a two parts, second part should be %id%
			  src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe. 
				},
			}
		}
	});
	$('.product-options li.radio').on("click", function(){
		$(this).addClass(function() {
			if($(this).hasClass("active")) return "";
			return "active";
		});
		
		$(this).siblings("li").removeClass("active");
		$(this).parent().find('.selected-option').html('<span class="label label-success">'+ $(this).find('img').data('original-title') +'</span>');
	});
	// Product detial reviews button
	$(".reviews_button,.write_review_button").on("click", function (){
		var tabTop = $(".producttab").offset().top;
		$("html, body").animate({ scrollTop:tabTop }, 1000);
	});
	
	//Client Say
	$('.slider-clients-say').owlCarousel2({
		pagination: false,
		center: false,
		nav: true,
		loop: false,
		margin: 25,
		navText: [ 'prev', 'next' ],
		slideBy: 1,
		autoplay: false,
		autoplayTimeout: 2500,
		autoplayHoverPause: true,
		autoplaySpeed: 800,
		startPosition: 0, 
		responsive:{
			0:{
				items:1
			},
			480:{
				items:1
			},
			768:{
				items:1
			},
			1200:{
				items:1
			}
		}
	});	 
});

	
