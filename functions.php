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
* VARIOUS FIXES
* db2011
*
***********************************/
// Removes <p> tags around the category descriptions
remove_filter('term_description','wpautop');

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
* CUSTOM POST TYPES
* db2011
*
***********************************/
register_post_type('artwork', array(	'label' => 'Artwork','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => '', 'with_front' => false),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('post_tag',),'labels' => array (
  'name' => 'Artwork',
  'singular_name' => 'Artwork',
  'menu_name' => 'Artwork',
  'add_new' => 'Add Artwork',
  'add_new_item' => 'Add New Artwork',
  'edit' => 'Edit',
  'edit_item' => 'Edit Artwork',
  'new_item' => 'New Artwork',
  'view' => 'View Artwork',
  'view_item' => 'View Artwork',
  'search_items' => 'Search Artwork',
  'not_found' => 'No Artwork Found',
  'not_found_in_trash' => 'No Artwork Found in Trash',
  'parent' => 'Parent Artwork',
),) );
register_post_type('motion', array(	'label' => 'Motion','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => '', 'with_front' => false),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('post_tag',),'labels' => array (
  'name' => 'Motion',
  'singular_name' => 'Motion',
  'menu_name' => 'Motion',
  'add_new' => 'Add Motion',
  'add_new_item' => 'Add New Motion',
  'edit' => 'Edit',
  'edit_item' => 'Edit Motion',
  'new_item' => 'New Motion',
  'view' => 'View Motion',
  'view_item' => 'View Motion',
  'search_items' => 'Search Motion',
  'not_found' => 'No Motion Found',
  'not_found_in_trash' => 'No Motion Found in Trash',
  'parent' => 'Parent Motion',
),) );
register_post_type('websites', array(	'label' => 'Websites','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => '', 'with_front' => false),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('post_tag',),'labels' => array (
  'name' => 'Websites',
  'singular_name' => 'Website',
  'menu_name' => 'Websites',
  'add_new' => 'Add Website',
  'add_new_item' => 'Add New Website',
  'edit' => 'Edit',
  'edit_item' => 'Edit Website',
  'new_item' => 'New Website',
  'view' => 'View Website',
  'view_item' => 'View Website',
  'search_items' => 'Search Websites',
  'not_found' => 'No Websites Found',
  'not_found_in_trash' => 'No Websites Found in Trash',
  'parent' => 'Parent Website',
),) );

// Adding Permalinks
// http://stackoverflow.com/questions/3859852/utilizing-wordpresss-permalink-structure-on-custom-post-types
function portfolio_permalinks() {
	// Single posts - must be put above indexes as they take priority
    add_rewrite_rule(
        'artwork/([^/]+)',
        'index.php?artwork=$matches[1]',
        'top'
	);
    add_rewrite_rule(
        'motion/([^/]+)',
        'index.php?motion=$matches[1]',
        'top'
	);
    add_rewrite_rule(
        'websites/([^/]+)',
        'index.php?websites=$matches[1]',
        'top'
	);
	
	// Index posts
    add_rewrite_rule(
        'artwork',
        'index.php?post_type=artwork',
        'top'
	);
    add_rewrite_rule(
        'motion',
        'index.php?post_type=motion',
        'top'
	);
    add_rewrite_rule(
        'websites',
        'index.php?post_type=websites',
        'top'
	);
}
add_action( 'init', 'portfolio_permalinks' );

/***********************************
*
* SEARCH FILTER
* db2011
* http://speckyboy.com/2010/09/19/10-useful-wordpress-search-code-snippets/
*
***********************************/
function SearchFilter($query) {
  if ($query->is_search or $query->is_feed) {
    // Portfolio
	if($_GET['post_type'] == "portfolio") {
		$query->set('post_type', array('artwork', 'websites', 'motion'));
	}
	// Tutorials
	elseif($_GET['post_type'] == "tutorials") {
		$query->set('category_name','tutorials');
	}
	// EVERYTHING! MWAHAHAHAHAHA
	elseif($_GET['post_type'] == "all") {
		$query->set('post_type', array('artwork', 'websites', 'motion', 'post'));
	}
  }
  return $query;
}
// This filter will jump into the loop and arrange our results before they're returned
add_filter('pre_get_posts','SearchFilter');

