<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<section id="search-container">
			<div id="search-content" role="main">


<?php
	// Group Portfolio Results
	/*
	$s = $_GET['s'];
	 echo "<h2>Portfolio Results</h2>";
	 query_posts('post_type=artwork&s='.$s);
	 if(have_posts()) {
		get_template_part( 'loop', 'search' );
	 }
	 
	 query_posts('post_type=motion&s='.$s);
	 if(have_posts()) {
		get_template_part( 'loop', 'search' );
	 }
	 query_posts('post_type=websites&s='.$s);
	 if(have_posts()) {
		get_template_part( 'loop', 'search' );
	 }
	 
	 echo "<h2>Blog Results</h2>";
	 query_posts('post_type=post&s='.$s);
	 if(have_posts()) {
		get_template_part( 'loop', 'search' );
	 }
	 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
    <?php include('functions/get.options.php'); if(!$db2011_loadmore) { // If not using AJAX LoadMore, show WP-PageNavi, or default WP Navigation ?>

	<div id="nav-above" class="navigation">
		<?php if ( function_exists("wp_pagenavi") ) : wp_pagenavi(); else : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
        <?php endif; ?>
	</div><!-- #nav-above -->
    
    <?php } ?>
<?php endif; ?>

<div class="posts-container">

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>


<?php if ( have_posts() ) : ?>
	<?php while( have_posts() ) : the_post(); ?>
    
    
        <?php // WEBSITES ?>
    	<?php if ( get_post_type(get_the_ID())=='websites') : ?>
		<article class="websiteContainer post">
        
        	<div class="websiteSliderContainer">
        	<ul class="websiteSlider">
				<?php 
					$heroID = get_post_thumbnail_id($post->ID);
					$heroImage =  wp_get_attachment_image_src( $heroID, "Small Slider");
					$heroLink =  wp_get_attachment_image_src( $heroID, "full");
					echo "<a href='".$heroLink[0]."' title='".get_the_title()."'><img src='".$heroImage[0]."' alt='". get_the_title() ."' /></a>";
					echo (get_post_meta($post->ID, 'Gallery Images', true)); ?>
                <?php  ?>
            </ul>
            </div>
            <div class="websiteInfo">
	        	<h2><?php the_title(); ?></h2>
                <?php edit_post_link( __( 'Edit this project', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
                <div class="websiteContent"><?php the_content(); ?></div>
                <p class="websiteLink">
	                <?php $link = get_post_meta($post->ID, 'URL', true); ?>
                    <?php if ($link != "") { ?>
                    <a href="<?php echo $link; ?>" target="_blank">Visit Website</a>
                    <?php } ?>
                </p>
            </div>
            <div class="clear"></div>
        </article>
        
        
        <?php // MOTION/ARTWORK ?>
    	<?php elseif ( get_post_type(get_the_ID())=='motion' OR get_post_type(get_the_ID()) == "artwork") : ?>
		<?php 
		
			// Column Set up
			$columnCount = $columnCount + 1;
			if($columnCount == 4) {$columnCount = 1;}
			
			// Image URLs and what not.
			
			// Motion Thumbnail
			if( get_post_type() == "motion") {
			$imageid = get_post_meta($post->ID, 'File Upload', true); 
			$FullImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
			$LargeImageLink = $FullImage[0];
			$VideoLink = wp_get_attachment_url( $imageid );	
			$ThumbnailImage = get_the_post_thumbnail( $post->ID, "Gallery Thumbnail" );
			} else {

			// Artwork Thumbnail
			$imageid = get_post_meta($post->ID, 'File Upload', true); 
			$LargeImageLink = wp_get_attachment_url( $imageid );
			$ThumbnailImage = wp_get_attachment_image( $imageid, "Gallery Thumbnail" );
			}
		?>
        <div class="post result">
            <h2>Portfolio Result: <?php the_title(); ?></h2>
        	<a href="<?php echo $LargeImageLink; ?>" rel="gallery" class="galleryImage galleryThumbnail <?php if( get_post_type() == "motion") :?>galleryMedia<?php endif; ?>" title="<?php echo the_title(); ?>" data-date="<?php echo the_date(); ?>" <?php if( get_post_type() == "motion") :?>data-video="<?php echo $VideoLink; ?>"<?php endif; ?> data-permalink="<?php echo the_permalink(); ?>">
			<?php echo $ThumbnailImage; ?></a>
        <div class="clear"></div>
        </div>
        
        
        <?php // TUTORIALS ?>
		<?php elseif (in_category("tutorials")) : ?>
 
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        	<span class="category-link"><?php echo get_the_category_list( ' ' ); ?></span>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				Posted on <time datetime="<?php the_date('c'); ?>" pubdate><?php the_time('F jS, Y') ?> at exactly <?php the_time('g:i a') ?></time>
			</div><!-- .entry-meta -->
            
            <div class="entry-content">
            	<div class="tutorial-image">
                	<a href="<?php the_permalink(); ?>" title="Read Tutorial: <?php the_title(); ?>">
	                	<?php if (has_post_thumbnail()) : // If has post thumbnail ?>
                			<?php the_post_thumbnail(); ?>
                    	<?php else : // if doesn't have post thumbnail, show default fallback ?>
            		    	<img src="<?php bloginfo('template_url'); ?>/images/tutorial-thumbnail.png" alt="tutorial" />
    		            <?php endif; ?>
	                </a>
                </div>
                <div class="tutorial-post">
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="readmore">Read Tutorial</a>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="entry-utility">
                <?php if ( count( get_the_category() ) ) : ?>
                    <span class="cat-links">
                        <?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
                    </span>
                    <span class="meta-sep">|</span>
                <?php endif; ?>
                <?php
                    $tags_list = get_the_tag_list( '', ', ' );
                    if ( $tags_list ):
                ?>
                    <span class="tag-links">
                        <?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
                    </span>
                    <span class="meta-sep">|</span>
                <?php endif; ?>
                <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
                <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
                <?php // Show +1 Button if turned on
					include('functions/get.options.php');
					if($db2011_gplusone) {?>
                    | <g:plusone size="small" <?php if(!$db2011_gplusone_count) { ?>count="false"<?php } ?> href="<?php the_permalink(); ?>"></g:plusone>
                    <?php }	?>
            </div><!-- .entry-utility -->
            <div class="clear"></div>
           
        </div>

        <?php // NORMAL POSTS ?>
        <?php else: ?>
        
		<?php 
		// Check for all thumbs setting
		include('functions/get.options.php');
		if($db2011_allthumb) {
		?>
        
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        	<span class="category-link"><?php echo get_the_category_list( ' ' ); ?></span>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				Posted on <time datetime="<?php the_date('c'); ?>" pubdate><?php the_time('F jS, Y') ?> at exactly <?php the_time('g:i a') ?></time>
			</div><!-- .entry-meta -->
            
            <div class="entry-content">
            	<figure class="tutorial-image">
                	<a href="<?php the_permalink(); ?>" title="Read Post: <?php the_title(); ?>">
	                	<?php if (has_post_thumbnail()) : // If has post thumbnail ?>
                			<?php the_post_thumbnail(); ?>
                    	<?php else : // if doesn't have post thumbnail, show default fallback ?>
            		    	<img src="<?php bloginfo('template_url'); ?>/images/post-thumbnail.png" alt="<?php the_title(); ?>" />
    		            <?php endif; ?>
	                </a>
                </figure>
                <div class="tutorial-post">
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="readmore">Read this Post</a>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="entry-utility">
                <?php if ( count( get_the_category() ) ) : ?>
                    <span class="cat-links">
                        <?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
                    </span>
                    <span class="meta-sep">|</span>
                <?php endif; ?>
                <?php
                    $tags_list = get_the_tag_list( '', ', ' );
                    if ( $tags_list ):
                ?>
                    <span class="tag-links">
                        <?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
                    </span>
                    <span class="meta-sep">|</span>
                <?php endif; ?>
                <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
                <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
                <?php // Show +1 Button if turned on
					if($db2011_gplusone) {?>
                    | <g:plusone size="small" <?php if(!$db2011_gplusone_count) { ?>count="false"<?php } ?> href="<?php the_permalink(); ?>"></g:plusone>
                    <?php }	?>
            </div><!-- .entry-utility -->
            <div class="clear"></div>
        </div>
    	
    	<?php } else { 
		// Posts do not all have thumbnails
		?>
        
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        	<span class="category-link"><?php echo get_the_category_list( ' ' ); ?></span>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				Posted on <time datetime="<?php the_date('c'); ?>" pubdate><?php the_time('F jS, Y') ?> at exactly <?php the_time('g:i a') ?></time>
			</div><!-- .entry-meta -->

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

			<div class="entry-utility">
				<?php if ( count( get_the_category() ) ) : ?>
					<span class="cat-links">
						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					</span>
					<span class="meta-sep">|</span>
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<span class="tag-links">
						<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</span>
					<span class="meta-sep">|</span>
				<?php endif; ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
                <?php // Show +1 Button if turned on
					include('functions/get.options.php');
					if($db2011_gplusone) {?>
                    | <g:plusone size="small" <?php if(!$db2011_gplusone_count) { ?>count="false"<?php } ?> href="<?php the_permalink(); ?>"></g:plusone>
                    <?php }	?>
			</div><!-- .entry-utility -->
            <div class="clear"></div>
		</div><!-- #post-## -->
		<?php } endif; ?>
    <?php endwhile; ?>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
#				 get_template_part( 'loop', 'search' );
				?>
<?php endif; ?>
        
</div> <?php // End posts-container ?>
        
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
<?php if($db2011_loadmore) { // Check for AJAX LoadMore?>
    
	    <div id="loadMore"><?php 
			if( $wp_query->max_num_pages == get_query_var('paged') ) {
				echo "<a class='disabledBtn' title='No more posts to load'>Load More Posts</a>";
			} else {
				next_posts_link( __( 'Load More Posts', 'twentyten' ) ); 
			}
		?></div>
        <div id="loadMorePagination">or <a href="#" class="loadPagination" title="Show pagination links for superuser page clicking action.">Show Pagination</a></div>
		<div id="loadMorePaginationLinks"><?php if ( function_exists("wp_pagenavi") ) : wp_pagenavi(); else : echo "pagination plugin not installed"; endif; ?></div>
    
    <?php } else { // If not using AJAX LoadMore, show WP-PageNavi, or default WP Navigation ?>
    
    <?php /* Display navigation to next/previous pages when applicable */ ?>
        <div id="nav-below" class="navigation">
            <?php if ( function_exists("wp_pagenavi") ) : wp_pagenavi(); else : ?>
            <ul id="postPagination">
                <li class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></li>
                <li class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></li>
            </ul>
            <?php endif; ?>
        </div><!-- #nav-below -->
    <?php } ?>
<?php endif; ?>
<div class="clear"></div>

<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>