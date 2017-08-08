<?php

/**
 * Padding_Widget Class
 */
class Padding_Widget extends WP_Widget {
	/** constructor */
	function __construct() 
	{
		parent::WP_Widget(false, $name = 'AMILLI - Padding');
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) 
	{
		extract( $args );
		$widget = '<div class="padding-widget" style="height:'.$instance['title'].'px"></div>';
		echo $widget;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) 
	{
		$defaults = array( 
			'title' => '10'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = esc_attr($instance['title']);
		?>
		<p>
		  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Pixels:'); ?></label>
		  <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<?php
	}

} // class Padding_Widget