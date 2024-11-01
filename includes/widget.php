<?php
class SocialMediaPresenceWidget extends WP_Widget{
	
	function SocialMediaPresenceWidget() {
		$widget_ops = array( 
			'classname' => 'social-media-wp',
			'description' => 'Display your social links in your sidebar.'
		);
		
		parent::WP_Widget('social-media-wp-widget', 'Social Media', $widget_ops);
	}

	function form($instance) {
		$title = esc_attr($instance['title']);
        ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
	}

	function widget($args, $instance) {
		global $social_networks;
		global $plugin_path;
		$icon_size = get_option( 'smp_icon_size' );
		$effect = get_option( 'smp_special_effect' );
		$rotate = get_option( 'smp_rotate' );
		$hover_text = get_option( 'smp_text_follow' );
		$css_style = get_option( 'smp_css_style' );
		$backcolor = get_option( 'smp_background_color' );
		$highlight = get_option( 'smp_highlight_color' );


		extract( $args );
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        ?>
			<?php echo $before_widget; ?>
				<?php if ( !empty ( $title ) )
					echo $before_title . $title . $after_title; ?>

				<div style="<?php echo $css_style;?>">
                     
				<?php foreach($social_networks as $slug => $name):?>
					<?php $smp_link = get_option('smp_'.$slug);?>
					<?php if ( !empty( $smp_link ) ):?>
						<a href="<?php echo $smp_link;?>" rel="nofollow" target="<?php echo get_option('smp_link_target');?>"><img style="width: <?php echo intval($icon_size);?>px; height: <?php echo intval($icon_size);?>px;" src="<?php echo $plugin_path;?>icons/<?php echo $slug;?>.png" title="<?php echo $hover_text .' '. $name;?>" alt="<?php echo $name;?>" /></a>

<?php switch ($effect) {
	case "None": 
		break; 
    	case "Dog Ear": ?>
		<a href="<?php echo $smp_link;?>" rel="nofollow" target="<?php echo get_option('smp_link_target');?>"><img style="width: <?php echo intval($icon_size);?>px; height: <?php echo intval($icon_size);?>px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: 0px; margin-left: -<?php echo intval($icon_size)+3;?>px;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" src="<?php echo $plugin_path;?>icons/mo/dogear.png" 
title="<?php echo $hover_text .' '. $name;?>" alt="<?php echo $name;?>" /></a>
     		<?php break; 
	case "Shrink": ?>
		<a href="<?php echo $smp_link;?>" rel="nofollow" target="<?php echo get_option('smp_link_target');?>"><img style="width: <?php echo intval($icon_size)-2;?>px; height: <?php echo intval($icon_size)-2;?>px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: -2px; border: 3px solid <?php echo $backcolor;?>; margin-left: -<?php echo intval($icon_size)+4;?>px;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" src="<?php echo $plugin_path;?>icons/<?php echo $slug;?>.png" title="<?php echo $hover_text .' '. $name;?>" alt="<?php echo $name;?>" /></a>
		<?php break; 
	case "Enlarge": ?>
		<a href="<?php echo $smp_link;?>" rel="nofollow" target="<?php echo get_option('smp_link_target');?>"><img style="width: <?php echo intval($icon_size)+2;?>px; height: <?php echo intval($icon_size)+2;?>px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: 0px; margin-left: -<?php echo intval($icon_size)+4;?>px;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" src="<?php echo $plugin_path;?>icons/<?php echo $slug;?>.png" title="<?php echo $hover_text .' '. $name;?>" alt="<?php echo $name;?>" /></a>
		<?php break; 
	case "Shift Up": ?>
		<a href="<?php echo $smp_link;?>" rel="nofollow" target="<?php echo get_option('smp_link_target');?>"><img style="width: <?php echo intval($icon_size);?>px; height: <?php echo intval($icon_size);?>px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: 0px; border-bottom-style: solid; border-bottom-width: 3px; border-bottom-color: <?php echo $backcolor;?>; margin-left: -<?php echo intval($icon_size)+3;?>px;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" src="<?php echo $plugin_path;?>icons/<?php echo $slug;?>.png" title="<?php echo $hover_text .' '. $name;?>" alt="<?php echo $name;?>" /></a>
		<?php break; 
	case "Highlight": ?>
		<a href="<?php echo $smp_link;?>" rel="nofollow" target="<?php echo get_option('smp_link_target');?>"><img style="width: <?php echo intval($icon_size)-2;?>px; height: <?php echo intval($icon_size)-2;?>px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: -2px; border: 3px solid <?php echo $highlight;?>; margin-left: -<?php echo intval($icon_size)+4;?>px;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" src="<?php echo $plugin_path;?>icons/<?php echo $slug;?>.png" title="<?php echo $hover_text .' '. $name;?>" alt="<?php echo $name;?>" /></a>
		<?php break;
	case "Rotate": ?>
		<a href="<?php echo $smp_link;?>" rel="nofollow" target="<?php echo get_option('smp_link_target');?>"><img style="width: <?php echo intval($icon_size);?>px; height: <?php echo intval($icon_size);?>px; -moz-transform: rotate(<?php echo $rotate;?>deg); -ms-transform: rotate(<?php echo $rotate;?>deg); opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: 0px; margin-left: -<?php echo intval($icon_size)+2;?>px;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" src="<?php echo $plugin_path;?>icons/<?php echo $slug;?>.png" title="<?php echo $hover_text .' '. $name;?>" alt="<?php echo $name;?>" /></a>
		<? break;
	case "Bullseye": ?>
		<a href="<?php echo $smp_link;?>" rel="nofollow" target="<?php echo get_option('smp_link_target');?>"><img style="width: <?php echo intval($icon_size);?>px; height: <?php echo intval($icon_size);?>px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: 0px; margin-left: -<?php echo intval($icon_size)+3;?>px;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" src="<?php echo $plugin_path;?>icons/mo/bullseye.png" 
title="<?php echo $hover_text .' '. $name;?>" alt="<?php echo $name;?>" /></a>
		<? break;
			} ?>
					<?php endif;?>
				<?php endforeach;?>

				</div>

				<?php if(get_option('smp_display_credit')):?>
					<br /><a style="font-size: 0.8em;" href="http://socialmedia.site88.net">http://socialmedia.site88.net</a>
				<?php endif;?>
			<?php echo $after_widget; ?>
        <?php
	}

}
add_action('widgets_init', create_function('', 'return register_widget("SocialMediaPresenceWidget");'));
?>