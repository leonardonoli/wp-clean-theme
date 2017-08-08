<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package clean
 */
global $post, $stylesheet_directory_uri, $permalink, $thumbnail_uri, $title, $template_directory_uri, $site_logo, $favicon;
// Function found in themes/clean/inc/widgets/facebook_likebox_popup.php
facebook_likebox_popup(is_single());

parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $google_analytics_extra_keys);
if (!empty($_SERVER['QUERY_STRING']))
{
	setcookie('p',$_SERVER['QUERY_STRING'],time()+3600*24,'/',null);
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<script>
		var string = getValue();
		var url = location.href;
		if (url.search(/\?/)==-1 && string!=null)
		{
			url = url+"?"+string;
			window.history.pushState(null, null, url); // Change the addressbar url
		}
		function getValue()
		{
			var name = "p=";
			var ca = document.cookie.split(';');
			for(var i=0; i<ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1);
					if (c.indexOf(name) == 0) return decodeURIComponent(c.substring(name.length,c.length));
			}
			return null;
		}
	</script>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta http-equiv="Content-cache" content="public" />
<meta http-equiv="Expires" content="36000" />
<meta property="og:locale" content="en_US" />
<meta property="og:site_name" content="<?= bloginfo('name'); ?>" />
<meta property="og:title" content="<?= $post->post_title; ?>" />
<meta property="og:url" content="<?= $permalink; ?>" />
<meta property="og:type" content="<?= $post->post_type; ?>" />
<meta property="og:updated_time" content="<?= $post->post_modified; ?>" />
<meta property="og:description" content="<?= $post->post_excerpt; ?>" />
<meta property="og:image" content="<?= $thumbnail_uri; ?>" />
<meta property="article:published_time" content="<?= $post->post_date; ?>" />
<meta property="article:modified_time" content="<?= $post->post_modified; ?>" />
<script type="text/javascript" src="<?= $template_directory_uri; ?>/js/postscribe.min.js" async></script>
<script type="text/javascript" src="<?= $template_directory_uri; ?>/js/htmlParser.min.js" async></script>
<script type="text/javascript" src="<?= $template_directory_uri; ?>/js/navigation.js" async></script>
<script type="text/javascript" src="<?= $template_directory_uri; ?>/js/skip-link-focus-fix.js" async></script>
<?php wp_head(); ?>
<?php// Function declared in widgets/init?>
<script>document.write(load_widget('mobile-in-head','desktop-in-head'));</script>
<link rel="shortcut icon" href="<?= $favicon; ?>" type="image/x-icon" />  
<link rel="stylesheet" type="text/css" href="<?= $stylesheet_directory_uri; ?>/style.css" media="screen" />
</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<?php 
global $google_analytics_include;
if ($google_analytics_include==true)
{
	global $google_analytics_id; ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '<?= $google_analytics_id; ?>', 'auto');
  ga('send', 'pageview');

	ga('set', 'dimension1', '<?php echo $google_analytics_extra_keys['utm_content_id']; ?>');
	ga('set', 'dimension2', '<?php echo $google_analytics_extra_keys['utm_boost_id']; ?>');
	ga('set', 'dimension3', '<?php echo $google_analytics_extra_keys['utm_widget_id']; ?>');
	ga('set', 'dimension4', '<?php echo $google_analytics_extra_keys['utm_targeting']; ?>');
</script>
<?php
}
?>
<?php
if (!is_front_page())
{
 $meta = get_post_meta( get_the_ID(), 'google_analytics_experiment', true );
 echo $meta;
}
?>

<?php global $facebook_app_id; ?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=<?= $facebook_app_id; ?>&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Facebook Likebox -->
<script>
var close = false;
var x;
jQuery("#facebook-likebox-close").on("click",function(){
	jQuery("#facebook-likebox-container").hide();
	clearTimeout(x);
	if (close) {
		var date = new Date();
		date.setTime(date.getTime()+(7*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
		document.cookie = "fblb=true;"+expires+"; path=/";
	}
});
jQuery("#facebook-likebox-block").on('mouseenter',function(e){
	x = setTimeout(function(){close = true},500);
});	
</script>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'clean' ); ?></a>
	<header id="masthead" class="site-header full-content max-width center" role="banner">
		<div class="site-branding relative">
			<a href="http://<?= $_SERVER['SERVER_NAME']; ?>">
				<img class="logo_image" src="<?= $site_logo; ?>" />
			</a>
			<div class="logo-banner">
				<?php
				// Function declared in widgets/init
				if (strpos(strtolower($title),'test')===false)
				{
				?>
				<script>document.write(load_widget('','desktop-next-to-logo'));</script>
				<?php
				}
				?>
			</div>
		</div><!-- .site-branding -->
		<div class="clear"></div>
		<nav id="site-navigation" class="navigation_bar framed boxed bottom-border-orange" role="navigation">
			<div class="menu-toggle mobile-icon" aria-controls="primary-menu" aria-expanded="false"></div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<div id="content" class="site-content full-content max-width center">
