<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<?php 

// Endless Galleries!
if ( !is_search() && get_post_type()=='artwork' OR get_post_type()=='motion' OR get_post_type()=='websites') {
	$posts_home = -1;
	$post_type = get_post_type();
	query_posts("posts_per_page=$posts_home&post_type=$post_type");
}
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ($post_type == "artwork" or $post_type == "motion" or $post_type == "websites") : else : ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
		<?php if ( function_exists("wp_pagenavi") ) : wp_pagenavi(); else : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
        <?php endif; ?>
	</div><!-- #nav-above -->
<?php endif; endif; ?>

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

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
     
<?php while ( have_posts() ) : the_post();

			$postID = get_the_ID();
			//echo($postID);
			
 /* Artwork */ ?>

	<?php if ( get_post_type($postID)=='artwork' OR get_post_type($postID)=='motion') : ?>
        
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
        <a href="<?php echo $LargeImageLink; ?>" rel="gallery" class="galleryImage galleryThumbnail <?php if( get_post_type() == "motion") :?>galleryMedia<?php endif; ?> galleryColumn<?php echo $columnCount; ?>" title="<?php echo the_title(); ?>" data-date="<?php echo the_date(); ?>" <?php if( get_post_type() == "motion") :?>data-video="<?php echo $VideoLink; ?>"<?php endif; ?> data-permalink="<?php echo the_permalink(); ?>">
		<?php echo $ThumbnailImage; ?></a>
        
<?php /* Websites */ ?>

	<?php elseif ( get_post_type($postID)=='websites') :  ?>
        
        <article class="websiteContainer">
        
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
        
<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>

	<?php elseif ( 'galleria' == get_post_format( $post->ID ) || in_category( _x( 'galleria', 'galleria category slug', 'twentyten' ) ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php twentyten_posted_on(); ?>
			</div><!-- .entry-meta -->

			<div class="entry-content">
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'twentyten' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								number_format_i18n( $total_images )
							); ?></em></p>
				<?php endif; ?>
						<?php the_excerpt(); ?>
<?php endif; ?>
			</div><!-- .entry-content -->

			<div class="entry-utility">
			<?php if ( 'gallery' == get_post_format( $post->ID ) ) : ?>
				<a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'twentyten' ); ?>"><?php _e( 'More Galleries', 'twentyten' ); ?></a>
				<span class="meta-sep">|</span>
			<?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'twentyten' ) ) ) : ?>
				<a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'twentyten' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'twentyten' ); ?>"><?php _e( 'More Galleries', 'twentyten' ); ?></a>
				<span class="meta-sep">|</span>
			<?php endif; ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>

	<?php elseif ( 'aside' == get_post_format( $post->ID ) || in_category( _x( 'asides', 'asides category slug', 'twentyten' ) )  ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-utility">
				<?php twentyten_posted_on(); ?>
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
            <div class="clear"></div>
		</div><!-- #post-## -->

<?php elseif (in_category("tutorials")) : ?>

 
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        	<span class="category-link"><?php echo get_the_category_list( ' ' ); ?></span>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				Posted on <time datetime="<?php the_date('c'); ?>" pubdate><?php the_time('F jS, Y') ?> at exactly <?php the_time('g:i a') ?></time>
			</div><!-- .entry-meta -->
            
            <div class="entry-content">
            	<figure class="tutorial-image">
                	<a href="<?php the_permalink(); ?>" title="Read Tutorial: <?php the_title(); ?>">
	                	<?php if (has_post_thumbnail()) : // If has post thumbnail ?>
                			<?php the_post_thumbnail(); ?>
                    	<?php else : // if doesn't have post thumbnail, show default fallback ?>
            		    	<img src="<?php bloginfo('template_url'); ?>/images/tutorial-thumbnail.png" alt="tutorial" />
    		            <?php endif; ?>
	                </a>
                </figure>
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

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        	<span class="category-link"><?php echo get_the_category_list( ' ' ); ?></span>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				Posted on <time datetime="<?php the_date('c'); ?>" pubdate><?php the_time('F jS, Y') ?> at exactly <?php the_time('g:i a') ?></time>
			</div><!-- .entry-meta -->

			<div class="entry-summary">
				<?php the_content('Read More'); ?>
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

		<?php comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<?php if ( function_exists("wp_pagenavi") ) : wp_pagenavi(); else : ?>
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
					<?php endif; ?>
				</div><!-- #nav-below -->
<?php endif; ?>
