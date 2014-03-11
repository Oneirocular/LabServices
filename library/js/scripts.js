/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

	// No svg change all images to png
	if (!Modernizr.svg) {
		var imgs = document.getElementsByTagName('img');
	    var dotSVG = /.*\.svg$/;
	    for (var i = 0; i != imgs.length; ++i) {
	        if(imgs[i].src.match(dotSVG)) {
	            imgs[i].src = imgs[i].src.slice(0, -3) + 'png';
	        }
	    }
	}


// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
	window.getComputedStyle = function(el, pseudo) {
		this.el = el;
		this.getPropertyValue = function(prop) {
			var re = /(\-([a-z]){1})/g;
			if (prop == 'float') prop = 'styleFloat';
			if (re.test(prop)) {
				prop = prop.replace(re, function () {
					return arguments[2].toUpperCase();
				});
			}
			return el.currentStyle[prop] ? el.currentStyle[prop] : null;
		}
		return this;
	}
}


// about us animation 
function scrollAnimatedTo(anchor) {
	console.log(anchor);

	var pos = jQuery('a[name='+anchor+']').offset();
			  		//var pos = search_response_container.offset();
	jQuery('html,body').animate({scrollTop: (pos.top) });

}





// as the page loads, call these scripts
jQuery(document).ready(function($) {




/* Language selector */
$('.active_language').click(function() {

	if ($('.language_select').hasClass("open")) {
		$('.language_select').removeClass("open");
		$('.language_select').hide();
	} else {
		$('.language_select').addClass("open");
		$('.language_select').show();
	}


});



$('.js-show-menu').click(function() {

	console.log('hha');

	if (!$('.mobile-menu').hasClass('opened')) {
		$('.mobile-menu').slideDown( "fast", function() {
			$('.mobile-menu').addClass('opened');
		});	
	} else {
		$('.mobile-menu').slideUp( "fast", function() {
			$('.mobile-menu').removeClass('opened');
		});	
	}



	// $('.mobile-menu .opened').slideUp( "fast", function() {
 //   		$('.mobile-menu').removeClass("opened");
 // 	 });

});




	/* ACCORDEON */
	init_accordeon();

	var closed_height = 0;
	var bottom_margin = 21;
	var open_duration = 300;
	var close_duration = 200;

	function init_accordeon() {

		$('.ls-accordeon-row .ls-accordeon-header').click(function(e) {
			var parent = $(this).parent();

			if ($(parent).hasClass('closed')) {
				// Open row
				var original_height = $(parent).find('.ls-accordeon-container-content').height();
				toggle(parent,original_height,open_duration);
			} else {
				// Close row
				toggle(parent,closed_height,close_duration);
			}

		});

	}

	// Handles the actual opening and closing
	function toggle(el, height, duration){

		// If not closing add margin
		if (height > 0) {
			height = height+bottom_margin;
		}

		$(el).children('.ls-accordeon-container').stop().animate(
			{
				height:height+'px'
			},
			{
				queue:false,
				duration:duration,
				complete:function(){

					if (height == closed_height) {
						$(el).addClass('closed'); 

					} else if (height > closed_height) {
						$(el).removeClass('closed'); 
					}

				}
			}
		);
	}



	/* SEARCHING */
var searchRequest; // this variable holds the search request

	$("#search_products_icon").click(function(e) {

		var query_value = $("#product_search_field").val();

		do_search(query_value);

	});





	/* Searching */


	$('#product_search_field').on('keyup', function(e) {


			// Abort the current search request
			if (typeof searchRequest != 'undefined') {
				searchRequest.abort();
				hide_loader();
			}

			// Set Timeout
			clearTimeout(jQuery.data(this, 'timer'));

			// Set Search String
			var search_string = $("#product_search_field").val();

			// Do Search
			if (search_string != '' && search_string.length >= 3) {
				jQuery(this).data('timer', setTimeout(function() { do_search(search_string); }, 200));
			};
		});



	function do_search(the_query) {

		show_loader();

		var search_result_container = $("#search_results");
		var search_response_container = $("#search_response");


		// use a light delay to give a better search experience

		setTimeout(function(){

			 searchRequest = $.ajax({
			  	type:'GET',
			  	data:{action:'search_product_database',query_value:the_query},
			  	url: constant_vars.ajax_url,
			  	success: function(returnvalue) {

			  		hide_loader();

			  		var return_object = JSON.parse(returnvalue);

			  		search_result_container.empty();
			  		search_response_container.empty();

			  		if (return_object.state == "succes") {

			  			search_response_container.append("<p>"+return_object.response.title+"</p>");
			  			search_result_container.append(return_object.html);

			  		} else if (return_object.state == "failed") {

			  			search_response_container.append("<p>"+return_object.response.title+"</p>");

			  		}

			  		search_response_container.show();

			  		var pos = search_response_container.offset();
			  		$('html,body').animate({scrollTop: (pos.top-130) });
			  		// $('body').animate({ scrollTop: '+=10' });
			  		
	//scroll(0,pos.top);
			  		//console.log(search_response_container.offset());
	    			//$("#search_response").animate({ scrollTop: '0px' });

			 	},

			  });


		}, 1000);






	}

	function show_loader() {
		$("#search_products_icon").fadeOut(100);
		$("#icon_loader").fadeIn(100);
	}

	function hide_loader() {
		$("#icon_loader").fadeOut(200);
		$("#search_products_icon").fadeIn(200);
	}

	/* CARROUSEL */

	var slide_nr = 0;


	function addToCarousel() {
		
		var html = '<div class="item">a'+slide_nr+'<img src="http://localhost/labservices/wp-content/themes/bones-bootstrap-sass/library/images/content/product_400x400.jpg"/></div>';
		$(".carousel-inner").append( html );

		slide_nr++;
		//$(".carousel-inner").hide();
	}

	



$('.social-feeds-carousel').carousel({
	interval: 10000
});


$('.social-feeds-carousel').on('slide.bs.carousel', function (e) {
    $('.social-feeds-carousel .lab-feeds').animate({height: $(e.relatedTarget).outerHeight()});
});



$('.carousel').carousel();


/*

UPDATE CAROUSEL

This function is called when a new media query is activated.
The product slider gets rearranged.

*/
function update_carousel() {

	// Init
	var nr_of_colums = 12;
	var items_per_slide;

	// Calculate the number of items per slide
	if (mode == 'xs') {
		items_per_slide = 1;
	} else if (mode == 'sm') {
		items_per_slide = 2;
	} else if (mode == 'md') {
		items_per_slide = 3;
	} else if (mode == 'lg') {
		items_per_slide = 4;
	};




	// Html containers
	var slides_html = '';
	var indicators_html = '';
	
	// 
	var carousel_container = $(".products .carousel");
	var carousel_inner = $(".products .carousel-inner");
	var slides = $(".products .main-product-frame");
	var carousel_indicator = $(".products .carousel-indicators");

	//
	var row_counter = 1;
	var state = false;

	// Slides generator
	for (var i = slides.length - 1; i >= 0; i--) {

		// First iteration
		if (i == slides.length-1) {
			state = 'active';
		} else {
			state = '';
		}

		// Start of row
		if (row_counter == 1) {
			// Create slide
			slides_html += '<div class="item '+state+'"><div class="row">';
			// Create indicator
			indicators_html += '<li data-target="#myCarousel" data-slide-to="'+(row_counter-1)+'" class="'+state+'">';
		}

		// Slide html
		slides_html += '<div class="main-product-frame col-sm-'+(nr_of_colums/items_per_slide)+'">';
		slides_html += $(slides[i]).html();
		slides_html += '</div>';


		// End of row or last iteration
		if (row_counter == items_per_slide || i == 0) {
			slides_html += '</div></div>';			
			row_counter = 1;
		} else {
			row_counter++;
		}

	};


	// Regenerate carousel indicators
	carousel_indicator.empty();
	carousel_indicator.append(indicators_html);

	// Regenerate carousel
	carousel_inner.empty();
	carousel_inner.append(slides_html);

}




/*
$('a[name=foo]')*/


	/*
	Responsive jQuery is a tricky thing.
	There's a bunch of different ways to handle
	it, so be sure to research and find the one
	that works for you best.
	*/
	
	// /* getting viewport width */
	// var responsive_viewport = $(window).width();
	
	// /* if is below 481px */
	// if (responsive_viewport < 481) {
	
	// } /* end smallest screen */
	
	// /* if is larger than 481px */
	// if (responsive_viewport > 481) {
	
	// } /* end larger than 481px */
	
	//  if is above or equal to 768px 
	// if (responsive_viewport >= 768) {
	
	// 	/* load gravatars */
	// 	$('.comment img[data-gravatar]').each(function(){
	// 		$(this).attr('src',$(this).attr('data-gravatar'));
	// 	});
		
	// }
	
	// /* off the bat large screen actions */
	// if (responsive_viewport > 1030) {
	
	// }
	

	var mode;
                

    var getMediaState = function () {
   		
   		var responsive_viewport = $(window).width();

        if ($(window).width() < 768) {
            return 'xs';
        }
        else if ($(window).width() >= 768 && $(window).width() < 992) {
            return 'sm';
        }
        else if ($(window).width() >= 992 && $(window).width() < 1200) {
            return 'md';
        }
        else {
            return 'lg';
        }

    };
        
    var checkViewport = function () {
        if (mode !== getMediaState()) {

            mode = getMediaState();

            $('body').removeClass('media-xs media-sm media-md media-lg');

            $('body').addClass('media-'+mode);
            // Fire carousel update
            update_carousel();
			//console.log(getMediaState());
        }
    };

    $(window).on('resize', function () {
        checkViewport();
    });

    checkViewport();
        
     

	
	// add all your scripts here
	
 
}); /* end of as page load scripts */


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
	var doc = w.document;
	if( !doc.querySelector ){ return; }
	var meta = doc.querySelector( "meta[name=viewport]" ),
		initialContent = meta && meta.getAttribute( "content" ),
		disabledZoom = initialContent + ",maximum-scale=1",
		enabledZoom = initialContent + ",maximum-scale=10",
		enabled = true,
		x, y, z, aig;
	if( !meta ){ return; }
	function restoreZoom(){
		meta.setAttribute( "content", enabledZoom );
		enabled = true; }
	function disableZoom(){
		meta.setAttribute( "content", disabledZoom );
		enabled = false; }
	function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
		if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );







