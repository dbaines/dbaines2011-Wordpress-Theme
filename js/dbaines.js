/* ------------------------------------------------------------------------------

SCRIPTS
dbaines.com

------------------------------------------------------------------------------ */

$(function() {

/* ------------------------------------------------------------------------------
	SEARCH OPTIONS
------------------------------------------------------------------------------ */
// Hide searchOptions by default
$("#searchAnchor").click(function() {
	$("#search").toggleClass("searchOptionsGo");
});

/* ------------------------------------------------------------------------------
	PORTFOLIO SCRIPTS
------------------------------------------------------------------------------ */

/* ----- Galleries ----- */
// Vignette Effect
//$("a.galleryThumbnail").append('<div class="vignette"></div>');

// Fixing Titles for the Gallery on Colorbox pop ups
$("a.galleryThumbnail").children("img").each(function() {
	var newTitle = $(this).parent(".galleryImage").attr("title");
	$(this).attr("title",newTitle);
});

// Colorboxing Artwork
$("a.galleryThumbnail").colorbox({
	opacity: 0.92,
	scalePhotos: true,
	maxHeight: "90%",
	maxWidth: "90%",
	title: function() {
		var url = $(this).attr("href");
		var title = $(this).attr("title");
		var download = '<span id="cboxDownload"><a href="'+url+'" title="Download This Image"><strong>Download</strong></a></span>';
		var permalink = $(this).attr("data-permalink");
		return '<span id="cboxTitleLeft">'+title+'</span>'+download;
	}
});

// Colorboxing Motion Gallery
$("a.galleryMedia").colorbox({
	opacity: 0.92,
	scalePhotos: true,
	maxHeight: "90%",
	maxWidth: "90%",
	title: function() {
		var url = $(this).attr("data-video");
		var title = $(this).attr("title");
		var download = '<span id="cboxDownload"><a href="'+url+'" title="Download This Image"><strong>Download</strong></a></span>';
		var permalink = $(this).attr("data-permalink");
		//var facebook = '<div class="cbox-fblike"><iframe src="http://www.facebook.com/plugins/like.php?href='+permalink+'&amp;layout=button_count&amp;show_faces=true&amp;width=100&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe></div>';
		return '<span id="cboxTitleLeft">'+title+'</span>'+download;
	},
	scrolling:false,
	onComplete:function(){
			var thumbnail = $("#cboxLoadedContent").children("img").attr("src");
			var video = $(this).attr('data-video');
			var flvp = templateDir+"/flowplayer/flowplayer-3.2.6.swf";
			
			// Calling Flowplayer inside Colorbox, woah!
			$("#cboxLoadedContent").html('<a href="'+video+'" id="player"></a>');
			flowplayer("player", flvp,  {
							clip: {
									autoPlay: false,
									autoBuffering: true
							},
							plugins:{
									"controls":{
										"timeColor":"#ffffff",
										"borderRadius":"0px",
										"bufferGradient":"none",
										"slowForward":true,
										"backgroundColor":"rgba(0, 0, 0, 0)",
										"volumeSliderGradient":"none",
										"slowBackward":false,
										"timeBorderRadius":20,
										"progressGradient":"none",
										"time":true,
										"height":26,
										"volumeColor":"#4599ff",
										"tooltips":{
											"marginBottom":5,
											"scrubber":true,
											"volume":true,
											"buttons":false
										},
										"fastBackward":false,
										"opacity":1,
										"timeFontSize":12,
										"bufferColor":"#a3a3a3",
										"volumeSliderColor":"#ffffff",
										"border":"0px",
										"buttonColor":"#ffffff",
										"mute":true,
										"autoHide":{
											"enabled":true,
											"hideDelay":500,
											"hideStyle":"fade",
											"mouseOutDelay":500,
											"hideDuration":400,
											"fullscreenOnly":true
										},
										"backgroundGradient":"none",
										"width":"100pct",
										"display":"block",
										"sliderBorder":"1px solid rgba(128, 128, 128, 0.7)",
										"buttonOverColor":"#ffffff",
										"fullscreen":true,
										"timeBgColor":"rgb(0, 0, 0, 0)",
										"scrubberBarHeightRatio":0.2,
										"bottom":0,
										"stop":false,
										"sliderColor":"#000000",
										"zIndex":1,
										"scrubberHeightRatio":0.6,
										"tooltipTextColor":"#ffffff",
										"sliderGradient":"none",
										"timeBgHeightRatio":0.8,
										"volumeSliderHeightRatio":0.6,
										"timeSeparator":" ",
										"name":"controls",
										"volumeBarHeightRatio":0.2,
										"left":"50pct",
										"tooltipColor":"rgba(0, 0, 0, 0)",
										"playlist":false,
										"durationColor":"#b8d9ff",
										"play":true,
										"fastForward":true,
										"progressColor":"#4599ff",
										"timeBorder":"0px solid rgba(0, 0, 0, 0.3)",
										"scrubber":true,
										"volume":true,
										"volumeBorder":"1px solid rgba(128, 128, 128, 0.7)",
										"builtIn":false
									}
							}
			});
	}
});

// Wrap each image in a list item, ready for sliderising.
$(".websiteSlider").children("a").wrap("<li></li>");

var websiteNum = 0;
$(".websiteSlider").each(function() {
	
	// Fixing Titles for website slider colorbox
	$(".websiteSlider").find("a").each(function() {
		var newTitle = $(this).attr("title");
		$(this).children("img").attr("title",newTitle);
	});

	// Increment number for slider, for grouping
	websiteNum++;
	
	// Grab title from adjacent H2
	var thisTitle = $(this).parent(".websiteSliderContainer").parent(".websiteContainer").find("h2").html();
	$(this).find("a").attr("rel","web"+websiteNum).attr("title",thisTitle);
});

// Colorboxing for Website Slider
$(".websiteSlider a").colorbox({
	opacity: 0.92,
	scalePhotos: true,
	maxHeight: "90%",
	maxWidth: "90%",
	title: function() {
		var title = $(this).attr("title");
		return '<span id="cboxTitleLeft">'+title+'</span>';
	}
});

/* ------------------------------------------------------------------------------
	BLOG SCRIPTS
------------------------------------------------------------------------------ */
// Colorboxing Blog
$(".wp-caption a").addClass("wp-cbox");
$(".gallery-item a").addClass("wp-cbox");
$(".post").each(function() {
	var thisPost = $(this).attr("id");
	$(this).find(".wp-cbox").each(function() {
		// Grouping
		var thisTitle = $(this).children("img").attr("alt"); 
		$(this).attr({
			"title": thisTitle,
			"rel": thisPost
		});
	});
});

// History Relling
$(".historyLeft a").attr({
	"rel": "history"
});

$(".wp-cbox").colorbox({
	opacity: 0.92,
	scalePhotos: true,
	maxHeight: "90%",
	maxWidth: "90%",
	title: function() {
		var title = $(this).attr("title");
		return '<span id="cboxTitleLeft">'+title+'</span>';
	}
});
// Fixing Titles for blog colorboxes
$(".wp-cbox[title='']").children("img").each(function() {
	var newTitle = $(this).attr("title");
	$(this).parent("a").attr("title",newTitle);
});


/* ------------------------------------------------------------------------------
	EASY SLIDERS
------------------------------------------------------------------------------ */
$(".homepageSliderWrapper").easySlider({
	continuous: true,
	prevId: "largePrev",
	nextId: "largeNext",
	keyboard: true,
	speed: 600
});
$(".websiteSliderContainer").easySlider({
	continuous: false,
	numeric: true,
	prevId: "smallPrev",
	nextId: "smallNext",
	speed: 200
});

/* ------------------------------------------------------------------------------
	LARGE ARROWS
------------------------------------------------------------------------------ */
// EasySlider
$("#largeNext a").hover(function() {
	$(this).stop();
	$(this).animate({"right": "-80px", "width": "80px"},200);
}, function() {
	$(this).stop();
	$(this).animate({"right": "-60px", "width": "60px"});
});
$("#largePrev a").hover(function() {
	$(this).stop();
	$(this).animate({"left": "-80px", "width": "80px"},200);
}, function() {
	$(this).stop();
	$(this).animate({"left": "-60px", "width": "60px"});
});

// Colorbox
$("#cboxNext").hover(function() {
	$(this).animate({"right": "-80px", "width": "80px"},200);
}, function() {
	$(this).stop();
	$(this).animate({"right": "-60px", "width": "60px"});
});
$("#cboxPrevious").hover(function() {
	$(this).animate({"left": "-80px", "width": "80px"},200);
}, function() {
	$(this).stop();
	$(this).animate({"left": "-60px", "width": "60px"});
});

/* ------------------------------------------------------------------------------
	SOCIAL LINKS / RSS FEEDS / ICONS
------------------------------------------------------------------------------ */
$(".homepageFeedsExtended").hide();
$(".homepageFeeds > li").hover(function() {
	$(".homepageFeedsExtended").show();
}, function() {
	$(".homepageFeedsExtended").stop();
	$(".homepageFeedsExtended").hide();
});

/* End of doc.ready */
}); 