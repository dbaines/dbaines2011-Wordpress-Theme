<?php

/***********************************
*
* WORDPRESS OPTIONS PAGE
* db2011
* 
* http://net.tutsplus.com/tutorials/wordpress/how-to-create-a-better-wordpress-options-panel/
* http://codex.wordpress.org/Creating_Options_Pages
* http://wpshout.com/create-an-advanced-options-page-in-wordpress/
* http://keighl.com/2010/04/switching-visualhtml-modes-with-tinymce/
* 
* Usage of Options:
* if ($option_id == "true") {doSomething();}
*
***********************************/

// Some Settings
$themename = "dBaines2011";
$shortname = "db2011";


/***********************************
*
* BUILDING THE OPTIONS
*
***********************************/
$options = array (
	
	// Layout
	array(
		"desc" => __("Layout"),
		"type" => "title"
	),
	
	array( 
		"name" => "Google +1 Buttons",
		"desc" => "Tick to enable Google +1 Buttons on this theme",
		"id" => $shortname."_gplusone",
		"type" => "checkbox",
		"std" => ""
	),
	
	array( 
		"name" => "Google +1 Count",
		"desc" => "Tick to enable the count bubbles on the +1 buttons",
		"id" => $shortname."_gplusone_count",
		"type" => "checkbox",
		"std" => ""
	),
	
	array( 
		"name" => "AJAX Load More Posts",
		"desc" => "Tick to enable a twitter/facebook style load more button instead of pagination",
		"id" => $shortname."_loadmore",
		"type" => "checkbox",
		"std" => ""
	),
	
	array( 
		"name" => __("All My Posts Have Thumbnails"),
		"desc" => __("Tick to show thumbnails for all posts. Untick to only show thumbnails for posts in the 'tutorial' category."),
		"id" => $shortname."_allthumb",
		"type" => "checkbox",
		"std" => ""
	),
	
	// Text Customisations
	array(
		"desc" => __("Customisations"),
		"type" => "title"
	),
	
	array( 
		"name" => __("Wordpress Menu"),
		"desc" => __("Tick to enable built-in Wordpress Menu"),
		"id" => $shortname."_wpmenu",
		"type" => "checkbox",
		"std" => ""
	),
	
	array( 
		"name" => __("Blogroll for Friends"),
		"desc" => __("Tick to replace the 'friends' links at the bottom of the page with the links from the Blogroll category of links"),
		"id" => $shortname."_blogroll",
		"type" => "checkbox",
		"std" => ""
	),
	
	array(
		"name" => __('Footer Text'),
		"desc" => __("The text that appears at the bottom of the page."),
		"id" => $shortname."_footertext",
		"std" => __(htmlentities('Copyright &copy; David Baines 2011 &bull; <a href="'. get_bloginfo("url") .'/about">About</a> &bull; <a href="'. get_bloginfo("url") .'/sitemap">Sitemap</a> &bull; <a href="'. get_bloginfo("url") .'/blog/wp-admin/">Login</a>')),
		"type" => "textarea",
		"editor" => false
	),
	
	array(
		"name" => __('Comments Warning (Optional)'),
		"desc" => __("This text appears above the comment form"),
		"id" => $shortname."_commentswarn",
		"std" => stripslashes("Please note: Any comments in a language other than English will be deleted. Similarly any comments using your website name or SEO keywords as your name will also be deleted. If it's your first time commenting your first comment will need to be approved, after which you will be able to comment freely."),
		"type" => "textarea",
		"editor" => false
	),
	
	array(
		"name" => __('Google Analytics UA Code'),
		"desc" => __("The UA Code for your Google Analytics. Should look like: UA-XXXXX-X"),
		"id" => $shortname."_googleua",
		"std" => stripslashes(""),
		"type" => "text"
	)
		
);

/***********************************
*
* ADDING THE ADMIN MENU
*
***********************************/
add_action('admin_menu', 'theme_options_menu');
function theme_options_menu() {
	// Add as a submenu to Appearance
	add_submenu_page('themes.php', 'dBaines2011 Options', 'dBaines2011 Options', 'manage_options', 'dbaines2011-options-page', 'db2011_options');
}


// To add
add_action("admin_print_scripts", "js_libs");
function js_libs() {
  wp_enqueue_script('tiny_mce');
}

