<?php

/**
 * Horizontal_Divider Class
 */
class Horizontal_Divider extends WP_Widget {
	/** constructor */
	function Horizontal_Divider() 
	{
		parent::WP_Widget(false, $name = 'AMILLI - Horizontal Divider');
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) 
	{
		extract( $args );
		$height = str_replace("px","",$instance['height']);
		$width = $instance['width'];
		$color = str_replace("#","",$instance['color']);
		$divider = '<div style="width:'.$width.';height: '.$height.'px;background-color:#'.$color.'"></div>';
		echo $divider;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['height'] = $new_instance['height'];
		$instance['width'] = $new_instance['width'];
		$instance['color'] = $new_instance['color'];
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) 
	{
		
		/* Set up some default widget settings. */
		$defaults = array( 
			'height'                => '1',
			'width'                 => '100%',
			'color'                 => '000000'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$height = esc_attr($instance['height']);
		$width = esc_attr($instance['width']);
		$color = esc_attr($instance['color']);
		?>
		 <p>
		  <label style="width: 80px;display: inline-block" for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:'); ?></label>
		  <input type="text" style="width: 60px; text-align: center;" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $height; ?>" maxlength="4" />
			<p><i>Only include the number for the height</i></p>
		 </p>
		 <p>
		  <label style="width: 80px;display: inline-block" for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:'); ?></label>
		  <input type="text" style="width: 60px; text-align: center;" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $width; ?>" maxlength="6" />
			<p><i>Include either % or px for the width</i></p>
		 </p>
		 <p>
		  <label style="width: 80px;display: inline-block" for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Color:'); ?></label>
		  <input type="text" style="width: 60px; text-align: center;" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" value="<?php echo $color; ?>" maxlength="6" />
			<p><i>Do not include the # for the color</i></p>
		 </p>

		<?php
	}

} // class Horizontal_Divider_Widget