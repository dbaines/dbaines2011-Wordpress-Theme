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
    	<span class="floatLeft">Copyright &copy; David Baines 2011 &bull; <a href="<?php bloginfo("url"); ?>/?page_id=11">About</a> &bull; <a href="<?php bloginfo("url"); ?>/?page_id=21">Sitemap</a> &bull; <a href="<?php bloginfo("url"); ?>/wp-admin/">Login</a></span>
    </div>
</footer>

<script type="text/javascript">var templateDir = "<?php bloginfo("template_url"); ?>";</script>

<?php // Facebook Sscripts ?>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({appId: '169017283147625', status: true, cookie: true,
             xfbml: true});
  };
  (function() {
    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol +
      '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
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
<script src="<?php bloginfo('template_url'); ?>/js/jquery-1.5.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.colorbox.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.easySlider1.7.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/dbaines.js"></script>

<?php wp_footer(); ?>
</body>
</html>