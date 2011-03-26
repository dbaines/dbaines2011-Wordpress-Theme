<?php
/**
 * Template Name: Sitemap
 */
get_header(); ?>

<h2 id="pages">Pages</h2>
<ul>
<?php
// Add pages you'd like to exclude in the exclude here
wp_list_pages( 
  array(
    'exclude' => '115,45,129,111',
    'title_li' => '',
  )
);
?>
</ul>
 
<h2 id="posts">Portfolio</h2>
<ul>
	<li><h3><a href="<?php bloginfo('url'); ?>/websites">Websites</a></h3>
    <ul>
	<?php
      query_posts('posts_per_page=-1&post_type=websites');
      while(have_posts()) {
        the_post();
        echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
      }
    ?>
    </ul></li>
	<li><h3><a href="<?php bloginfo('url'); ?>/artwork">Artwork</a></h3>
    <ul>
	<?php
      query_posts('posts_per_page=-1&post_type=artwork');
      while(have_posts()) {
        the_post();
        echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
      }
    ?>
    </ul></li>
	<li><h3><a href="<?php bloginfo('url'); ?>/motion">Motion</a></h3>
    <ul>
	<?php
      query_posts('posts_per_page=-1&post_type=motion');
      while(have_posts()) {
        the_post();
        echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
      }
    ?>
    </ul></li>
</ul>
 
<h2 id="posts">Blog</h2>
<ul>
<?php
// Add categories you'd like to exclude in the exclude here
$cats = get_categories('exclude=');
foreach ($cats as $cat) {
  echo "<li><h3><a href='".get_bloginfo('url')."/blog/category/".$cat->cat_name."'>".$cat->cat_name."</a></h3>";
  echo "<ul>";
  query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
  while(have_posts()) {
    the_post();
    $category = get_the_category();
    // Only display a post link once, even if it's in multiple categories
    if ($category[0]->cat_ID == $cat->cat_ID) {
      echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
    }
  }
  echo "</ul>";
  echo "</li>";
}
?>
</ul>

<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>