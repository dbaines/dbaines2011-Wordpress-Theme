<?php

// Including Geshi
if(!function_exists('GeShi')) {
	include_once ('geshi/geshi.php');
}

// Removing Texturizing
remove_filter('the_excerpt', 'wptexturize');
remove_filter('the_content', 'wptexturize');
remove_filter('comment_text', 'wptexturize');

// Shortcode Function
function codebox_tag($atts, $content = null) {
	extract(shortcode_atts(array("lang" => "php", "line" => "none", "escaped" => "true", "caption" => ""), $atts));
	
	// Fixing up Wordpress Stuff
	$content = preg_replace('<<br />>','',$content);
#	$content = preg_replace('<\n<p>>','',$content);
#	$content = preg_replace('<</p>\n>', '',$content);
	if ($escaped == "true") $content = htmlspecialchars_decode($content);
	
	// Calling and Configing Geshi...
	$geshied = new GeSHi($content, $lang);
	//$geshied->enable_strict_mode(true);
	$geshied->set_tab_width(8);
	//$geshied->set_overall_class('codebox');
	//$geshied->set_header_type(GESHI_HEADER_PRE_VALID);
	//$geshied->enable_classes();

	// Code blocks are technically figures
	$codebox .= "<figure class=\"codeboxFig\">";

    if ($line != "none")
    {
        $codebox .= "<table class=\"codebox\"><tr><td class=\"line_numbers\">";
        $codebox .= wp_syntax_line_numbers($content, $line);
        $codebox .= "</td><td class=\"code\">";
        $codebox .= $geshied->parse_code();
        $codebox .= "</td></tr></table>";
    }
    else
    {
        $codebox .= "<div class=\"codebox\">";
        $codebox .= $geshied->parse_code();
        $codebox .= "</div>";
    }
	
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