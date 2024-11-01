<?php 

add_action('admin_menu', 'social_media_presence_options');

function social_media_presence_options(){
	if( function_exists( 'add_theme_page' ) ):
		add_theme_page( 'Social Media Options', 'Social Media Options', 'manage_options', 'social_media_presence', 'social_media_presence_html');
	endif;
}

function social_media_presence_html(){
	global $social_networks;
		//must check that the user has the required capability 
    if ( !current_user_can('manage_options') ):
		wp_die( __('You do not have sufficient permissions to access this page.') );
    endif;

	// variables for the field and option names 
	$smp_hidden = 'smp_hidden';
	$smp_icon_size = get_option( 'smp_icon_size' );
	$smp_special_effect = get_option( 'smp_special_effect' );
	$smp_rotate = get_option( 'smp_rotate' );
	$smp_display_credit = get_option( 'smp_display_credit' );
	$smp_link_target = get_option( 'smp_link_target' );
	$smp_background_color = get_option( 'smp_background_color' );
	$smp_highlight_color = get_option( 'smp_highlight_color' );
	$smp_text_follow = get_option( 'smp_text_follow' );
	$smp_text_rss = get_option( 'smp_text_rss' );
	$smp_css_style = get_option( 'smp_css_style' );

	
	$values = array();
    // Read in existing option value from database
    foreach($social_networks as $slug => $name):
    	$values[ $slug ] = get_option( 'smp_' . $slug );
	endforeach;

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $smp_hidden ]) && $_POST[ $smp_hidden ] == 'Y' ):
    	// Get value from posted data and save data
	    foreach($social_networks as $slug => $name):
	    	$values[$slug] = $_POST[ 'smp_' . $slug ];
        	update_option( 'smp_' . $slug, $values[ $slug ] );
		endforeach;
		
		$smp_icon_size = $_POST[ 'smp_icon_size' ];
		update_option( 'smp_icon_size' , $smp_icon_size );

		$smp_special_effect = $_POST[ 'smp_special_effect' ];
		update_option( 'smp_special_effect' , $smp_special_effect );

		$smp_rotate = $_POST[ 'smp_rotate' ];
		update_option( 'smp_rotate' , $smp_rotate );

		$smp_link_target = $_POST[ 'smp_link_target' ];
		update_option( 'smp_link_target' , $smp_link_target );

		$smp_background_color = $_POST[ 'smp_background_color' ];
		update_option( 'smp_background_color' , $smp_background_color );

		$smp_highlight_color = $_POST[ 'smp_highlight_color' ];
		update_option( 'smp_highlight_color' , $smp_highlight_color );

		$smp_text_follow = $_POST[ 'smp_text_follow' ];
		update_option( 'smp_text_follow' , $smp_text_follow );

		$smp_text_rss = $_POST[ 'smp_text_rss' ];
		update_option( 'smp_text_rss' , $smp_text_rss );

		$smp_css_style = $_POST[ 'smp_css_style' ];
		update_option( 'smp_css_style' , $smp_css_style );

		
		if(isset($_POST[ 'smp_display_credit' ]) && $_POST[ 'smp_display_credit' ] == 1):
			$smp_display_credit = $_POST[ 'smp_display_credit' ];
			update_option( 'smp_display_credit', true );
		else:
			$smp_display_credit = false;
			update_option( 'smp_display_credit', false );
		endif;

        // Put an settings updated message on the screen
	?>
		<div class="updated"><p><strong><?php _e('Settings saved. Please browse to the Appearance->Widgets page to add the widget.', 'menu-test' ); ?></strong></p></div>
	
	<?php endif; ?>
    
	<div class="wrap">
		<div id="icon-themes" class="icon32"><br /></div>
		<h2><?php _e( 'Social Media Options', 'social_media_presence' );?></h2>
		
		<form name="form1" method="post" action="">
		<input type="hidden" name="<?php echo $smp_hidden; ?>" value="Y">
		
		<h3>Social Networks</h3>
		
		<p><?php _e( 'Please enter the URLs to your social profiles (include the http://). Any fields left blank will not be displayed.', 'social_media_presence' );?></p>

                <table>
                <?php $count = 0;?>
		<?php foreach($social_networks as $slug => $name):?>
                    <?php if($count % 2 == 0)echo '<tr>';$eol = false;?>
                        <td align="right">&nbsp;&nbsp;<?php _e($name, 'social_media_presence' ); ?></td>
			<td><input type="text" name="smp_<?php echo $slug?>" value="<?php echo $values[$slug]; ?>" size="40"></td>
                    <?php $count++;?>
                    <?php if($count % 2 == 0)echo '</tr>';$eol = true;?>
		<?php endforeach;?>
                    <?php if(!$eol)echo '</tr>';?>
                </table>
		
		<h3>Link &amp; Icon Options</h3>

		<p><?php _e('CSS style for your icons', 'social_media_presence' ); ?>
		<input type="text" default="text-align: center;" value="<?php echo $smp_css_style; ?>" name="smp_css_style" size="40" />
		</p>

		
		<p><?php _e('Icon Size', 'social_media_presence' ); ?> 
			<select name="smp_icon_size">
				<option value="16x16" <?php if($smp_icon_size == "16x16") echo 'selected="selected"'?>>16x16</option>
				<option value="24x24" <?php if($smp_icon_size == "24x24") echo 'selected="selected"'?>>24x24</option>
				<option value="32x32" <?php if($smp_icon_size == "32x32") echo 'selected="selected"'?>>32x32</option>
				<option value="48x48" <?php if($smp_icon_size == "48x48") echo 'selected="selected"'?>>48x48</option>
				<option value="64x64" <?php if($smp_icon_size == "64x64") echo 'selected="selected"'?>>64x64</option>		
			</select>
		</p>


		<p><?php _e('Special Effect', 'social_media_presence' ); ?> 
			<select name="smp_special_effect">
				<option value="None" <?php if($smp_special_effect == "None") echo 'selected="selected"'?>>None</option>
				<option value="Dog Ear" <?php if($smp_special_effect == "Dog Ear") echo 'selected="selected"'?>>Dog Ear</option>
				<option value="Enlarge" <?php if($smp_special_effect == "Enlarge") echo 'selected="selected"'?>>Enlarge</option>
				<option value="Shrink" <?php if($smp_special_effect == "Shrink") echo 'selected="selected"'?>>Shrink</option>
				<option value="Shift Up" <?php if($smp_special_effect == "Shift Up") echo 'selected="selected"'?>>Shift Up</option>
				<option value="Highlight" <?php if($smp_special_effect == "Highlight") echo 'selected="selected"'?>>Highlight</option>
				<option value="Rotate" <?php if($smp_special_effect == "Rotate") echo 'selected="selected"'?>>Rotate</option>
				<option value="Bullseye" <?php if($smp_special_effect == "Bullseye") echo 'selected="selected"'?>>Bullseye</option>
			</select>
		</p>


		<p><?php _e('Rotate', 'social_media_presence' ); ?> 
			<select name="smp_rotate">
				<option value="90" <?php if($smp_rotate == "90") echo 'selected="selected"'?>>90</option>
				<option value="180" <?php if($smp_rotate == "180") echo 'selected="selected"'?>>180</option>
				<option value="270" <?php if($smp_rotate == "270") echo 'selected="selected"'?>>270</option>
				<option value="-90" <?php if($smp_rotate == "-90") echo 'selected="selected"'?>>-90</option>
				<option value="-180" <?php if($smp_rotate == "-180") echo 'selected="selected"'?>>-180</option>
				<option value="-270" <?php if($smp_rotate == "-270") echo 'selected="selected"'?>>-270</option>
			</select>
		</p>

		<p><?php _e('Background Color of widget where Icons are displayed. (In Hex ex: #ffffff)', 'social_media_presence' ); ?>
		<input type="text" value="<?php echo $smp_background_color; ?>" name="smp_background_color" />
		</p>

		<p><?php _e('Color to use for Highlight effect. (In Hex ex: #000fff)', 'social_media_presence' ); ?>
		<input type="text" value="<?php echo $smp_highlight_color; ?>" name="smp_highlight_color" />
		</p>

		<p><?php _e('Hover Text (the icon name appends to the end). ex: Follow us on Twitter.', 'social_media_presence' ); ?>
		<input type="text" value="<?php echo $smp_text_follow; ?>" name="smp_text_follow" size="40" />
		</p>

		<p><?php _e('Hover Text for RSS Icon. ex: Subscribe to our Feed', 'social_media_presence' ); ?>
		<input type="text" value="<?php echo $smp_text_rss; ?>" name="smp_text_rss" size="40" />
		</p>


		<p><?php _e('Open Link In', 'social_media_presence' ); ?>
			<select name="smp_link_target">
				<option value="_parent" <?php if($smp_link_target == "_parent") echo 'selected="selected"'?>>Current Window</option>
				<option value="_blank" <?php if($smp_link_target == "_blank") echo 'selected="selected"'?>>New Window</option>
			</select>
		</p>
		
		<p><input type="checkbox" name="smp_display_credit" value="1" <?php if($smp_display_credit) echo 'checked="checked"'?> />
			<?php _e('Check the box to display a link to the plugin under the widget. Help support the Author.', 'social_media_presence' ); ?> 
		</p>		
	
		<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
		</p>
	
		</form>
	</div>
	<?php
}
?>