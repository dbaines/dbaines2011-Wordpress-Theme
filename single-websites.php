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
            ?>
            
                <article class="websiteContainer">
                    <div class="websiteSliderContainer">
                    <ul class="websiteSlider">
						<?php 
                        $heroID = get_post_thumbnail_id($post->ID);
                        $heroImage =  wp_get_attachment_image_src( $heroID, "Small Slider");
                        $heroLink =  wp_get_attachment_image_src( $heroID, "full");
                        echo "<a href='".$heroLink[0]."' title='".get_the_title()."'><img src='".$heroImage[0]."' alt='". get_the_title() ."' /></a>";
                        echo (get_post_meta($post->ID, 'Gallery Images', true)); 
						?>
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
                </article>
            
            <div class="clear"></div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>