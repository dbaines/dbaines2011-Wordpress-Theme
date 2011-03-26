<?php
/**
 * Template Name: Portfolio
 */

get_header(); ?>

<div class="portfolioHomeContainer">
<?php 
$args = array( 
	'numberposts' => 1,
	'post_type' => 'websites'
	);
$lastposts = get_posts( $args );
foreach($lastposts as $post) : setup_postdata($post); ?>
	<a href="<?php bloginfo("url") ?>/websites" class="galleryImage galleryColumn1"><?php echo get_the_post_thumbnail( $post->ID, "Gallery Thumbnail" ); ?><span>Websites</span></a>
<?php endforeach; ?>

<?php 
$args = array( 
	'numberposts' => 1,
	'post_type' => 'artwork'
	);
$lastposts = get_posts( $args );
foreach($lastposts as $post) : setup_postdata($post); ?>
	<?php 
        // Image URLs and what not.				
        $imageid = get_post_meta($post->ID, 'File Upload', true); 
        $GalleryImage = wp_get_attachment_image( $imageid, "Gallery Thumbnail" );
    ?>
	<a href="<?php bloginfo("url") ?>/artwork" class="galleryImage galleryColumn2"><?php echo $GalleryImage; ?><span>Artwork</span></a>
<?php endforeach; ?>

<?php 
$args = array( 
	'numberposts' => 1,
	'post_type' => 'motion'
	);
$lastposts = get_posts( $args );
foreach($lastposts as $post) : setup_postdata($post); ?>
	<?php 
        // Image URLs and what not.				
        $imageid = get_post_meta($post->ID, 'File Upload', true); 
        $GalleryImage = wp_get_attachment_image( $imageid, "Gallery Thumbnail" );
    ?>
	<a href="<?php bloginfo("url") ?>/motion" class="galleryImage galleryColumn3"><?php echo get_the_post_thumbnail( $post->ID, "Gallery Thumbnail" ); ?><span>Motion</span></a>
<?php endforeach; ?>
</div>
<div class="clear"></div>
<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>