<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

			<article id="page-content" role="main" class="page<?php echo the_title(); ?>">

				<?php if ( ! have_posts() ) : ?>
                    <div id="post-0" class="post error404 not-found">
                        <h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
                        <div class="entry-content">
                            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
                            <?php get_search_form(); ?>
                        </div><!-- .entry-content -->
                    </div><!-- #post-0 -->
                <?php endif; ?>
                
                <?php while ( have_posts() ) : the_post(); ?>
                	<?php the_content(); ?>
                <?php endwhile; ?>

			</article><!-- #content -->
            
<?php  /*

	Link = Large Image (placeholder of video)
	

		<script>
			flowplayer("player", "<?php bloginfo("template_url"); ?>/flowplayer/flowplayer-3.2.6.swf");
		</script>
*/ ?>

<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>