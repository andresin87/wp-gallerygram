/*!
 * Gallerygram
 * http://shatmanov.com
 */
 
jQuery(function($) {
		
		var retina = window.devicePixelRatio > 1;
		if (retina) {
			jQuery("ul#instagramPhotos li.instablock div.album .photo-stats .stat-likes b").addClass( "retina" );
			jQuery("ul#instagramPhotos li.instablock div.album .photo-stats .stat-comments b").addClass( "retina" );
		}
		else {
		    //no retina display
		}
	
	$("ul#instagramPhotos li.instablock div.album").live('click',function(){

		if ($('#gallerygram_wrapper').is(':visible')) {
			
		} else {
			$("body").find('#gallerygram_wrapper').remove();
		}
		
		var scr = $(this).attr("gram-img");
		var scrvideo = $(this).attr("gram-video");
		if(!scrvideo){var scrObject = '<img src="'+scr+'" width="480">';var barClObject = ' novid';}else{var scrObject = '<video width="480" height="480" poster="'+scr+'" controls="controls" preload="auto" id="gallerygramvideo"><source type="video/mp4" src="'+scrvideo+'" /></video>';var barClObject = '';};
		var gramtitle = $(this).attr("gram-title");
		if(!gramtitle){var gramtitle = "Instagram";};
		var gramurl = $(this).attr("gram-url");
		var gramuser = $(this).attr("gram-user");
		var gramuserpic = $(this).attr("gram-user-pic");
		var gramid = $(this).attr("gram-id");
		var gramcommentcount = $(this).attr("gram-comment-count");
		if(gramcommentcount=='0'){var gramacommentshide = ' style="display: none;"';}else{var gramacommentshide = '';}
		
		var likegram = '#l'+gramid;
		var commentagram = '#com'+gramid;
		
		var retina = window.devicePixelRatio > 1;
		if (retina) {
			var retina = ' retina';
		}
		else {
		    var retina = '';
		}
		var jQueryih = jQuery('#gallerygram_wrapper').height();
		$( "body" ).css({"overflow": "hidden", "height": jQueryih});
				
		if ($('#gallerygram_wrapper').is(':visible')) {
			$("#gallerygram_wrapper").html('<div id="gallerygram_bg"></div><div id="gallerygram-box"><div id="gallerygram_close">×</div><div class="images">'+scrObject+'<span class="bar'+barClObject+'"><a href="'+gramurl+'">'+gramtitle+'</a></span><div id="controls_gram"><span class="prev_gram"></span><span class="next_gram"></span></div></div><div class="info"><img src="'+gramuserpic+'" class="avatar" align="left"><a href="//instagram.com/'+gramuser+'" title="'+gramuser+'" target="_blank">'+gramuser+'</a><br><span class="title">'+gramtitle+'</span>   <div class="likes'+retina+'"></div><div id="gramacomments"'+gramacommentshide+'></div>   </div></div>');
		} else {
			$("body").append('<div id="gallerygram_wrapper"><div id="gallerygram_bg"></div><div id="gallerygram-box"><div id="gallerygram_close">×</div><div class="images">'+scrObject+'<span class="bar'+barClObject+'"><a href="'+gramurl+'">'+gramtitle+'</a></span><div id="controls_gram"><span class="prev_gram"></span><span class="next_gram"></span></div></div><div class="info"><img src="'+gramuserpic+'" class="avatar" align="left"><a href="//instagram.com/'+gramuser+'" title="'+gramuser+'" target="_blank">'+gramuser+'</a><br><span class="title">'+gramtitle+'</span>   <div class="likes'+retina+'"></div><div id="gramacomments"'+gramacommentshide+'></div>   </div></div></div>');
		}

		$(likegram).clone().prependTo( "#gallerygram-box .info .likes" ).css('display', 'block');
		$(commentagram).clone().prependTo( "#gramacomments" ).css('display', 'block');
		
		if ($('#gallerygram_wrapper').is(':visible')) {
			
		} else {
			$("#gallerygram_wrapper").fadeIn(800);
		}
		
		
if(!scrvideo){}else{
		$('#gallerygramvideo').mediaelementplayer({features: ['progress'],alwaysShowControls: true,success: function (mediaElement, domObject) {mediaElement.play();}});
}
		
		$("#gallerygram-box .images").hover(
			function(){$("#gallerygram-box .images span.bar").css('display', 'block');},
			function(){$("#gallerygram-box .images span.bar").css('display', 'none');}
		);
		
		/* Навигация */
		var curr = $(this);
		$("#gallerygram-box .images #controls_gram span.prev_gram").hover(
			function(){$(this).addClass('hover'); if (retina) {$(this).addClass('retina');}else {}},
			function(){$(this).removeClass('hover'); if (retina) {$(this).removeClass('retina');}else {}}
		);
		$("#gallerygram-box .images #controls_gram span.prev_gram").click(function(){		
			curr.closest('ul#instagramPhotos li.instablock').prev().find('div.album').trigger('click');
		});
		$("#gallerygram-box .images #controls_gram span.next_gram").hover(
			function(){$(this).addClass('hover'); if (retina) {$(this).addClass('retina');}else {}},
			function(){$(this).removeClass('hover'); if (retina) {$(this).removeClass('retina');}else {}}
		);
		$("#gallerygram-box .images #controls_gram span.next_gram").click(function(){		
			curr.closest('ul#instagramPhotos li.instablock').next().find('div.album').trigger('click');
		});
			
		$('#gramacomments').perfectScrollbar();
		$("#gallerygram_bg, #gallerygram_close").click(function(){$("#gallerygram_wrapper").fadeOut(800, function() {$(this).remove();$( "body" ).css('overflow', 'visible');});});
		return false;
	});
	
	
	
	
	
	
	
	$("ul#gallerygram_widget li div.wgw").live('click',function(){

		if ($('#gallerygram_wrapper').is(':visible')) {
			
		} else {
			$("body").find('#gallerygram_wrapper').remove();
		}
		
		var scr = $(this).attr("gram-img");
		var scrvideo = $(this).attr("gram-video");
		if(!scrvideo){var scrObject = '<img src="'+scr+'" width="480">';var barClObject = ' novid';}else{var scrObject = '<video width="480" height="480" poster="'+scr+'" controls="controls" preload="auto" id="gallerygramvideo"><source type="video/mp4" src="'+scrvideo+'" /></video>';var barClObject = '';};
		var gramtitle = $(this).attr("gram-title");
		if(!gramtitle){var gramtitle = "Instagram";};
		var gramurl = $(this).attr("gram-url");
		var gramuser = $(this).attr("gram-user");
		var gramuserpic = $(this).attr("gram-user-pic");
		var gramid = $(this).attr("gram-id");
		var gramcommentcount = $(this).attr("gram-comment-count");
		if(gramcommentcount=='0'){var gramacommentshide = ' style="display: none;"';}else{var gramacommentshide = '';}
		
		var likegram = '#l'+gramid;
		var commentagram = '#com'+gramid;
		
		var retina = window.devicePixelRatio > 1;
		if (retina) {
			var retina = ' retina';
		}
		else {
		    var retina = '';
		}
		var jQueryih = jQuery('#gallerygram_wrapper').height();
		$( "body" ).css({"overflow": "hidden", "height": jQueryih});
				
		if ($('#gallerygram_wrapper').is(':visible')) {
			$("#gallerygram_wrapper").html('<div id="gallerygram_bg"></div><div id="gallerygram-box"><div id="gallerygram_close">×</div><div class="images">'+scrObject+'<span class="bar'+barClObject+'"><a href="'+gramurl+'">'+gramtitle+'</a></span><div id="controls_gram"><span class="prev_gram"></span><span class="next_gram"></span></div></div><div class="info"><img src="'+gramuserpic+'" class="avatar" align="left"><a href="//instagram.com/'+gramuser+'" title="'+gramuser+'" target="_blank">'+gramuser+'</a><br><span class="title">'+gramtitle+'</span>   <div class="likes'+retina+'"></div><div id="gramacomments"'+gramacommentshide+'></div>   </div></div>');
		} else {
			$("body").append('<div id="gallerygram_wrapper"><div id="gallerygram_bg"></div><div id="gallerygram-box"><div id="gallerygram_close">×</div><div class="images">'+scrObject+'<span class="bar'+barClObject+'"><a href="'+gramurl+'">'+gramtitle+'</a></span><div id="controls_gram"><span class="prev_gram"></span><span class="next_gram"></span></div></div><div class="info"><img src="'+gramuserpic+'" class="avatar" align="left"><a href="//instagram.com/'+gramuser+'" title="'+gramuser+'" target="_blank">'+gramuser+'</a><br><span class="title">'+gramtitle+'</span>   <div class="likes'+retina+'"></div><div id="gramacomments"'+gramacommentshide+'></div>   </div></div></div>');
		}

		$(likegram).clone().prependTo( "#gallerygram-box .info .likes" ).css('display', 'block');
		$(commentagram).clone().prependTo( "#gramacomments" ).css('display', 'block');
		
		if ($('#gallerygram_wrapper').is(':visible')) {
			
		} else {
			$("#gallerygram_wrapper").fadeIn(800);
		}
		
		
if(!scrvideo){}else{
		$('#gallerygramvideo').mediaelementplayer({features: ['progress'],alwaysShowControls: true,success: function (mediaElement, domObject) {mediaElement.play();}});
}
		
		$("#gallerygram-box .images").hover(
			function(){$("#gallerygram-box .images span.bar").css('display', 'block');},
			function(){$("#gallerygram-box .images span.bar").css('display', 'none');}
		);
		
		/* Навигация */
		var curr = $(this);
		$("#gallerygram-box .images #controls_gram span.prev_gram").hover(
			function(){$(this).addClass('hover'); if (retina) {$(this).addClass('retina');}else {}},
			function(){$(this).removeClass('hover'); if (retina) {$(this).removeClass('retina');}else {}}
		);
		$("#gallerygram-box .images #controls_gram span.prev_gram").click(function(){		
			curr.closest('ul#gallerygram_widget li').prev().find('div.album').trigger('click');
		});
		$("#gallerygram-box .images #controls_gram span.next_gram").hover(
			function(){$(this).addClass('hover'); if (retina) {$(this).addClass('retina');}else {}},
			function(){$(this).removeClass('hover'); if (retina) {$(this).removeClass('retina');}else {}}
		);
		$("#gallerygram-box .images #controls_gram span.next_gram").click(function(){		
			curr.closest('ul#gallerygram_widget li').next().find('div.album').trigger('click');
		});
			
		$('#gramacomments').perfectScrollbar();
		$("#gallerygram_bg, #gallerygram_close").click(function(){$("#gallerygram_wrapper").fadeOut(800, function() {$(this).remove();$( "body" ).css('overflow', 'visible');});});
		return false;
	});
	
});