/***********************************
*
* THE OPTIONS PAGE
*
***********************************/
function db2011_options() {
	
	global $themename, $shortname, $options;
	
	// Permissions check
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	// If form submitted, show what happened, yo.
	if ( $_REQUEST['action'] == 'save' ) {

		foreach ($options as $value) {
			update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

		foreach ($options as $value) {
			if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

		echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';

	} else if( 'reset' == $_REQUEST['action'] ) {

		foreach ($options as $value) {
			delete_option( $value['id'] ); }
			
		echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

	}
	?>
	
    <div class="wrap">
    <h2><?php echo $themename; ?> Settings</h2>
    <p>Use these options to customise your <?php echo $themename ?> experience!</p>
	<form method="post">
    	<div id="poststuff">
    	<table class="form-table">
		<?php 
			
		// This is where the magic happens. Bow chicka-wow wow.
		foreach ($options as $value) {
		switch ( $value['type'] ) {
			
			// Text Options
			case 'text':
			?>
			
            <tr>
            <th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
            <td>
            	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
            	<span class="description"><?php echo $value['desc']; ?></span>
			</td>
            </tr>
			<?php
			break;
			 
			 // Textareas
			case 'textarea':
			?>
            
            <tr>
            <th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
            <td>

				<?php // Get either the saved content, or the default (std) content ?>
                <?php if ( get_settings( $value['id'] ) != "") { $editorContent = htmlentities(get_settings( $value['id']) ); } else { $editorContent = $value['std']; } ?>
                
                <?php if ($value['editor']) { // Check if using RTE ?>
					<?php 
					
					wp_tiny_mce( 
						false, // true makes the editor "teeny"
                    	array(
							"editor_selector" => "large-text",
							"theme" => "advanced",
							"plugins" => "inlinepopups,spellchecker,media,paste,wpdialogs,wpeditimage,wpfullscreen,wplink"
						)
					);
					
					?>
                    
                    <p align="right" data-id="<?php echo $value['id'] ?>" class="mceControl">
                      <a class="button toggleVisual_<?php echo $value['id'] ?>">Visual</a>
                      <a class="button toggleHTML_<?php echo $value['id'] ?>">HTML</a>
                    </p>
                    <script>
						jQuery('.mceControl').each(function() {
							
							var id = jQuery(this).attr('data-id');
							//alert(id);
					
							jQuery('a.toggleVisual_'+id, this).click(function() {
								tinyMCE.execCommand('mceAddControl', false, id);
							});
							
							jQuery('a.toggleHTML_'+id, this).click(function() {
								tinyMCE.execCommand('mceRemoveControl', false, id);
							});
						});
					</script>
					<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" class="large-text" cols="" rows="" style="max-width: 600px; width: 100%; height: 120px;"><?php echo stripslashes(htmlspecialchars_decode($editorContent)) ?></textarea>
                    <br /><span class="description"><?php echo $value['desc']; ?></span>
                    
                                    
                <?php } else { // If not using RTE, just show textarea ?>
                
					<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows="" style="max-width: 600px; width: 100%; height: 120px;"><?php echo stripslashes($editorContent) ?></textarea>
                    <br /><span class="description"><?php echo $value['desc']; ?></span>
                
                <?php } ?>
                
			 </td>
             </tr>
			  
			<?php
			break;
			
			// Select 
			case 'select':
			?>
			
			<div class="rm_input rm_select">
                <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                
                <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $option) { ?>
                <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
                </select>
                
                <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
			</div>
			<?php
			break;

			// Checkboxes
			case "checkbox":
			?>
            
            <tr>
            <th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
            <td>
                <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
                <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                <span class="description"><?php echo $value['desc']; ?></span>
			 </td>
             </tr>
			
			 
			<?php
			break;

			// Headings
			case "title":
			?>
            
            <tr><th colspan="2"><br /><strong class='title'><?php echo $value['desc']; ?></strong></th></tr>
            
			<?php
			break;
			 
		}
		}
		?>
        
        </tr>
        </table>
        </div>

		<p class="submit">
        <input name="save" type="submit" value="<?php _e('Save changes','thematic'); ?>" id="submit" class="button-primary" />
		<input type="hidden" name="action" value="save" />
        </p>
	</form>
	</div>
    
    <?php
}



/***********************************
*
* GIVES THEME ACCESS TO OPTIONS
*
***********************************/
include('get.options.php');