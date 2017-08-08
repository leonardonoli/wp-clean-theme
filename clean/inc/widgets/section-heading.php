<?php

/**
 * Section_Heading Class
 */
class Section_Heading extends WP_Widget {
	/** constructor */
	function __construct() 
	{
		/* Widget settngs. */
		$widget_ops = array( 'classname' => 'Section_Heading', 'description' => 'Adds a heading styled title. Shortcode [section_heading]');

		/* Widget control settings. */
		$control_ops = array('id_base' => 'section_heading' );
		parent::WP_Widget(false, $name = 'AMILLI - Section Heading', $widget_ops, $control_ops );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) 
	{
		extract( $args );
		$title = '<div class="theme-widget-title">'.$instance['title'].'</div>';
		echo $title;
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
		$title = esc_attr($instance['title']);
		?>
		 <p>
		  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Section Heading:'); ?></label>
		  <input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		 </p>

		<?php
	}

} // class Section_Heading

function section_heading_shortcode( $atts, $content = null)
{
	extract( shortcode_atts( array(
			'title'                 => ''
			), $atts 
		) 
	);

	ob_start();
	the_widget('Section_Heading',$atts);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'section_heading', 'section_heading_shortcode');