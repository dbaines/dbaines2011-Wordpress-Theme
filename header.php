<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>

	<?php // Important Meta Business ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="author" content="David Baines">
    <meta name="description" content="South Australian Web Developer - Portfolio & Blog">
    <meta name="keywords" content="David Baines, dbaines, South Australian Web Developer, Art, Adelaide, Para Hills">
    
    <?php // Mobile Viewport Reset ?>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

	<?php // Insano Title of +10 Insanity ?>
    <title><?php
        global $page, $paged;
        wp_title( '|', true, 'right' );
    
		// Custom Post Types in Title
		$post_type = get_post_type(get_the_ID());
		if($post_type == "artwork") {
			echo "Artwork | ";
		} else if($post_type == "motion") {
			echo "Motion | ";
		}else if($post_type == "websites") {
			echo "Websites | ";
		}
	
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
    
	<?php // Modernizr & Flowplayer in Header, everything else in footer ?>
    <script src="<?php bloginfo('template_url'); ?>/js/modernizr-1.6.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/flowplayer-3.2.6.min.js"></script>

	<?php // Links and Stylesheets and What not - Oh my! ?>    
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    
    <?php // Icons ?>
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    
    <?php // Pingbacks ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    <?php // Feeds ?>
	<link href="<?php bloginfo('url'); ?>/?post_type=post&amp;feed=rss2" rel="alternate" type="application/atom+xml" title="dBaines.com - Blog Posts" />
	<link href="<?php bloginfo('url'); ?>/?post_type=portfolio&feed=rss2" rel="alternate" type="application/atom+xml" title="dBaines.com - Portfolio Posts" />
	<link href="<?php bloginfo('url'); ?>/?post_type=tutorials&feed=rss2" rel="alternate" type="application/atom+xml" title="dBaines.com - Tutorial Posts Only" />
	<link href="<?php bloginfo('url'); ?>/?post_type=all&feed=rss2" rel="alternate" type="application/atom+xml" title="dBaines.com - All Posts" />
	<link href="<?php bloginfo('comments_rss2_url'); ?>" rel="alternate" type="application/atom+xml" title="dBaines.com - Blog Comments" />
    
    <?php 
	// Social Share Thumbnails
	// Uses a post-thumbnail if available, otherwise uses a generic image
		
		// Get Any Post Thumbnails (Tutorials/Motion/Websites)
		if (is_single() && has_post_thumbnail()) {
			$FullImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
			$LargeImageLink = $FullImage[0];
			
			// Facebook Thumbnail
			echo '<meta property="og:image" content="'.$LargeImageLink.'" />';
			
			// Non-Facebook Thumbnail
			echo '<link rel="image_src" href="'. $LargeImageLink .'" />';
		}
		
		// If Artwork
		elseif(get_post_type(get_the_ID()) == "artwork") {
			
			$imageid = get_post_meta($post->ID, 'File Upload', true); 
			$LargeImageLink = wp_get_attachment_url( $imageid );
			
			// Facebook Image
		    echo '<meta property="og:image" content="'.$LargeImageLink.'" />';
			
			// Non-Facebook Image
			echo '<link rel="image_src" href="'. $LargeImageLink .'" />';
			
		} else {
	
	// If there is no post thumbnail, fall back to genetic image
	?>
    <meta property="og:image" content="<?php bloginfo("template_url"); ?>/images/facebook.png" />
    <link rel="image_src" href="<?php bloginfo("template_url"); ?>/images/facebook.png" />
    <?php } ?>
    
    <?php // Facebook Stuff ?>
    <meta property="og:type" content="website" /> 
    <meta property="og:site_name" content="dBaines.com" /> 
    <meta property="fb:admins" content="537643353" /> 
    <meta property="fb:app_id" content="169017283147625" /> 
    
    <?php // Wordpress Stuff ?>
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) {wp_enqueue_script( 'comment-reply' );} wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>
	<div class="wrapper">
        <a href="<?php bloginfo('url'); ?>" id="logo" class="ir" title="dBaines.com">dBaines.com</a>
        <form id="search" name="searchform" method="get" action="<?php bloginfo("url"); ?>" <?php if(is_search()) {echo "class='current'";}?>>
            
            <section id="searchMain">
				<input type="search" id="s" name="s" title="Search Blog" placeholder="Search dBaines.com" />
                <button type="submit" value="search" id="searchsubmit">Search</button>
                <a href="#" id="searchAnchor">Search Options</a>
            </section>
            <section id="searchOptions">
                <input type="radio" value="all" name="post_type" id="searchOptionsAll" checked /> <label for="searchOptionsAll">Search All</label><br />
                <input type="radio" value="post" name="post_type" id="searchOptionsBlog" /> <label for="searchOptionsBlog">Search Blog Only</label><br />
                <input type="radio" value="portfolio" name="post_type" id="searchOptionsPortfolio" /> <label for="searchOptionsPortfolio">Search Portfolio Only</label><br />
                <input type="radio" value="tutorials" name="post_type" id="searchOptionsTutorials" /> <label for="searchOptionsTutorials">Search Tutorials Only</label>
            </section>
        </form>
        <nav>
            <ul>
                <li><a href="<?php bloginfo('url'); ?>/about" <?php 
					if(is_page('about') or is_page('my computer')) {echo "class='current'";} 
					?>>about</a>
                    <ul>
                    	<li><a href="<?php bloginfo('url'); ?>/about#contact">contact me</a></a>
                    </ul>
                </li>
                <li><a href="<?php bloginfo('url'); ?>/blog" <?php 
					if(
						is_page('blog') or 
						is_category() or 
						is_tag() or 
						is_home() && get_post_type(get_the_ID()) != "artwork" &&  
							get_post_type(get_the_ID()) != "motion" &&  
							get_post_type(get_the_ID()) != "websites" or
						is_single() && get_post_type(get_the_ID()) != "artwork" &&  
							get_post_type(get_the_ID()) != "motion" &&  
							get_post_type(get_the_ID()) != "websites"
					) {echo "class='current'";}
					?>>blog</a>
                    <ul>
                         <li><a href="<?php bloginfo('url'); ?>/blog/category/tutorials">tutorials</a></li>
                    </ul>
                </li>
                <li><a href="<?php bloginfo('url'); ?>/portfolio" <?php
                	if(
						is_page('portfolio') or 
						is_single() && get_post_type(get_the_ID()) == "artwork" or
						is_single() && get_post_type(get_the_ID()) == "motion" or
						is_single() && get_post_type(get_the_ID()) == "websites" or
						!is_search() && get_post_type(get_the_ID()) == "artwork" or 
						!is_search() && get_post_type(get_the_ID()) == "motion" or 
						!is_search() && get_post_type(get_the_ID()) == "websites"
					) {echo "class='current'";}
				?>>portfolio</a>
                    <ul>
                        <li><a href="<?php bloginfo('url'); ?>/websites">websites</a></li>
                        <li><a href="<?php bloginfo('url'); ?>/artwork">artwork</a></li>
                        <li><a href="<?php bloginfo('url'); ?>/motion">motion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <hgroup id="headerTitle">
            <h2>
            <?php

				if(is_single()) {
					if (in_category("tutorials")) {echo "<a href='".get_bloginfo('url')."/blog/category/tutorials/' title='Return to Tutorials'>Tutorials</a> <a href='".get_bloginfo('url')."/?post_type=tutorials&amp;feed=rss2' class='headerRSS' title='Subscribe to Tutorials'>Subscribe to Tutorials</a>";}
					elseif (get_post_type(get_the_ID()) == "artwork") {echo "<a href='".get_bloginfo("url")."/?post_type=artwork' title='Return to Artwork Gallery'>Artwork</a> <a href='".get_bloginfo('url')."/?post_type=artwork&amp;feed=rss2' class='headerRSS' title='Subscribe to Artwork'>Subscribe to Artwork</a>";}
					elseif (get_post_type(get_the_ID()) == "motion") {echo "<a href='".get_bloginfo("url")."/?post_type=motion' title='Return to Motion Gallery'>Motion</a> <a href='".get_bloginfo('url')."/?post_type=motion&amp;feed=rss2' class='headerRSS' title='Subscribe to Motion'>Subscribe to Motion</a>";}
					elseif (get_post_type(get_the_ID()) == "websites") {echo "<a href='".get_bloginfo("url")."/?post_type=websites' title='Return to Websites Gallery'>Websites</a> <a href='".get_bloginfo('url')."/?post_type=websites&amp;feed=rss2' class='headerRSS' title='Subscribe to Websites'>Subscribe to Websites</a>";}
					else {echo "<a href='".get_bloginfo("url")."/blog/' title='Return to Blog'>Blog</a> <a href='".get_bloginfo('url')."/?feed=rss2' class='headerRSS' title='Subscribe to Blog'>Subscribe to Blog</a>";}
				}
				elseif(is_search()) {echo "Search";}
				
				// Archives
				elseif(is_tag()) {printf( __( '%s', 'twentyten' ), single_tag_title( '', false ) ); echo " <a href='".get_bloginfo('url')."?tag=".single_tag_title( '', false )."&amp;feed=rss2' class='headerRSS' title='Subscribe to this tag'>Subscribe to this tag</a>";}
				elseif(is_category()) {printf( __( '%s', 'twentyten' ), single_cat_title( '', false ) );  echo " <a href='".get_bloginfo('url')."?tag=".single_cat_title( '', false )."&amp;feed=rss2' class='headerRSS' title='Subscribe to this category'>Subscribe to this category</a>"; }
				elseif(is_archive()) {
					if ( is_day() ) : ?>
									<?php printf( __( 'Daily Archives: <span>%s</span>', 'twentyten' ), get_the_date() ); ?>
					<?php elseif ( is_month() ) : ?>
									<?php printf( __( 'Monthly Archives: <span>%s</span>', 'twentyten' ), get_the_date( 'F Y' ) ); ?>
					<?php elseif ( is_year() ) : ?>
									<?php printf( __( 'Yearly Archives: <span>%s</span>', 'twentyten' ), get_the_date( 'Y' ) ); ?>
					<?php else : ?>
									<?php _e( 'Blog Archives', 'twentyten' ); ?>
					<?php endif;
				}
				
				// Portfolio Categories
				elseif(get_post_type(get_the_ID())=='artwork') {echo "<a href='".get_bloginfo("url")."/portfolio/' title='Return to Portfolio'>Portfolio</a> <a href='".get_bloginfo('url')."/?post_type=portfolio&amp;feed=rss2' class='headerRSS' title='Subscribe to Portfolio'>Subscribe to Portfolio</a>";}
				elseif(get_post_type(get_the_ID())=='motion') {echo "<a href='".get_bloginfo("url")."/portfolio/' title='Return to Portfolio'>Portfolio</a> <a href='".get_bloginfo('url')."/?post_type=portfolio&amp;feed=rss2' class='headerRSS' title='Subscribe to Portfolio'>Subscribe to Portfolio</a>";}
				elseif(get_post_type(get_the_ID())=='websites') {echo "<a href='".get_bloginfo("url")."/portfolio/' title='Return to Portfolio'>Portfolio</a> <a href='".get_bloginfo('url')."/?post_type=portfolio&amp;feed=rss2' class='headerRSS' title='Subscribe to Portfolio'>Subscribe to Portfolio</a>";}
				
				// Other Pages
				elseif(is_home()) {echo "Blog <a href='".get_bloginfo('url')."/?feed=rss2' class='headerRSS' title='Subscribe to Blog'>Subscribe to Blog</a>";}
				elseif(is_page("portfolio")) {echo "Portfolio <a href='".get_bloginfo('url')."/?post_type=portfolio&amp;feed=rss2' class='headerRSS' title='Subscribe to Portfolio'>Subscribe to Portfolio</a>";}
				//elseif(is_page("about")) {echo "About";}
				elseif(is_page()) {echo get_the_title();}
				else {}
			?>
            </h2>
            <h1>
            <?php
				if(is_search()) {printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' );}
				elseif(is_single()) {echo the_title();}
				elseif(get_post_type()=='artwork') {echo "Artwork";}
				elseif(get_post_type()=='motion') {echo "Motion";}
				elseif(get_post_type()=='websites') {echo "Websites";}
				elseif(is_tag()) {echo "Tag Archives";}
				elseif(is_category()) {echo "Category Archives";}
			?>
            </h1>
            <?php 
				if(is_single()) { ?>
            		<h3>Posted on <time datetime="<?php the_date('c'); ?>" pubdate><?php the_time('F jS, Y') ?> at exactly <?php the_time('g:i a') ?></time>
						 <?php // Show +1 Button if turned on
                        include('functions/get.options.php');
                        if($db2011_gplusone) {?>
                        | <g:plusone size="small" <?php if(!$db2011_gplusone_count) { ?>count="false"<?php } ?> href="<?php the_permalink(); ?>"></g:plusone>
                        <?php }	?>
                    </h3>
            <?php 
				}
				elseif(!is_search() && is_category()) {
					$category_description = category_description();
					if ( ! empty( $category_description ) )
					echo '<h3>' . $category_description . '</h3>';
				}
			?>
        </hgroup>
        <noscript>
        	<span class="message important"><strong>Warning:</strong> You are viewing this website with Javascript turned off. Certain features will not work with Javascript turned off.</span>
        </noscript>
	</div>
</header>
<section id="body">
	<div id="body-top">
	<div class="wrapper">