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
		//var facebook = '<div class="cbox-fblike"><iframe src="http://www.facebook.com/plugins/like.php?href='+permalink+'&amp;layout=button_count&amp;show_faces=true&amp;width=100&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe></div>';
		return '<span id="cboxTitleLeft">'+title+'</span><span id="cboxGplus"></span>'+download;
	},
	onComplete: function() {
		// +1 Button
		if (gplus == true) {
			var permalink = $(this).attr("data-permalink");
			gapi.plusone.render("cboxGplus", {"size": "small", "count": gplus_count, "href": permalink});
		}
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
		return '<span id="cboxTitleLeft">'+title+'</span><span id="cboxGplus"></span>'+download;
	},
	scrolling:false,
	onComplete:function(){
			// Flowplayer settings
			var thumbnail = $("#cboxLoadedContent").children("img").attr("src");
			var video = $(this).attr('data-video');
			var flvp = templateDir+"/flowplayer/flowplayer-3.2.6.swf";
			
			// +1 Button
			if (gplus == true) {
				var permalink = $(this).attr("data-permalink");
				gapi.plusone.render("cboxGplus", {"size": "small", "count": gplus_count, "href": permalink});
			}
			
			// Calling Flowplayer inside Colorbox, woah!
			$("#cboxLoadedContent").html('<a href="'+video+'" id="player"></a>');
			flowplayer("player", flvp,  {
							clip: {
									autoPlay: false,
									autoBuffering: true
							},
							// This is probably a bit excessive
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
function colorboxTargets() {
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

	// History Relling™
	$(".historyLeft a").attr({
		"rel": "history"
	});

	// Colorboxing with Wordpress
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
	
	// Post Icons
	$(".category-link a").each(function() {
		
		// Get the Category Name, convert to lower case
		// I have a category with a "." in it, so lets convert that to something css friendly with a replace function
		var catName = $(this).text().toLowerCase().replace('.', '-');
		
		// Add Class to A
		$(this).addClass("category-"+catName);

		// Only show once the class has been applied
		$(this).show();
	});

}
colorboxTargets();

/* ------------------------------------------------------------------------------
	SUDO SLIDERS
------------------------------------------------------------------------------ */

$(".homepageSliderWrapper").sudoSlider({
	prevHtml: '<span id="largePrev"><a href="#" class="prevBtn"> previous </a></span>',
	nextHtml: '<span id="largeNext"><a href="#" class="nextBtn"> next </a></span>',
	controlsFade: false,
	continuous: false,
	autowidth: false,
	speed: 600
});

$(".websiteSliderContainer").sudoSlider({
	prevHtml: '<span id="smallPrev"><a href="#" class="prevBtn"> previous </a></span>',
	nextHtml: '<span id="smallNext"><a href="#" class="nextBtn"> next </a></span>',
	numeric: true,
	controlsShow: true,
	controlsFade: false,
	continuous: false,
	autowidth: false,
	updateBefore: true,
	prevNext: false,
	keyboardNav: false,
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

/* ------------------------------------------------------------------------------
	AJAX LOAD MORE POSTS
	Adapted from:
	http://wpcanyon.com/tipsandtricks/the-easy-way-to-make-wordpress-ajax-pagination-using-jquery/
	http://forum.jquery.com/topic/load-but-append-data-instead-of-replace
------------------------------------------------------------------------------ */
$('#loadMore a').live('click', function(e){

	// Stop right there, criminal scum!
	e.preventDefault();
	
	// Check if disabled
	if($(this).hasClass("disabledBtn")) {return false;}

	// Get the URL to load
	var linkToGet = $(this).attr('href');

	// Put load more link in to a variable in case we need it again later (error reporting)
	var oldLoadMore = $("#loadMore").html();

	// Show a loading message
	$('#loadMore').html('<span class="loadingPosts">Loading...</span>');
	
	// Hide any errors
	$(".loadError").hide();
	
	// Hide the pagination link
	$("#loadMorePagination").hide();
	$("#loadMorePaginationLinks").hide();
	
	// Some target logic
	if($("#blog-content").length>0) {var ajaxTarget = "#blog-content";}
	else if($("#search-content").length>0) {var ajaxTarget = "#search-content";}
	else if($("#archive-content").length>0) {var ajaxTarget = "#archive-content";}
	else {var ajaxTarget = "#content";}

	// Loading new content in to a div
	$("<div>").load(linkToGet+' '+ajaxTarget, function(response, status) {
		if(response.readyState = 4) {
		if(status == "success") {
			
			// Add page-break
			$(".posts-container").append("<div class='posts-pagebreak'>");

			// Getting page number from AJAX call and putting it in the page break
			var currentPage = $(".wp-pagenavi .pages", this).html();
			$(".posts-pagebreak").html("<span class='pages'>"+currentPage+"</div>");
			
			// Appending the html from this div in to #blog-content
			$(".posts-container").append($(this).find(".posts-container").html());
			
			// Loading new more link
			var loadMoreLink = $("#loadMore", this).html();
			$("#loadMore").html(loadMoreLink);
			
			// Loading new pagination links
			var loadMorePages = $("#loadMorePaginationLinks .wp-pagenavi", this);
			$("#loadMorePaginationLinks").html(loadMorePages);
			
			// Refresh Google +1 Buttons
			if (gplus == true) {
				gapi.plusone.go();
			}
			
			// Adding colorbox tags
			colorboxTargets();
			
			// Show pagination link
			$("#loadMorePagination").show();
			
		} else {
			// Show the load more button again
			$("#loadMore").html(oldLoadMore);
			
			// Show error message
			$("#loadMore").before("<span class='loadError'>Error retrieving posts. Please try again.</span>");
			
			// Show Pagination Links
			$("#loadMorePagination").show();
			
		}
		}
	});
});

// Do you want pagination instead? Well TOUGH LUCK BUDDY! What do you think this is? The Rit-- Oh. Yes, here it is.
$(".loadPagination").live("click",function(e) {
	// You know the drillbit. It goes on the drill. 
	e.preventDefault();
	// Hiding the pagination links because that would just be silly to keep them around. 
	$("#loadMorePagination").hide();
	// Fading in, because frankly I don't think this website has filled the fadeIn quota that every web2.0 website has. These IDs are getting worse.
	$("#loadMorePaginationLinks").fadeIn();
});

/* End of doc.ready */
}); 