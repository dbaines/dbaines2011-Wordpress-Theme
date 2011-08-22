<?php

/*************************************************
*
* CUSTOM SHORTCODES
* db2010-db2011
*
*************************************************/

/*************************************************
Shortcode: Clear
Usage [clear]
*************************************************/
function clearCode($atts) {
	return '<div class="clear">&nbsp;</div>';
}
add_shortcode("clear", "clearCode"); 

/*************************************************
Shortcode: Download Buttons
Usage type 1: [download file="path/to/file" style="pdf" label="this is a pdf button"]
Usage type 2: [download file="path/to/file" style="psd" label="this is a psd button"]
Usage type 3: [download file="path/to/file" style="file" label="this is a file button"]
Usage type 4: [download file="path/to/file" style="noicon" label="this is a button with no icon"]
Preceed buttons (or button rows) with [clear] for best results
*************************************************/

function downloadBtn($atts) {  
	extract(shortcode_atts(array(
	"style" => 'file',
	"file" => 'http://',
	"label" => 'Download',
	), $atts));
	
	# Google Tracking?
	$enableGoogleTracking = true;
		
	if($enableGoogleTracking) {
		$trackingCode = get_the_title()."/".$label;
		$tracking = ' onClick="javascript: _gaq.push([\'_trackPageview\', \''.$trackingCode.'\']);"';
	}
	
	$downloadbtn = '<a href="'.$file.'" class="downloadbtn downloadbtn_'.$style.'" title="'.$label.'"'.$tracking.' target="_blank"><span class="downloadbtn_icon"></span>'.$label.'</a>';
	
	return $downloadbtn;
}  
add_shortcode('download', 'downloadBtn');

/************************************************* 
Shortcode: Subheaders
Usage [subhead]Heading[/subhead]
*************************************************/
function subheader($atts, $content = null) {
	extract(shortcode_atts(array(
	"id" => null
	), $atts));
	
	if($id == null) :
		return '<h2 class="subheader">'.$content.'</h2>';  
	else :
		return '<h2 class="subheader" id="'.$id.'">'.$content.'</h2>';  
	endif;
}
add_shortcode("subhead", "subheader");  

/*************************************************
Shortcode: Important
Usage [important]content[/important]
*************************************************/
function important_tag($atts, $content = null) {
	return '<span class="message important">'.$content.'</span>';  
}
add_shortcode("important", "important_tag");  

/*************************************************
Shortcode: Info
Usage [info]content[/info]
*************************************************/
function info_tag($atts, $content = null) {
	return '<span class="message info">'.$content.'</span>';  
}
add_shortcode("info", "info_tag");  

/*************************************************
Shortcode: Error
Usage [error]content[/error]
*************************************************/
function error_tag($atts, $content = null) {
	return '<span class="message error">'.$content.'</span>';  
}
add_shortcode("error", "error_tag");  

/*************************************************
Shortcode: Hilight
Usage [hilight]functions.php[/hilight]
*************************************************/
function highlight_tag($atts, $content = null) {
	return '<span class="hilight">'.$content.'</span>';  
}
add_shortcode("hilight", "highlight_tag"); 

/*************************************************
Shortcode: Inline Code Highlight
Usage [code]functions.php[/code]
*************************************************/
function code_tag($atts, $content = null) {
	return '<code class="inline-code">'.$content.'</code>';  
}
add_shortcode("code", "code_tag"); 

/*************************************************
Shortcode: Float Right With Class
Usage [fright class="test"]This is to the right[/fright]
*************************************************/
function floatRight($atts) {  
	extract(shortcode_atts(array(
	"class" => '',
	), $atts));
	
	$return = '<div class="floatRight '.$class.'">'.$content.'</div>';
	
	return $downloadbtn;
}  
add_shortcode('floatRight', 'floatRight');

/*************************************************
Shortcode: Codebox
Usage [codebox lang="php/javascript/html/etc" line="1" caption="description text"]content[/codebox]
*************************************************/
// Want to use Google Code Prettify instead of Geshi?
#include("functions.shortcodes.prettify.php");
include('functions.shortcodes.geshi.php');

/*************************************************
Shortcode: Tab
Usage [tab]
Two spaces
*************************************************/
function tab_tag($content = null) {
	$content = "&nbsp;&nbsp;";
	return $content;
}
add_shortcode("tab", "tab_tag");

/*************************************************
* Demo/Download
* Tutorial buttons for demo link and download link
*************************************************/

function demodownload_tag($atts, $content = null) {
	extract(shortcode_atts(array("demo" => "", "download" => ""), $atts));
	$demodownload =  '<div class="ddlbox">';
	if ($demo != "") {
		$demodownload .=  '<a href="'.$demo.'" title="View Demo" class="ddlbox_demo">View Demo</a>';
	}
	if ($download != "") {
		$demodownload .=  '<a href="'.$download.'" title="Download Source Files" class="ddlbox_download">Download Files</a>';
	}
	$demodownload .=  '</div>';
	return $demodownload; 
	
}
add_shortcode("demodownload", "demodownload_tag");  

/*************************************************
* Columns
* [col span="x" total="y"]content[/col]
* where "x" or "y" can be 1,2,3,4.
* eg. [col span=3 total=4] produces a column that is three quaters wide.
* eg. [col span=1 total=3 first] produces a column that is one third wide.
*************************************************/

function col_tag($atts, $content = null) {
	extract(shortcode_atts(array("span" => "1", "total" => "1", "first" => ""), $atts));
	
	$column = "<div class='col col_".$span."_".$total;
	
	if ($first == "true") {$column .= " col_first";}
	
	$column .= "'>".$content."</div>";
	
	return $column; 
	
}
add_shortcode("col", "col_tag");  

/*************************************************
* Scrobbles
* [scrobbles]
*************************************************/
function scrobble_tag($content = null) {
	$content = "<ul class='scrobbles'>";
	if (function_exists(wpaudioscrobbler)) {$content .= /* wpaudioscrobbler(); */ "<li>coming soon</li>";} else { $content .= "<li><em>Audioscrobbler module missing or inactive</em></li>"; }
	$content .= "</ul>";
	return $content;
}
add_shortcode("scrobble", "scrobble_tag");


/*************************************************
* Replaces the wordpress caption divs with figure elements
* http://coding.smashingmagazine.com/2011/02/22/using-html5-to-transform-wordpress-twentyten-theme/
*************************************************/
add_shortcode('wp_caption', 'figure_caption_shortcode');
add_shortcode('caption', 'figure_caption_shortcode');

function figure_caption_shortcode($attr, $content = null) {

	extract(shortcode_atts(array(
	'id'    => '',
	'align'    => 'alignnone',
	'width'    => '',
	'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) ) {return $content;}
	if ( $id ) {$idtag = 'id="' . esc_attr($id) . '" '; }
	return '<figure ' . $idtag . 'aria-describedby="figcaption_' . $id . '" style="width: ' . (10 + (int) $width) . 'px" class="wp-caption ' . $align .'">'
	. do_shortcode( $content ) . '<figcaption id="figcaption_' . $id . '">' . $caption . '</figcaption></figure>';
}