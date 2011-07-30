<?php

/***********************************
*
* CUSTOM POST TYPES
* db2011
*
***********************************/
register_post_type('artwork', array(	'label' => 'Artwork','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => '', 'with_front' => false),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('post_tag',),'labels' => array (
  'name' => 'Artwork',
  'singular_name' => 'Artwork',
  'menu_name' => 'Artwork',
  'add_new' => 'Add Artwork',
  'add_new_item' => 'Add New Artwork',
  'edit' => 'Edit',
  'edit_item' => 'Edit Artwork',
  'new_item' => 'New Artwork',
  'view' => 'View Artwork',
  'view_item' => 'View Artwork',
  'search_items' => 'Search Artwork',
  'not_found' => 'No Artwork Found',
  'not_found_in_trash' => 'No Artwork Found in Trash',
  'parent' => 'Parent Artwork',
),) );
register_post_type('motion', array(	'label' => 'Motion','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => '', 'with_front' => false),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('post_tag',),'labels' => array (
  'name' => 'Motion',
  'singular_name' => 'Motion',
  'menu_name' => 'Motion',
  'add_new' => 'Add Motion',
  'add_new_item' => 'Add New Motion',
  'edit' => 'Edit',
  'edit_item' => 'Edit Motion',
  'new_item' => 'New Motion',
  'view' => 'View Motion',
  'view_item' => 'View Motion',
  'search_items' => 'Search Motion',
  'not_found' => 'No Motion Found',
  'not_found_in_trash' => 'No Motion Found in Trash',
  'parent' => 'Parent Motion',
),) );
register_post_type('websites', array(	'label' => 'Websites','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => '', 'with_front' => false),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('post_tag',),'labels' => array (
  'name' => 'Websites',
  'singular_name' => 'Website',
  'menu_name' => 'Websites',
  'add_new' => 'Add Website',
  'add_new_item' => 'Add New Website',
  'edit' => 'Edit',
  'edit_item' => 'Edit Website',
  'new_item' => 'New Website',
  'view' => 'View Website',
  'view_item' => 'View Website',
  'search_items' => 'Search Websites',
  'not_found' => 'No Websites Found',
  'not_found_in_trash' => 'No Websites Found in Trash',
  'parent' => 'Parent Website',
),) );

// Adding Permalinks
// http://stackoverflow.com/questions/3859852/utilizing-wordpresss-permalink-structure-on-custom-post-types
function portfolio_permalinks() {
	// Single posts - must be put above indexes as they take priority
    add_rewrite_rule(
        'artwork/([^/]+)',
        'index.php?artwork=$matches[1]',
        'top'
	);
    add_rewrite_rule(
        'motion/([^/]+)',
        'index.php?motion=$matches[1]',
        'top'
	);
    add_rewrite_rule(
        'websites/([^/]+)',
        'index.php?websites=$matches[1]',
        'top'
	);
	
	// Index posts
    add_rewrite_rule(
        'artwork',
        'index.php?post_type=artwork',
        'top'
	);
    add_rewrite_rule(
        'motion',
        'index.php?post_type=motion',
        'top'
	);
    add_rewrite_rule(
        'websites',
        'index.php?post_type=websites',
        'top'
	);
}
add_action( 'init', 'portfolio_permalinks' );

/***********************************
*
* SEARCH FILTER
* db2011
* http://speckyboy.com/2010/09/19/10-useful-wordpress-search-code-snippets/
*
***********************************/
function SearchFilter($query) {
  if ($query->is_search or $query->is_feed) {
    // Portfolio
	if($_GET['post_type'] == "portfolio") {
		$query->set('post_type', array('artwork', 'websites', 'motion'));
	}
	// Tutorials
	elseif($_GET['post_type'] == "tutorials") {
		$query->set('category_name','tutorials');
	}
	// EVERYTHING! MWAHAHAHAHAHA
	elseif($_GET['post_type'] == "all") {
		$query->set('post_type', array('artwork', 'websites', 'motion', 'post'));
	}
  }
  return $query;
}
// This filter will jump into the loop and arrange our results before they're returned
add_filter('pre_get_posts','SearchFilter');