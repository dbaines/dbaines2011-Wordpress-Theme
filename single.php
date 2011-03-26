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
            
			get_template_part( 'loop', 'single' ); ?>
            
            <div class="clear"></div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>