/***********************************
*
* CUSTOM SHORTCODES
* db2010-db2011
*
***********************************/

/** 
Shortcode: Clear
Usage [clear]
**/
function clearCode($atts) {
	return '<div class="clear">&nbsp;</div>';
}
add_shortcode("clear", "clearCode"); 

/** 
Shortcode: Download Buttons
Usage type 1: [download file="path/to/file" style="pdf" label="this is a pdf button"]
Usage type 2: [download file="path/to/file" style="psd" label="this is a psd button"]
Usage type 3: [download file="path/to/file" style="file" label="this is a file button"]
Usage type 4: [download file="path/to/file" style="noicon" label="this is a button with no icon"]
Preceed buttons (or button rows) with [clear] for best results
**/

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
	
	$downloadbtn = '<a href="'.$file.'" class="downloadbtn downloadbtn_'.$style.'" title="Download '.$label.'"'.$tracking.'><span class="downloadbtn_icon"></span>'.$label.'</a>';
	
	return $downloadbtn;
}  
add_shortcode('download', 'downloadBtn');

/** 
Shortcode: Subheaders
Usage [subhead]Heading[/subhead]
**/
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

/** 
Shortcode: Important
Usage [important]content[/important]
**/
function important_tag($atts, $content = null) {
	return '<span class="message important">'.$content.'</span>';  
}
add_shortcode("important", "important_tag");  

/** 
Shortcode: Info
Usage [info]content[/info]
**/
function info_tag($atts, $content = null) {
	return '<span class="message info">'.$content.'</span>';  
}
add_shortcode("info", "info_tag");  

/** 
Shortcode: Error
Usage [error]content[/error]
**/
function error_tag($atts, $content = null) {
	return '<span class="message error">'.$content.'</span>';  
}
add_shortcode("error", "error_tag");  

/** 
Shortcode: Hilight
Usage [hilight]functions.php[/hilight]
**/
function highlight_tag($atts, $content = null) {
	return '<span class="hilight">'.$content.'</span>';  
}
add_shortcode("hilight", "highlight_tag"); 

/** 
Shortcode: Inline Code Highlight
Usage [code]functions.php[/code]
**/
function code_tag($atts, $content = null) {
	return '<code class="inline-code">'.$content.'</code>';  
}
add_shortcode("code", "code_tag"); 

/** 
Shortcode: Float Right With Class
Usage [fright class="test"]This is to the right[/fright]
**/
function floatRight($atts) {  
	extract(shortcode_atts(array(
	"class" => '',
	), $atts));
	
	$return = '<div class="floatRight '.$class.'">'.$content.'</div>';
	
	return $downloadbtn;
}  
add_shortcode('floatRight', 'floatRight');

/** 
Shortcode: Codebox
Usage [codebox lang="php/javascript/html/etc]content[/codebox]
Geshi code unceremoniously stolen from WP-Syntax
Sorry - but it wasn't working with my shortcode, so I had to frankencode it :P
If you're reading this, check out WP-Syntax, it's pretty cool: 
http://wordpress.org/extend/plugins/wp-syntax/
**/
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
	extract(shortcode_atts(array("lang" => "php", "line" => "none", "escaped" => "true"), $atts));
	
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


/** 
* Demo/Download
* Tutorial buttons for demo link and download link
**/

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

/** 
* Columns
* [col span="x" total="y"]content[/col]
* where "x" or "y" can be 1,2,3,4.
* eg. [col span=3 total=4] produces a column that is three quaters wide.
* eg. [col span=1 total=3 first] produces a column that is one third wide.
**/

function col_tag($atts, $content = null) {
	extract(shortcode_atts(array("span" => "1", "total" => "1", "first" => ""), $atts));
	
	$column = "<div class='col col_".$span."_".$total;
	
	if ($first == "true") {$column .= " col_first";}
	
	$column .= "'>".$content."</div>";
	
	return $column; 
	
}
add_shortcode("col", "col_tag");  

