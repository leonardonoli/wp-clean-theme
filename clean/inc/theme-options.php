<?php
// create custom plugin settings menu
add_action('admin_menu', 'clean_create_menu');

function clean_create_menu() {

	//create new top-level menu
	add_menu_page('Clean Theme Settings', 'Clean Settings', 'administrator', __FILE__, 'clean_settings_page',get_template_directory_uri().'/images/icon.jpg');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'clean-settings-group', 'clicky_id' );
	register_setting( 'clean-settings-group', 'clicky_include' );
	register_setting( 'clean-settings-group', 'content_loading_animation' );
	register_setting( 'clean-settings-group', 'content_loading_delay' );
	register_setting( 'clean-settings-group', 'content_loading_display_desktop' );
	register_setting( 'clean-settings-group', 'content_loading_display_mobile' );
    register_setting( 'clean-settings-group', 'facebook_app_id' );
	register_setting( 'clean-settings-group', 'facebook_likebox_delay' );
	register_setting( 'clean-settings-group', 'facebook_page_url' );
	register_setting( 'clean-settings-group', 'facebook_likebox_display' );
	register_setting( 'clean-settings-group', 'fav_icon' );
	register_setting( 'clean-settings-group', 'google_analytics_id' );
	register_setting( 'clean-settings-group', 'google_analytics_include' );
	register_setting( 'clean-settings-group', 'post_publisher_key' );
	register_setting( 'clean-settings-group', 'quantcast_id' );
	register_setting( 'clean-settings-group', 'quantcast_include' );
	register_setting( 'clean-settings-group', 'site_logo' );
}

