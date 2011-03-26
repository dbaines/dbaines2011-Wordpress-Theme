<!DOCTYPE html>
<html <?php language_attributes(); ?> class="error404<?php echo rand(1,2);?> no-js">
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?>
</title>
    
<?php // Modernizr in Header, everything else in footer ?>
<script src="<?php bloginfo('template_url'); ?>/js/modernizr-1.6.min.js"></script>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

<article>
	<div class="wrapper">
        <a href="<?php bloginfo('url'); ?>" id="logo" class="ir">dBaines.com</a>
        <p>
        	That's unfortunate! Try the <a href="<?php bloginfo("url"); ?>">homepage</a>.
        </p>
	</div>
</article>

</body>
</html>