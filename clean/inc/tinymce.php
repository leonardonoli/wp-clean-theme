<?php
// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Image Title',  
			'classes' => 'image-title',
			'block' => 'p',  
			'wrapper' => false,
		),
		array(  
			'title' => 'One Sentece Summary',  
			'classes' => 'one-sentence-summary',
			'block' => 'p',  
			'wrapper' => false,
		),
		array(  
			'title' => 'Gallery Image',  
			'classes' => 'gallery-image',
			'block' => 'p',  
			'wrapper' => false,
		),
		array(  
			'title' => 'Image Source',  
			'classes' => 'image-source',
			'block' => 'p',  
			'wrapper' => false,
		),
		array(  
			'title' => 'Block Of Text',  
			'classes' => 'block-of-text',
			'block' => 'p',  
			'wrapper' => false,
		)
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );  

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');