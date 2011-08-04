<?php 
if ($db2011_blogroll) { 

	// Show the blogroll links
	wp_list_bookmarks(
		array(
		'orderby'          => 'name',
		'order'            => 'ASC',
		'limit'            => -1,
		'category'         => '',
		'exclude_category' => '',
		'category_name'    => 'Blogroll',
		'hide_invisible'   => 1,
		'show_updated'     => 0,
		'echo'             => 1,
		'categorize'       => 0,
		'title_li'         => __('Friends'),
		'title_before'     => '<h2>',
		'title_after'      => '</h2>',
		'category_orderby' => 'name',
		'category_order'   => 'ASC',
		'class'            => 'sub-friends',
		'category_before'  => '',
		'category_after'   => '' 
		)
	);

} else {
	
	// Show default friends
?>

<h2>Friends</h2>
<ul class="sub-friends">
	<li class="vcard"><a href="http://www.co-opp.net" class="fn org">Co-Opp</a></li>
	<li class="vcard"><a href="http://www.centraldown.com" class="fn org url" rel="friend">Centraldown</a></li>
	<li class="vcard"><a href="http://rogersmedia.com.au/" class="fn n url" rel="friend colleague met">RogersMedia</a></li>
	<li class="vcard"><a href="http://www.rhysaronson.org/" class="fn n url" rel="friend met">RhysAronson</a></li>
	<li class="vcard"><a href="http://skribbl.deviantart.com/" class="fn n url" rel="friend met">Skribbl</a></li>
	<li class="vcard"><a href="http://www.linuxinit.net" class="fn n url" rel="friend">Linuxinit</a></li>
	<li class="vcard"><a href="http://www.codyg.com" class="fn n url" rel="friend">Cody-G</a></li>
</ul>

<?php } ?> 