<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to twentyten_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyten' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>
<div id="comments-container">

	<h2 id="comments-title">Comments</h2>
    <?php if ( have_comments() ) : ?>
    
    	<?php # COMMENTS ------------------- ?>
		<?php if ( get_comment_pages_count() > 1 ) : // are there comments to navigate through ?>
            <div class="navigation">
                <?php wp_pagenavi(); ?>
            </div>
        <?php endif; // check for comment navigation ?>
    
    	<?php if ( ! empty($comments_by_type['comment']) ) : // Show only comments, if there are any ?>
			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'twentyten_comment', 'type' => 'comment' ) ); ?>
            </ol>
            
        <?php else : // If there are no comments of type "comment" ?>
        	<p class="nocomments">There aren't any comments for this post.</p>
        <?php endif; ?>
        
		<?php if ( get_comment_pages_count() > 1 ) : // are there comments to navigate through ?>
            <div class="navigation">
                <?php wp_pagenavi(); ?>
            </div>
        <?php endif; // check for comment navigation ?>
    
    	
       	<?php # PINGBACKS ------------------- ?>
    	<?php if ( ! empty($comments_by_type['pings']) ) : // Show only pings, if there are any ?>	
	    <h2>Trackbacks</h2>
			<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'twentyten_comment', 'type' => 'pings' ) ); ?>
            </ol>
        <?php endif; ?>
    
    <?php else: // If there are no comments at all ?>
    
    	<p class="nocomments">There aren't any comments for this post.</p>
    
    <?php endif; ?>
</div>
<div id="respond">
    <h2><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h2>
	<?php if ( comments_open() ) : // Only show form if comments are open ?>    
        
            <div class="cancel-comment-reply">
                <small><?php cancel_comment_reply_link(); ?></small>
            </div>
    
            <div class="comment-useable-html">
                These comments support XHTML! You can use these tags:<br /> <code><?php echo allowed_tags(); ?></code>
            </div>
    
                <div class="comment-gravatar-notice">
                <?php // Get Footer Text from theme options
                    include('functions/get.options.php');
                    if ($db2011_commentswarn) {
                        echo stripslashes($db2011_commentswarn);
						echo "<br />";
                    }
                ?>
              	This website uses Gravatar for your avatar, if you don't have one, <a href='http://en.gravatar.com/'>sign up today</a>, it's quick and painless.
            </div>
                
            <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
                <p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
            <?php else : ?>
        
            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        
            <?php if ( is_user_logged_in() ) : ?>
        
                <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
                
                <div id="respond-wide">
                    <textarea name="comment" id="comment" rows="10" tabindex="4" required></textarea>
                    <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /><?php comment_id_fields(); ?>
                </div>
        
            <?php else : ?>
            
            <div id="respond-left">
                <label for="author">Name <small><?php if ($req) echo "<span class='req reqstar'>*</span>"; ?></small></label>
                <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" placeholder="Your Name" <?php if ($req) echo "aria-required='true' required"; ?> />
    
                <label for="email">Mail<small> <?php if ($req) echo "<span class='req reqstar'>*</span>"; ?> (will not be published)</small></label>
                <input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" placeholder="Your E-Mail Address" <?php if ($req) echo "aria-required='true' required"; ?> />
                
                <label for="url">Website</label>
                <input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" placeholder="Your Website (Optional)" />
                
                <!-- <p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p> -->
            </div>
            <div id="respond-right">
                <label for="comment">Your Comment <small><?php if ($req) echo "<span class='req reqstar'>*</span>"; ?></small></label>
                <textarea name="comment" id="comment" rows="10" tabindex="4" placeholder="What's on your mind?" required></textarea>
                <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /><?php comment_id_fields(); ?>
            </div>
            <div class="clear"></div>
        
        <?php endif; ?>
        <?php do_action('comment_form', $post->ID); ?>
        
        </form>
        
        <?php endif; // If registration required and not logged in ?>
        </div>
    
    
    <?php else : // If comments are closed: ?>
	    <p class="nocomments"><?php _e( 'Comments are closed.', 'twentyten' ); ?></p>
    <?php endif; ?>

</div>
</div>