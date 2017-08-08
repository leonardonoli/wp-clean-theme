<?php

ini_set('memory_limit','512M');

global $template_directory_uri;
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */

/**
 * Include the theme plugins
 */
require_once("internal-content.php");
require_once("social-icons.php");
require_once("super-empty-widget.php");
require_once("section-heading.php");
require_once("ad-splitter.php");
require_once("padding-widget.php");
require_once("advertisement-notice.php");
require_once("pagination.php");
require_once("tinymce-pagebreak.php");
require_once("facebook-likebox-popup.php");
require_once("facebook-likebox-widget.php");
require_once("bottom-anchor.php");
require_once("desktop-popup-controller.php");
require_once("horizontal-divider.php");
require_once("popup-generator.php");

add_action( 'widgets_init', 'clean_widgets_init' );
add_action( 'widgets_init', function(){
	 register_widget( 'Internal_Widget' );
	 register_widget( 'Social_Icons' );
	 register_widget( 'Super_Empty_Widget' );
	 register_widget( 'Section_Heading' );
	 register_widget( 'Ad_Splitter' );
	 register_widget( 'Padding_Widget' );
	 register_widget( 'Advertisement_Notice' );
	 register_widget( 'Bottom_Anchor' );
	 register_widget( 'Facebook_Likebox_Widget' );
	 register_widget( 'Desktop_Popup_Controller' );
	 register_widget( 'Horizontal_Divider' );
	 register_widget( 'Popup_Generator' );
});
wp_enqueue_style( 'internal-content-style', $template_directory_uri."/inc/widgets/style.css" );

// Load cookie manager scripts
wp_enqueue_script('cookie-js-script', $template_directory_uri.'/js/cookie.min.js',true);
wp_enqueue_script('cookie-setter-script', $template_directory_uri.'/js/cookie.setter.js',true);


/**
 * Add filters for widget areas
 */
class Widget_Sidebar_Manager {

	public function __construct() {
		add_action( 'load-widgets.php', array( $this, 'init_hooks' )  );
	}

	public function init_hooks() {
		global $template_directory_uri;
		add_action( 'widgets_admin_page', array( $this, 'sidebar_select' )  );
		add_action( 'admin_print_styles', array( $this, 'print_styles' ) );
		wp_enqueue_script( 'widget-manage-scripts', $template_directory_uri."/js/sidebar-filtering.js", array( 'jquery' ), '1.0.0', true );
	}

	public function print_styles() {
		?>
		<style type="text/css">
		#widget-sidebar-manage-wrap {
			/*float: right;*/
		}
		</style>
		<?php
	}

	public function sidebar_select() {
		global $wp_registered_sidebars;
		?>
		<div id="widget-sidebar-manage-wrap" class="widget-liquid-right">
			<select id="widget-sidebar-manage-device" name="widget-sidebar-manage-utm" >
				<option value="">Filter Device</option>
				<option value="desktop">Desktop</option>
				<option value="mobile">Mobile</option>
			</select>
			<select id="widget-sidebar-manage-utm" name="widget-sidebar-manage-utm">
				<option value="">Filter UTM</option>
				<option value="utm">UTM</option>
				<option value="no-utm">No UTM</option>
			</select>
			<div style="clear:both;"></div>
		</div>
		<?php
	}
}
new Widget_Sidebar_Manager();

