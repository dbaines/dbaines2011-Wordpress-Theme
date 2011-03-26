<h2>Latest Blog Posts</h2>
<ul class="sub-blog-latest">
    <?php query_posts('posts_per_page=7&post_type=array(post, update, tutorial)'); ?>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <?php // Get Post Type
			$id = get_the_ID();
			$type = get_post_type($id);
		?>
        	<li class="<?php echo $type; ?>">
            	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <small><?php the_time('F jS, Y') ?> at exactly <?php the_time('g:i a') ?></small>
            </li>
		<?php endwhile; ?>
    <?php endif; ?>
</ul>