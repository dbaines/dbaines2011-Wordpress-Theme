<?php
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */



/***********************************
*
* EXTERNAL FUNCTIONS
* db2011
* 
* These functions can be found in /functions/
*
***********************************/
// Custom Post Types
include('functions/functions.post-types.php');

// Custom Wordpress Options Page
include('functions/functions.options.php');

// Shortcodes
include('functions/functions.shortcodes.php');

// Comments Template
include('functions/functions.comments.php');


/***********************************
*
* ADDING SHORTCODES INFO TO POSTING PAGE
* db2011
* 
* http://wordpress.org/support/topic/functionsphp-not-recognizing-add_meta_box
* 
***********************************/
// This function tells WP to add a new "meta box"
function add_shortcodes_box() {
	add_meta_box(
		'db2011_shortcodesbox', // id of the <div> we'll add
		'Shortcodes Reference', //title
		'db2011_shortcodesbox_content', // callback function that will echo the box content
		'post' // where to add the box: on "post", "page", or "link" page
	);
}
// Hook things in, late enough so that add_meta_box() is defined
if (is_admin())
	add_action('admin_menu', 'add_shortcodes_box');

// This function echoes the content of our meta box
function db2011_shortcodesbox_content() {
?>
<style>
.dbscLeft {float: left; clear: both; width: 20%;}
.dbscRight {float: right; width: 70%;}
.dbscLeft, .dbscRight {padding: 10px 0;}
</style>

<div class='dbscLeft'>[clear]</div>
<div class='dbscRight'><strong>Clear</strong><br />
Generic clear element for times when these things become unruly. </div>

<div class='dbscLeft'>[download file='' style='' label='']</div>
<div class='dbscRight'><strong>File Download Button</strong><br />
A download button. File attribute is the link, label attribute is the text for the link. Style defines what icon the button uses.<br />
Styles available: file, archive, pdf, psd, photo, email, love, lock, book, mouse, tick, add, cancel, rss, search, settings, comment, star, noicon</div>

<div class='dbscLeft'>[subhead id='']Heading[/subhead]</div>
<div class='dbscRight'><strong>Subheading</strong><br />
Subheading (H2) element with optional id for anchor linking</div>

<div class='dbscLeft'>[important]text[/important]</div>
<div class='dbscRight'><strong>Important Message</strong><br />
Yellow box with alert icon</div>

<div class='dbscLeft'>[info]text[/info]</div>
<div class='dbscRight'><strong>Info Message</strong><br />
Blue box with info icon</div>

<div class='dbscLeft'>[error]text[/error]</div>
<div class='dbscRight'><strong>Error Message</strong><br />
Red box with error icon</div>

<div class='dbscLeft'>[hilight]text[/hilight]</div>
<div class='dbscRight'><strong>Inline Highlight</strong><br />
Highlights the text with a yellow background</div>

<div class='dbscLeft'>[code]code[/code]</div>
<div class='dbscRight'><strong>Inline Code</strong><br />
Highlights the text with a grey background and changes the font</div>

<div class='dbscLeft'>[codebox lang='' line='' caption='']code[/codebox]</div>
<div class='dbscRight'><strong>Codebox</strong><br />
A GeSHi styled code box. If no line number is defined it will just render as a box, rather than a table with line numbers. Optional caption.</div>

<div class='dbscLeft'>[fright class='']text[/fright]</div>
<div class='dbscRight'><strong>Float Right</strong><br />
Floats the content to the right with optional class for further styling.</div>

<div class='dbscLeft'>[demodownload demo='' download='']</div>
<div class='dbscRight'><strong>Demo/Download</strong><br />
Shows two buttons, demo and download. Both attributes are for URLs to their respective links. Both attributes are optional, so you can have a demo with no download or a download with no demo. Or neither, but that's just nuts.</div>

<div class='dbscLeft'>[col span='' total='']text[/col]</div>
<div class='dbscRight'><strong>Columns</strong><br />
Columned Content. Span is how many columns this column takes up and total is how many columns there are total. Usually used in pairs or more.</div>

<div class='dbscLeft'>[scrobbles]</div>
<div class='dbscRight'><strong>AudioScrobbler</strong><br />
Uses the AudioScrobbler plugin. If not found will show a message saying so. </div>

<div style="clear:both;"></div>
<?php 
}

/***********************************
*
* VARIOUS FIXES
* db2011
*
***********************************/
// Removes <p> tags around the category descriptions
remove_filter('term_description','wpautop');

// Remove automatic links to feeds
// http://www.456bereastreet.com/archive/201103/controlling_and_customising_rss_feeds_in_wordpress/
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

/*************************************************
* Comment Buttons
* Adds buttons to comments for admin actions
*************************************************/
function delete_comment_link($id) {
  if (current_user_can('edit_post')) {
	echo '&bull; <a href="'.admin_url("comment.php?action=cdc&c=$id").'">Delete</a> ';
	echo '&bull; <a href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">Spam</a>';
  }
}

/***********************************
*
* CUSTOM LOGIN SCREEN
* db2010
*
***********************************/
function custom_login() { 
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/custom-login/custom-login.css" />'; 
}
add_action('login_head', 'custom_login');


/***********************************
*
* CUSTOM FIELDS FUNCTION
*
***********************************/
// Get Custom Field Template Values
function getCustomField($theField) {
	global $post;
	$block = get_post_meta($post->ID, $theField);
	if($block){
		foreach(($block) as $blocks) {
			echo $blocks;
		}
	}
}


/***********************************
*
* TWENTYTEN DEFAULT FUNCTIONS
*
***********************************/
include('functions/functions.twentyten.php');