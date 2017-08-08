<?php

/**
 * Bottom_Anchor Class
 */
class Bottom_Anchor extends WP_Widget {
	/** constructor */
	function __construct() 
	{
		/* Widget settngs. */
		$widget_ops = array( 'classname' => 'Bottom_Anchor', 'description' => 'Adds an anchor internal ad to the bottom of the page.');

		/* Widget control settings. */
		$control_ops = array('id_base' => 'bottom_anchor' );
		parent::WP_Widget(false, $name = 'AMILLI - Bottom Anchor', $widget_ops, $control_ops );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) 
	{
		extract( $args );
		$bottom_anchor = '<div id="bottom-anchor" style="width:'.$instance['width'].'px;height:'.$instance['height'].'px;';
		switch ($instance['position'])
		{
			case "left":
				$bottom_anchor .= 'left:0;';
				break;
			case "right":
				$bottom_anchor .= 'right:0;';
				break;
			default:
				$bottom_anchor .= 'left:50%;margin-left:-'.($instance['width']/2).'px;';
				break;
		}
		$bottom_anchor .= '">';
		$bottom_anchor .= '<a href="'.$instance['target_url'].'" target="_blank">';
		$bottom_anchor .= '<img src="'.$instance['image_url'].'"/>';
		$bottom_anchor .= '</a>';
		$bottom_anchor .= '</div>';
		echo $bottom_anchor;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['image_url'] = $new_instance['image_url'];
		$instance['target_url'] = $new_instance['target_url'];
		$instance['position'] = $new_instance['position'];
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) 
	{
		$image_url = esc_attr($instance['image_url']);
		$target_url = esc_attr($instance['target_url']);
		$position = esc_attr($instance['position']);
		$width = esc_attr($instance['width']);
		$height = esc_attr($instance['height']);
		?>
		 <p><label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Image URL:'); ?></label></p>
		  <input class="widefat" type="text" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" value="<?php echo $image_url; ?>" />
		  <p><label for="<?php echo $this->get_field_id('target_url'); ?>"><?php _e('Target URL:'); ?></label></p>
		  <input class="widefat" type="text" id="<?php echo $this->get_field_id('target_url'); ?>" name="<?php echo $this->get_field_name('target_url'); ?>" value="<?php echo $target_url; ?>" />
		  <p><label for="<?php echo $this->get_field_id('position'); ?>"><?php _e('Position:'); ?></label></p>		  
			<select class="small" id="<?php echo $this->get_field_id('position'); ?>" name="<?php echo $this->get_field_name('position'); ?>">
					<option value="left" <?= ($position=="left")?'selected':'';?>>Left</option>
					<option value="center" <?= ($position=="center")?'selected':'';?>>Center</option>
					<option value="right" <?= ($position=="right")?'selected':'';?>>Right</option>
			</select>
		  <p><label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:'); ?></label>
		  <input class="small" type="text" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $width; ?>" /><i>px</i></p>
		  <p><label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:'); ?></label>
		  <input class="small" type="text" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $height; ?>" /><i>px</i></p>

		<?php
	}

} // class Bottom_Anchor