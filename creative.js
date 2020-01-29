/**
 * File creative.js.
 *
 * Creative Blazer enhancements.
 *
 * Contains functions for cute animations.
 */

jQuery(document).ready(function($) {

	// Owl Carousel
	var $owlCarousel = $(".owl-carousel");
	//include owl carousel
	$owlCarousel.owlCarousel({
		items:1,
		lazyLoad: true,
		autoplay: true,
		loop: true,
		center: true,
		dotsEach: true,
		nav: true,
		animateIn: "fadeIn",
		animateOut: "fadeOut",
		navText : ["<i class='fa fa-3x fa-chevron-left'></i>","<i class='fa fa-3x fa-chevron-right'></i>"]
	});
	
	
	//scroll function
	$(window).scroll(function(){
		var top		= $(window).scrollTop(); //cache each window scroll amount
		
	//toggling sticky header class when page is at top or scrolled any amount
		$masthead	= $("#masthead"); //cache the handler for site header
		noScroll	= "no-scroll"; //make a variable for the string to be class name
		$backTop    = $("#back-to-top"); //make a variable for the back-to-top button
		if( top > 0 ) { //check for user scroll
			$masthead.removeClass(noScroll); //remove a css class from header
			$masthead.addClass("scrolled"); //add a css class to header
			$backTop.addClass("appear");//add appear class from back-to-top button
		}
		else { //for when the scroll amount is zero
			$masthead.removeClass("scrolled"); //remove css class from header
			$masthead.addClass(noScroll); //add css class to header
			$backTop.removeClass("appear");//remove appear class from back-to-top button
		}

		//Testimonials 2
		//fix testimonial page sidebar at select scroll heights
		var testimonialMenu	  	= $( ".testimonial-menu-tile" ); 
			footer			    = $( "#sub-footer" );
			footerPosition	    = footer.position().top;
			viewHeight			= $( window ).height();
			bottomPagePosition	= top + viewHeight;
		if( top > 164 && bottomPagePosition < footerPosition  ) {
			testimonialMenu.removeClass( "bottom" );
			testimonialMenu.addClass( "mid-fixed" );
    		$backTop.removeClass( "stick" );
		}
		else if( bottomPagePosition > footerPosition ) {
			testimonialMenu.removeClass( "mid-fixed" );
			testimonialMenu.addClass( "bottom" );
			$backTop.addClass( "stick" );
		}
		else {
			testimonialMenu.removeClass("mid-fixed");
			$backTop.removeClass( "stick" );
		}

		//hero bendy curve
		if( $("body").hasClass("home")) {
			var	$cbSlider 		= $( ".cb-slider" ); //cache hero section handler
				parallaxFactor	= Math.round(top / 2);
				parallaxRule	= parallaxFactor.toString() + "px";
				$heroCurveDiv	= $( "#cb-curved-corners" ); //cache element handle with lower curved corners
				borderRadHero	= Math.round(260 - top); //260px for initial border y radius minus scroll amount
				heroCurveRule	= "100% " + borderRadHero.toString() + "px"; //prepare the css rule to append to hero section
				$aboutDiv		= $( "#front-page-about" ); //cache element handle with lower curved corners
				borderRadAbout	= Math.round(top - 260); //0px initial to full curve
				aboutCurveRule 	= "100% " + borderRadAbout.toString() + "px"; //prepare the css rule to append to about section
			if (top <= 260) { //first 260 pixels the hero curve flattens to 0
				//parallax owl carousel
				$cbSlider.css({
					"top" : parallaxFactor
				})
				//dynamically change border radius as user scrolls
				$heroCurveDiv.css({ 
					"border-bottom-left-radius" : heroCurveRule, 
					"border-bottom-right-radius" : heroCurveRule,
					"box-shadow" : "0px 125px 0px 28px #549fa1" }); 
				//no about section border radius
				$aboutDiv.css({ 
					"border-top-left-radius" : "0", 
					"border-top-right-radius" : "0" });
			}
			else if (top > 260 && top <= 520) { //next 260 pixels about section curves to 260px
				//parallax owl carousel
				$cbSlider.css({
					"top" : parallaxFactor
				})
				//no hero border radius or box shadow
				$heroCurveDiv.css({ 
					"border-bottom-left-radius" : "0", 
					"border-bottom-right-radius" : "0",
					"box-shadow" : "none" });
				//dynamically change border radius of about section as user scrolls
				$aboutDiv.css({ 
					"border-top-left-radius" : aboutCurveRule, 
					"border-top-right-radius" : aboutCurveRule }); 
			}
			else {//beyond 520px
				//no more parallax
				//parallax owl carousel
				$cbSlider.css({
					"top" : "260px"
				})
				//no hero bend
				$heroCurveDiv.css({ 
					"border-bottom-left-radius" : "0", 
					"border-bottom-right-radius" : "0",
					"box-shadow" : "none" });
				//about section remains curved
				$aboutDiv.css({ 
					"border-top-left-radius" : "100% 260px", 
					"border-top-right-radius" : "100% 260px" });
			}
		} 
	});//end window scroll function

// smooth scrolling for internal page links.  Many thanks to Chris Coyier of css tricks
		// Select all links with hashes
		var $allLinks = $('a[href*="#"]')
		$allLinks
			// Remove links that don't actually link to anything
			.not('[href="#"]')
			.not('[href="#0"]')
			.click(function(event) {
				// On-page links
				if (
					location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
					&& 
					location.hostname == this.hostname
					&&
					!$(this).hasClass('children-nav-tab')
				) {
					// Figure out element to scroll to
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
					// Does a scroll target exist?
					if (target.length) {
					// Only prevent default if animation is actually gonna happen
					event.preventDefault();
						$('html, body').animate({
							scrollTop: target.offset().top
						}, 1000, function() {
							// Callback after animation
							// Must change focus!
							var $target = $(target);
							$target.focus();
							if ($target.is(":focus")) { // Checking if the target was focused
								return false;
							} else {
								$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
								$target.focus(); // Set focus again
							};
						});
					}
				}
		});//end smooth anchor scroll

	// Run functions for Show More/ Show All/ Close buttons on Testimonials page
	var $testimonialPage = 'page-template-archivish-testimonials';
	if ($('body').hasClass($testimonialPage)) {
		var $readMoreButton = $('.read-more-button');
			$testimonialBlock = $('.testimonial-blocks');
		//loop every testimonial block
		$testimonialBlock.each(function() {
			//remove button from blocks with 3 or less testimonials in them
			if($(this).children().length < 4){
				$(this).next($readMoreButton).addClass('d-none');
			}
			//hide extra testimonials by default
			$(this).children().slice(3).toggle();
		});
		//hide and show extra testimonials on button click
		$readMoreButton.toggle(function(){
			$(this).prev().children().slice(3).show(400);
			$(this).children().text('See Fewer Testimonials');
		},function(){
			$(this).prev().children().slice(3).slideUp(400);
			var $currentBlock = $(this).prev();
			$.scrollTo($currentBlock, 400, 82);
			$(this).children().text('See More Testimonials');
		});
	}//end hide show testimonials

	
});//end jquery















