<?php

/**
 * Facebook_Likebox_Widget Class
 */
class Facebook_Likebox_Widget extends WP_Widget {
	/** constructor */
	function Facebook_Likebox_Widget() 
	{
		parent::WP_Widget(false, $name = 'AMILLI - Facebook Likebox Widget');
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) 
	{	
		extract( $args );
		$facebook_page_url = $instance['facebook_page_url'];
	?>
	<div id="facebook-likebox-iframe" class="fb-page" data-href="<?= $facebook_page_url; ?>"data-hide-cover="false" data-height="350" data-width="500" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?= $facebook_page_url; ?>"><a href="<?= $facebook_page_url; ?>"></a></a></blockquote></div></div>
	<?php
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['facebook_page_url'] = $new_instance['facebook_page_url'];
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) 
	{
		/* Set up some default widget settings. */
		$defaults = array( 
			'facebook_page_url'     => esc_attr( get_option('facebook_page_url') )
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$facebook_page_url = esc_attr($instance['facebook_page_url']);
		?>
		 <p>
		  <label for="<?php echo $this->get_field_id('facebook_page_url'); ?>"><?php _e('Facebook page url:'); ?></label>
				  </p>
		  <input type="text" class="widefat" id="<?php echo $this->get_field_id('facebook_page_url'); ?>" name="<?php echo $this->get_field_name('facebook_page_url'); ?>" value="<?php echo $facebook_page_url; ?>" />

		<?php		
	}

} // class Facebook_Likebox_Widget