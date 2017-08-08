<?php

/**
 * Super_Empty_Widget Class
 */
class Super_Empty_Widget extends WP_Widget {
	/** constructor */
	function Super_Empty_Widget() 
	{
		parent::WP_Widget(false, $name = 'AMILLI - HEAD Widget');
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) 
	{
		extract( $args );
		$content = $instance['content'];
		echo $content;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['content'] = $new_instance['content'];
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) 
	{
		$content = esc_attr($instance['content']);
		?>
		 <p>
		  <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?></label>
				  </p>
		  <textarea class="widefat" cols="20" rows="16" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>

		<?php
	}

} // class Super_Empty_Widget