function clean_settings_page() {
?>
<style type="text/css">
/************/
/* Back-End */
/************/

.block-sections td {
	padding: 10px;
	text-align: center;
	width: 100px;
	box-sizing: border-box;
}
.settings_container {
	width:50%;text-align:left;display: inline-block;float:left;padding:10px;box-sizing:border-box;
}
</style>
<div class="wrap">
<<<<<<< HEAD
<h1>Clean Theme Settings</h1>
=======
<h2>Clean Theme</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'clean-settings-group' ); ?>
    <?php do_settings_sections( 'clean-settings-group' ); ?>
    <table class="form-table">
    	<tr>
    	<th scope="row" colspan="2"><hr /><h3>Content Delay Settings</h3></th>
    	</tr>
        <tr valign="top">
        <th scope="row">Loading animations</th>
        <td>
        	<table class="block-sections">
        		<tr>
        			<td><img src="<?= get_template_directory_uri()."/images/482.gif"; ?>" /></td>
        			<td><img src="<?= get_template_directory_uri()."/images/103.gif"; ?>" /></td>
        			<td><img src="<?= get_template_directory_uri()."/images/89.gif"; ?>" /></td>
        			<td><img src="<?= get_template_directory_uri()."/images/728.gif"; ?>" /></td>
        		</tr>
        		<tr>
        			<td><input type="radio" name="content_loading_animation" value="<?= get_template_directory_uri()."/images/482.gif"; ?>" <?= (esc_attr(get_option('content_loading_animation'))==get_template_directory_uri()."/images/482.gif")?'checked':''; ?>/></td>
        			<td><input type="radio" name="content_loading_animation" value="<?= get_template_directory_uri()."/images/103.gif"; ?>" <?= (esc_attr(get_option('content_loading_animation'))==get_template_directory_uri()."/images/103.gif")?'checked':''; ?>/></td>
        			<td><input type="radio" name="content_loading_animation" value="<?= get_template_directory_uri()."/images/89.gif"; ?>" <?= (esc_attr(get_option('content_loading_animation'))==get_template_directory_uri()."/images/89.gif")?'checked':''; ?>/></td>
        			<td><input type="radio" name="content_loading_animation" value="<?= get_template_directory_uri()."/images/728.gif"; ?>" <?= (esc_attr(get_option('content_loading_animation'))==get_template_directory_uri()."/images/728.gif")?'checked':''; ?>/></td>
        		</tr>
        	</table>
        </td>
        <tr valign="top">
        <th scope="row">Image Delay</th>
        <td><input type="text" name="content_loading_delay" size=4 maxlength=4 value="<?php echo esc_attr( get_option('content_loading_delay') ); ?>" /> <i>In seconds</i></td>
        </tr>
        <tr valign="top">
        <th scope="row">Use Content Delay feature on desktop</th>
        <td><input type="checkbox" name="content_loading_display_desktop" value="true" <?php if (get_option('content_loading_display_desktop')) { echo "checked"; } ?> /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Use Content Delay feature on mobile</th>
        <td><input type="checkbox" name="content_loading_display_mobile" value="true" <?php if (get_option('content_loading_display_mobile')) { echo "checked"; } ?> /><?php submit_button(); ?></td>
        </tr>
    	<tr>
    	<th scope="row" colspan="2"><hr /><h3>Facebook Settings</h3></th>
    	</tr>
        <tr valign="top">
        <th scope="row">Facebook App ID</th>
        <td><input type="text" name="facebook_app_id" value="<?php echo esc_attr( get_option('facebook_app_id') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Facebook Page Url</th>
        <td><input type="text" name="facebook_page_url" value="<?php echo esc_attr( get_option('facebook_page_url') ); ?>" class="regular-text code" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Facebook Likebox Delay</th>
        <td><input type="text" name="facebook_likebox_delay" size=4 maxlength=4 value="<?php echo esc_attr( get_option('facebook_likebox_delay') ); ?>" /> <i>In seconds</i></td>
        </tr>
        <tr valign="top">
        <th scope="row">Display Facebook Likebox</th>
        <td><input type="checkbox" name="facebook_likebox_display" value="true" <?php if (get_option('facebook_likebox_display')) { echo "checked"; } ?> /><?php submit_button(); ?></td>
        </tr>
    	<tr>
    	<th scope="row" colspan="2"><hr /><h3>Google Analytics</h3></th>
    	</tr>
        <tr valign="top">
        <th scope="row">Google Analytics ID</th>
        <td><input type="text" name="google_analytics_id" value="<?php echo esc_attr( get_option('google_analytics_id') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Include Google Analytics</th>
        <td><input type="checkbox" name="google_analytics_include" value="true" <?php if (get_option('google_analytics_include')) { echo "checked"; } ?> /><?php submit_button(); ?></td>
        </tr>
    	<tr>
    	<th scope="row" colspan="2"><hr /><h3>Clicky</h3></th>
    	</tr>
        <tr valign="top">
        <th scope="row">Clicky ID</th>
        <td><input type="text" name="clicky_id" value="<?php echo esc_attr( get_option('clicky_id') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Include Clicky</th>
        <td><input type="checkbox" name="clicky_include" value="true" <?php if (get_option('clicky_include')) { echo "checked"; } ?> /><?php submit_button(); ?></td>
        </tr>
    	<tr>
    	<th scope="row" colspan="2"><hr /><h3>Quantcast</h3></th>
    	</tr>
        <tr valign="top">
        <th scope="row">Quantcast ID</th>
        <td><input type="text" name="quantcast_id" value="<?php echo esc_attr( get_option('quantcast_id') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Include Quantcast</th>
        <td><input type="checkbox" name="quantcast_include" value="true" <?php if (get_option('quantcast_include')) { echo "checked"; } ?> /><?php submit_button(); ?></td>
        </tr>
    	<tr>
    	<th scope="row" colspan="2"><hr /><h3>Po.st</h3></th>
    	</tr>
        <tr valign="top">
        <th scope="row">Publisher Key</th>
        <td><input type="text" name="post_publisher_key" value="<?php echo esc_attr( get_option('post_publisher_key') ); ?>" /><?php submit_button(); ?></td>
        </tr>
    	<tr>
    	<th scope="row" colspan="2"><hr /></th>
    	</tr>
    </table>
>>>>>>> Added device support for content delay

