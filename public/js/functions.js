/* global google */

jQuery(function($) {

	//#main-slider
	$(function(){
		$('#main-slider.carousel').carousel({
			interval: 8000
		});
	});
	
	
	//Initiat WOW JS
	new WOW().init();
	
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
			} else {
				$('.scrollup').fadeOut();
			}
		});
		$('.scrollup').click(function(){
			$("html, body").animate({ scrollTop: 0 }, 1000);
				return false;
		});
	
	// portfolio filter
	$(window).load(function(){'use strict';
		var $portfolio_selectors = $('.portfolio-filter >li>a');
		var $portfolio = $('.portfolio-items');
		$portfolio.isotope({
			itemSelector : '.portfolio-item',
			layoutMode : 'fitRows'
		});
		
		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});


	//Pretty Photo
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false
	});
        
        var url = window.location.href;

        // passes on every "a" tag
        $(".menu a").each(function() {
            // checks if its the same on the address bar
            if (url === (this.href)) {
                $(this).closest("li").addClass("active");
                $(this).addClass("active");
                //for making parent of submenu active
               $(this).closest("li").parent().parent().addClass("active");
            }
        });
    
    //Google Map
    if (typeof google !== 'undefined') {
        var get_latitude = $('#google-map').data('latitude');
        var get_longitude = $('#google-map').data('longitude');

        function initialize_google_map() {
            var myLatlng = new google.maps.LatLng(get_latitude, get_longitude);
            var mapOptions = {
                zoom: 14,
                scrollwheel: false,
                center: myLatlng
            };
            var map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize_google_map);
    }
});