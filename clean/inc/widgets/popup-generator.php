<?php

/**
 * popup_generator Class
 */
class Popup_Generator extends WP_Widget {
	/** constructor */
	function popup_generator() 
	{
		parent::WP_Widget(false, $name = 'AMILLI - Popup Generator');
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) 
	{
		global $page, $post;
		if (is_single())
		{
			$numpages = count(explode("<!--nextpage-->",$post->post_content));
			$title = $instance['title'];
			$popup_trigger = $instance['popup_trigger'];
			$show_close = $instance['show_close'];
			$delay = $instance['delay'];
			$code = $instance['code'];
			$width = $instance['width'];
			$height = $instance['height'];
			$border_radius = $instance['border_radius'];
			$cookie_expire = $instance['cookie_expire'];
			$container_id = str_replace(" ","_",$title.dechex(rand(1111111,99999999)));
			if (($popup_trigger=='start' && $page==0) || ($popup_trigger=='end' && $page==$numpages) || $popup_trigger=='exit')
			{
				echo '<style type="text/css">';
				echo '#'.$container_id.' { left:0;right:0;top:0;bottom:0;background-color:rgba(0,0,0,.7);position:fixed;z-index:9000000000;display: none; }';
				echo '#'.$container_id.' .pop-container { padding: 20px 10px 10px 10px;width:'.$width.'px;height:'.$height.'px;border-radius:'.$border_radius.'px;background-color: #FCFCFC;margin: auto auto;position: relative; }';
				$display = ($show_close)?'inline-block':'none';
				echo '#'.$container_id.' .pop-container .close-popup { display: '.$display.'; }';
				echo '</style>';
				echo '<script type="text/javascript">';
				echo '	jQuery(document).ready(function(){';
				echo ($popup_trigger!="exit")?'setTimeout(show_pop,'.$delay.'000);':'';
				echo '
						});
						function show_pop() {
							jQuery("#'.$container_id.'").show();
							var top = ((jQuery(window).height()-'.$height.')/2)-110;
							if (top<0) {
								top = ((jQuery(window).height()-'.$height.')/2);
							}
							jQuery("#'.$container_id.' .pop-container").css({"margin-top":top+"px"});
							jQuery("#'.$container_id.' .pop-container .close-popup").on("click",function(){
								jQuery("#'.$container_id.'").hide();
							});
						}
						jQuery( document ).on( "mousemove", function( event ) {
						  	var xpos = event.pageX;
						  	var ypos = event.pageY;
						  	if (cookie.get("pop")!="shown") {
							  	if (xpos <= 50 || ypos <= 50) {
							  		show_pop();
									cookie.set("pop", "shown", {path: "/", expires: '.$cookie_expire.', seconds: true});
							  	}
							}
						});
					';
				echo '</script>';
				$popup_generator = '<div id="'.$container_id.'"><div class="pop-container"><div class="close-popup"></div>'.$code.'</div></div>';
				echo $popup_generator;
			}
		}
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['popup_trigger'] = $new_instance['popup_trigger'];
		$instance['show_close'] = $new_instance['show_close'];
		$instance['delay'] = $new_instance['delay'];
		$instance['code'] = $new_instance['code'];
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];
		$instance['border_radius'] = $new_instance['border_radius'];
		$instance['cookie_expire'] = $new_instance['cookie_expire'];
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance) 
	{
		$title = esc_attr($instance['title']);
		$popup_trigger = esc_attr($instance['popup_trigger']);
		$show_close = esc_attr($instance['show_close']);
		$delay = esc_attr($instance['delay']);
		$code = esc_attr($instance['code']);
		$width = esc_attr($instance['width']);
		$height = esc_attr($instance['height']);
		$border_radius = esc_attr($instance['border_radius']);
		$cookie_expire = esc_attr($instance['cookie_expire']);
		?>
		<p>
		  	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		  	<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		  	<i>This title will not be visible to the user</i>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('popup_trigger'); ?>"><?php _e('Popup Trigger:'); ?></label>
			<select class="small" id="<?php echo $this->get_field_id('popup_trigger'); ?>" name="<?php echo $this->get_field_name('popup_trigger'); ?>">
					<option value="start" <?= ($popup_trigger=='start')?'selected':''; ?>>First Post Page</option>
					<option value="end" <?= ($popup_trigger=='end')?'selected':''; ?>>Last Post Page</option>
					<option value="exit" <?= ($popup_trigger=='exit')?'selected':''; ?>>Exit Intent</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_close'); ?>"><?php _e('Show close button:'); ?></label>
		  	<input type="checkbox" id="<?php echo $this->get_field_id('show_close'); ?>" name="<?php echo $this->get_field_name('show_close'); ?>" value="true" <?= ($show_close)?'checked':''; ?>/>
		</p>
		 <p>
		  <label for="<?php echo $this->get_field_id('delay'); ?>"><?php _e('Delay:'); ?></label>
		  <input class="small" style="text-align: center" size="3" maxlength=3 type="text" id="<?php echo $this->get_field_id('delay'); ?>" name="<?php echo $this->get_field_name('delay'); ?>" value="<?php echo $delay; ?>" />
		   <i>In seconds</i>
		</p>
		 <p>
		  <label for="<?php echo $this->get_field_id('cookie_expire'); ?>"><?php _e('Cookie Expiration:'); ?></label>
		  <input class="small" style="text-align: center" size="3" maxlength=6 type="text" id="<?php echo $this->get_field_id('cookie_expire'); ?>" name="<?php echo $this->get_field_name('cookie_expire'); ?>" value="<?php echo $cookie_expire; ?>" />
		   <i>In seconds e.g: 300 = 5 min</i>
		</p>
		 <p>
			<h3>Container measurements</h3>
			<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:'); ?></label>
			<input class="small" style="text-align: center" size="4" maxlength=4 type="text" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $width; ?>" />
			<i>px</i>
			 | 
			<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:'); ?></label>
			<input class="small" style="text-align: center" size="4" maxlength=4 type="text" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $height; ?>" />
			<i>px</i>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('border_radius'); ?>"><?php _e('Border Radius:'); ?></label>
			<input class="small" style="text-align: center" size="3" maxlength=3 type="text" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('border_radius'); ?>" value="<?php echo $border_radius; ?>" />
			<i>px</i>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('code'); ?>"><?php _e('Code:'); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>"><?php echo $code; ?></textarea>
		</p>
		<?php
	}

} // class popup_generator