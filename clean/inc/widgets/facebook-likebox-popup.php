<?php
function facebook_likebox_popup($single_post=false)
{
	$facebook_page_url = esc_attr( get_option('facebook_page_url') );
	$facebook_likebox_display = esc_attr( get_option('facebook_likebox_display') );
	$facebook_likebox_delay = esc_attr( get_option('facebook_likebox_delay') );
	$continue = false;
	if (!isset($_COOKIE['ti']))
		setcookie('ti', time(), strtotime('+1 day'),'/');
	else
	{
		if ((time()-$_COOKIE['ti'])>$facebook_likebox_delay) 
		{
			$continue = true;
		}
	}
	if ($facebook_likebox_display==true && !isset($_COOKIE['fblb']) && $continue)
	{
		setcookie('fblb', 'displayed', strtotime('+1 month'),'/');
	?>
	<div id="facebook-likebox-container">
		<table>
			<tr>
				<td>
					<div id="facebook-likebox-block">
						<div id="facebook-likebox-close"></div>
						<div id="facebook-likebox-iframe" class="fb-page" data-href="<?= $facebook_page_url; ?>"data-hide-cover="false" data-height="350" data-width="500" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?= $facebook_page_url; ?>"><a href="<?= $facebook_page_url; ?>"></a></a></blockquote></div></div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<?php
	}
}
?>