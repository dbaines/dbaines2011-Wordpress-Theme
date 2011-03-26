<h2>Latest Artwork</h2>
<ul class="sub-latest-artwork">
	<li>
		<?php
		#zenpressed_latestphotos( null, array( "count" => "10", "size" => "53", "showtitle" => "off" ));
		if (function_exists('zenpressed_dbthumbs')) {
		zenpressed_dbthumbs( null, array( "count" => "20", "size" => "150", "showtitle" => "off" )); 
		} else {echo "<em>ZenPhoto module missing or inactive</em>";}
		?>
	</li>
	<li class="sub-latest-artwork-viewmore"><a href="http://dbaines.com/art/">View More</a></li>
</ul>
