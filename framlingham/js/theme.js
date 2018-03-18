 jQuery(document).ready(function($) {
	/*$(".tm-button").click(function(){
		$(".flex-card").toggleClass("flex-open");
	});*/
	$('.main-menu-button').click(function() {
		$(this).toggleClass('active');
		$('body').toggleClass('mobile-menu-active');
		$('.tm-mobile-nav-drop').slideToggle();
		return false;
	});

	$('.side-bar ul .menu-item-has-children > a, .menu-item-476 > a').click(function(event) {
		if($(this).attr('href') == '#') {
			event.preventDefault();
			$(this).toggleClass('active');
		}
		//$(this).next().stop().slideToggle();
	});

	/*=====  Load More  ======*/
	$('.load-more-button').click(function(event) {
		event.preventDefault();
		var nextLink = $('.next-trigger a').attr('href'),
			ajaxURL  = nextLink + ' #post-list';
		$(this).addClass('loading');
		$('#temp-posts').load(ajaxURL, function(){
			var posts = $('#temp-posts').find('.uk-grid').html(),
				nextTrigger =  $('#temp-posts').find('.next-trigger a').attr('href');

			$('#post-list .uk-grid').append(posts);
			$('#post-list .next-trigger a').attr('href', nextTrigger);
			$('.load-more-button').removeClass('loading');
			if(!nextTrigger){
				$('.load-more-button').hide();
			}
		});
	});

	$(window).on('load resize', function(event) {
		$('.home-banner').addClass('loaded');
		
	});

	$('.flexslider').flexslider({
    	animation: "fade-in",
    	smoothHeight: true,
    	touch:true
  	});

	/*var vimeoPlayers = $('.flexslider').find('iframe'), player;        

	for (var i = 0, length = vimeoPlayers.length; i < length; i++) {            
			player = vimeoPlayers[i];           
			$f(player).addEvent('ready', ready);        
	}       

	function addEvent(element, eventName, callback) {           
		if (element.addEventListener) {                 
			element.addEventListener(eventName, callback, false)            
		} else {                
			element.attachEvent(eventName, callback, false);            
		}       
	}       

	function ready(player_id) {             
		var froogaloop = $f(player_id);
		console.log('ready');           
		froogaloop.addEvent('play', function(data) {                
			$('.flexslider').flexslider("pause");          
			console.log('playing');
		});             
		froogaloop.addEvent('pause', function(data) {               
			$('.flexslider').flexslider("play");
		});
		froogaloop.addEvent('ended', function(data) {               
			$('.flexslider').flexslider("play");
		});



	}*/

	function sizeTheVideo(){
		// - 1.78 is the aspect ratio of the video
		// - This will work if your video is 1920 x 1080
		// - To find this value divide the video's native width by the height eg 1920/1080 = 1.78
		var aspectRatio = 1.78;

		var video = $('.videoWrapper iframe');

		video.each(function(index, el) {
			if( $(this).is(':visible')) {
				var videoHeight = $(this).outerHeight();
				var newWidth = videoHeight*aspectRatio;
				var halfNewWidth = newWidth/2;
				$(this).css({"width":newWidth+"px","left":"50%","margin-left":"-"+halfNewWidth+"px"});
			}
		});
	}

	sizeTheVideo();


	$('.flexslider').flexslider({
		animation: "slide",
		controlsContainer: $(".custom-controls-container"),
		customDirectionNav: $(".custom-navigation a"),
		smoothHeight: true,
		animationLoop: true,
		start: function(slider){
			if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
				$('.flexslider').flexslider("pause");

				var id = slider.slides.eq(slider.currentSlide).find('iframe').attr('id'),
					wistiaEmbed  = document.getElementById( id ).wistiaApi;

					console.log(wistiaEmbed);
					//wistiaEmbed.play();

				/*$f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('play');				
				console.log('start');*/
			}
				
		},
		before: function(slider){
			if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
				/*$f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');
				console.log('before');*/
				var id = slider.slides.eq(slider.currentSlide).find('iframe').attr('id'),
					wistiaEmbed  = document.getElementById( id ).wistiaApi;
					//wistiaEmbed.pause();

			}
		},
		after: function(slider){
			sizeTheVideo();
			if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
				/*$f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('play');
				console.log('after');*/
				$('.flexslider').flexslider("pause");

				var id = slider.slides.eq(slider.currentSlide).find('iframe').attr('id'),
					wistiaEmbed  = document.getElementById( id ).wistiaApi;
					//wistiaEmbed.play();

			}
		}
	});

	$(window).resize(function(){
		sizeTheVideo();
	});


	jQuery('#gform_4').on('gform_repeater_after_repeat gform_repeater_after_unrepeat', function(event, repeaterId, repeatId) {
		jQuery('#gform_4 .hasDatepicker').each(function(index, el) {
			if( $(this).data("datepicker") == null ) {
				$(this).removeClass('hasDatepicker');
				gformInitDatepicker();
			}
		});
	});


});