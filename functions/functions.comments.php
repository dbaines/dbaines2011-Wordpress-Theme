<?php 

/***********************************
*
* COMMENTS TEMPLATE
*
***********************************/
if ( ! function_exists( 'twentyten_comment' ) ) :
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS ['comment'] = $comment; ?>
	<?php if ( '' == $comment->comment_type ) : ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-top">
        	<div class="comment-author vcard">
            	<?php $defaultgrav = get_bloginfo("template_url")."/images/default-avatar.png";?>
				<?php echo get_avatar( $comment, 48, $defaultgrav ); ?>
				<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'twentyten' ), get_comment_author_link() ); ?>
            </div>
            <div class="comment-meta">
            	<?php printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?>
            	&bull; <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">Permalink</a>
            	<?php edit_comment_link( __( 'Edit', 'twentyten' ),' &bull; ','' ); ?>
	            <?php delete_comment_link(get_comment_ID());  ?>
			</div>
		</div>
        
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<span class="comment-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></span>
			<br />
		<?php endif; ?>

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
	    </div>
    <?php # end li omitted, for some reason wordpress adds it anyway, adding it in as you would will only break things ?>

	<?php else : ?>
	<li class="post pingback">
		<p><?php _e( 'Pingback: ', 'twentyten' ); ?><?php comment_author_link(); ?><?php edit_comment_link ( __('edit', 'twentyten'), '&nbsp;&nbsp;', '' ); ?></p>
	<?php endif;
}
endif;

/***********************************
*
* COMMENTS FORM
* http://coding.smashingmagazine.com/2011/02/22/using-html5-to-transform-wordpress-twentyten-theme/
*
***********************************/
add_filter('comment_form_default_fields', 'comments_form');
function comments_form() {

	$req = get_option('require_name_email');
	
	$fields =  array(
		'author' => '<p>' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .
		'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder = "What should we call you?"' . ( $req ? ' required' : '' ) . '/></p>',
	
		'email'  => '<p><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .
		'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="How can we reach you?"' . ( $req ? ' required' : '' ) . ' /></p>',
	
		'url'    => '<p><label for="url">' . __( 'Website' ) . '</label>' .
		'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="Have you got a website?" /></p>'
	);
	return $fields;
}