function clean_widgets_init() {
	register_sidebar( array(
		'name'          => 'Desktop - In HEAD',
		'id'            => 'desktop-in-head',
		'class'			=> 'desktop utm no-utm',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Top next to logo | Any UTM',
		'id'            => 'desktop-next-to-logo',
		'class'			=> 'desktop utm',
		'before_widget' => '<div class="ad-unit ad_top_right">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Top next to logo | No UTM',
		'id'            => 'desktop-next-to-logo-no-utm',
		'class'			=> 'desktop no-utm',
		'before_widget' => '<div class="ad-unit ad_top_right">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Home Above Content',
		'id'            => 'desktop-home-above-content',
		'class'			=> 'desktop utm no-utm',
		'before_widget' => '<div class="ad-unit ad_top_right">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Above content',
		'id'            => 'desktop-above-content',
		'class'			=> 'desktop utm no-utm',
		'before_widget' => '<div class="ad-unit ad_content_top">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Above pagination | Any UTM',
		'id'            => 'desktop-above-pagination',
		'class'			=> 'desktop utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Above pagination | No UTM',
		'id'            => 'desktop-above-pagination-no-utm',
		'class'			=> 'desktop no-utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Below content | Any UTM',
		'id'            => 'desktop-below-content',
		'class'			=> 'desktop utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Below content | No UTM',
		'id'            => 'desktop-below-content-no-utm',
		'class'			=> 'desktop no-utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Sidebar | Any UTM',
		'id'            => 'desktop-sidebar',
		'class'			=> 'desktop utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Sidebar | No UTM',
		'id'            => 'desktop-sidebar-no-utm',
		'class'			=> 'desktop no-utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Before Closing BODY',
		'id'            => 'desktop-before-closing-body',
		'class'			=> 'desktop utm no-utm',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - End of Slideshow',
		'id'            => 'desktop-end-of-slideshow',
		'class'			=> 'desktop utm no-utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Desktop - Test',
		'id'            => 'desktop-test',
		'class'			=> 'desktop utm no-utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	/**
	 * Mobile areas
	 */
	 register_sidebar( array(
		'name'          => 'Mobile - In HEAD',
		'id'            => 'mobile-in-head',
		'class'			=> 'mobile utm no-utm',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => 'Mobile - Above Content',
		'id'            => 'mobile-above-content',
		'class'			=> 'mobile utm no-utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Mobile - In Pagination',
		'id'            => 'mobile-in-pagination',
		'class'			=> 'mobile utm no-utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Mobile - Above Pagination | Any UTM',
		'id'            => 'mobile-above-pagination',
		'class'			=> 'mobile utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Mobile - Above Pagination | No UTM',
		'id'            => 'mobile-above-pagination-no-utm',
		'class'			=> 'mobile no-utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Mobile - Below Content | Any UTM',
		'id'            => 'mobile-below-content',
		'class'			=> 'mobile utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Mobile - Below Content | No UTM',
		'id'            => 'mobile-below-content-no-utm',
		'class'			=> 'mobile no-utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Mobile - Before Closing BODY',
		'id'            => 'mobile-before-closing-body',
		'class'			=> 'mobile utm no-utm',
		'class'			=> 'mobile',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => 'Mobile - End of Slideshow',
		'id'            => 'mobile-end-of-slideshow',
		'class'			=> 'mobile utm no-utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Mobile - Test',
		'id'            => 'mobile-test',
		'class'			=> 'mobile utm no-utm',
		'before_widget' => '<div class="ad-unit">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="hidden">',
		'after_title'   => '</h1>',
	) );
}

/* End Desktop Widgets */

/**
*   [end_of_slideshow_content_widget_func]
*   JS Script for the End-Of-Slideshow widget
*/
function end_of_slideshow_content_widget_func( $atts ){
	$code = '<ul class="sidebar no-title desktop-eos"><script>document.write(load_widget("mobile-end-of-slideshow","desktop-end-of-slideshow"));</script></ul>';
	return $code;
}
add_shortcode( 'end_of_slideshow_content_widget', 'end_of_slideshow_content_widget_func' );

/**
*   Add the End-Of-Slideshow widget as an
*   extra page at the end of every post
*/
add_filter( 'the_posts', 'my_the_content_filter');
function my_the_content_filter( $content ) {

	if ( is_single() ){
		if(count($content)==1){
			$content[0]->post_content .= '<!--nextpage-->[end_of_slideshow_content_widget]';
		}
	}

	return $content;
}


/**
 * Add all widgets to a javascript array
 */
add_action('wp_head', 'initWidgetAreasJsPrint');
function initWidgetAreasJsPrint(){
    // getAjaxWidgetAreas() needs to be defined inside each theme's functions.php
    // and it should return an array of strings of the widget areas' ids
    ?>
    <script type="text/javascript" >
    	var ajaxUnit = new Array;
    	var widgetAreaResponse = new Array;
    	var showWidget = cookie.get('showWidget','no-utm');
		<?php
    	$widgets = wp_get_widget_defaults();
	    foreach (wp_get_widget_defaults() as $key => $value)
		{
			if (is_active_sidebar($key))
			{
				ob_start();
				dynamic_sidebar($key);
				$sidebar = ob_get_contents();
				ob_end_clean();
				$sidebar = str_replace("\n","",$sidebar);
				$sidebar = str_replace("\t","",$sidebar);
				$sidebar = str_replace("\r","",$sidebar);
				$sidebar = str_replace("script","scr+ipt",$sidebar);
				$pattern = "|<ajax id=\"(.+?)\">([\.\$\^\{\[\(\|\)\]\}\*\+\?\"\_\s]*.*?)(<\/ajax>)|m";
				if (preg_match_all($pattern,$sidebar,$results))
				{
					for ($i=0;$i<count($results[1]);$i++)
					{
						$page = null;
						$code = str_ireplace("document.write(","postscribe('#".$results[1][$i]."',",$results[2][$i]);
						$id = $results[1][$i];
						if (strpos($id,'page="')!==false)
						{
							$page_pattern = "@\" page=\"(.+?)@";
							preg_match_all($page_pattern,$id,$page_results);
							$page = $page_results[1][0];
							$id = str_replace($page_results[0][0],'',$id);
						}
						$code = do_shortcode($code);
						$code = str_replace("\n","",$code);
						$code = str_replace("\t","",$code);
						$code = str_replace("\r","",$code);
						$code = str_replace("script","scr+ipt",$code);
						?>
						var widgetID = '<?= $key; ?>';
						if (widgetID.search('no-utm')==-1 && showWidget=="regular")
						{
							ajaxUnit.push({id:'<?= $id; ?>',code:'<?= addslashes ($code); ?>',page:'<?= $page; ?>'});							
						}
						if (widgetID.search('no-utm')>0 && showWidget=="no-utm")
						{
							ajaxUnit.push({id:'<?= $id; ?>',code:'<?= addslashes ($code); ?>',page:'<?= $page; ?>'});							
						}
						<?php
					}
				}else{
					// $
				}
			}
		}
	?>
    </script>
    <?php
	$positions = array();
	foreach (wp_get_widget_defaults() as $key => $value)
	{
		if (strpos($key,'no-utm')===false)
		{
			array_push($positions,$key);
		}
	}
    foreach($positions as $position){
        ob_start();
        dynamic_sidebar( $position );
        $regular[$position] = $noutm[$position] = ob_get_clean();
        if ( array_key_exists($position.'-no-utm',$widgets) ) {
            ob_start();
            dynamic_sidebar( $position.'-no-utm' );
            $noutm[$position] = ob_get_clean();
        }
    }
    ?>
    <script type="text/javascript" >
        if( showWidget == 'no-utm' ){
            widgetAreaResponse = <?= json_encode($noutm);?>;
        }else{
            widgetAreaResponse = <?= json_encode($regular);?>;
        }
    </script>
    <?php
}


add_action('wp_head', 'widget_script_loader');
/**
 * Load the script in charge of printing the widget areas
 */
function widget_script_loader()
{
	global $page;
?>
	<script type="text/javascript">	
	// Load widget dynamically for mobile and desktop
	// each one of the variables contain the id of their widget or blank
	function load_widget(mobile,desktop) {
		var width = parseFloat(jQuery(window).width());
		if (width<500 && mobile!='') { // You may replace this for a smaller or bigger resolution to be captured as mobile
			if( showWidget == 'regular' ){
				if (widgetAreaResponse[mobile].search("<~----~>")=="-1") {
					return widgetAreaResponse[mobile];
				}else{
					return split_response(widgetAreaResponse[mobile]);
				}
			}else{
				if (typeof widgetAreaResponse[mobile+"-no-utm"] !== 'undefined')
				{
					if (widgetAreaResponse[mobile+"-no-utm"].search("<~----~>")=="-1") {
						return widgetAreaResponse[mobile+"-no-utm"];
					}else{
						return split_response(widgetAreaResponse[mobile+"-no-utm"]);
					}
				}else{
					if (widgetAreaResponse[mobile].search("<~----~>")=="-1") {
						return widgetAreaResponse[mobile];
					}else{
						return split_response(widgetAreaResponse[mobile]);
					}
				}
			}
		}else if(width>501 && desktop!=''){

			if( showWidget == 'regular' ){
				if (widgetAreaResponse[desktop].search("<~----~>")=="-1") {
					return widgetAreaResponse[desktop];
				}else{
					return split_response(widgetAreaResponse[desktop]);
				}
			}else{
				if (typeof widgetAreaResponse[desktop+"-no-utm"] !== 'undefined')
				{
					if (widgetAreaResponse[desktop+"-no-utm"].search("<~----~>")=="-1") {
						return widgetAreaResponse[desktop+"-no-utm"];
					}else{
						return split_response(widgetAreaResponse[desktop+"-no-utm"]);
					}
				}else{
					if (widgetAreaResponse[desktop].search("<~----~>")=="-1") {
						return widgetAreaResponse[desktop];
					}else{
						return split_response(widgetAreaResponse[desktop]);
					}
				}
			}
		}else{
			return '';
		}
	}
	
	function split_response(widget) {
		var page = "<?= $page; ?>";
		var response = widget.match(/<~----~>(.*?[\s\S]*?)>!----!</g);
		if (page==="0")
		{
			page = 1;
		}
		for (i=0;i<response.length;i++)
		{
			if (typeof response[i] !== "undefined")
			{
				var conditional_widget = response[i].replace("<~----~>","").replace(">!----!<","");
				conditional_widget = conditional_widget.split("||");
				var new_response;
				if (conditional_widget[0]==page)
				{
					widget = widget.replace(response[i],conditional_widget[1]);
				}
				else
				{
					widget = widget.replace(response[i],"");
				}
			}
		}
		return widget;
	}
	</script>
<?php
}

/**
 * Resize an image to a specified maximum width or height
 * @param  string  $src     [Contains the path to the image]
 * @param  obj  $file    [Contains an image object]
 * @param  int $mwidth  [Contains the maximum width allowed]
 * @param  int $mheight [Contains the maximum height allowed]
 * @return obj $resized_image  [Contains the resized image object]
 */
function resize_image($src, $file, $mwidth, $mheight) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($width > $height)
    {
	    $newheight = $mwidth/$r;
	    $newwidth = $mwidth;
	    if ($mheight<600 && $newheight<$mheight)
	    {
		    $newheight = $mheight;
		    $newwidth = $mheight*$r;
	    }
    }
    else
    {
	    $newheight = $mheight;
	    $newwidth = $mheight*$r;
	    if ($mwidth<680 && $newwidth<$mwidth)
	    {
	    	$newheight = $mwidth/$r;
	    	$newwidth = $mwidth;
	    }
    }
    $resized_image = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($resized_image, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    return $resized_image;
}

function compress_image( $image_url, $type=null)
{
	switch ($type) {
		case 'sidebar-large':
				$mwidth = 300;
				$mheight = 225;
				$image_size = '-300x225';
			break;
		case 'content-adwall':
				$mwidth = 230;
				$mheight = 173;
				$image_size = '-230x173';
			break;
		case 'sidebar-list':
				$mwidth = 80;
				$mheight = 80;
				$image_size = '-80x80';
			break;
		default:
				$mwidth = 688;
				$mheight = 600;
				$image_size = '';
			break;
	}
	// Extract the image data (width, height, mime)
	$info = getimagesize($image_url); 

	$image_parts = explode("/",$image_url);

	// Extract the image name from the 
	$image_file = array_pop($image_parts);

	$image_name_parts = explode(".",$image_file);
	$image_ext = array_pop($image_name_parts);
	$image_name = implode(".",$image_name_parts);

	preg_match('@\/(\d\d\d\d)\/(\d\d)\/@',$image_url,$date);
	// Save the full file_path where the image is/will be saved
	$file_path = get_home_path().'wp-content/uploads/'.$date[1].'/'.$date[2].'/'.$image_name.$image_size.".".$image_ext;
	
	if ($info['mime'] == 'image/jpeg') 
	{
		// Create an image object out of the jpeg file
		$image = imagecreatefromjpeg($image_url); 

		// If the original image's width is wider than 688 pixes call function to resize
		if ($info[0]>$mwidth || $info[1]>$mheight)
			$image = resize_image( $image, $image_url, $mwidth, $mheight );

		// Create a new png image with medium compression out of the image object
		imagejpeg($image, $file_path, 90);
	}
	elseif ($info['mime'] == 'image/png') 
	{
		// Create an image object out of the png file
		$image = imagecreatefrompng($image_url);

		// If the original image's width is wider than 688 pixes call function to resize
		if ($info[0]>$mwidth || $info[1]>$mheight)
			$image = resize_image( $image, $image_url, $mwidth, $mheight );

		// Create a new png image with highest compression out of the image object
		imagepng($image, $file_path, 9, PNG_ALL_FILTERS);
	}
	
	return $file_path;
}

/**
 * Loads the uploaded image, compresses and resizes it to
 * a maximum of 688 pixels width or 600 pixels height
 * @param  int $post_ID [The resource ID for the uploaded image]
 * @return int $post_ID [The resource ID for the uploaded image]
 */
function process_uploaded_image( $post_ID ) 
{
	// Get the image url from the resource ID 
	$image_url = wp_get_attachment_image_src( $post_ID )[0];
	
	compress_image( $image_url );
    return $post_ID;
};
        
// add the filter
add_filter( 'add_attachment', 'process_uploaded_image', 10, 2 ); 
add_theme_support( 'post-thumbnails' );


/**
 * Retroactive image optimization
 */
add_action( 'wp_ajax_optimizible_list', 'get_optimizable_image_list' );
add_action( 'wp_ajax_optimize_image', 'send_images_to_optimize' );

/**
 * Prepares the file tree and report table for the optimized image list
 */
function get_optimizable_image_list() 
{
	global $wpdb; // this is how you get access to the database
	if (!isset($_POST['dir_path']))
		$starting_path = wp_upload_dir()['basedir'];
	else
		$starting_path = $_POST['dir_path'];
	
	$contents = extract_directory_contents($starting_path);
	echo json_encode($contents);
	wp_die(); // this is required to terminate immediately and return a proper response
}

/**
 * Cycles through the file tree sent to it and sends each image to the compress_image function
 * @param  array $contents [Contains the file tree]
 */
function send_images_to_optimize()
{
	$file_data = array();
	$file_path = $_POST['file_path'];
	
	$old_image_info = filesize($file_path);
	$file_data['file_path'] = str_replace(wp_upload_dir()['basedir'],"",stripslashes($file_path));
	$file_data['previous_size'] = ($old_image_info/1000)." kb";
	
	$image = compress_image($file_path);

	$new_image_info = filesize($file_path);
	$file_data['new_size'] = ($new_image_info/1000)." kb";
	
	$image_parts = explode("/",$file_path);
	// Extract the image name from the 
	$image_file = array_pop($image_parts);
	$image_name_parts = explode(".",$image_file);
	$image_ext = array_pop($image_name_parts);
	$image_name = implode(".",$image_name_parts);


	preg_match('@\/(\d\d\d\d)\/(\d\d)\/@',$file_path,$date);
	$file_root = wp_upload_dir()['baseurl'].'/'.$date[1].'/'.$date[2].'/'.$image_name.$image_size.".".$image_ext;
	$attachment_id = get_attachment_id_by_url($file_root);
	$metadata = wp_generate_attachment_metadata($attachment_id, $image);
	wp_update_attachment_metadata( $attachment_id,  $metadata );
	echo json_encode($file_data);
	wp_die(); // this is required to terminate immediately and return a proper response
}

/**
 * Retrieves a list of all files inside of the upload directory
 * @param  string $root_directory [The root directory where to start collection]
 * @return array $contents     [An array with the directory's contents]
 */
function extract_directory_contents($root_directory)
{
	global $images_to_optimize;
	$contents = array();
	$dir = opendir($root_directory);
	$file_count = 0;
	while (($file = readdir($dir)) !== false) 
	{
		$file_count++;
		if (substr($root_directory,-1)!="/")
		{
			$root_directory = $root_directory."/";
		}
		$file_path = $root_directory.$file;
		$file_type = filetype($file_path);
		if ($file_type == "dir")
		{
			if ($file_count>2) 
			{
				// $sub_contents = extract_directory_contents($file_path);
			}
			else
			{
				$sub_contents = "";
			}
			if (substr($file_path,-1)!="." && substr($file_path,-2)!="..")
			{
				$contents[$file_path] = array("filetype"=>$file_type,"contents"=>$sub_contents);
			}
		}
		else
		{
			preg_match('@(-(\d\d\d?\d?x\d\d\d?\d?))\.@',$file_path,$matches);
			$dimensions = $matches[2];
			$base_file = str_replace($matches[1],"",$file_path);
			$contents[$base_file]['file_path'] = $file_path;
			$contents[$base_file]['filetype'] = $file_type;
			if (!empty($dimensions))
			{
				$contents[$base_file]['dimensions'][] = $dimensions;
			}
		}
  }
	return $contents;
}

function get_attachment_id_by_url( $url ) {

	global $wpdb;
	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $url ) );
	// Returns null if no attachment is found
	return $attachment[0];
}

add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }

    return $title;

});
?>