<?php
/**
 * InternalWidget Class - Wrapper for the widget
 *
 * @package Internal_Content
 * @subpackage Widgets
 * @author Leonardo Noli
 */
class Social_Icons extends WP_Widget {
	
	/** constructor */
	function __construct() 
	{
		/* Widget settngs. */
		$widget_ops = array( 'classname' => 'Social_Icons', 'description' => 'Widget that adds a share button for facebook, google+, pinterest and twitter. Shortcode [social_icons]');

		/* Widget control settings. */
		$control_ops = array('id_base' => 'social_icons' );

		/* Create the widget. */
		parent::WP_Widget( 'social_icons', __('AMILLI - Social Icons', 'social-icons'), $widget_ops, $control_ops );
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
		$instance['share_type'] = strip_tags($new_instance['share_type']);
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	public function widget( $args, $instance )
	{	
		global $post, $facebook_app_id, $post_publisher_key, $template_directory_uri, $thumbnail;
		$url = urlencode($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		$title = urlencode($post->post_title);
		$image = urlencode($thumbnail);
		$site_name = get_bloginfo('name');
		switch ($instance['share_type'])
		{
			case '1':
			case '6':
				$social_icons = '<div class="social-bar">
								<a class="button-googleplus" href="https://plus.google.com/share?url=http://'.$url.'" target="_blank"><span class="icon"></span><content>Share It!</content></a> <a class="button-facebook" href="https://www.facebook.com/sharer/sharer.php?u=http://'.$url.'" target="_blank"><span class="icon"></span><content>Share It!</content></a> <a class="button-twitter" href="https://twitter.com/home?status='.$url.' http://'.$url.'" target="_blank"><span class="icon"></span><content>Tweet It!</content></a> <a class="button-pinterest" href="https://pinterest.com/pin/create/link/?url='.$url.'&media='.$image.'&description='.$title.'" target="_blank"><span class="icon"></span><content>Pin It!</content></a> 
								</div>';
				break;
			case "2":
					$social_icons = '<div class="social-bar-desktop long">
										<a class="button-facebook" href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" target="_blank"><span class="icon"><img src="'.$template_directory_uri.'/images/icon_fb.png" /></span><content>Share On Facebook</content></a> <a class="button-twitter" href="https://twitter.com/home?status='.$title.' '.$url.'" target="_blank"><span class="icon"><img src="'.$template_directory_uri.'/images/icon_twitter.png" /></span><content>Share On Twitter</content></a> 
									</div>';
				break;
			case '3':
			case '8':
				$social_icons = '
								<div id="fb_large_share">
								    <div class="pw-widget">';
				if ($instance['share_type']==3)
				{
					$social_icons .= '<a id="onclick-popup" class="fb-share pw-button-facebook" href="http://www.facebook.com/sharer/sharer.php?u='.$url.'?utm_source=FacebookBigShareButton&utm_medium=Internal&utm_campaign=PostShare&app_id='.$facebook_app_id.'" onclick="window.open (this.href, \'child\', \'height=400,width=665,scrollbars\'); return false">';
				}
				else
				{
					$social_icons .=  '<a class="pw-button-facebook">';
				}
				$social_icons .= '
											<img src="'.$template_directory_uri.'/images/fb-icon.png" class="pw-left-fb-icon">
								   			<span id="fb-share-text">Share this article on Facebook</span>
								    		<span style="" class="fb-share-count pw-facebook-share-count"><img class="fb-quote-image" src="'.$template_directory_uri.'/images/arrow-white.png" /><span class="fb-share-count">0</span>
										</a>
									</div>
								</div>
								<!-- Get FB like and share count -->
								<script>
									jQuery.ajax({
										type: "GET",
										url: "https://graph.facebook.com/?id='.$url.'",
										success: function(data) {
											showCount(data);
										}
									});
								function formatNumber(num) {
									return num > 999 ? (num/1000).toFixed(1) + "K" : num
								}
								function showCount(responseText) {
									var json = responseText;console.log(json);
									if( typeof json.data[0].shares == "undefined" || json.data[0].shares == 0){
										return;
									}
									var count = formatNumber(json.data[0].shares);
  									jQuery(".fb-share-count").html("<img class=\'fb-quote-image\' src=\"'.$template_directory_uri.'/images/arrow-white.png\">"+count);
									jQuery(".fb-share-count").show();
								}
								</script>';
				break;
			case "4":
					$social_icons = '<div class="social-bar-mobile long">
										<a class="button-facebook" href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" target="_blank"><span class="icon"></span><content>Share This</content></a> <a class="button-twitter" href="https://twitter.com/home?status='.$title.' '.$url.'" target="_blank"><span class="icon"></span><content>Tweet This</content></a> 
									</div>';
				break;
			case "5":
					$social_icons = '<div class="social-bar-mobile">
										<a class="button-facebook" href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" target="_blank"><span class="icon"></span><content>Share<content></a> 
										<a class="button-twitter" href="https://twitter.com/home?status='.$title.' '.$url.'" target="_blank"><span class="icon"></span><content>Tweet</content></a> 
										<a class="button-whatsapp" href="whatsapp://send?text='.$title.' '.$url.'"><span class="icon"></span><content>Share</content></a>
									</div>';
				break;
			case "7":
					$social_icons = '<div class="social-bar-desktop long">
										<div id="fb_content_24" class="hide">
											<div class="share_buttons customPostWrapper" style="margin-top:5px">
												<table border="0" style="width:100%">
													<tbody>
														<tr>
															<td id="twitter_btn">
																<a class="pw-button-twitter">
																	<div class="btn_share btn_twitter">
																		<img src="'.$template_directory_uri.'/images/icon_twitter.png" border="0" width="16" style="margin-right:4px"> Share on Twitter 
																	</div>
																</a>	
															</td>
															<td id="spacer_btn">&nbsp;</td>
															<td id="fb_btn">
																<a class="pw-button-facebook">
																	<div class="btn_share btn_fb">
																		<img src="'.$template_directory_uri.'/images/icon_fb.png" border="0" width="16" style="margin-right:4px"> Share on Facebook
																	</div>
																</a>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>';
					$social_icons .= "
									<script>
									(function () {
									var s = document.createElement('script');
									s.type = 'text/javascript';
									s.async = true;
									s.src = ('https:' == document.location.protocol ? 'https://s' : 'http://i')
									+ '.po.st/share/script/post-widget.js#publisherKey=".$post_publisher_key."';
									var x = document.getElementsByTagName('script')[0];
									x.parentNode.insertBefore(s, x);
									})();
									</script>";
				break;
			case "9":
					$social_icons = '<div class="post-share">
									<!-- BEGIN Social Po.st Widget left floating -->
										<div class="pw-widget pw-layout-vertical pw-size-medium pw-counter-vertical" style="margin-bottom:8px;width: 49px;margin-left: auto;margin-right: auto;">
									        <a class="pw-button-facebook-like"></a>
									        <a class="pw-button-facebook look-native pw-counter-none" style="left:6px !important; position:relative !important; width:48px !important"></a>
									        <a class="pw-button-twitter look-native"></a>
									    </div>
									<!-- END Social Po.st Widget left floating -->										
									</div>';
				break;
			case "10":
					$social_icons = '<!-- BEGIN Po.st Social Widget Above Title -->
								    <div id="fb_content_25" class="hide">
								       <div class="pw-widget" style="margin-bottom:8px;margin-left: auto;margin-right: auto;" pw:url="" pw:title="">
								            <a class="pw-button button-type-square pw-size-small pw-button-facebook">
								                <span class="pw-icon-holder"></span>
								                <span class="pw-share pw-share-facebook">Share</span>
								            </a>
								            <a class="pw-button button-type-square pw-size-small pw-button-googleplus">
								                <span class="pw-icon-holder"></span>
								                <span class="pw-share pw-share-googleplus">Share</span>       
								            </a>
								            <a class="pw-button button-type-square pw-size-small pw-button-twitter">
								                <span class="pw-icon-holder"></span>
								                <span class="pw-share pw-share-twitter">Tweet</span>       
								            </a>
								            <a class="pw-button button-type-square pw-size-small pw-button-pinterest">
								                <span class="pw-icon-holder"></span>
								                <span class="pw-share pw-share-pinterest">Pin</span>       
								            </a>
								        </div>
								    </div>

								    <script type="text/javascript">
								    var pwidget_config = {
								        publisherKey:"'.$post_publisher_key.'",
								        copypaste: false,
								        shareQuote:false,
								        defaults:{
								            stickyPopup:true,
								            services: {
								                twitter:{
								                    via: "'.$site_name.'"
								                }
								            }
								        }
								    };

								    (function(){
								        var pw_twitter_title = jQuery(\'meta[property="og:title"]\').attr(\'content\');
								        jQuery(\'.pw-widget\').attr("pw:title", pw_twitter_title);
								        var pw_twitter_url = jQuery(\'meta[property="og:url"]\').attr(\'content\');
								        jQuery(\'.pw-widget\').attr("pw:url", pw_twitter_url);
								    })();

								    jQuery(document).ready(function(){
								        jQuery(\'#fb_content_25\').removeClass(\'hide\');
								    });
								    </script>
								            <!--END Social Po.st Widget above Title-->';
				break;
		}
		if ($instance['share_type'] > 7)
		{
			$social_icons .= "
							<script>
							(function () {
							var s = document.createElement('script');
							s.type = 'text/javascript';
							s.async = true;
							s.src = ('https:' == document.location.protocol ? 'https://s' : 'http://i')
							+ '.po.st/static/v3/post-widget.js#publisherKey=".$post_publisher_key."';
							var x = document.getElementsByTagName('script')[0];
							x.parentNode.insertBefore(s, x);
							})();
							</script>";
		}
		echo $social_icons;
	}

	/**
	 * Handle Widget Form
	 *
	 * @see WP_Widget::form
	 */
	function form($instance) {
		
		/* Set up some default widget settings. */
		$defaults = array( 
			'share_type'		=> '1',
			'title'					=> ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$share_type    	= esc_attr($instance['share_type']);
		$title 					= esc_attr($instance['title']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('share_type'); ?>">
				Share Type
			<label>
			<select class="widefat" id="<?php echo $this->get_field_id('share_type'); ?>" name="<?php echo $this->get_field_name('share_type'); ?>" onchange="jQuery('#<?php echo $this->get_field_id('title'); ?>').val(jQuery(this).find('option:selected').text())">
					<option value="9" <?= ($share_type==9)?'selected':''; ?>>Desktop - Left floater (po.st)</option>
					<option value="1" <?= ($share_type==1)?'selected':''; ?>>Desktop - Google, Facebook, Twitter, Pinterest</option>
					<option value="10" <?= ($share_type==10)?'selected':''; ?>>Desktop - Google, Facebook, Twitter, Pinterest (po.st)</option>
					<option value="2" <?= ($share_type==2)?'selected':''; ?>>Desktop - Facebook Twitter</option>
					<option value="7" <?= ($share_type==7)?'selected':''; ?>>Desktop - Facebook Twitter (po.st)</option>
					<option value="3" <?= ($share_type==3)?'selected':''; ?>>Desktop - Facebook with count</option>
					<option value="8" <?= ($share_type==8)?'selected':''; ?>>Desktop - Facebook with count (po.st)</option>
					<option value="4" <?= ($share_type==4)?'selected':''; ?>>Mobile - Facebook Twitter</option>
					<option value="5" <?= ($share_type==5)?'selected':''; ?>>Mobile - Facebook Twitter Whatsapp</option>
					<option value="6" <?= ($share_type==6)?'selected':''; ?>>Mobile - Google, Facebook, Twitter, Pinterest</option>
			</select>
			<input class="widefat" type="hidden" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<?php
	}
}

function social_icons_shortcode( $atts, $content = null)
{
	extract( shortcode_atts( array(
			'share_type'                 => ''
			), $atts 
		) 
	);

	ob_start();
	the_widget('Social_Icons',$atts);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'social_icons', 'social_icons_shortcode');