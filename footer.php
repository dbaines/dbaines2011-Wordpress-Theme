<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

    </div>
    </div>
</section>
<footer>
	<div class="wrapper">
    	<span class="floatLeft">
			<?php // Get Footer Text from theme options
            	include('functions/get.options.php');
	            if ($db2011_footertext) {
					echo stripslashes($db2011_footertext);
				} else { 
					echo 'Copyright &copy; David Baines 2011 &bull; <a href="'. get_bloginfo("url") .'/about">About</a> &bull; <a href="'. get_bloginfo("url") .'/sitemap">Sitemap</a> &bull; <a href="'. get_bloginfo("url") .'/blog/wp-admin/">Login</a>';
				}
			?>
        </span>
    </div>
</footer>

<script type="text/javascript">
	// Passing some php variables through to JS so we can do stuff with things
	var templateDir = "<?php bloginfo("template_url"); ?>";
	var gplus = <?php include('functions/get.options.php'); echo ($db2011_gplusone == true ? "true" : "false"); ?>;
	var gplus_count = <?php include('functions/get.options.php'); echo ($db2011_gplusone_count == true ? "true" : "false"); ?>;
</script>

<?php // Google +1 - http://www.google.com/webmasters/+1/button/ ?>
<script>
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<?php // Google Analytics ?>
<script>
   var _gaq = [['_setAccount', 'UA-21857677-1'], ['_trackPageview']];
   (function(d, t) {
    var g = d.createElement(t),
        s = d.getElementsByTagName(t)[0];
    g.async = true;
    g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
   s.parentNode.insertBefore(g, s);
   })(document, 'script');
</script>

<?php // jQuery and scriptages ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.js"></script>
<script>window.jQuery || document.write('<script src="<?php bloginfo('template_url'); ?>/js/jquery-1.6.2.min.js">\x3C/script>')</script>
<script src="<?php bloginfo('template_url'); ?>/js/plugins.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/dbaines.js"></script>

<?php wp_footer(); ?>
</body>
</html>