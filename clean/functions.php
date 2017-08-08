<?php
/**
 * clean functions and definitions
 *
 * @package clean
 */

/* Global variables declaration */
$url = $_SERVER['REQUEST_URI'];
$post_id = url_to_postid( $url );
$content = get_post_field('post_content', $post_id);;
$title = get_the_title($post_id);
$tags = get_the_tags($post_id); 
$category = get_the_category($post_id);
$thumbnail = get_the_post_thumbnail( $post_id, 'medium', array('class'=>'image') );
$thumbnail_uri = wp_get_attachment_url( $thumbnail );
$permalink = get_the_permalink($post_id);
$template_directory = get_template_directory();
$stylesheet_uri = get_stylesheet_uri();
$stylesheet_directory_uri = get_stylesheet_directory_uri();
$template_directory_uri = get_template_directory_uri();

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'clean_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function clean_setup() {
	global $template_directory;
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on clean, use a find and replace
	 * to change 'clean' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'clean', $template_directory . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'clean' ),
		'fdooter' => __( 'Footer Disclaimers', 'clean' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'clean_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Register Shortcodes
	add_filter('widget_text', 'shortcode_unautop');
	add_filter('widget_ad_1', 'shortcode_unautop');
	add_filter('widget_ad_2', 'shortcode_unautop');
	add_filter('widget_text', 'do_shortcode');
	add_filter('widget_ad_1', 'do_shortcode');
	add_filter('widget_ad_2', 'do_shortcode');

	/**
	 * Image and thumbnail settings
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'sidebar-large', 300, 225, true ); // Hard Crop 
	add_image_size( 'content-adwall', 230, 173, true ); // Hard Crop 
	add_image_size( 'sidebar-list', 80, 80, true ); // Hard Crop 
}
endif; // clean_setup
add_action( 'after_setup_theme', 'clean_setup' );


/**
 * Enqueue scripts and styles.
 */
function clean_scripts() {
	global $stylesheet_uri, $template_directory_uri;
	wp_enqueue_style( 'clean-style', $stylesheet_uri );
	wp_enqueue_script( 'jquery' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clean_scripts' );

/**
 * Custom Settings
 */
update_option('image_default_link_type','none'); // Don't add link to images by default

/**
 * Implement the Custom Header feature.
 */
//require $template_directory . '/inc/custom-header.php'; 

/**
 * Custom template tags for this theme.
 */
require $template_directory . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require $template_directory . '/inc/extras.php';

/**
 * TinyMCE Customizations.
 */
require $template_directory . '/inc/tinymce.php';

/**
 * Widgets Initializer.
 */
require $template_directory . '/inc/widgets/init.php';


/**
 * Update Notifications.
 */
require $template_directory . '/inc/update_notifier.php';

/**
 * Widgets Initializer.
 */
require $template_directory . '/inc/theme-options.php';

/**
 * Plugin required script.
 */
require $template_directory . '/class-tgm-plugin-activation.php';


/**
 * Remove links from post images
 * @param  string content
 * @return string content
 */
add_filter( 'the_content', 'attachment_image_link_remove_filter' ); 
function attachment_image_link_remove_filter( $content ) 
{ 
	$content = preg_replace( array('{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}', '{ wp-image-[0-9]*" /></a>}'), array('<img','" />'), $content ); 
	return $content; 
}

add_filter( 'the_content', 'content_delay_filter' ); 
function content_delay_filter( $content ) 
{ 
	global $page, $numpages;
	if (((!wp_is_mobile() && esc_attr( get_option('content_loading_display_desktop'))) || (wp_is_mobile() && esc_attr( get_option('content_loading_display_mobile')))) && $numpages != $page)
	{
		$content_loading_animation = esc_attr( get_option('content_loading_animation') );
		$content = '<div id="content-block">'.$content;
		$content .= '</div><div id="loader"><img src="'.$content_loading_animation.'" alt="Loading content" /></div>'; 
	}
	return $content; 
}

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_meta_box() 
{
    $screens = array( 'post' );
    foreach ( $screens as $screen ) 
    {
            add_meta_box(
                    'myplugin_sectionid',
                    __( 'Google Analytics Experiment Code', 'myplugin_textdomain' ),
                    'myplugin_meta_box_callback',
                    $screen,
                    'side'
            );
    }
}

add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_save_meta_box_data', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'google_analytics_experiment', true );

	echo "<br />";
	echo '<textarea id="myplugin_new_field" name="myplugin_new_field" rows=10 style="width: 100%;">' . esc_attr( $value ) . '</textarea>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['myplugin_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data =  $_POST['myplugin_new_field'];

	// Update the meta field in the database.
	update_post_meta( $post_id, 'google_analytics_experiment', $my_data );
}
add_action( 'save_post', 'myplugin_save_meta_box_data' );
/**
 * Front end variables
 */
$site_logo = esc_attr( get_option('site_logo') );
$favicon = esc_attr( get_option('fav_icon') );
$facebook_app_id = esc_attr( get_option('facebook_app_id') );
$google_analytics_id = esc_attr( get_option('google_analytics_id') );
$google_analytics_include = esc_attr( get_option('google_analytics_include') );
$clicky_id = esc_attr( get_option('clicky_id') );
$clicky_include = esc_attr( get_option('clicky_include') );
$quantcast_id = esc_attr( get_option('quantcast_id') );
$quantcast_include = esc_attr( get_option('quantcast_include') );
$post_publisher_key = esc_attr( get_option('post_publisher_key') );
$content_loading_delay = esc_attr( get_option('content_loading_delay') );
$content_loading_display_mobile = esc_attr( get_option('content_loading_display_mobile') );
$content_loading_display_desktop = esc_attr( get_option('content_loading_display_desktop') );
