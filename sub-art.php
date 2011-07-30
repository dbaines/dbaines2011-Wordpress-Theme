<?php
	if (getImageTitle() !="" ) :
		// in image
?>

	<?php include(TEMPLATEPATH.'/subsections/art-image-comments.php'); ?>

<?php
	elseif (getAlbumTitle() !="" ) :
		// In Album
?>

<div id="subsection-column1">
	<?php include(TEMPLATEPATH.'/subsections/art-browse-date.php'); ?>
	<?php include(TEMPLATEPATH.'/subsections/art-browse-cats.php'); ?>
</div>
<div id="subsection-column2">
	<?php include(TEMPLATEPATH.'/subsections/blog-latest-posts.php'); ?>
	<?php include(TEMPLATEPATH.'/subsections/get-fed.php'); ?>
</div>
<div id="subsection-column3">
	<?php include(TEMPLATEPATH.'/subsections/art-latest-comments.php'); ?>
	<?php include(TEMPLATEPATH.'/subsections/lastfm.php'); ?>
</div>


<?php
	else:
	// home/search etc.
?>

<div id="subsection-column1">
	<?php include(TEMPLATEPATH.'/subsections/art-browse-date.php'); ?>
</div>
<div id="subsection-column2">
	<?php include(TEMPLATEPATH.'/subsections/blog-latest-posts.php'); ?>
	<?php include(TEMPLATEPATH.'/subsections/get-fed.php'); ?>
</div>
<div id="subsection-column3">
	<?php include(TEMPLATEPATH.'/subsections/art-latest-comments.php'); ?>
	<?php include(TEMPLATEPATH.'/subsections/lastfm.php'); ?>
</div>

<?php endif; ?>