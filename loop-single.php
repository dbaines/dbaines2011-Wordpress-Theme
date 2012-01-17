<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
					<article class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
					</article><!-- .entry-content -->
                    
					<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
                        <div id="entry-author-info">
                            <div id="author-avatar">
                                <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 120 ) ); ?>
                            </div><!-- #author-avatar -->
                            <div id="author-description">
                                <h3><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h3>
                                <?php the_author_meta( 'description' ); ?>
                                <div id="author-link">
                                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                        <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyten' ), get_the_author() ); ?>
                                    </a>
                                </div><!-- #author-link	-->
                            </div><!-- #author-description -->
                            <div class="clear"></div>
                        </div><!-- #entry-author-info -->
                    <?php endif; ?>
                    
                    <ul class="entry-meta-large">
						<?php edit_post_link('Edit', '<li class="edit">', '</li>'); ?>
                        <li class="time"><time datetime="<?php the_date('c'); ?>" pubdate><?php the_time('F jS, Y') ?> at exactly <?php the_time('g:i a') ?></time></li>
                        <li class="music">
							<?php 
								$music = get_post_meta(get_the_ID(), "Listening To", true);
								if($music) { echo $music; } else { echo "Nothing Playing"; }
                            ?>
                        </li>
                        <li class="category"><?php the_category(', ') ?></li>
                        <?php the_tags('<li class="tags">', ', ', '</li>'); ?>
                        <?php previous_post_link('<li class="prevpost">%link</li>') ?>
                        <?php next_post_link('<li class="nextpost">%link</li>') ?>
                    </ul>
				</section><!-- #post-## -->

				<?php #comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>