/**
* Scrobbles
* [scrobbles]
**/
function scrobble_tag($content = null) {
	$content = "<ul class='scrobbles'>";
	if (function_exists(wpaudioscrobbler)) {$content .= /* wpaudioscrobbler(); */ "<li>coming soon</li>";} else { $content .= "<li><em>Audioscrobbler module missing or inactive</em></li>"; }
	$content .= "</ul>";
	return $content;
}
add_shortcode("scrobble", "scrobble_tag");

/** 
* Comment Buttons
* Adds buttons to comments for admin actions
**/
function delete_comment_link($id) {
  if (current_user_can('edit_post')) {
	echo '&bull; <a href="'.admin_url("comment.php?action=cdc&c=$id").'">Delete</a> ';
	echo '&bull; <a href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">Spam</a>';
  }
}

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
* COMMENTS TEMPLATE
*
***********************************/
if ( ! function_exists( 'twentyten_comment' ) ) :
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS ['comment'] = $comment; ?>
	<?php if ( '' == $comment->comment_type ) : ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-top">
        	<div class="comment-author vcard">
            	<?php $defaultgrav = get_bloginfo("template_url")."/images/default-avatar.png";?>
				<?php echo get_avatar( $comment, 48, $defaultgrav ); ?>
				<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'twentyten' ), get_comment_author_link() ); ?>
            </div>
            <div class="comment-meta">
            	<?php printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?>
            	&bull; <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">Permalink</a>
            	<?php edit_comment_link( __( 'Edit', 'twentyten' ),' &bull; ','' ); ?>
	            <?php delete_comment_link(get_comment_ID());  ?>
			</div>
		</div>
        
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<span class="comment-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></span>
			<br />
		<?php endif; ?>

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
	    </div>
    <?php # end li omitted, for some reason wordpress adds it anyway, adding it in as you would will only break things ?>

	<?php else : ?>
	<li class="post pingback">
		<p><?php _e( 'Pingback: ', 'twentyten' ); ?><?php comment_author_link(); ?><?php edit_comment_link ( __('edit', 'twentyten'), '&nbsp;&nbsp;', '' ); ?></p>
	<?php endif;
}
endif;



/***********************************
*
* DEFAULT FUNCTIONS BELOW
*
***********************************/



/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );

	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	if ( ! defined( 'HEADER_IMAGE' ) )
		define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	/*
	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 198 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
	*/
	
	// Don't support text inside the header image.
	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
	add_custom_image_header( '', 'twentyten_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/berries.jpg',
			'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Berries', 'twentyten' )
		),
		'cherryblossom' => array(
			'url' => '%s/images/headers/cherryblossoms.jpg',
			'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Cherry Blossoms', 'twentyten' )
		),
		'concave' => array(
			'url' => '%s/images/headers/concave.jpg',
			'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Concave', 'twentyten' )
		),
		'fern' => array(
			'url' => '%s/images/headers/fern.jpg',
			'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Fern', 'twentyten' )
		),
		'forestfloor' => array(
			'url' => '%s/images/headers/forestfloor.jpg',
			'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Forest Floor', 'twentyten' )
		),
		'inkwell' => array(
			'url' => '%s/images/headers/inkwell.jpg',
			'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Inkwell', 'twentyten' )
		),
		'path' => array(
			'url' => '%s/images/headers/path.jpg',
			'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'twentyten' )
		),
		'sunset' => array(
			'url' => '%s/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Sunset', 'twentyten' )
		)
	) );
}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function twentyten_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 140;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	if(!in_category("tutorials")) :
	return ' <a class="readmore" href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
	endif;
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip; ' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Twenty Ten 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Twenty Ten 1.0
 * @deprecated Deprecated in Twenty Ten 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	
	register_sidebar( array(
		'name' => __( 'Recent Posts', 'twentyten' ),
		'id' => 'recentposts-widget-area',
		'description' => __( 'Recent Posts', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Categories', 'twentyten' ),
		'id' => 'categories-widget-area',
		'description' => __( 'Categories', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Recent Comments', 'twentyten' ),
		'id' => 'recentcomments-widget-area',
		'description' => __( 'Recent Comments', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;