<form method="post" action="options.php" >
	<?php settings_fields( 'clean-settings-group' ); ?>
	<?php do_settings_sections( 'clean-settings-group' ); ?>
	<div class="column c2">
		<div class="section">
			<div class="section-heading">Site Settings</div>
			<div class="row">
				<div class="settings_container">
					<table border=0 style="width: 100%">
						<tr>
							<td>
								<span class="section-label" style="width:auto;">Logo</span>
							</td>
							<td>
								<input type="text" name="site_logo" value="<?php echo esc_attr( get_option('site_logo') ); ?>" style="width:100%" />
							</td>
						</tr>
						<tr>
							<td colspan=2 style="text-align:center">
								<?php if(empty(esc_attr( get_option('site_logo') ))) { $logo = "http://placehold.it/250x100"; }else{ $logo = esc_attr( get_option('site_logo') ); } ?>
								<img src="<?= $logo ?>" style="width:250px" />
							</td>
						</tr>
					</table>
				</div>
				<div class="settings_container">
					<table border=0 style="width: 100%">
						<tr>
							<td>
								<span class="section-label" style="width:auto;">Fav Icon</span>
							</td>
							<td>
								<input type="text" name="fav_icon" value="<?php echo esc_attr( get_option('fav_icon') ); ?>" style="width:100%" />
							</td>
						</tr>
						<tr>
							<td colspan=2 style="text-align:center">
								<?php if(empty(esc_attr( get_option('fav_icon') ))) { $icon = "http://placehold.it/40x40"; }else{ $icon = esc_attr( get_option('fav_icon') ); } ?>
								<img src="<?= $icon ?>" style="width:40px" />
							</td>
						</tr>
					</table>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
		<div class="section">
			<div class="section-heading">Facebook Settings</div>
			<div class="row">
				<div class="section-label">Facebook App ID</div>
				<div class="section-content">
					<input type="text" name="facebook_app_id" value="<?php echo esc_attr( get_option('facebook_app_id') ); ?>" />
				</div>
			</div>
			<div class="row">
				<div class="section-label">Facebook Page Url</div>
				<div class="section-content">
					<input type="text" name="facebook_page_url" value="<?php echo esc_attr( get_option('facebook_page_url') ); ?>" class="regular-text code" />
				</div>
			</div>
			<div class="row">
				<div class="section-label">Facebook Likebox Delay</div>
				<div class="section-content">
					<input type="text" name="facebook_likebox_delay" size=4 maxlength=4 value="<?php echo esc_attr( get_option('facebook_likebox_delay') ); ?>" /> <i>In seconds</i>
				</div>
			</div>
			<div class="row">
				<div class="section-label">Display Facebook Likebox</div>
				<div class="section-content">
					<input type="checkbox" name="facebook_likebox_display" value="true" <?php if (get_option('facebook_likebox_display')) { echo "checked"; } ?> /><?php submit_button(); ?>
				</div>
			</div>
		</div>
		<div class="section">
			<div class="section-heading">Analytics</div>
			<div class="row">
				<div class="section-label">Google Analytics ID</div>
				<div class="section-content">
					<input type="text" name="google_analytics_id" value="<?php echo esc_attr( get_option('google_analytics_id') ); ?>" />
				</div>
			</div>
			<div class="row">
				<div class="section-label">Include Google Analytics</div>
				<div class="section-content">
					<input type="checkbox" name="google_analytics_include" value="true" <?php if (get_option('google_analytics_include')) { echo "checked"; } ?> />
				</div>
			</div>
			<div class="row">
				<hr />
				<div class="section-label">Clicky ID</div>
				<div class="section-content">
					<input type="text" name="clicky_id" value="<?php echo esc_attr( get_option('clicky_id') ); ?>" />
				</div>
			</div>
			<div class="row">
				<div class="section-label">Include Clicky</div>
				<div class="section-content">
					<input type="checkbox" name="clicky_include" value="true" <?php if (get_option('clicky_include')) { echo "checked"; } ?> />
				</div>
			</div>
			<div class="row">
				<hr />
				<div class="section-label">Quantcast ID</div>
				<div class="section-content">
					<input type="text" name="quantcast_id" value="<?php echo esc_attr( get_option('quantcast_id') ); ?>" />
				</div>
			</div>
			<div class="row">
				<div class="section-label">Include Quantcast</div>
				<div class="section-content">
					<input type="checkbox" name="quantcast_include" value="true" <?php if (get_option('quantcast_include')) { echo "checked"; } ?> /><?php submit_button(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="column c2">
		<div class="section">
			<div class="section-heading">Image Optimization</div>
			<div class="row">
				<div class="section-label">Retroactive Optimization</div>
				<div class="section-content">
					<button type="button" onclick="load_images()" class="button button-primary" id="optimize-button">Optimize</button>
				</div>
				<div id="response">
					<table id="image_optimization_list" cellspacing="0">
						<thead>
							<tr>
								<th class="long">File</th>
								<th class="small">Uncompressed</th>
								<th class="small">Compressed</th>
							</tr>
							<tr>
								<td colspan="3" style="text-align: center">Processed <span id="done">0</span> images</td>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
								<td></td><td></td><td></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="section">
			<div class="section-heading">Content Delay Settings</div>
			<div class="row">
				<div class="section-label">Loading animations</div>
				<div class="section-content">
					<table class="block-sections">
						<tr>
							<td><img src="<?= get_template_directory_uri()."/images/482.GIF"; ?>" /></td>
							<td><img src="<?= get_template_directory_uri()."/images/103.GIF"; ?>" /></td>
							<td><img src="<?= get_template_directory_uri()."/images/89.GIF"; ?>" /></td>
							<td><img src="<?= get_template_directory_uri()."/images/728.GIF"; ?>" /></td>
						</tr>
						<tr>
							<td><input type="radio" name="content_loading_animation" value="<?= get_template_directory_uri()."/images/482.GIF"; ?>" <?= (esc_attr(get_option('content_loading_animation'))==get_template_directory_uri()."/images/482.GIF")?'checked':''; ?>/></td>
							<td><input type="radio" name="content_loading_animation" value="<?= get_template_directory_uri()."/images/103.GIF"; ?>" <?= (esc_attr(get_option('content_loading_animation'))==get_template_directory_uri()."/images/103.GIF")?'checked':''; ?>/></td>
							<td><input type="radio" name="content_loading_animation" value="<?= get_template_directory_uri()."/images/89.GIF"; ?>" <?= (esc_attr(get_option('content_loading_animation'))==get_template_directory_uri()."/images/89.GIF")?'checked':''; ?>/></td>
							<td><input type="radio" name="content_loading_animation" value="<?= get_template_directory_uri()."/images/728.GIF"; ?>" <?= (esc_attr(get_option('content_loading_animation'))==get_template_directory_uri()."/images/728.GIF")?'checked':''; ?>/></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="section-label">Image Delay</div>
				<div class="section-content">
					<input type="text" name="content_loading_delay" size=4 maxlength=4 value="<?php echo esc_attr( get_option('content_loading_delay') ); ?>" /> <i>In seconds</i>
				</div>
			</div>
			<div class="row">
				<div class="section-label">Use Image Delay Feature on desktop</div>
				<div class="section-content">
					<input type="checkbox" name="content_loading_display_desktop" value="true" <?php if (get_option('content_loading_display_desktop')) { echo "checked"; } ?> /><?php submit_button(); ?>
				</div>
			</div>
			<div class="row">
				<div class="section-label">Use Image Delay Feature on mobile</div>
				<div class="section-content">
					<input type="checkbox" name="content_loading_display_mobile" value="true" <?php if (get_option('content_loading_display_mobile')) { echo "checked"; } ?> /><?php submit_button(); ?>
				</div>
			</div>
		</div>
		<div class="section">
			<div class="section-heading">Po.st</div>
			<div class="row">
				<div class="section-label">Publisher Key</div>
				<div class="section-content">
					<input type="text" name="post_publisher_key" value="<?php echo esc_attr( get_option('post_publisher_key') ); ?>" /><?php submit_button(); ?>
				</div>
			</div>
		</div>
	</div>
</form>
</div>
<script type="text/javascript">
	var processed_mages;
	function load_images()
	{
		jQuery("#optimize-button").html("Optimization started");
		var data = {
			'action': 'optimizible_list'
		};
		// We can also pass the url value separately from ajaxurl for front end AJAX implementations
		jQuery.post('<?= admin_url( 'admin-ajax.php' ); ?>', data, function(response) {
			var contents = jQuery.parseJSON(response);
			navigate_file_tree(contents);
			jQuery("#done").html(0);
			jQuery("#image_optimization_list>tbody").html('');
		});
	}
	
	var stop = 0;
	function navigate_file_tree(contents) {
		for (var key in contents)
		{
			if (contents[key]['filetype']=='dir')
			{
					var data = {
						'action': 'optimizible_list',
						'dir_path': key 
					};
					// We can also pass the url value separately from ajaxurl for front end AJAX implementations
					jQuery.post('<?= admin_url( 'admin-ajax.php' ); ?>', data, function(response) {
						var contents = jQuery.parseJSON(response);
						navigate_file_tree(contents);
					});
			}
			else
			{
				var data = {
					'action': 'optimize_image',
					'file_path' : key
				};
				jQuery.post('<?= admin_url( 'admin-ajax.php' ); ?>', data, function(response) {
					var site_data = jQuery.parseJSON(response);
					var row = '<tr><td>'+site_data['file_path']+'</td><td style="text-align: right">'+site_data['previous_size']+'</td><td style="text-align: right">'+site_data['new_size']+'</td></tr>';
					jQuery("#image_optimization_list>tbody").prepend(row);
					jQuery("#done").html(parseFloat(jQuery("#done").text())+1);
				});
			}
		}		
	}
</script>
<?php } ?>