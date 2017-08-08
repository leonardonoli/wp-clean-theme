<?php

/**
 * Advertisement_Notice Class
 */
class Desktop_Popup_Controller extends WP_Widget {
	/** constructor */
	function __construct() 
	{
		parent::WP_Widget(false, $name = 'AMILLI - Desktop Popup Controller');
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) 
	{
		extract( $args );
		$trigger = strip_tags($instance['page']);
		$code = strip_tags($instance['code']);
		$code = apply_filters( '', empty( $instance['code'] ) ? '' : $instance['code'], $instance );
	
		echo "<~----~>".$trigger."||". $code .">!----!<";
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['code'] = $new_instance['code'];
		$instance['page'] = $new_instance['page'];
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$defaults = array( 
			'code'                => '',
			'page'                => '8'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$code = esc_attr($instance['code']);
		$page = esc_attr($instance['page']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('page'); ?>"><?php _e('Page to Trigger:'); ?></label>
			<input class="small" size="2" type="text" id="<?php echo $this->get_field_id('page'); ?>" name="<?php echo $this->get_field_name('page'); ?>" value="<?php echo $page; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('code'); ?>"><?php _e('Code:'); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>"><?php echo $code; ?></textarea>
		</p>

		<?php
	}

} // class Advertisement_Notice