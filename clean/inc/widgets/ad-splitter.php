<?php

class Ad_Splitter extends WP_Widget {
	function Ad_Splitter () 
	{
		load_plugin_textdomain( 'ad-splitter', false, dirname( plugin_basename( __FILE__ ) ) );
		$widget_ops = array('classname' => 'widget_splitter', 'description' => __('Split between two ads with custom amounts', 'ad-splitter'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('ad-splitter', __('AMILLI - Ad Splitter', 'ad-splitter'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) 
	{
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$ad1 = apply_filters( 'widget_ad_1', empty( $instance['ad_1'] ) ? '' : $instance['ad_1'], $instance );
		$ad2 = apply_filters( 'widget_ad_2', empty( $instance['ad_2'] ) ? '' : $instance['ad_2'], $instance );

		$split1 = apply_filters( 'widget_split_1', $instance['split_1'], $instance );	
		echo $before_widget;
		if ( !empty( $title )) { echo $before_title . $title . $after_title; }
			?>
			<div class="splitterwidget">
				<script type="text/javascript">
					<?php if (!empty($split1)) { ?>
					var split_amount = <?= $split1; ?>;
					<?php }else{ ?>
					var split_amount = 100;
					<?php } ?>
					var split = Math.floor((Math.random()*100)+1);
					if (split<=split_amount) {
						document.write(<?= json_encode($ad1); ?>);
					}else{
						document.write(<?= json_encode($ad2); ?>);					
					}
				</script>
			</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') ) {
			$instance['ad_1'] =  $new_instance['ad_1'];
			$instance['desc_1'] =  $new_instance['desc_1'];
			$instance['split_1'] =  $new_instance['split_1'];
			$instance['ad_2'] =  $new_instance['ad_2'];
			$instance['desc_2'] =  $new_instance['desc_2'];
		}else{
			$instance['ad_1'] = stripslashes( wp_filter_post_kses( $new_instance['ad_1'] ) );
			$instance['desc_1'] =  $new_instance['desc_1'];
			$instance['split_1'] = stripslashes( wp_filter_post_kses( $new_instance['split_1'] ) );
			$instance['ad_2'] = stripslashes( wp_filter_post_kses( $new_instance['ad_2'] ) );
			$instance['desc_2'] =  $new_instance['desc_2'];
		}
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) 
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'ad_1' => '', 'desc_1' => '', 'split_1' => '', 'ad_2' => '', 'desc_2' => '') );
		$title = strip_tags($instance['title']);
		$ad1 = format_to_edit($instance['ad_1']);
		$desc1 = format_to_edit($instance['desc_1']);
		$split1 = format_to_edit($instance['split_1']);
		$ad2 = format_to_edit($instance['ad_2']);
		$desc2 = format_to_edit($instance['desc_2']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ad-splitter'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('split_1'); ?>">Advertisement One</label><input style="width: 80px;margin-left: 10px;" id="<?php echo $this->get_field_id('split_1'); ?>" name="<?php echo $this->get_field_name('split_1'); ?>" type="text" value="<?php echo esc_attr($split1); ?>" placeholder="Split %" /> %
		<input class="widefat" id="<?php echo $this->get_field_id('desc_1'); ?>" name="<?php echo $this->get_field_name('desc_1'); ?>" type="text" value="<?php echo esc_attr($desc1); ?>" placeholder="Description" />
		<textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('ad_1'); ?>" name="<?php echo $this->get_field_name('ad_1'); ?>" placeholder="Ad Tag"><?php echo $ad1; ?></textarea>
		</p>
		<p><label for="<?php echo $this->get_field_id('ad_2'); ?>">Advertisement Two</label>
		<input class="widefat" id="<?php echo $this->get_field_id('desc_2'); ?>" name="<?php echo $this->get_field_name('desc_2'); ?>" type="text" value="<?php echo esc_attr($desc2); ?>" placeholder="Description" />
		<textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('ad_2'); ?>" name="<?php echo $this->get_field_name('ad_2'); ?>" placeholder="Ad Tag"><?php echo $ad2; ?></textarea>
		</p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("Ad_Splitter");'));
