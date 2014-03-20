/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/// No svg change all images to png
function scrollAnimatedTo(e){var t=jQuery("a[name="+e+"]").offset();jQuery("html,body").animate({scrollTop:t.top})}if(!Modernizr.svg){var imgs=document.getElementsByTagName("img"),dotSVG=/.*\.svg$/;for(var i=0;i!=imgs.length;++i)imgs[i].src.match(dotSVG)&&(imgs[i].src=imgs[i].src.slice(0,-3)+"png")}window.getComputedStyle||(window.getComputedStyle=function(e,t){this.el=e;this.getPropertyValue=function(t){var n=/(\-([a-z]){1})/g;t=="float"&&(t="styleFloat");n.test(t)&&(t=t.replace(n,function(){return arguments[2].toUpperCase()}));return e.currentStyle[t]?e.currentStyle[t]:null};return this});jQuery(document).ready(function(e){function s(){e(".ls-accordeon-row .ls-accordeon-header").click(function(n){var s=e(this).parent();if(e(s).hasClass("closed")){var u=e(s).find(".ls-accordeon-container-content").height();o(s,u,r)}else o(s,t,i)})}function o(r,i,s){i>0&&(i+=n);e(r).children(".ls-accordeon-container").stop().animate({height:i+"px"},{queue:!1,duration:s,complete:function(){i==t?e(r).addClass("closed"):i>t&&e(r).removeClass("closed")}})}function a(t){f();var n=e("#search_results"),r=e("#search_response");setTimeout(function(){u=e.ajax({type:"GET",data:{action:"search_product_database",query_value:t},url:constant_vars.ajax_url,success:function(t){l();var i=JSON.parse(t);n.empty();r.empty();if(i.state=="succes"){r.append("<p>"+i.response.title+"</p>");n.append(i.html)}else i.state=="failed"&&r.append("<p>"+i.response.title+"</p>");r.show();var s=r.offset();e("html,body").animate({scrollTop:s.top-130})}})},1e3)}function f(){e("#search_products_icon").fadeOut(100);e("#icon_loader").fadeIn(100)}function l(){e("#icon_loader").fadeOut(200);e("#search_products_icon").fadeIn(200)}function h(){var t='<div class="item">a'+c+'<img src="http://localhost/labservices/wp-content/themes/bones-bootstrap-sass/library/images/content/product_400x400.jpg"/></div>';e(".carousel-inner").append(t);c++}function p(){var t=12,n;d=="xs"?n=1:d=="sm"?n=2:d=="md"?n=3:d=="lg"&&(n=4);var r="",i="",s=e(".products .carousel"),o=e(".products .carousel-inner"),u=e(".products .main-product-frame"),a=e(".products .carousel-indicators"),f=1,l=!1;for(var c=u.length-1;c>=0;c--){c==u.length-1?l="active":l="";if(f==1){r+='<div class="item '+l+'"><div class="row">';i+='<li data-target="#myCarousel" data-slide-to="'+(f-1)+'" class="'+l+'">'}r+='<div class="main-product-frame col-sm-'+t/n+'">';r+=e(u[c]).html();r+="</div>";if(f==n||c==0){r+="</div></div>";f=1}else f++}a.empty();a.append(i);o.empty();o.append(r)}e(".active_language").click(function(){if(e(".language_select").hasClass("open")){e(".language_select").removeClass("open");e(".language_select").hide()}else{e(".language_select").addClass("open");e(".language_select").show()}});e(".js-show-menu").click(function(){e(".mobile-menu").hasClass("opened")?e(".mobile-menu").slideUp("fast",function(){e(".mobile-menu").removeClass("opened")}):e(".mobile-menu").slideDown("fast",function(){e(".mobile-menu").addClass("opened")})});s();var t=0,n=21,r=300,i=200,u;e("#search_products_icon").click(function(t){var n=e("#product_search_field").val();a(n)});e("#product_search_field").on("keyup",function(t){if(typeof u!="undefined"){u.abort();l()}clearTimeout(jQuery.data(this,"timer"));var n=e("#product_search_field").val();n!=""&&n.length>=3&&jQuery(this).data("timer",setTimeout(function(){a(n)},200))});var c=0;e(".social-feeds-carousel").carousel({interval:1e4});e(".social-feeds-carousel").on("slide.bs.carousel",function(t){e(".social-feeds-carousel .lab-feeds").animate({height:e(t.relatedTarget).outerHeight()})});e(".carousel").carousel();var d,v=function(){var t=e(window).width();return e(window).width()<768?"xs":e(window).width()>=768&&e(window).width()<992?"sm":e(window).width()>=992&&e(window).width()<1200?"md":"lg"},m=function(){if(d!==v()){d=v();e("body").removeClass("media-xs media-sm media-md media-lg");e("body").addClass("media-"+d);p()}};e(window).on("resize",function(){m()});m()});(function(e){function c(){n.setAttribute("content",s);o=!0}function h(){n.setAttribute("content",i);o=!1}function p(t){l=t.accelerationIncludingGravity;u=Math.abs(l.x);a=Math.abs(l.y);f=Math.abs(l.z);!e.orientation&&(u>7||(f>6&&a<8||f<8&&a>6)&&u>5)?o&&h():o||c()}if(!(/iPhone|iPad|iPod/.test(navigator.platform)&&navigator.userAgent.indexOf("AppleWebKit")>-1))return;var t=e.document;if(!t.querySelector)return;var n=t.querySelector("meta[name=viewport]"),r=n&&n.getAttribute("content"),i=r+",maximum-scale=1",s=r+",maximum-scale=10",o=!0,u,a,f,l;if(!n)return;e.addEventListener("orientationchange",c,!1);e.addEventListener("devicemotion",p,!1)})(this);(function(e,t,n,r){"use strict";function s(){var r=[{featureType:"all",elementType:"all",stylers:[{saturation:-100}]}],s=new google.maps.StyledMapType(r,{name:"grayscale"});e.ajax({type:"GET",data:{action:"get_maps_marker",post_id:constant_vars.post_id},url:constant_vars.ajax_url,success:function(e){var e=jQuery.parseJSON(e),r={center:new google.maps.LatLng(e.lat,e.lng),zoom:14,mapTypeControlOptions:{mapTypeIds:[google.maps.MapTypeId.ROADMAP,"map_style"]},scrollwheel:!1};i=new google.maps.Map(n.getElementById("map-canvas"),r);i.mapTypes.set("map_style",s);i.setMapTypeId("map_style");var o=new google.maps.LatLng(e.lat,e.lng),u=new google.maps.Marker({position:o,map:i,icon:{anchor:new google.maps.Point(28.5,76),size:new google.maps.Size(116,161),scaledSize:new google.maps.Size(58,80),origin:new google.maps.Point(0,0),url:constant_vars.theme_url+"/library/images/pointers/pointer_googlemaps.png"}});google.maps.event.addDomListener(t,"resize",function(){var e=i.getCenter();google.maps.event.trigger(i,"resize");i.setCenter(e)})}})}var i;google.maps.event.addDomListener(t,"load",s)})(jQuery,this,this.document);