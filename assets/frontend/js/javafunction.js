$(function() {
 //carousel begin
 $(".carousel").jCarouselLite({
	 
 btnNext: ".next",
 btnPrev: ".prev",
 			speed: 500,
			crossfade: false,
			autopagination:false,
 			autoplay: 5000
 });
 //rollover hover
 $(".carousel li").hover(function() { //On hover...
 var thumbOver = $(this).find("img").attr("src"); //Get image url and assign it to 'thumbOver'
 $(this).find("span").css({'background' : 'url(' + thumbOver + ') no-repeat center bottom'});
 //Animate the image to 0 opacity (fade it out)
 $(this).find("a").stop().fadeTo('normal', 1 , function() {
 // $(this).hide() //Hide the image after fade
 });
 } , function() { //on hover out...
 //Fade the image to full opacity
 $(this).find("a").stop().fadeTo('normal', 1).show();
 });
 }); 