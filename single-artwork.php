<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="single-container">
			<div id="single-content" role="main">

			<?php
			/* Run the loop to output the post.
			 * If you want to overload this in a child theme then include a file
			 * called loop-single.php and that will be used instead.
			 */
			//get_template_part( 'loop', 'single' );
                setup_postdata($post);
					
				
                    // Column Set up
                    $columnCount = $columnCount + 1;
                    if($columnCount == 4) {$columnCount = 1;}
        
                    // Artwork Thumbnail
                    $imageid = get_post_meta($post->ID, 'File Upload', true); 
                    $LargeImageLink = wp_get_attachment_url( $imageid );
                    $ThumbnailImage = wp_get_attachment_image( $imageid, "medium" );
                    
                ?>
                
                <p class="center">
				<a href="<?php echo $LargeImageLink; ?>" rel="gallery" class="galleryImage galleryThumbnail <?php if( get_post_type() == "motion") :?>galleryMedia<?php endif; ?> galleryColumn<?php echo $columnCount; ?>" title="<?php echo the_title(); ?>" data-date="<?php echo the_date(); ?>" <?php if( get_post_type() == "motion") :?>data-video="<?php echo $VideoLink; ?>"<?php endif; ?> data-permalink="<?php echo the_permalink(); ?>">
				<?php echo $ThumbnailImage; ?></a>
                </p>
            
            <div class="clear"></div>
			</div><!-- #content -->
		</div><!-- #container -->
	
		<!-- this will install flowplayer inside previous A- tag. -->

<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>