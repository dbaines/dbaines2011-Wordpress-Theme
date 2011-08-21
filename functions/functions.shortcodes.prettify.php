<?php
/*
 Google Code Prettify
 http://code.google.com/p/google-code-prettify/
*/

// Removing Texturizing
remove_filter('the_excerpt', 'wptexturize');
remove_filter('the_content', 'wptexturize');
remove_filter('comment_text', 'wptexturize');

// Shortcode Function
function codebox_tag($atts, $content = null) {
	extract(shortcode_atts(array("lang" => "php", "line" => "none", "escaped" => "true", "caption" => ""), $atts));

	// Code blocks are technically figures
	$codebox .= "<figure class=\"codeboxFig\">";
	
	// Putting popup-ready content somewhere
	$codebox .= "<div class='codeboxPopup'>".$content."</div>";

	// View Source Link
	$codebox .= "<a href=''>Raw</a>";
	
// Fixing up Wordpress Stuff
	$content = preg_replace('<<br />>','',$content);
#	$content = preg_replace('<\n<p>>','',$content);
#	$content = preg_replace('<</p>\n>', '',$content);
	if ($escaped == "true") $content = htmlspecialchars_decode($content);

	// Line Numbers are optional
    if ($line != "none") {
        $codebox .= "<pre class='codebox codeboxLined prettyprint linenums:".$line."'>";		
    } else {
        $codebox .= "<pre class='codebox prettyprint'>";
    }
	
	// The content
	$codebox .= $content;
	$codebox .= "</pre>";
	
	if ($caption != "") {
		$codebox .= "<figcaption>".$caption."</figcaption>";
	}
	$codebox .= "</figure>";
	
	// Parse Code and Output
	//$codebox = $geshied->parse_code();
	return $codebox; 
	

}
add_shortcode("codebox", "codebox_tag");  

function wp_syntax_line_numbers($code, $start)
{
    $line_count = count(explode("\n", $code));
    $output = "<pre>";
    for ($i = 0; $i < $line_count; $i++)
    {
        $output .= ($start + $i) . "\n";
    }
    $output .= "</pre>";
    return $output;
}