/* Google maps */
(function ($, window, document, undefined) {

  'use strict';
  var map;
  function initialize() {

	  	var map_styling = [{
	  		featureType: "all",
	  		elementType: "all",
	  		stylers: [{ saturation: -100 }]	
	  	}];

	  	var map_type = new google.maps.StyledMapType(map_styling, { name:"grayscale" });

			$.ajax({
			type:'GET',
			data:{action:'get_maps_marker',post_id:constant_vars.post_id},
			url: constant_vars.ajax_url,
			success: function(returnvalue) {

				var returnvalue = jQuery.parseJSON(returnvalue);

				var map_options = {
					center: new google.maps.LatLng(returnvalue.lat, returnvalue.lng),
					zoom: 14,
					mapTypeControlOptions: {
						mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
					},
					scrollwheel: false 	
				}

				map = new google.maps.Map(document.getElementById("map-canvas"), map_options);
				map.mapTypes.set('map_style',map_type);
				map.setMapTypeId('map_style');


		

				// var image = new google.maps.MarkerImage(constant_vars.theme_url+"/library/images/pointers/pointer_googlemaps.png",
				//             new google.maps.Size(58, 80),
				//             new google.maps.Point(0, 0),
				//             new google.maps.Point(28.5, 76));


				var latLng = new google.maps.LatLng(returnvalue.lat, returnvalue.lng);
				var marker = new google.maps.Marker({
					position: latLng,
					map: map,
					icon: {
						anchor:new google.maps.Point(28.5, 76),
						size: new google.maps.Size(116, 161),
						scaledSize: new google.maps.Size(58, 80),
						origin:new google.maps.Point(0,0),
						url: constant_vars.theme_url+"/library/images/pointers/pointer_googlemaps.png" 
					}
				});


		  	 	//listeners
		  	 	//click
		  	 	// google.maps.event.addListener(marker, 'click', function() {
		  	 	// 	window.location.href = this.url;
		  	 	// });
		  	 	google.maps.event.addDomListener(window, "resize", function() {
		  	 		var center = map.getCenter();
		  	 		google.maps.event.trigger(map, "resize");
		  	 		map.setCenter(center);
		  	 	});


			}
		});

  }

  google.maps.event.addDomListener(window, 'load', initialize);

 }(jQuery, this, this.document));