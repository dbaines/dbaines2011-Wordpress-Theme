<?php
/**
 * Template Name: Homepage
 */

get_header(); ?>

<div class="homepageSliderWrapper">
<ul class="homepageSlider">

<?php 

$args = array( 
	'numberposts' => 6,
//	'post_type' => 'artwork'
	'post_type' => array('artwork', 'websites', 'motion')
	);
$lastposts = get_posts( $args );
foreach($lastposts as $post) : setup_postdata($post); ?>

	<?php 
        // Image URLs and what not.
		if ( get_post_type()=='websites' or get_post_type()=='motion') {
		$SliderImage =  get_the_post_thumbnail( $post->ID, "Large Slider" );
		}else {
        $imageid = get_post_meta($post->ID, 'File Upload', true); 
        $LargeImageLink = wp_get_attachment_url( $imageid );
        $SliderImage = wp_get_attachment_image( $imageid, "Large Slider" );
		}
    ?>
    
    <li>
	<?php echo $SliderImage; ?>
    <hgroup class="sliderDetails">
    	<h2><?php the_title(); ?></h2>
        <h3><a href="<?php the_permalink(); ?>" title="View <?php the_title(); ?>">View Project</a></h3>
    </hgroup>
    </li>
    
<?php endforeach; ?>
</ul>
</div>

<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>