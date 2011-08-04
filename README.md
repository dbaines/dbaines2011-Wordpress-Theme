dbaines2011 - dBaines.com Wordpress Theme
=========================================

This is the theme currently in use at dBaines.com

## Notable features:

* Custom Post types for artwork, motion and website portfolios
* Motion Post Type uses flowplayer to display a .flv video
* Website Post Type uses easySlider to display multiple images of each website project
* Search bar drop down options to search in specific custom post types, or all
* Permalinks for custom post type indexes
* RSS Feeds for custom post types
* Portfolio page takes the latest thumbnail from each area (website, artwork, motion) and creates a button from that image
* Modified EasySlider script to include keyboard navigation and support for multiple easysliders on a single page
* Heavy uses of HTML5 and CSS3
* Custom homepage theme
* Randomised 404 page
* Responsive design for less than 960 width and a mobile-friendly(ish) display for less than 600.
* Custom login page
* Shortcodes reference panel when writing a post
* Theme Options page:
	* Enable Google +1 buttons
	* Enable the count bubble for the Google +1 buttons
	* Twitter-like load more posts option
	* All posts have thumbnails on/off
	* Use custom Wordpress menu instead of hardcoded menu
	* Use custom Wordpress blogroll links category instead of hardcoded friends list
	* Custom Footer text
	* Custom Comments intro text
	* Custom Google Analytics code
	
It should be noted that this theme does not (and will not) support old browsers. 

## Recommended Wordpress Plugins:

* Additional Image Sizes - Provides image sizes for homepage slider, website slider, gallery thumbnail, as well as the default post sizes.
* Advanced Excerpt - HTMLified Excerpts for searches and tutorial posts
* Custom Field Template - Very handy template to set up custom fields for different custom post types. 
* Post Types Order - Quickly and easily re-arrange your custom post types - in my case portfolio entries.
* WP Page Navi - The best page navigation replacement plugin. 
* WP Audioscrobbler - Classic last.fm integration

## Credits

### Base:

* HTML5 Boilerplate
* TwentyTen Wordpress Theme (3.1)

### Icons:

* iconsweets2
* inFocus
* Function

### Scripts:

* Modernizr
* EasySlider
* Colorbox
* Flowplayer

### Fonts:

* TitilliumText

If you are the creator of any of these resources and have issue with me redistributing them, please let me know. I'll be more than happy to remove your material from this project.


## Version History

### Near Future
* Blue hover for homepage logo
* Implement custom close button for colorbox
* Replace most of the backgrounds with CSS3 gradients where applicable. Supply .no-cssgradient via modernizr support with graphics.
	
### 1.4 - 2011-08-04
* Styled figcaption for codebox
* Added aprilfools.css for headache inducing fun come April-time
* Added Wordpress Option: Google Analytics UA Code
* Added Wordpress Option: Enable Wordpress Menu - Uses a Wordpress menu, "Main Menu" as the main navigation instead of the hardcoded links
* Added Wordpress Option: Replace 'friends' with 'blogroll' links
* Added Wordpress Option: All posts have thumbnails - includes shiny new generic post-thumbnail.png
* Added Wordpress Option: AJAX Post Loading - Facebook/twitter esque post loading technique
* Removed -webkit-appearance from search input
* Added Google +1 buttons to search results
* Added .2 seconds of transitions (of various vendors) to the top-level nav links for fun and profit
* Gave .homepageSlider h2 1px of text shadow blur to fix the shadow being white in chrome 12/13.
* Added line-height: 1.5 to p,ul - if it affects too many things I'll specify it to content areas only.
* Hardware Acceleration (via the "Magic Bullet" -webkit-transform: translateZ(0);) given to homepage slider and websites slider
* Added a "Shortcodes Reference" box in the new post admin page. Super convenient!
* Responsive Design changes:
	* Fixed rendering of the search input in Firefox for the mobile design, again. Should stick this time. 
	* Made the artwork portfolio look somewhat nicer on the reponsive design
	* Changes for the contact form when less than 960px wide
	* Made the "About me" image centred and styled like the centred images in the blog
	
### 1.3 - 2011-08-01
* Fixed search input rendering in Firefox for the mobile display
* Added +1 buttons to portfolio colourbox popups (dbaines.js)
* Added +1 buttons to websites loop

### 1.2 - 2011-07-31
* Fixed the 1.1 date (2011, not 2001)
* Figure HTML5 elements for wp-captions
* Figure HTML5 elements for tutorial post thumbnails
* Figure elements for code blocks, adding caption option to codebox shortcode: [codebox caption=""]
* HTML5 form fields for comments form
* Removed some vendor prefixes for some box shadows and rounded corners as the major browsers now use non-vendor-prefixes.
* Fixed some more inconsistent typography
* New Wordpress Theme Options:
	* Google Plus "count" bubbles on/off
	* Footer Text
	* Comments Intro
	* Laid groundwork for WYSIWYG editors in plugin pages, still a bit buggy.

### 1.1 - 2011-07-31
* Reponsive Design changes for <960 and <600 wide
* <600 wide is optimised for mobile devices
* Pseudoelement CSS icons for subsection (dark grey area) and post meta icons
* Fixed some inconsistent typography
* Added GooglePlus and Forrst Icon to homepage
* Plugins.js for minified plugins, moved original non-minified scripts in to /js/src/
* jQuery from Google CDN, Updated to 1.6.2
* Add rel="me" (confirm) to links to my profiles on things
* Re-arranged functions.php, cleaned up, separated large chunks in to manageable files (ie. functions.shortcodes.php)
* Removed Facebook Likes
* Added Google +1 Buttons
* Wordpress Options Page, starting with Google +1 buttons on/off toggle.
* Updated login css to reflect changes in Wordpress 3.2

### 1.0
* Initial Release
