<?php

/**
 * Advertisement_Notice Class
 */
class Advertisement_Notice extends WP_Widget {
	/** constructor */
	function __construct() 
	{
		parent::WP_Widget(false, $name = 'AMILLI - Advertisement Notice');
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) 
	{
		extract( $args );
		$position = strip_tags($instance['position']);
		$title = strip_tags($instance['title']);
		$widget = '<div class="ad-notice '.$position.'">'.$title.'</div>';
		echo $widget;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['position'] = $new_instance['position'];
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$defaults = array( 
			'title'                 => 'ADVERTISEMENT',
			'position'                => 'left'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = esc_attr($instance['title']);
		$position = esc_attr($instance['position']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Section Heading:'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('position'); ?>"><?php _e('Position:'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('position'); ?>" name="<?php echo $this->get_field_name('position'); ?>">
					<option value="left" <?= ($position=="left")?'selected':'';?>>Left</option>
					<option value="center" <?= ($position=="center")?'selected':'';?>>Center</option>
					<option value="right" <?= ($position=="right")?'selected':'';?>>Right</option>
			</select>
		</p>

		<?php
	}

} // class Advertisement_Notice