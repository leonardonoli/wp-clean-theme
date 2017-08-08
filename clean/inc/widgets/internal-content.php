<?php
/**
 * InternalWidget Class - Wrapper for the widget
 *
 * @package Internal_Content
 * @subpackage Widgets
 * @author Leonardo Noli
 */
class Internal_Widget extends WP_Widget 
{
	
	/** constructor */
	function __construct() 
	{
		/* Widget settngs. */
		$widget_ops = array( 'classname' => 'Internal_Widget', 'description' => "Shortcode [internal_content]" );

		/* Widget control settings. */
		$control_ops = array('id_base' => 'internal_widget' );

		/* Create the widget. */
		parent::WP_Widget( 'internal_widget', __('AMILLI - Internal Content', 'internal-content'), $widget_ops, $control_ops );
	}

	/**
	 * Handle Widget update
	 *
	 * @see WP_Widget::update
	 *
	 */
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;

		// validate data
		$instance['title']                 = strip_tags($new_instance['title']);
		$instance['display_title']         = strip_tags($new_instance['display_title']);
		$instance['number']                = intval($new_instance['number']);
		$instance['order']                 = strip_tags($new_instance['order']);
		$instance['custom']                = strip_tags($new_instance['custom']);		
		$instance['style_type']		       = $new_instance['style_type'];
		
		return $instance;
	}

	public function widget( $args, $instance )
	{	
		global $post;
		$post_id = $post->ID;
		$style_type = $instance['style_type'];
		$display_title = $instance['display_title'];
		$internal_content = '
			<div class="'.$instance['style_type'].'">';
		if ($display_title) 
		{
				$titlePieces = explode(" ",$instance['title']);
				foreach ($titlePieces as $key => $value)
				{
					$titlePieces[$key] = '<span class="word'.$key.'">'.$value.'</span>';
				}
				$internal_content .= '<div class="theme-widget-title internal-content-title">'.implode(" ",$titlePieces).'</div>';
		}
		$internal_content .= '<ul>';
		switch ($instance['order'])
		{
			case 'random':
				$orderby = 'rand';
				$order = '';
				break;
			case 'newest':
				$orderby = 'date';
				$order = 'desc';
				break;
		}
		if ($instance['custom']==0)
		{
			$posts = get_posts('orderby='.$orderby.'&order='.$order.'&numberposts='.$instance['number'].'&exclude='.$post_id.'&post_status=publish'); 
		}
		else
		{
			$posts = get_posts('orderby=none&include='.$instance['custom'].'&post_status=publish'); 
		}


		foreach($posts as $single_post) 
		{ 
			$image = get_the_post_thumbnail( $single_post->ID, $style_type, array('class'=>'image') );
			$link = get_the_permalink($single_post->ID);
			$title = get_the_title($single_post->ID);
			$internal_content .= '
				<li>
					<a href="'.$link.'" title="'.$title.'">
					<div class="image-container">'.
					$image
					.'</div>
					<div class="divider"></div>
					<div class="post-title">
							'.mb_strimwidth($title,0,65,"...").'
					</div>
					<div class="clear"></div>
					</a>
				</li>';
		}
		$internal_content .=	'
			</ul>
			<div class="clear"></div>
		</div>';
		echo $internal_content;
	}

	/**
	 * Handle Widget Form
	 *
	 * @see WP_Widget::form
	 */
	function form($instance) 
	{
		
		/* Set up some default widget settings. */
		$defaults = array( 
			'title'                 => 'More From Us',
			'display_title'			=> true,
			'number'                => '5',
			'order'                 => 'random',
			'custom'                => '0',
			'excerpt'				=> false,
			'style_type'			=> 'sidebar-list'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title      			= esc_attr($instance['title']);
		$display_title			= esc_attr($instance['display_title']);
		$number 	           	= intval($instance['number']);
		$order 	               	= esc_attr($instance['order']);
		$custom                	= esc_attr($instance['custom']);
		$excerpt               	= esc_attr($instance['excerpt']);
		$style_type				= esc_attr($instance['style_type']);

?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				Title:
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />		
			<br>
			<i>Shortcode: title=""</i>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('display_title'); ?>">
				Display Title:
			</label>
			<input id="<?php echo $this->get_field_id('display_title'); ?>" name="<?php echo $this->get_field_name('display_title'); ?>" type="checkbox" value="true" <?= ($display_title)?'checked':''; ?>/>
			<br>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('style_type'); ?>">
				Style Type:
			<label>
		<select class="widefat" id="<?php echo $this->get_field_id('style_type'); ?>" name="<?php echo $this->get_field_name('style_type'); ?>">
					<option value="sidebar-list" <?= ($style_type=="sidebar-list")?'selected':'';?>>Sidebar List</option>
					<option value="sidebar-large" <?= ($style_type=="sidebar-large")?'selected':'';?>>Sidebar Large</option>
					<option value="content-adwall" <?= ($style_type=="content-adwall")?'selected':'';?>>Content Ad Wall</option>
			</select>
			<br>
			<i>Shortcode: style_type=""</i>
			<br>
			<b><i>Options:</i></b> <i>sidebar-list</i>, <i>sidebar-large</i>, <i>content-adwall</i>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>">
				Order:
			<label>
			<select class="widefat" id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
					<option value="newest" <?= ($order=="newest")?'selected':'';?>>Newest</option>
					<option value="random" <?= ($order=="random")?'selected':'';?>>Random</option>
			</select>
			<br>
			<i>Shortcode: title=""</i>
			<br>
			<b><i>Options:</i></b> <i>newest</i>, <i>random</i>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('custom'); ?>">
				Custom Posts:
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('custom'); ?>" name="<?php echo $this->get_field_name('custom'); ?>" type="text" value="<?php echo $custom; ?>" />		
			<i>List of post IDs separated by commas.</i>
			<br>
			<i>Shortcode: custom=""</i>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('number'); ?>">
			Number of posts to show:
		<input style="width: 25px; text-align: center;" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label>
			<br>
			<i>Shortcode: number=""</i>
	</p>
		<?php
	}
}

function internal_content_shortcode( $atts, $content = null)
{
	extract( shortcode_atts( array(
			'title'                 => '',
			'display_title'         => '',
			'number'                => '',
			'order'                 => '',
			'custom'                => '',
			'excerpt'				=> false,
			'style_type'			=> ''
			), $atts 
		) 
	);

	ob_start();
	the_widget('Internal_Widget',$atts);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'internal_content', 'internal_content_shortcode');