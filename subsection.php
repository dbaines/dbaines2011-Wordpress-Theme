<?php 
	// Hide SubSection for....
	if(is_page('about') or
	is_page("My Computer")  or
	#is_page("Portfolio") or
	(is_single() && get_post_type(get_the_ID()) == "websites") or
	(is_single() && get_post_type(get_the_ID()) == "artwork") or
	(is_single() && get_post_type(get_the_ID()) == "motion")
	) : else :
?>
    </div>
    </div>
</section>

<section id="subsection">
	<div id="subsection-top">
	<div class="wrapper
            <?php if (is_single()) {
                echo (" subsection-comments");
            }?>">
            <div id="subsection-columns">
                <?php
                    
                    // Downloads Sidebar
                    //elseif (is_page('downloads') or is_page('Foobar2000 Downloads')) {
                    //	include(TEMPLATEPATH."/sub-downloads.php");
                    //}
                    
                    // Contact Sidebar
                    //elseif (is_page('contact')) {
                        //include(TEMPLATEPATH."/sub-contact.php");
                    //}
                    
                    // Homepage subsection
                    if (is_page('homepage')) {
                        include(TEMPLATEPATH."/sub-homepage.php");
                    }
                    
                    // Single/Blog Post Subsection (Comments)
                    elseif (is_single()) {
						if (get_post_type(get_the_ID()) != "artwork" and get_post_type(get_the_ID()) != "motion" and get_post_type(get_the_ID()) != "websites") {
                       		comments_template('', true);
						}
                    }
                    
                    // Pages/Articles
                    elseif (is_page()) {
                        include(TEMPLATEPATH."/sub-blog.php");
                    }
                    
                    // Everything Else = Blog
                    else {
                        include(TEMPLATEPATH."/sub-blog.php");
                    }
                ?>
                <div class="clear"></div>
            </div>
	<?php endif; ?>