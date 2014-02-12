/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

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

// as the page loads, call these scripts
jQuery(document).ready(function($) {

	



	/* PRODUCT GROUP ACCORDEON */
	init_productgroup_accordeon();

	var closed_height = 0;
	var bottom_margin = 21;
	var open_duration = 300;
	var close_duration = 200;

	function init_productgroup_accordeon() {

		$('.product-group .header').click(function(e) {
			var parent = $(this).parent();

			if ($(parent).hasClass('closed')) {
				// Open row
				var original_height = $(parent).find('.product-group-container').height();
				toggle(parent,original_height,open_duration);
			} else {
				// Close row
				toggle(parent,closed_height,close_duration);
			}

		});

	}

	// Handles the actual opening and closing
	function toggle(el, height, duration){

		$(el).children('.products').stop().animate(
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

		  			search_response_container.append("<h3>"+return_object.response.title+"</h3><p>"+return_object.response.description+"</p>");
		  			search_result_container.append(return_object.html);

		  		} else if (return_object.state == "failed") {

		  			search_response_container.append("<h3>"+return_object.response.title+"</h3><p>"+return_object.response.description+"</p>");

		  		}

		 	},

		  });
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

	
$('.carousel').carousel();
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