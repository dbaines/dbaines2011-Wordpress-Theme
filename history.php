<?php
/**
 * Template Name: History
 */
get_header(); ?>

			<article id="page-content" role="main" class="page<?php echo the_title(); ?>">

				<?php # do the page business ?>
				<?php if ( ! have_posts() ) : ?>
                    <div id="post-0" class="post error404 not-found">
                        <h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
                        <div class="entry-content">
                            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
                            <?php get_search_form(); ?>
                        </div><!-- .entry-content -->
                    </div><!-- #post-0 -->
                <?php endif; ?>
                
                <?php while ( have_posts() ) : the_post(); ?>
                	<?php the_content(); ?>
                <?php endwhile; ?>
                
                <?php # faux blog posts for the history page ?>
                <div id="blog-content" class="historyContainer">
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/2011-homepage.png" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2011-homepage_thumb.png" title="2011 - Homepage" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2011</h2>
                            <p>
With the release of Wordpress 3.1 and the post type feature, I finally decided to do away with ZenPhoto and keep the gallery/portfolio entirely contained in Wordpress. I ended up creating three substantially different post types; websites, motion and artwork. Each post type had their own index and "full story" styles. Each website would appear a jQuery slider, each artwork would appear as a colorbox image and each motion would appear as a colorbox video.
                            </p>
                            <p>
ZenPhoto wasn't the only thing to go with this version, a lot of the pages were removed and content really stripped down. I realised a lot of stuff was irrelevant and not needed any more. 
                            </p>
                            <p>
This is also <a href="/about/">the first version of dBaines to be released as a GitHub project</a>. Feel free to download it and dissect it!
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/2010-rainbow.jpg" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2010-rainbow_thumb.jpg" title="2010 - Taste the Rainbow" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2010</h2>
                            <p>
Mostly the same as the previous years template but with added shiny-happiness and some minor re-aligning and tweaking over the year. 
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/2009-seraphim.png" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2009-seraphim_thumb.png" title="2009 - The Seraphim" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2009 - New Logo</h2>
                            <p>
Content
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post">
                        <div class="historyLeft">
                        	<a href="/blog/images/history/2009-grungehome.png" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2009-grungehome_thumb.png" title="2009 - Grunge Homepage" /></a><br />
                            <a href="/blog/images/history/2009-grunge.png" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2009-grunge_thumb.png" title="2009 - Grunge" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2009</h2>
                            <p>
                				Content
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/2009-blue.png" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2009-blue_thumb.png" title="2009 - The Blue Dragon" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2009</h2>
                            <p>
Sticking with the idea for a widescreen layout, I decided to create a fluid, fullscreen version of my blog. Here you can see it sporting a new logo that I was field testing for a whort while, along with the snowman that appeared in December. 
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/2008-widescreen.jpg" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2008-widescreen_thumb.jpg" title="2008 - Widescreen" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2008 - Widescreen</h2>
                            <p>
A design that never actually came to fruition due to time restraints. It was going to be an alternate design (non default) that required a widescreen resolution. 
</p><p>
This would have been the first version of dBaines.com to have contextual sidebars. As you can see from the mockups, the sidebar would have changed depending on which section of the site you were on. <br />
It also would have been the first version to have flash elements. The shiny logo at the top left had an animated shine.
</p><p>
It never actually went public but I liked it so much that I consider it to be a real dBaines.com version.
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/2008-breeze.png" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2008-breeze_thumb.png" title="2008 - Breeze" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2008</h2>
                            <p>
                				Content
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/2006-resurgence.png" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2006-resurgence_thumb.png" title="2006 - Resurgence Template" /></a><br />
							<a href="/blog/images/history/2006-mario.jpg" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2006-mario_thumb.jpg" title="2006 - Do the Mario Template" /></a><br />
							<a href="/blog/images/history/2006-dioxide.png" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2006-dioxide_thumb.png" title="2006 - Dioxide Template" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2006 - Alternate Templates</h2>
                            <p>
I was playing around with a CSS stylesheet switcher and realised I could have a series of completely different designs for my website that the user could choose between. Here you can see three of them I had going. I actually ended up with over ten different stylesheets at one time!
</p><p>
The first I named "Resurgence", since it was a remake of the old dBaines.com version 1 template. 
</p><p>
The second one I named "Do the Mario" and was made up almost entirely of Mario 3 sprites. It was great fun to make, I actually want to take a stab at it again some time. 
</p><p>
The third was named "Dioxide" and it was by far my most popular of the alternate skins. 
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/2006-the-third.jpg" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2006-the-third_thumb.jpg" title="2006 - dBaines 3" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2006 - dBaines 3: With a Vengeance</h2>
                            <p>
                				Content
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/2005-portfolio.jpg" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2005-portfolio_thumb.jpg" title="2005 - Stand-alone Portfolio" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2005 - Portfolio Edition</h2>
                            <p>
I needed a self-contained portfolio that wasn't a part of a larger website or blog. I wanted something really arty and completely different from my blog. The character in the top left would randomise on page load out of a series of characters I had drawn. 
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/2005-the-second.jpg" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2005-the-second_thumb.jpg" title="2005 - dBaines 2" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2005 - dBaines II: Attack of the Clones</h2>
                            <p>
                				Content
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/2005-the-first.jpg" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/2005-the-first_thumb.jpg" title="2005" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2005</h2>
                            <p>
                				Content
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <!--
                    <div class="post">
                        <div class="historyLeft">
                            <a href="/blog/images/history/" class="galleryImage wp-cbox" rel="history"><img src="/blog/images/history/" title="" /></a>
                        </div>
                        <div class="historyRight">
                            <h2>2010</h2>
                            <p>
                				Content
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    -->
                </div>
                
			</article><!-- #content -->
            
		</div><!-- #container -->
        
<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>
