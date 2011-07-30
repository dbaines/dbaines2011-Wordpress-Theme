<?php

/***********************************
*
* WORDPRESS OPTIONS PAGE
* db2011
* 
* http://net.tutsplus.com/tutorials/wordpress/how-to-create-a-better-wordpress-options-panel/
* http://codex.wordpress.org/Creating_Options_Pages
* http://wpshout.com/create-an-advanced-options-page-in-wordpress/
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
	
	array( 
		"name" => "Google +1 Buttons",
		"desc" => "Tick to enable Google +1 Buttons on this theme",
		"id" => $shortname."_gplusone",
		"type" => "checkbox",
		"std" => ""
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
    	<table class="form-table">
        <tr>
		<?php 
			
		// This is where the magic happens. Bow chicka-wow wow.
		foreach ($options as $value) {
		switch ( $value['type'] ) {
			
			// Text Options
			case 'text':
			?>
			
            <div class="rm_input rm_text">
            	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
            	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
            	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
			</div>
			<?php
			break;
			 
			 // Textareas
			case 'textarea':
			?>
            
            <div class="rm_input rm_textarea">
                <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
                <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
            </div>
			  
			<?php
			break;
			 
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
            
            <th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
            <td>
                <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
                <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                <span class="description"><?php echo $value['desc']; ?></span>
			 </td>
			
			 
			<?php break;
			 
		}
		}
		?>
        
        </tr>
        </table>

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